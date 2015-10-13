<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Stock extends BaseModel
{
    protected $fillable = ['product_id', 'mutation_type', 'reff', 'unit', 'quantity', 'description', 'created_by', 'updated_by'];

    protected $rules = [
    	'product_id' => 'required|numeric',
    	'mutation_type' => 'required|string',
    	'reff' => 'required|numeric',
    	'unit' => 'required|string',
    	'quantity' => 'required|numeric',
    	'description' => 'required|string',
    ];


}
