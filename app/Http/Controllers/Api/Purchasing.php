<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Purchasing extends ApiController
{
    public function __construct(\livepos\Purchasing $model)
    {
        parent::__construct($model);
    }
}
