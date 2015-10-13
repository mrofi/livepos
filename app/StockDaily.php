<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class StockDaily extends Model
{
    protected $fillable = ['product_id', 'unit', 'quantity', 'created_by', 'updated_by'];

    protected $rules = [
    	'product_id' => 'required|numeric',
    	'unit' => 'required|string',
    	'quantity' => 'required|numeric',
    ];


}
