<?php
namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use App\Models\Stamp;

use Form;
use DB;
use Auth;
use Goutte;
use Carbon;

class StickerController extends Controller
{
	public function getIndex()
	{
		$data['rs'] = new Sticker;
		$data['rs'] = $data['rs']->where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->get();
		return view('creator.sticker.index', $data);
	}

	public function getForm()
	{
		return view('creator.sticker.form');
	}

	public function postSave(Request $rq, $id = null)
	{

		$this->validate($rq, [
			'sticker_code' => 'required|numeric|unique:stickers'
		], [
			'sticker_code.required' => ' ห้ามเป็นค่าว่าง',
			'sticker_code.numeric' => ' เป็นตัวเลขเท่านั้น',
			'sticker_code.unique' => ' หมายเลขไอดีของสติ๊กเกอร์นี้มีในระบบแล้ว ถ้าสติ๊กเกอร์ชุดนี้เป็นของคุณ <a href="' . url('creator/page/view/8') . '">คลิกที่นี่</a>'
		]);

		$sticker_code = $rq->sticker_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');
		
		// check node empty
		if ($crawler->filter('div.mdCMN08Img > img')->count() == 0) {
			set_notify('error', "ข้อมูลไม่ถูกต้อง");
			return redirect()->back();
		}

		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$sticker_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$sticker_description = $crawler->filter('p.mdCMN08Desc')->text();
		$sticker_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();

		// dump($image_cover);
		// dump($head_credit);
		// dump($sticker_name);
		// dump($sticker_description);
		// dump($sticker_price);
		// dump($foot_credit);

		$image_cover_path = explode("/", $image_cover);
		$version = str_replace('v', '', $image_cover_path[4]);

		$curlSession = curl_init();
		curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta');
		curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        // $jsonData = json_decode(curl_exec($curlSession));
		$result = curl_exec($curlSession);
		curl_close($curlSession);
		$json = json_decode($result, true);
		// dump($jsonData);

		// Save
		$model = $id ? Sticker::find($id) : new Sticker;
		$model->fill(array(
			'id' => $model->id,
			'sticker_code' => $sticker_code,
			'name' => $sticker_name,
			'description' => $sticker_description,
			'price' => trim($sticker_price),
			'head_credit' => $head_credit,
			'foot_credit' => $foot_credit,
			'user_id' => Auth::user()->id,
			'status' => 1,
			'version' => $version,
			'hasanimation' => @$json['hasAnimation'],
			'hassound' => @$json['hasSound'],
			'stickerresourcetype' => @$json['stickerResourceType'],
			'slug' => generateUniqueSlug($sticker_name),
		));
		$model->save();

		// Sticker Detail Stamp Save
		for ($i = 0; $i < 40; $i++) {
			// check node empty
			if ($crawler->filter('.mdCMN09Image')->eq($i)->count() != 0) {
				$imgTxt = $crawler->filter('.mdCMN09Image')->eq($i)->attr('style');
				$image_path = explode("/", getUrlFromText($imgTxt));
				$stamp_code = $image_path[6];
				// dump($stamp_code);

				$data[] = array(
					'sticker_id' => $model->id,
					'sticker_code' => $sticker_code,
					'stamp_code' => $stamp_code,
					'version' => $version,
				);
			}
		}
		DB::table('stamps')->insert($data);


		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/sticker/index');
	}

	public function getDelete($id = null)
	{
		$rs = Sticker::find($id);
		if ($rs->user_id == Auth::user()->id) {
			$rs->stamp()->delete();
			$rs->delete(); // Delete process
			set_notify('error', trans('message.completeDelete'));
		} else {
			set_notify('error', 'ไม่สามารถดำเนินรายการได้');
		}
		return Redirect('creator/sticker/index');
	}
	
	// เช็ก sticker ซ้ำใน user เดียวกัน
	public function getAjaxchecksticker()
	{
		$rs = new Sticker;
		$rs = $rs->where('sticker_code', @$_GET['sticker_code'])->where('user_id', Auth::user()->id)->first();

		if ($rs) {
			return 'false';
		} else {
			return 'true';
		}
	}

	public function getUpdate($id = null)
	{
		$rs = Sticker::find($id);

		$sticker_code = $rs->sticker_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$sticker_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$sticker_description = $crawler->filter('p.mdCMN08Desc')->text();
		$sticker_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
		
		// dump($image_cover);
		// dump($head_credit);
		// dump($sticker_name);
		// dump($sticker_description);
		// dump(trim($sticker_price));
		// dump($foot_credit);
		// exit();

		$image_cover_path = explode("/", $image_cover);
		$version = str_replace('v', '', $image_cover_path[4]);

		$curlSession = curl_init();
		curl_setopt($curlSession, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta');
		curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);
        // $jsonData = json_decode(curl_exec($curlSession));
		$result = curl_exec($curlSession);
		curl_close($curlSession);
		$json = json_decode($result, true);
		// dump($jsonData);

		// Save
		$model = $id ? Sticker::find($id) : new Sticker;
		$model->fill(array(
			'id' => $rs->id,
			'sticker_code' => $sticker_code,
			'name' => $sticker_name,
			'description' => $sticker_description,
			'price' => trim($sticker_price),
			'head_credit' => $head_credit,
			'foot_credit' => $foot_credit,
			'user_id' => Auth::user()->id,
			'status' => 1,
			'version' => $version,
			'hasanimation' => @$json['hasAnimation'],
			'hassound' => @$json['hasSound'],
			'stickerresourcetype' => @$json['stickerResourceType'],
			'slug' => generateUniqueSlug($sticker_name),
		));
		$model->timestamps = false;
		$model->save();

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/sticker/index');
	}

	function getUp($id = null)
	{
		// check datetime
		$lastUpdate = Sticker::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->first();
		$update = new Carbon($lastUpdate->updated_at);
		$now = Carbon::now();
		$difference = $update->diffInMinutes($now);
		$wait = 5 - $difference;

		if ($difference >= 5) {
			$model = Sticker::find($id);
			$model->touch();
			set_notify('success', trans('message.completeSave'));
			return Redirect('creator/sticker/index');
		} else {
			set_notify('error', "ไม่สามารถดำเนินรายการได้ในขณะนี้ โปรดรออีกประมาณ " . $wait . " นาที");
			return Redirect('creator/sticker/index');
		}
	}

	function getTagform($id = null)
	{
		$data['rs'] = Sticker::find($id);
		if ($data['rs']->user_id != Auth::user()->id) {
			set_notify('error', 'ไม่สามารถดำเนินรายการได้');
			return Redirect('creator/sticker/index');
		}

		// ถ้า sticker นี้ยังไม่มีข้อมูล stamp ให้ทำการอัพเดทแล้ว save stamp ใหม่
		if (count($data['rs']->stamp) == 0) {
			$crawler = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $data['rs']->sticker_code . '/th');
			// Sticker Detail Stamp Save
			for ($i = 0; $i < 40; $i++) {
				// check node empty
				if ($crawler->filter('.mdCMN09Image')->eq($i)->count() != 0) {
					$imgTxt = $crawler->filter('.mdCMN09Image')->eq($i)->attr('style');
					$image_path = explode("/", getUrlFromText($imgTxt));
					$stamp_code = $image_path[6];
					// dump($stamp_code);

					$stamp[] = array(
						'sticker_id' => $data['rs']->id,
						'sticker_code' => $data['rs']->sticker_code,
						'stamp_code' => $stamp_code,
						'version' => $data['rs']->version,
					);
				}
			}
			DB::table('stamps')->insert($stamp);
		}

		return view('creator.sticker.tagform', $data);
	}

	public function postTagsave(Request $rq, $id = null)
	{
		$this->validate($rq, [
			'tag.*' => 'max:50'
		], [
			'tag.*.max' => ' ห้ามเกิน 50 ตัวอักษร'
		]);

		foreach ($rq->id as $key => $item) {
			$model = Stamp::find($item);
			$model->tag = @$rq->input('tag')[$key];
			$model->save();
		}
		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/sticker/tagform/' . $rq->input('sticker_id'));
	}
}
