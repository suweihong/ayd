<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bill extends Model
{
	use SoftDeletes;
     /**
     * 该账单所属商店
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}
