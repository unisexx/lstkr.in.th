<?php

namespace App\Widgets;

use App\Models\Sticker;
use Arrilot\Widgets\AbstractWidget;

class OtherSticker extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The number of minutes before cache expires.
     * False means no caching at all.
     *
     * @var int|float|bool
     */
    // public $cacheTime = 5;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $data['other'] = new Sticker;
		$data['other'] = $data['other']->inRandomOrder()->take(4)->get();
        return view('widgets.other_sticker', $data);
    }
}
