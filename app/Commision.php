<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Commision extends Model
{
    protected $fillable = ['selling_id', 'multilevel_id', 'commision'];

    protected $rules = [
    	'selling_id' => 'require|numeric',
    	'multilevel_id' => 'require|numeric',
    ]; 
}
