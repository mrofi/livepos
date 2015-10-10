<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class ProductMeta extends ApiController
{
    public function __construct(\livepos\ProductMeta $model)
    {
        parent::__construct($model);
    }

    public function getTes()
    {
    	var_dump(\livepos\ProductMeta::where('product_id', '5')->where('meta_key', 'multi_unit')->count('*'));
    	var_dump(\livepos\ProductMeta::where('meta_value', 'like', '%"barcode":"000-1"%')->first());
    }
}
