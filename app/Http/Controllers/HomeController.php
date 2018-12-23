<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Sticker;
use App\Models\Theme;
use App\Models\Emoji;

use DB;
use SEO;
use SEOMeta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');
        SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม จากครีเอเทอร์');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://i.imgur.com/M1FvcTu.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

        // สติ๊กเกอร์ไลน์ทางการ
        $data['sticker_official'] = new Sticker;
        $data['sticker_official'] = $data['sticker_official']
                            ->where('category','<>','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // สติ๊กเกอร์ไลน์ทางการ
        $data['sticker_creator'] = new Sticker;
        $data['sticker_creator'] = $data['sticker_creator']
                            ->where('category','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // ธีมไลน์ทางการ
        $data['theme_official'] = new Theme;
        $data['theme_official'] = $data['theme_official']
                            ->where('category','official')
                            ->where('status','approve')
                            ->orderBy('id', 'desc')
                            ->take(12)
                            ->get();

        // ธีมไลน์ครีเอเตอร์
        $data['theme_creator'] = new Theme;
        $data['theme_creator'] = $data['theme_creator']
                            ->where('category','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // อิโมจิทางการ
        $data['emoji_official'] = new Emoji;
        $data['emoji_official'] = $data['emoji_official']
                            ->where('category','official')
                            ->where('status','approve')
                            ->orderBy('id', 'desc')
                            ->take(12)
                            ->get();

        // อิโมจิครีเอเตอร์
        $data['emoji_creator'] = new Emoji;
        $data['emoji_creator'] = $data['emoji_creator']
                            ->where('category','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        return view('home',$data);
    }

    public function search()
    {
        $data['sticker'] = new Sticker;
        if (!empty($_GET['q'])) {
            $data['sticker'] = $data['sticker']->where('name', 'like', '%' . $_GET['q'] . '%')->orWhere('description', 'like', '%' . $_GET['q'] . '%');
        }
        $data['sticker'] = $data['sticker']->orderBy('updated_at', 'desc')->get();

        $data['theme'] = new Theme;
        if (!empty($_GET['q'])) {
            $data['theme'] = $data['theme']->where('name', 'like', '%' . $_GET['q'] . '%')->orWhere('description', 'like', '%' . $_GET['q'] . '%');
        }
        $data['theme'] = $data['theme']->orderBy('updated_at', 'desc')->get();

        return view('home', $data);
    }

    public function author($user_id)
    {
        $data['sticker'] = new Sticker;
        $data['sticker'] = $data['sticker']->where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();

        $data['theme'] = new Theme;
        $data['theme'] = $data['theme']->where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();

        return view('home.author', $data);
    }

    public function tag($tag)
    {
        $data['tag'] = $tag;
        $data['stamp'] = new Stamp;
        if (!empty($tag)) {
            $data['stamp'] = $data['stamp']->where('tag', 'like', '%' . $tag . '%');
        }
        $data['stamp'] = $data['stamp']->orderBy('updated_at', 'desc')->get();

        return view('home.tag', $data);
    }

    public function aboutus()
    {
        SEO::setTitle('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม');
        SEO::setDescription('รวมสติ๊กเกอร์ไลน์ขายดี แนะนำ ฮิตๆ ยอดนิยม จากครีเอเทอร์');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://i.imgur.com/M1FvcTu.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

        $data['sticker'] = new Sticker;
        $data['sticker'] = $data['sticker']->orderBy('updated_at', 'desc')->take(12)->get();

        // $data['theme'] = new Theme;
        // $data['theme'] = $data['theme']->orderBy('updated_at', 'desc')->take(12)->get();

        return view('aboutus',$data);
    }
}
