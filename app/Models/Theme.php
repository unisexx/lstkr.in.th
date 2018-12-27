<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    // use SoftDeletes;
    
    protected $fillable = array('theme_code','name','description','price','head_credit','foot_credit','user_id','status','theme_path','slug','country');
    
    // protected $dates = ['deleted_at'];
}
