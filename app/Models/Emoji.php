<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emoji extends Model
{

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
    
}
