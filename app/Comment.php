<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function post(){
        return $this->belongsTo('App\Post','id','post_id');
    }
    public function likes(){
        return $this->hasMany('App\Like','comment_id','id');
    }
    public function dislikes(){
        return $this->hasMany('App\Dislike','comment_id','id');
    }
}
