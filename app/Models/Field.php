<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Field extends Model
{
    //
    	use SoftDeletes;

    	//该商品所属类型
    	public function type()
    	{
    	return $this->belongsToMany('App\Models\Type');
    	}

        //该商品所属项目 场地 或 票卡
        public function item()
        {
            return $this->belongsToMany('App\Models\Item');
        }

    	//该商品所属的商家
    	public  function store()
    	{
    		return $this->belongsToMany('App\Models\Store');
    		
    	}

        //该商品所属订单
        public function orders()
        {
            return $this->belongsToMany('App\Models\Order');
        }

}
