<?php

namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use Form;
use DB;
use Auth;
use Goutte;
use Carbon;

class ThemeController extends Controller {
    public function getIndex() {
    	$data['rs'] = new Theme;
		$data['rs'] = $data['rs']->where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->get();
        return view('creator.theme.index',$data);
    }

    public function getForm(){
        return view('creator.theme.form');
    }

    public function postSave(Request $rq, $id = null){

		$this->validate($rq,[
			'theme_code' => 'required|unique:themes'
		],[
			'theme_code.required' => ' ห้ามเป็นค่าว่าง',
			'theme_code.unique'   => ' หมายเลขไอดีของธีมนี้มีในระบบแล้ว ถ้าธีมชุดนี้เป็นของคุณ <a href="'.url('creator/page/view/8').'">คลิกที่นี่</a>'
		]);

    	$theme_code = $rq->theme_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/themeshop/product/'.$theme_code.'/th');
		
		// check node empty
		if($crawler->filter('div.mdCMN08Img > img')->count() == 0){
			set_notify('error', "ข้อมูลไม่ถูกต้อง");
			return redirect()->back();
		}
		
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$theme_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$theme_description = $crawler->filter('p.mdCMN08Desc')->text();
		$theme_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');

		$ex = explode("/", $image_cover);
		$theme_path = $ex[6]."/".$ex[7]."/".$ex[8]."/".$ex[9]."/".$ex[10];
		
		// Save
		$model = $id ? Theme::find($id) : new Theme;
		$model->fill(array(
			'id'          => $model->id,
			'theme_code'  => $theme_code,
			'name'        => $theme_name,
			'description' => $theme_description,
			'price'       => $theme_price,
			'head_credit' => $head_credit,
			'foot_credit' => $foot_credit,
			'user_id'     => Auth::user()->id,
			'status'      => 1,
			'theme_path'  => $theme_path,
			'slug'        => generateUniqueSlug($theme_name),
		));
		$model->save();

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/theme/index');
    }

	public function getDelete($id = null) {
		$rs = Theme::find($id);
	    if($rs->user_id = Auth::user()->id) {
	      $rs->delete(); // Delete process
	      set_notify('error', trans('message.completeDelete'));
	    }else{
	    	set_notify('error', 'ไม่สามารถดำเนินรายการได้');
	    }
	    return Redirect('creator/theme/index');
	}
	
	// เช็ก sticker ซ้ำใน user เดียวกัน
    public function getAjaxchecktheme(){
      $rs = new Theme;
      $rs = $rs->where('theme_code',@$_GET['theme_code'])->where('user_id',Auth::user()->id)->first();

		if($rs){
	        return 'false';
	    }else{
	    	return 'true';
	    }
	}
	
	public function getUpdate($id = null){
		$rs = Theme::find($id);
		
		$theme_code = $rs->theme_code;
		$crawler = Goutte::request('GET', 'https://store.line.me/themeshop/product/'.$theme_code.'/th');
		$head_credit = $crawler->filter('p.mdCMN08Copy > a')->text();
		$theme_name = $crawler->filter('h3.mdCMN08Ttl')->text();
		$theme_description = $crawler->filter('p.mdCMN08Desc')->text();
		$theme_price = $crawler->filter('p.mdCMN08Price')->text();
		$foot_credit = $crawler->filter('p.mdCMN09Copy')->text();
		$image_cover = $crawler->filter('div.mdCMN08Img > img')->attr('src');
		
		$ex = explode("/", $image_cover);
		$theme_path = $ex[6]."/".$ex[7]."/".$ex[8]."/".$ex[9]."/".$ex[10];
		
		// Save
		$model = $id ? Theme::find($id) : new Theme;
		$model->fill(array(
			'id'          => $model->id,
			'theme_code'  => $theme_code,
			'name'        => $theme_name,
			'description' => $theme_description,
			'price'       => $theme_price,
			'head_credit' => $head_credit,
			'foot_credit' => $foot_credit,
			'user_id'     => Auth::user()->id,
			'status'      => 1,
			'theme_path'  => $theme_path,
			'slug'        => generateUniqueSlug($theme_name),
		));
		$model->timestamps = false;
		$model->save();
		
		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/theme/index');
	}

	function getUp($id = null){
		// check datetime
		$lastUpdate = Theme::where('user_id',Auth::user()->id)->orderBy('updated_at','desc')->first();
		$update = new Carbon($lastUpdate->updated_at);
		$now = Carbon::now();
		$difference = $update->diffInMinutes($now);
		$wait = 5 - $difference;

		if($difference >= 5){
			$model = Theme::find($id);
			$model->touch();
			set_notify('success', trans('message.completeSave'));
			return Redirect('creator/theme/index');
		}else{
			set_notify('error', "ไม่สามารถดำเนินรายการได้ในขณะนี้ โปรดรออีกประมาณ ".$wait." นาที");
			return Redirect('creator/theme/index');
		}
	}
	
}
