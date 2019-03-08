<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Crawler;
use App\Models\Emoji;
use App\Models\Sticker;
use App\Models\Theme;

use DB;
use Goutte;


class CrawlerController extends Controller
{

    /**
     * ดึงอิโมจิจากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * Cat : top, new, top_creators, new_top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
	public function getEmojistore($type,$cat,$page = null)
	{
        if($type == 1){ // official
            $pageTarget = 'https://store.line.me/emojishop/showcase/'.$cat.'/th?page='.$page;
            $category = 'official';
        }elseif($type == 2){ // creator
            $pageTarget = 'https://store.line.me/emojishop/showcase/'.$cat.'/th?page='.$page;
            $category = 'creator';
        }

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use($category) {

            // หา url ของอโมจิ
            $url = $node->filter('a')->attr('href');
            
            // เอาลิ้งค์ อิโมจิที่ได้มา หาค่า emoji_code
            $emoji_code = explode("/",$url);
            $emoji_code = $emoji_code[3];

            // นำ emoji_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Emoji::select('id')->where('emoji_code',$emoji_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)){

                $crawler_page = Goutte::request('GET','https://store.line.me/emojishop/product/'.$emoji_code.'/th');

                $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
                $creator_name = trim($crawler_page->filter('p.mdCMN08Copy')->text());
                $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
                $country = "global";
                $price = substr(trim($crawler_page->filter('p.mdCMN08Price')->text()),0,-3);

                // insert ลง db
                DB::table('emojis')->insert(
                    [
                        'emoji_code'   => $emoji_code,
                        'title'        => $title,
                        'detail'       => $detail,
                        'creator_name' => $creator_name,
                        'created'      => date("Y-m-d H:i:s"),
                        'category'     => $category,
                        'country'      => $country,
                        'slug'         => clean_url($title),
                        'price'        => $price,
                        'status'       => 'approve',
                    ]
                );

                dump($title);
            }// endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if(isset($page) && $page != 1){
            $page = $page - 1;
            $page_redirect = url('crawler/emojistore/'.$type.'/'.$cat.'/'.$page);
            echo "<script>setTimeout(function(){ window.location.href = '".$page_redirect."'; }, 1000);</script>";
        }
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * cat : top, new, top_creators, new_top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getStickerstore($type,$cat,$page = null)
    {
        if($type == 1){ // official
            $pageTarget = 'https://store.line.me/stickershop/showcase/'.$cat.'/th?page='.$page;
            $category = 'official';
        }elseif($type == 2){ // creator
            $pageTarget = 'https://store.line.me/stickershop/showcase/'.$cat.'/th?page='.$page;
            $category = 'creator';
        }

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use($category) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');
            
            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า sticker_code
            $sticker_code = explode("/",$url);
            $sticker_code = $sticker_code[3];
            // dump($sticker_code);

            // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Sticker::select('id')->where('sticker_code',$sticker_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)){

                $crawler_page = Goutte::request('GET','https://store.line.me/stickershop/product/'.$sticker_code.'/th');

                // หา stamp_start & stamp_end
                for ($i = 0; $i < 40; $i++) {
                    // check node empty
                    if ($crawler_page->filter('.mdCMN09Image')->eq($i)->count() != 0) {
                        $imgTxt = $crawler_page->filter('.mdCMN09Image')->eq($i)->attr('style');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        // dump($stamp_code);

                        $data[] = array(
                            'stamp_code' => $stamp_code,
                        );
                    }
                }

                // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
                // $image = trim($crawler_page->filter('div.mdCMN08Img > img')->attr('src'));
                $image = trim($crawler_page->filter('img.FnImage')->attr('src'));
                $image = explode("/", $image);
                $version = str_replace('v','',$image[4]);

                // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL,'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
                $result=curl_exec($ch);
                curl_close($ch);
                $productInfo = json_decode($result, true);

                $title_th            = @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'];
                $title_en            = $productInfo['title']['en'];
                $author_th           = @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'];
                $author_en           = $productInfo['author']['en'];
                $onsale              = $productInfo['onSale'];
                $hasanimation        = $productInfo['hasAnimation'];
                $hassound            = $productInfo['hasSound'];
                $validdays           = $productInfo['validDays'];
                $stickerresourcetype = $productInfo['stickerResourceType'];

                $detail              = @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text());
                $credit              = @trim($crawler_page->filter('a.mdCMN38Item01Author')->text());
                $sticker_code        = $sticker_code;
                $created             = date("Y-m-d H:i:s");
                $price               = @th_2_coin(substr(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()),0,-3));
                $country             = "thai";
                $stamp_start         = reset($data)['stamp_code'];
                $stamp_end           = end($data)['stamp_code'];

                // dump($productInfo);
                // dump($price);

                // insert ลง db
                DB::table('stickers')->insert(
                    [
                        'sticker_code'        => $sticker_code,
                        'version'             => $version,
                        'title_th'            => $title_th,
                        'title_en'            => $title_en,
                        'detail'              => $detail,
                        'author_th'           => $author_th,
                        'author_en'           => $author_en,
                        'credit'              => $credit,
                        'created'             => date("Y-m-d H:i:s"),
                        'category'            => $category,
                        'country'             => $country,
                        'price'               => $price,
                        'status'              => 'approve',
                        'onsale'              => $onsale,
                        'validdays'           => $validdays,
                        'hasanimation'        => $hasanimation,
                        'hassound'            => $hassound,
                        'stickerresourcetype' => $stickerresourcetype,
                        'stamp_start'         => $stamp_start,
                        'stamp_end'           => $stamp_end
                    ]
                );

                unset($data);

                dump($title_th);
            }// endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if(isset($page) && $page != 1){
            $page = $page - 1;
            $page_redirect = url('crawler/stickerstore/'.$type.'/'.$cat.'/'.$page);
            echo "<script>setTimeout(function(){ window.location.href = '".$page_redirect."'; }, 1000);</script>";
        }
    }

    /**
     * ดึงธีมจากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * cat : top, new, top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getThemestore($type,$cat,$page = null)
    {
        if($type == 1){ // official
            $pageTarget = 'https://store.line.me/themeshop/showcase/'.$cat.'/th?page='.$page;
            $category = 'official';
        }elseif($type == 2){ // creator
            $pageTarget = 'https://store.line.me/themeshop/showcase/'.$cat.'/th?page='.$page;
            $category = 'creator';
        }

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use($category) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า theme_code
            $theme_code = explode('/',$url);
            $theme_code = $theme_code[3];

            // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Theme::select('id')->where('theme_code',$theme_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)){

                $crawler_page = Goutte::request('GET','https://store.line.me/themeshop/product/'.$theme_code.'/th');

                $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
                $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
                $author = trim($crawler_page->filter('p.mdCMN08Copy')->text());
                $credit = trim($crawler_page->filter('p.mdCMN09Copy')->text());
                $price = substr(trim($crawler_page->filter('p.mdCMN08Price')->text()),0,-3);

                // insert ลง db
                DB::table('themes')->insert(
                    [
                        'theme_code' => $theme_code,
                        'title'      => $title,
                        'slug'       => clean_url($title),
                        'detail'     => $detail,
                        'author'     => $author,
                        'credit'     => $credit,
                        'created'    => date("Y-m-d H:i:s"),
                        'category'   => $category,
                        'country'    => 'thai',
                        'price'      => $price,
                        'status'     => 'approve',
                    ]
                );

                dump($title);
            }// endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if(isset($page) && $page != 1){
            $page = $page - 1;
            $page_redirect = url('crawler/themestore/'.$type.'/'.$cat.'/'.$page);
            echo "<script>setTimeout(function(){ window.location.href = '".$page_redirect."'; }, 1000);</script>";
        }
    }


    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ yabe (ptype=1 ของ yabe คือหน้า sticker)
     * $type 1 = creator, 2 = official
     * $country global,tw,ja,id,in,th,kr,us,en,es,hk,ar,bs,my,vn,de,it,mx
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getStickeryabe($type,$page = null,$country = false)
    {

        $typeArray = array('1'=>'creator','2'=>'official');
        $countryArray = array('global'=>'global','tw'=>'taiwan','ja'=>'japan','id'=>'indonesia','in'=>'india','th'=>'thailand','kr'=>'korea','us'=>'us','en'=>'en');
        $data['type'] = $typeArray[$type];
        $data['country'] = @$countryArray[$country] ? $countryArray[$country] : 'global' ;

        $crawler = Goutte::request('GET', 'http://yabeline.tw/Products.php?ptype=1&type='.$type.'&country='.$country.'&pageNum_Stickers_Data='.$page);

        // foreach
        $crawler->filter('.forSticker .item')->each(function ($node) use ($data) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href'); // output : Stickers_Data.php?Number=12831
            
            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า sticker_code
            $sticker_code = explode("=",$url);
            $sticker_code = $sticker_code[1];
            // dump($sticker_code);

            // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Sticker::select('id')->where('sticker_code',$sticker_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)){

                $crawler_page = Goutte::request('GET','http://yabeline.tw/Stickers_Data.php?Number='.$sticker_code);

                // หา stamp_start & stamp_end
                for ($i = 0; $i < 40; $i++) {
                    if ($crawler_page->filter('.stickerSub > img')->eq($i)->count() != 0) {
                        $imgTxt = $crawler_page->filter('.stickerSub > img')->eq($i)->attr('src');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        // dump($stamp_code);
        
                        $dataStamp[] = array(
                            'stamp_code' => $stamp_code
                        );
                    }
                }

                // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
                $image = trim($crawler_page->filter('.stickerSub > img')->attr('src'));
                $image = explode("/", $image);
                $version = str_replace('v','',$image[4]);


                // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL,'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
                $result=curl_exec($ch);
                curl_close($ch);
                $productInfo = json_decode($result, true);

                // dump($productInfo);

                $title_th            = @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'];
                $title_en            = $productInfo['title']['en'];
                $author_th           = @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'];
                $author_en           = $productInfo['author']['en'];
                $onsale              = $productInfo['onSale'];
                $hasanimation        = $productInfo['hasAnimation'];
                $hassound            = $productInfo['hasSound'];
                $validdays           = $productInfo['validDays'];
                $stickerresourcetype = $productInfo['stickerResourceType'];
                // $detail              = trim($crawler_page->filter('p.mdCMN08Desc')->text());
                // $credit              = trim($crawler_page->filter('p.mdCMN09Copy')->text());
                $sticker_code        = $sticker_code;
                $created             = date("Y-m-d H:i:s");
                $price               = intval($productInfo['price'][0]['price']);
                $category            = $data['type'];
                $country             = $data['country'];
                $stamp_start         = reset($dataStamp)['stamp_code'];
                $stamp_end           = end($dataStamp)['stamp_code'];

                // dump($data['country']);
                // dump($productInfo);
                // dump($price);

                // insert ลง db
                DB::table('stickers')->insert(
                    [
                        'sticker_code'        => $sticker_code,
                        'version'             => $version,
                        'title_th'            => $title_th,
                        'title_en'            => $title_en,
                        // 'detail'              => $detail,
                        'author_th'           => $author_th,
                        'author_en'           => $author_en,
                        // 'credit'              => $credit,
                        'created'             => date("Y-m-d H:i:s"),
                        'category'            => $category,
                        'country'             => $country,
                        'price'               => $price,
                        'status'              => 'approve',
                        'onsale'              => $onsale,
                        'validdays'           => $validdays,
                        'hasanimation'        => $hasanimation,
                        'hassound'            => $hassound,
                        'stickerresourcetype' => $stickerresourcetype,
                        'stamp_start'         => $stamp_start,
                        'stamp_end'           => $stamp_end
                    ]
                );

                unset($data);
                dump($title_th);

            }// endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if(isset($page) && $page != 1){
            $page = $page - 1;
            $page_redirect = url('crawler/stickeryabe/'.$type.'/'.$page);
            echo "<script>setTimeout(function(){ window.location.href = '".$page_redirect."'; }, 1000);</script>";
        }
    }


    // public function getUpdateauthor()
    // {
    //     Sticker::select('id','author')->whereNotNull('author')->whereNull('author_th')->where('status','<>','draft')->orderBy('id', 'desc')->chunk(5, function ($sticker) {
    //         foreach ($sticker as $row) {

    //             $author = json_decode($row->author, true);

    //             // dump(@$author['en']);

    //             $row->update([
    //                 'author_th' => @$author['th'] ? $author['th'] : $author['en'],
    //                 'author_en' => $author['en']
    //             ]);
    //         }

    //         // exit();
    //     });
    // }

    // public function getUpdatethemecode()
    // {
    //     // set_time_limit(0);
    //     Theme::select('id','url')->whereNotNull('url')->whereNull('theme_code')->where('status','<>','draft')->orderBy('id', 'desc')->chunk(100, function ($theme) {
    //         foreach ($theme as $row) {

    //             // /themeshop/product/202581a5-4d2b-4008-baec-ed40960d37ce/th
    //             $theme_code = explode('/',$row->url);
    //             // dump($theme_code[3]);

    //             $row->update([
    //                 'theme_code' => @$theme_code[3],
    //             ]);
    //         }
    //         // exit();
    //     });
    // }


    /** 
     * cronjob 
     * ใช้อัพเดท sticker stamp 
     * ถ้าใน database stamp_start & stamp_code เป็น 0 แสดงว่า สติกเกอร์นี้ไม่มีในเว็บ yabe 
     * ให้ลองหา stamp ในเว็บ store.line.me ต่อไป
     * */
    public function getUpdatestamp()
    {
        Sticker::select('id','sticker_code')
                    ->where('status','approve')
                    ->where('category','official')
                    ->where('country','indonesia')
                    ->whereNull('stamp_start')
                    ->whereNull('stamp_end')
                    ->where('status','<>','draft')
                    ->orderBy('id', 'asc')
                    ->chunk(100, function ($sticker) {
                        
            foreach ($sticker as $row) {

                $crawler = Goutte::request('GET','https://store.line.me/stickershop/product/'.$row->sticker_code.'/th');
                
                // หา stamp_start & stamp_end
                for ($i = 0; $i < 40; $i++) {
                    // check node empty
                    if ($crawler->filter('.mdCMN09Image')->eq($i)->count() != 0) {
                        $imgTxt = $crawler->filter('.mdCMN09Image')->eq($i)->attr('style');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        // dump($stamp_code);

                        $data[] = array(
                            'stamp_code' => $stamp_code,
                        );
                    }
                }

                if ($crawler->filter('.mdCMN09Image')->eq(0)->count() != 0) {
                    $row->update([
                        'detail'=>trim($crawler->filter('p.mdCMN08Desc')->text()),
                        'credit'=>trim($crawler->filter('p.mdCMN09Copy')->text()),
                        'stamp_start' => @reset($data)['stamp_code'] ? reset($data)['stamp_code'] : 0,
                        'stamp_end' => @end($data)['stamp_code'] ? end($data)['stamp_code'] : 0
                    ]);
                }

                unset ($data);
            }

            exit();
        });
        
    }

    public function getTest(){
        $crawler = Goutte::request('GET', 'https://yabeline.tw/Homepage.php');
        print_r($crawler);
    }
}
