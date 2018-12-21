<?php
namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Lucky;
use App\Models\Sticker;
use App\Models\Theme;

use Form;
use DB;
use Auth;

class LuckyController extends Controller
{
	// public function __construct()
    // {
    //     if(Auth::user()->level != 99){
	// 		set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
	// 		return back()->send();
	// 	}
	// }

	public function getIndex()
	{
		//permission
		// if (Auth::user()->level != 99) {
		// 	set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
		// 	return back()->send();
		// }

		$data['rs'] = new Lucky;
		$data['rs'] = $data['rs']->orderBy('id', 'desc')->get();

		return view('creator.lucky.index', $data);
	}

	public function getRandom()
	{
		//permission
		if (Auth::user()->level != 99) {
			set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
			return back()->send();
		}

		$sticker = Sticker::inRandomOrder()->first();
		$theme = Theme::inRandomOrder()->first();

		dump($sticker->id);

		$s = new Lucky;
		$s->type = 1;
		$s->sticker_id = $sticker->id;
		$s->save();

		$t = new Lucky;
		$t->type = 2;
		$t->theme_id = $theme->id;
		$t->save();

		return Redirect('creator/lucky/index');
	}

}
