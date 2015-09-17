<?php

namespace livepos;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    protected $fillable = ['name', 'category_id', 'brand_id', 'unit', 'min_stock', 'purchase_price', 'selling_price', 'created_by', 'updated_by'];
    
    protected $rules = [
        'name' => 'required|string|max:50|unique:products,name,__id__',
        'category_id' => 'required|numeric',
        'brand_id' => 'required|numeric',
        'unit' => 'required|string|max:10',
        'purchase_price' => 'required|numeric',
        'selling_price' => 'required|numeric|min:1',
    ];

    protected function addMeta($product_id, Array $attributes = [])
    {
    	if ($units = json_decode($attributes['_multi_unit_data']))  
    	{
    		$_units = [];
    		foreach ($units as $unit) 
    		{
    			if ($unit->unit == $attributes['unit']) 
				{
					DB::rollback();
					return ['error' => trans('livepos.product.errorNotAllowedDuplicatedUnit')];	
				}

				if ($unit->unit == '' || $unit->quantity == '')
				{
					DB::rollback();
					return ['error' => trans('livepos.product.errorNotAllowedEmptyUnit')];	
				}

				unset($unit->action);
				$_units[] = $unit;
    		}

    		ProductMeta::create(['product_id' => $product_id, 'meta_key' => 'multi_unit', 'meta_value' => json_encode($_units), 'created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id]);
    	}

    	if ($prices = json_decode($attributes['_multi_price_data']))  
    	{
    		$_prices = [];
    		foreach ($prices as $price) 
    		{
    			if ($price->quantity == '' || $price->selling_price == '')
				{
					DB::rollback();
					return ['error' => trans('livepos.product.errorNotAllowedEmptyPrice')];	
				}

    			unset($price->action);
    			$_prices[] = $price;
    		}

    		ProductMeta::create(['product_id' => $product_id, 'meta_key' => 'multi_price', 'meta_value' => json_encode($_prices), 'created_by' => auth()->user()->id, 'updated_by' => auth()->user()->id]);
    	}

    }

    public static function create(Array $attributes = [])
    {
        DB::beginTransaction();

	    	$created = parent::create($attributes);

	    	$this->addMeta($created->id, $attributes);
	    	
	    DB::commit();
	    
	    return $created;
    }

    public function update(Array $attributes = [])
    {
        DB::beginTransaction();

	    	$updated = parent::update($attributes);

	    	ProductMeta::where('product_id', $this->id)->delete();

	    	$this->addMeta($this->id, $attributes);
	    	
	    DB::commit();
	    
	    return $updated;
    }

    public function delete()
    {
        DB::beginTransaction();

            $deleted = parent::delete();

            ProductMeta::where('product_id', $this->id)->delete();
            
        DB::commit();
        
        return $deleted;
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

}
