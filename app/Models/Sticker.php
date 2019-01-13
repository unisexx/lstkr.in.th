<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Sticker extends Model
{
    // use SoftDeletes;

    protected $fillable = array(
        'sticker_code',
        'category',
        'country',
        'title_th',
        'title_en',
        'author_th',
        'author_en',
        'detail',
        'credit',
        'price',
        'version',
        'onsale',
        'validdays',
        'hasanimation',
        'hassound',
        'stickerresourcetype',
        'status',
        'threedays',
        'stamp_start',
        'stamp_end',
    );
    
    // protected $dates = ['deleted_at'];

    // public function stamp()
    // {
    //     return $this->hasMany('App\Models\Stamp', 'sticker_id', 'id');
    // }
}
