<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{

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
    
}
