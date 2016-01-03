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

    public function redeem(Request $request, $id)
    {
    	$redeems = \livepos\Commision::where('redeem', '0')->where('multilevel_id', $id);
    	$nomimal = $redeems->sum('commision');

    	$redeems->update(['redeem' => '1']);

    	return ['message' => 'ok', 'nomimal' => $nomimal];
    }

    
}
