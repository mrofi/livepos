<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use livepos\Product as Model;
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
        
        $brand = array_flatten(\livepos\ProductBrand::where('brand', 'like', "%{$query}%")->get(['id']));
    	
        $category = array_flatten(\livepos\ProductCategory::where('category', 'like', "%{$query}%")->get(['id']));

        $product = Model::with('metas')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('barcode', 'like', "%{$query}%")
            ->orWhereIn('brand_id', $brand)
            ->orWhereIn('category_id', $category)
            ->where('active', '1')
        ->get();
    	
        return $product;
    }
}
