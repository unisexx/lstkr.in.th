<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lucky extends Model
{
    protected $fillable = array('type', 'sticker_id', 'theme_id');

    public function sticker()
    {
        return $this->hasOne('App\Models\Sticker', 'id', 'sticker_id');
    }

    public function theme()
    {
        return $this->hasOne('App\Models\Theme', 'id', 'theme_id');
    }
}
