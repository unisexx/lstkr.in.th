<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    protected $fillable = array('sticker_id', 'sticker_code', 'stamp_code', 'tag', 'version', 'url');

    public function sticker()
    {
        return $this->hasOne('App\Models\Sticker', 'id', 'sticker_id');
    }
}
