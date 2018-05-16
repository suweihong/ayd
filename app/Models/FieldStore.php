<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class FieldStore extends Model
{
    protected $table = 'field_store';
	use SoftDeletes;
}
