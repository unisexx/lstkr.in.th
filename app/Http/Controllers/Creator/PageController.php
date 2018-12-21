<?php
namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Page;

use Form;
use DB;
use Auth;

class PageController extends Controller
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
		if (Auth::user()->level != 99) {
			set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
			return back()->send();
		}

		$data['rs'] = new Page;
		$data['rs'] = $data['rs']->orderBy('id', 'desc')->get();
		return view('creator.page.index', $data);
	}

	public function getForm($id = null)
	{
		//permission
		if (Auth::user()->level != 99) {
			set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
			return back()->send();
		}

		$data['rs'] = Page::find($id);
		return view('creator.page.form', $data);
	}

	public function postSave(Request $rq, $id = null)
	{
		//permission
		if (Auth::user()->level != 99) {
			set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
			return back()->send();
		}

		$rq->merge([
			'slug' => generateUniqueSlug($rq->input('title'))
		]);
		
		// Save
		$model = $id ? Page::find($id) : new Page;
		$model->fill($rq->all());
		$model->save();

		set_notify('success', trans('message.completeSave'));
		return Redirect('creator/page/index');
	}

	public function getDelete($id = null)
	{
		//permission
		if (Auth::user()->level != 99) {
			set_notify('error', trans('คุณไม่มีสิทธิ์เข้าใช้งาน'));
			return back()->send();
		}

		if ($rs = Page::find($id)) {
			$rs->delete(); // Delete process
			set_notify('error', trans('message.completeDelete'));
		}
		return Redirect('creator/page/index');
	}

	public function getView($id)
	{
		$data['rs'] = Page::find($id);
		return view('creator.page.view', $data);
	}

}
