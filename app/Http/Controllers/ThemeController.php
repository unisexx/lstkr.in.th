<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use DB;
use SEO;
use SEOMeta;
use OpenGraph;
use	Cache;

class ThemeController extends Controller {
    public function getIndex() {
		
	}
	
	public function getOfficial($country,$type)
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['theme'] = new Theme;
		$data['theme'] = $data['theme']
							->where('status','approve')
							->where('category','official')
							->where(function($q) use ($country){

								// ประเทศ : thai, oversea
								if($country == 'thai'){
									$q->where('country','global')->orWhere('country','thai');
								}elseif($country == 'oversea'){
									$q->where('country','!=','global')->where('country','!=','thai');
								}
								
							})
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('theme.official', $data);
	}

	public function getCreator($type)
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['theme'] = new Theme;
		$data['theme'] = $data['theme']
							->where('category','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('theme.creator', $data);
	}
	
	public function getProduct($id){
		// cache file
		// $data['rs'] = Cache::rememberForever('theme_'.$id, function() use ($id) {
		// 	return DB::table('themes')->find($id);
		// });
		
		$data['rs'] = Theme::find($id);

		// SEO
		SEO::setTitle($data['rs']->title.' - ธีมไลน์');
		SEO::setDescription('ธีมไลน์'.$data['rs']->detail);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/'.$data['rs']->theme_code.'/1/WEBSTORE/icon_198x278.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		OpenGraph::addProperty('image:width', '198');
		OpenGraph::addProperty('image:height', '278');
		
    	return view('theme.product',$data);
	}
}
