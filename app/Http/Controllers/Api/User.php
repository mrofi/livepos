<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class User extends ApiController
{
    public function __construct(\livepos\User $model)
    {
        parent::__construct($model, true);
    }
}
