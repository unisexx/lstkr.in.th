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
use Carbon;

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
        SEO::setTitle('ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ ของแท้ ไม่มีหาย');
        SEO::setDescription('ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% ที่เปิดให้บริการมากว่า 8 ปี');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://linesticker.in.th/image/qr_ratasak1234.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

        // DB::enableQueryLog();
        // สติ๊กเกอร์ไลน์โปรโมท
        $data['sticker_promote'] = DB::table('promotes')
            ->join('stickers', 'promotes.product_code', '=', 'stickers.sticker_code')
            ->select('stickers.*')
            ->where('promotes.end_date', '>=', Carbon::now()->toDateString())
            ->inRandomOrder()
            ->take(30)
            ->get();
        // dump(DB::getQueryLog());

        // สติ๊กเกอร์ไลน์ทางการ (ไทย)
        $data['sticker_official_thai'] = new Sticker;
        $data['sticker_official_thai'] = $data['sticker_official_thai']
                            ->where('status','approve')
                            ->where('category','official')
                            ->where(function($q){
                                $q->where('country','global')->orWhere('country','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // สติ๊กเกอร์ไลน์ทางการ (ต่างประเทศ)
        $data['sticker_official_oversea'] = new Sticker;
        $data['sticker_official_oversea'] = $data['sticker_official_oversea']
                            ->where('status','approve')
                            ->where('category','official')
                            ->where(function($q){
                                $q->where('country','!=','global')->where('country','!=','thai');
                            })
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
                            ->orderBy('threedays', 'desc')
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
                            ->orderBy('threedays', 'desc')
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
        // ค้นหา sticker
        $data['sticker'] = new Sticker;
        if (!empty($_GET['q'])) {
            $data['sticker'] = $data['sticker']
                                ->where('title_th', 'like', $_GET['q'] . '%')
                                ->orWhere('title_en', 'like', $_GET['q'] . '%');
        }
        $data['sticker'] = $data['sticker']->orderBy('id', 'desc')->take(12)->get();

        // ค้นหา theme
        $data['theme'] = new Theme;
        if (!empty($_GET['q'])) {
            $data['theme'] = $data['theme']
                                ->where('title', 'like', $_GET['q'] . '%');
        }
        $data['theme'] = $data['theme']->orderBy('id', 'desc')->take(12)->get();

        // ค้นหา emoji
        $data['emoji'] = new Emoji;
        if (!empty($_GET['q'])) {
            $data['emoji'] = $data['emoji']
                                ->where('title', 'like', $_GET['q'] . '%');
        }
        $data['emoji'] = $data['emoji']->orderBy('id', 'desc')->take(12)->get();

            return view('home.search', $data);
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
        SEO::setTitle('เกี่ยวกับเรา');
        SEO::setDescription('ข้อมูลเกี่ยวกับเว็บไซต์ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ linesticker.in.th');
        // SEO::opengraph()->setUrl(url()->current());
        // SEO::addImages('https://i.imgur.com/M1FvcTu.png');
        // SEO::twitter()->setSite('@line2me_th');
        // SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        // SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

        return view('aboutus');
    }

    public function info(){
        echo phpinfo();
    }
}
