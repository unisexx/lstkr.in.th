<?php

namespace App\Widgets;

use App\Models\Stamp;
use Arrilot\Widgets\AbstractWidget;

class Tag extends AbstractWidget
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
        $data['stamp'] = new Stamp;
        $data['stamp'] = $data['stamp']->where('tag', '!=', '')->inRandomOrder()->take(20)->get();
        return view('widgets.tag', $data);
    }
}
