<?php

namespace livepos;

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
        'selling_price' => 'required|numeric',
    ];

}
