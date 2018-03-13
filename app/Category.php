<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function generic_category(){
    	return $this->hasMany('App\GenCategory','category_id','id');
    }
    public function products(){
    	return $this->hasMany('App\Product','main_category','product_id');
    }
}
