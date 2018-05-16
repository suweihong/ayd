<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ItemType extends Model
{
    //
     protected $table = 'item_type';
	use SoftDeletes;

	// //该销售项目所属类别
	// public function type()
	// {
	// 	return $this->belongsToMany('App\Models\Types');
	// }

	// //该销售项目属于 票卡 或 场地
	// public function item()
	// {
	// 	return $this->belongsToMany('App\Models\Items');
	// }

	//
}
