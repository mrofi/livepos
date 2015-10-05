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
        $get = Model::where('id', '<>', '1')
                    ->where(function( $sql ) use($query) {
                        $sql->orWhere('customer', 'like', "%{$query}%") 
                            ->orWhere('address', 'like', "%{$query}%")
                            ->orWhere('id_no', 'like', "%{$query}%")
                            ->orWhere('contact1', 'like', "%{$query}%")
                            ->orWhere('contact2', 'like', "%{$query}%");
                    })
                    ->get();
        return $get;
    }
}
