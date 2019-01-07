<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Sticker extends Model
{
    // use SoftDeletes;

    protected $fillable = array('sticker_code', 'name', 'description', 'price', 'head_credit', 'foot_credit', 'user_id', 'status', 'version', 'hasanimation', 'hassound', 'stickerresourcetype', 'slug', 'author_th', 'author_en','stamp_start','stamp_end');
    
    // protected $dates = ['deleted_at'];

    // public function stamp()
    // {
    //     return $this->hasMany('App\Models\Stamp', 'sticker_id', 'id');
    // }
}
