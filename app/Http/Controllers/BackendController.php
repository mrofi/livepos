<?php

namespace livepos\Http\Controllers;

use Illuminate\Http\Request;

use View;
use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class BackendController extends ApiController
{
    public function __construct()
    {
        $class = new \ReflectionClass($this);
        View::share( 'thePage', strtolower($class->getshortname()) );  
    }

}