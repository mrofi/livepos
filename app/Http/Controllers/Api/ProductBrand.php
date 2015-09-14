<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class ProductBrand extends ApiController
{
    public function __construct(\livepos\ProductBrand $model)
    {
        parent::__construct($model);
    }
}
