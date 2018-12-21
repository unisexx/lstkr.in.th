<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Request;

class SocialShareBtn extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $data['url'] = Request::fullUrl();
        return view('widgets.social_share_btn', $data);
    }
}
