<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Selling extends ApiController
{
    public function __construct(\livepos\Selling $model)
    {
        parent::__construct($model);
    }
}
