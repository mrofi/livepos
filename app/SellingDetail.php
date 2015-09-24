<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class SellingDetail extends BaseModel
{
    protected $fillable = ['selling_id', 'product_id', 'product_name', 'unit', 'converter', 'purchase_price', 'selling_price', 'discount', 'quantity', 'amount', 'created_by', 'updated_by'];
    
    protected $rules = [
        'selling_id' => 'required|numeric',
        'product_id' => 'required|numeric',
        'product_name' => 'required|string|max:50',
        'unit' => 'required|string|max:10',
        'converter' => 'required|numeric',
        'purchase_price' => 'required|numeric',
        'selling_price' => 'required|numeric',
        'discount' => 'numeric',
        'quantity' => 'required|numeric|min:0.000000001',
        'amount' => 'required|numeric'
    ];

    protected $attributes = [
        'selling_id' => 'ID Selling',
        'product_id' => 'ID Produk',
        'product_name' => 'Nama Produk',
        'unit' => 'Satuan',
        'purchase_price' => 'Harga Beli',
        'selling_price' => 'Harga Jual',
        'discount' => 'Diskon',
        'quantity' => 'Quantity Produk',
        'amount' => 'Jumlah'
    ];

    public function selling()
    {
        return $this->belongsTo(Selling::class);
    }
}