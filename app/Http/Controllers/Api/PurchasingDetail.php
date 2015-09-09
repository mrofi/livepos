<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class PurchasingDetail extends ApiController
{
    public function __construct(\livepos\PurchasingDetail $model)
    {
        parent::__construct($model);
    }
}
