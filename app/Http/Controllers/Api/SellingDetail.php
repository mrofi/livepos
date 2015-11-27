<?php

namespace livepos\Http\Controllers\Api;

use Illuminate\Http\Request;

use DB;
use livepos\Selling as SellingModel;
use livepos\Product;
use livepos\ProductMeta;
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
	        $unit = $request->get('unit');
	        $quantity = $request->get('quantity');
	        $converter = 1;

	        $selling_price = $product->selling_price;
	        $cekMultiPrice = json_decode(ProductMeta::where('product_id', $product->id)->where('meta_key', 'multi_price')->first()->meta_value, true);
	        $cekMultiUnit = json_decode(ProductMeta::where('product_id', $product->id)->where('meta_key', 'multi_unit')->first()->meta_value, true);

	        foreach ($cekMultiUnit as $multiUnit) 
	        {
	        	if ($unit == $multiUnit['unit']) 
	        	{
	        		$converter = $multiUnit['quantity'];
	        		break;
	        	}

	        }

	        $selling_price_by_unit = $selling_price;
	        $smallQuantity = 1;
	        $factQuantity = $quantity * $converter; // quantity dalam satuan terkecil

	        foreach ($cekMultiPrice as $multiPrice) 
	        {
	        	if ($multiPrice['quantity'] > $smallQuantity)
	        	{
	        		if ($multiPrice['quantity'] <= $factQuantity) $selling_price = $multiPrice['selling_price'];
	        		if ($multiPrice['quantity'] <= $converter) $selling_price_by_unit = $multiPrice['selling_price'];
	        		$smallQuantity = $multiPrice['quantity'];
	        	}

	        }

	        $amount = $selling_price_by_unit * $factQuantity;
	        $discount = $request->get('discount', 0);
	        if ($amount > ($factQuantity * $selling_price)) $discount += $amount - ($factQuantity * $selling_price);
	        if ($discount > $amount) $discount = $amount;
	        $amount -= $discount;

	        $request->merge([
	        	'product_name' => $product->name,
	        	'amount' => $amount,
	        	'converter' => $converter,
	        	'selling_price' => $selling_price_by_unit,
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

    public function _store(Request $request)
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
