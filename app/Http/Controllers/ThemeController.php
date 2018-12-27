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

class ThemeController extends Controller {
    public function getIndex() {
		
	}
	
	public function getOfficial()
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		$data['theme'] = new Theme;
		$data['theme'] = $data['theme']
							->where('category','official')
							->where('status','approve')
							->orderBy('id', 'desc')
							->simplePaginate(30);
		return view('theme.official', $data);
	}

	public function getCreator()
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		$data['theme'] = new Theme;
		$data['theme'] = $data['theme']
							->where('category','creator')
							->where('status','approve')
							->orderBy('id', 'desc')
							->simplePaginate(30);
		return view('theme.creator', $data);
	}
	
	public function getProduct($id){
		$data['rs'] = Theme::find($id);

		// SEO
		SEO::setTitle($data['rs']->title.' - ธีมไลน์');
		SEO::setDescription('ธีมไลน์'.$data['rs']->detail);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages($data['rs']->cover);
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		OpenGraph::addProperty('image:width', '198');
		OpenGraph::addProperty('image:height', '278');
		
    	return view('theme.product',$data);
	}
}
