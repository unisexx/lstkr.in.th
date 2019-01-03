<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use DB;
use SEO;
use SEOMeta;
use Session;
use OpenGraph;


class StickerController extends Controller
{
	public function getIndex()
	{

	}

	public function getOfficial($type)
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['sticker'] = new Sticker;
		$data['sticker'] = $data['sticker']
							->where('category','<>','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('sticker.official', $data);
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

		$data['sticker'] = new Sticker;
		$data['sticker'] = $data['sticker']
							->where('category','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('sticker.creator', $data);
	}

	public function getProduct($id = null)
	{
		$data['rs'] = Sticker::where('sticker_code',$id)->first();

		// SEO
		SEO::setTitle($data['rs']->title_th . ' - สติ๊กเกอร์ไลน์');
		SEO::setDescription('สติ๊กเกอร์ไลน์' . $data['rs']->description);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('http://sdl-stickershop.line.naver.jp/products/0/0/' . $data['rs']->version . '/' . $data['rs']->sticker_code . '/LINEStorePC/main.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		OpenGraph::addProperty('image:width', '240');
		OpenGraph::addProperty('image:height', '240');

		return view('sticker.product', $data);
	}
}
