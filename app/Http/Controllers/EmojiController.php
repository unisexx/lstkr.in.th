<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Emoji;

use DB;
use SEO;
use SEOMeta;
use Session;
use OpenGraph;


class EmojiController extends Controller
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

		$data['emoji'] = new Emoji;
		$data['emoji'] = $data['emoji']
							->where('category','official')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('emoji.official', $data);
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

		$data['emoji'] = new Emoji;
		$data['emoji'] = $data['emoji']
							->where('category','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('emoji.creator', $data);
	}

	public function getProduct($emoji_code = null)
	{
		$data['rs'] = Emoji::where('emoji_code',$emoji_code)->first();

		// SEO
		SEO::setTitle($data['rs']->title . ' - อิโมจิไลน์');
		SEO::setDescription('อิโมจิไลน์' . $data['rs']->detail);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('https://stickershop.line-scdn.net/sticonshop/v1/product/'.$data['rs']->emoji_code.'/iphone/main.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords('line, emoji, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		SEOMeta::addKeyword('line, emoji, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		OpenGraph::addProperty('image:width', '240');
		OpenGraph::addProperty('image:height', '240');

		return view('emoji.product', $data);
	}
}
