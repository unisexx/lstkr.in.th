<?php
namespace App\Http\Controllers\Creator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use App\Models\Theme;
use App\Models\Page;

use Form;
use DB;
use Auth;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $data['sticker_count'] = Sticker::where('user_id', Auth::user()->id)->count();
        $data['theme_count'] = Theme::where('user_id', Auth::user()->id)->count();
        $data['page'] = Page::find(12);
        return view('creator.dashboard.index', $data);
    }
}
