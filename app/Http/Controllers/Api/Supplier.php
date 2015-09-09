<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Supplier extends ApiController
{
    public function __construct(\livepos\Supplier $model)
    {
        parent::__construct($model);
    }
}
