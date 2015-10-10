<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use DB;
use livepos\Selling as SellingModel;
use livepos\Product;
use livepos\Http\Requests;
use livepos\Http\Controllers\ApiController;

class SellingDetail extends ApiController
{
	protected $selling;

    public function __construct(\livepos\SellingDetail $model, Selling $selling)
    {
        parent::__construct($model);
        $this->selling = $selling;
    }

    public function store(Request $request)
    {
    	DB::beginTransaction();

    		// if selling_id == '' means it's new entry
	        if ($request->get('selling_id', '') == '')
	        {
	        	// make new selling header first
	        	$request2 = clone $request;
	        	$request2->merge(['customer_id' => 1, 'amount' => 0, 'total_amount' => 0, 'discount' => 0]);
	        	$selling = $this->selling->store($request2);

	        	if (!isset($selling['message']) || $selling['message'] != 'ok')
	        	{
	        		DB::rollback();
	        		return ['error' => 'cannot make new selling', 'created' => $selling];
	        	}

	        	$request->merge(['selling_id' => $selling['created']['id']]);
	        }


	        $product = Product::find($request->product_id);
	        $amount = $request->get('selling_price') * $request->get('quantity') * $request->get('converter');
	        $discount = $request->get('discount', 0);
	        if ($discount > $amount) $discount = $amount;
	        $amount -= $discount;

	        $request->merge([
	        	'product_name' => $product->name,
	        	'amount' => $amount,
	        	'discount' => $discount,
	        ]);

	        $stored = parent::store($request);

	        if (!isset($stored['message']) || $stored['message'] != 'ok')
        	{
        		DB::rollback();
        		return ['error' => 'cannot make new entry of selling', 'created' => $stored];
        	}

        	$sellingModel = SellingModel::find($request->get('selling_id'));

        	$calculation = $sellingModel->calculate();

        	if (!$calculation) 
        	{
        		DB::rollback();
        		return ['error' => 'error occurred when calculating'];
        	}

	    DB::commit();

	    return $stored;

    }

    public function destroy(Request $request, $id)
    {
    	DB::beginTransaction();

		    $deleted = parent::destroy($request, $id);

		    if (isset($deleted['deleted']['error'])) 
		    {
		    	DB::rollback();
		    	return $deleted;
		    } 

		    $sellingModel = SellingModel::find($deleted['deleted']['selling_id']);

		    $calculation = $sellingModel->calculate();

        	if (!$calculation) 
        	{
        		DB::rollback();
        		return ['error' => 'error occurred when calculating'];
        	}

		DB::commit();

		return $deleted;
    }
}
