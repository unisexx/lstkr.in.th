<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    
    protected $fillable = array('theme_code','name','description','price','head_credit','foot_credit','user_id','status','theme_path','slug','country');
    
}
