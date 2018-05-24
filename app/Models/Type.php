<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Type extends Model
{
		use SoftDeletes;

		protected $fillable = ['name'];

		 /**
     * 该品类的商家。（反向关联）
     */
    public function stores()
    {
        return $this->belongsToMany('App\Models\Store');
    }

    
}
