<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Customer extends ApiController
{
    public function __construct(\livepos\Customer $model)
    {
        parent::__construct($model);
    }
}
