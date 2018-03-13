<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use SyncableGraphNodeTrait;
    protected $table = 'users';
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function product(){
        return $this->hasMany('App\Product','user_id','id');
    }
    public function category(){
       return $this->belongsToMany('App\Category','user_category','user_id','category_id');
    }
    public function post(){
        return $this->hasMany('App\Post', 'user_id','id');
    }
    public function likes(){
        return $this->hasMany('App\Like','user_id','id');
    }
    public function subscribe(){
        return $this->hasMany('App\Subscribe','user_id','id');
    }
    protected static $graph_node_field_aliases = [
        'id' => 'facebook_id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
