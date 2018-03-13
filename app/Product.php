<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public function user(){
        return $this->belongsTo('App\User','product_id','user_id');
    }
    public function image(){
        return $this->hasMany('App\Image','product_id','product_id');
    }
    public function record(){
        return $this->hasOne('App\Record','product_id','product_id');
    }
    public function grabtable(){
        return $this->hasOne('App\Grab','p_id','product_id');
    }
    public function rating(){
        return $this->hasMany('App\Rating','product_id','rate_id');
    }
}
