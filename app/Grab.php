<?php

namespace App;
use App\Usergrab;

use Illuminate\Database\Eloquent\Model;

class Grab extends Model
{
    public function usergrab(){
    	 return $this->hasMany('App\Usergrab','grab_id','id');
    }
}
