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
}
