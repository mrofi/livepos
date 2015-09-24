<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use \livepos\Product as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Product extends ApiController
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function getSearch(Request $request)
    {
    	$query = $request->get('q');
    	$get = Model::where('active', '1')->where('name', 'like', "%{$query}%")->with('metas')->get();
    	return $get;
    }
}
