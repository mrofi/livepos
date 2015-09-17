<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class ProductMeta extends BaseModel
{
    protected $fillable = ['product_id', 'meta_key', 'meta_value', 'created_by', 'updated_by'];
    
    protected $rules = [
        'product_id' => 'required|numeric',
        'meta_key' => 'required|string|max:255',
        'meta_value' => 'required|string'
    ];

    protected $attributes = [
        'product_id' => 'ID Produk',
        'meta_key' => 'Meta Key',
        'meta_value' => 'Meta Value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}