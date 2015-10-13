<?php

namespace livepos\Http\Controllers\api;

use livepos\Product;
use Illuminate\Http\Request;
use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class Stock extends ApiController
{
    public function __construct(\livepos\Stock $model)
    {
        parent::__construct($model);
    }

    public function update(Request $request, $id)
    {
        $request->merge(array_map('trim', $request->all()));
     
        return $this->userAuthorize('update', function() use ($request, $id)
        {
            // find record
            $product = Product::findOrFail($id);
            
            $new_data = [
            	'product_id' => $product->id, 
            	'mutation_type' => 'manual', 
            	'reff' => 0,
            	'unit' => $product->unit,
            	];

            $request->merge($new_data);

            // validation
            $this->validate($request, $this->model->get_rules($id), $this->model->get_error_messages(), $this->model->get_attributes());
            
            // quantity
            $quantity = $request->get('quantity');

            if ($product->stock == $quantity) return ['message' => 'ok', 'changed' => $product];

            $quantity -= $product->stock;

            // adding user
            $request->merge(['quantity' => $quantity, 'created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id]);
            
            // adding data
            $this->model->create($request->all());

            $product->stock = $product->stock;

            return ['message' => 'ok', 'changed' => $product];
        });
    }
}
