<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Product extends ApiController
{
    public function __construct(\livepos\Product $model)
    {
        parent::__construct($model);
    }

    public function store(Request $request)
    {
    	return $request->all();
    }
}
