<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    protected $fillable = ['name', 'category_id', 'unit', 'min_stock', 'purchasing_price', 'selling_price', 'created_by', 'updated_by'];
    
    protected $rules = [
        'name' => 'required|string|max:50',
        'category_id' => 'required|numeric',
        'unit' => 'required|string|max:10',
        'puchase_price' => 'required|numeric',
        'selling_price' => 'required|numeric',
    ];

    protected $attributes = [
        'name' => 'Nama Produk',
        'category_id' => 'Kategori',
        'unit' => 'Satuan',
        'puchase_price' => 'Harga Beli',
        'selling_price' => 'Harga Jual'
    ];
}
