<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $fillable = ['order_id','store_id','status_id'];
	use SoftDeletes;


	//所属状态
	public function status()
	{
		return $this->belongsTo('App\Models\Status');
	}
	//所属订单
	public function order()
	{
		return $this->belongsTo('App\Models\Order');
	}
}
