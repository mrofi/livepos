<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Customer;
use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Multilevel extends ApiController
{
    public function __construct(\livepos\Multilevel $model)
    {
        parent::__construct($model);
    }

    public function getCustomerSearch(Request $request)
    {
        $query = $request->get('q');
        $get = Customer::has('multilevel')->with('multilevel')
                    ->where('id', '<>', '1')
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

    public function getCustomerNewSearch(Request $request)
    {
        $query = $request->get('q');
        $get = Customer::has('multilevel', '<', 1)->with('multilevel')
                    ->where('id', '<>', '1')
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



    public function redeem(Request $request, $id)
    {
    	$redeems = \livepos\Commision::where('redeem', '0')->where('multilevel_id', $id);
    	$nomimal = $redeems->sum('commision');

    	$redeems->update(['redeem' => '1']);

    	return ['message' => 'ok', 'nomimal' => $nomimal];
    }

    
}
