<?php

namespace livepos\Http\Controllers;

use Illuminate\Http\Request;

use View;
use livepos\Http\Requests;
use livepos\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function __construct()
    {
        $class = new \ReflectionClass($this);
        View::share( 'thePage', strtolower($class->getshortname()) );  
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }
    

}