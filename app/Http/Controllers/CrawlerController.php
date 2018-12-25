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
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
	public function getEmojistore($type,$page = null)
	{
        if($type == 1){ // official
            $pageTarget = 'https://store.line.me/emojishop/showcase/new/th?page='.$page;
            $category = 'official';
        }elseif($type == 2){ // creator
            $pageTarget = 'https://store.line.me/emojishop/showcase/new_creators/th?page='.$page;
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
                $slug = str_slug($title, '-');
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
            $page_redirect = url('crawler/emojistore/'.$type.'/'.$page);
            echo "<script>setTimeout(function(){ window.location.href = '".$page_redirect."'; }, 1000);</script>";
        }
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getStickerstore($type,$page = null)
    {
        if($type == 1){ // official
            $pageTarget = 'https://store.line.me/stickershop/showcase/new/th?page='.$page;
            $category = 'official';
        }elseif($type == 2){ // creator
            $pageTarget = 'https://store.line.me/stickershop/showcase/new_creators/th?page='.$page;
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

                // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
                $image = trim($crawler_page->filter('div.mdCMN08Img > img')->attr('src'));
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
                $detail              = trim($crawler_page->filter('p.mdCMN08Desc')->text());
                $credit              = trim($crawler_page->filter('p.mdCMN09Copy')->text());
                $sticker_code        = $sticker_code;
                $created             = date("Y-m-d H:i:s");
                $price               = @th_2_coin(substr(trim($crawler_page->filter('p.mdCMN08Price')->text()),0,-3));
                $country             = "thai";

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
                    ]
                );

                dump($title_th);
            }// endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if(isset($page) && $page != 1){
            $page = $page - 1;
            $page_redirect = url('crawler/stickerstore/'.$type.'/'.$page);
            echo "<script>setTimeout(function(){ window.location.href = '".$page_redirect."'; }, 1000);</script>";
        }
    }


    public function getUpdateauthor()
    {
        Sticker::whereNotNull('author')->whereNull('author_th')->where('status','<>','draft')->orderBy('id', 'asc')->chunk(100, function ($sticker) {
            foreach ($sticker as $row) {

                $author = json_decode($row->author, true);

                // dump(@$author['en']);

                $row->update([
                    'author_th' => @$author['th'] ? $author['th'] : $author['en'],
                    'author_en' => $author['en']
                ]);
            }

            // exit();
        });
    }
}
