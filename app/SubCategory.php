<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function products(){
    	return $this->hasMany('App\Product','subcatagory_id','product_id');
    }
}
