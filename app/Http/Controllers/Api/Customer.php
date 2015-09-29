<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Customer as Model;
use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Customer extends ApiController
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function getSearch(Request $request)
    {
        $query = $request->get('q');
        $get = Model::where('id', '<>', '1')->where('customer', 'like', "%{$query}%")->get();
        return $get;
    }
}
