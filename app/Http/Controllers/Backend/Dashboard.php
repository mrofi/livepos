<?php

namespace livepos\Http\Controllers\Backend;

use Illuminate\Http\Request;

use livepos\Http\Requests;
use livepos\Http\Controllers\BackendController;

class Dashboard extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('backend.dashboard');
    }
    
    

    
}
