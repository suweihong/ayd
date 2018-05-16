<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	//该用户的订单
    public function orders()
    {
    	return $this->hasMany('App\Models\Order');
    }
}
