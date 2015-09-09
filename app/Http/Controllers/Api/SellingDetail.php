<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class SellingDetail extends ApiController
{
    public function __construct(\livepos\SellingDetail $model)
    {
        parent::__construct($model);
    }
}
