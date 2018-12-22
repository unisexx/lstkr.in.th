<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Emoji extends Model
{
    // use SoftDeletes;

    protected $fillable = array(
        'emoji_code',
        'title',
        'detail',
        'creator_name',
        'threedays',
        'created',
        'updated',
        'category',
        'country',
        'slug',
        'price',
        'status',
    );
    
    // protected $dates = ['deleted_at'];
}
