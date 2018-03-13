<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenCategory extends Model
{
   public function subcategory(){
    	return $this->hasMany('App\SubCategory','gen_category_id','id');
    }
    public function products(){
    	return $this->hasMany('App\Product','generic_category','product_id');
    }
}
