<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class ProductCategory extends ApiController
{
    public function __construct(\livepos\ProductCategory $model)
    {
        parent::__construct($model);
    }
    
}
