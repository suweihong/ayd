<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    // use Notifiable;
    // protected  $table = 'ayd_users';//这个就是你新表

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
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

     use SoftDeletes;
     //该用户的订单
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    //该用户拥有的评论
    public function estimates()
    {
        return $this->hasMany('App\Models\Estimate');
    }
}
