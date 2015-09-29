<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Multilevel extends ApiController
{
    public function __construct(\livepos\Multilevel $model)
    {
        parent::__construct($model);
    }
}
