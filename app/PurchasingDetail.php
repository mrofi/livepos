<?php

namespace livepos;

use DB;
use Illuminate\Database\Eloquent\Model;

class PurchasingDetail extends BaseModel
{
    protected $fillable = ['purchasing_id', 'product_id', 'product_name', 'unit', 'converter', 'purchase_price', 'discount', 'quantity', 'amount', 'created_by', 'updated_by'];
    
    protected $rules = [
        'purchasing_id' => 'required|numeric',
        'product_id' => 'required|numeric',
        'product_name' => 'required|string|max:50',
        'unit' => 'required|string|max:10',
        'converter' => 'required|numeric',
        'purchase_price' => 'required|numeric',
        'discount' => 'numeric',
        'quantity' => 'required|numeric',
    ];

    protected $attributes = [
        'purchasing_id' => 'ID Purchasing',
        'product_id' => 'ID Produk',
        'product_name' => 'Nama',
        'unit' => 'Satuan',
        'purchase_price' => 'Harga Beli',
        'discount' => 'Diskon',
        'quantity' => 'Quantity',
        'amount' => 'Jumlah'
    ];

    public function purchasing()
    {
        $this->belongsTo(Purchasing::class);
    }

    public static function create(Array $attributes = [])
    {
        DB::beginTransaction();

            if (!isset($attributes['discount'])  || ! $attributes['discount']) $attributes['discount'] = 0;

            $attributes['purchase_price'] = $attributes['price'] / $attributes['converter'];

            $attributes['amount'] = $attributes['price'] * $attributes['quantity'] - $attributes['discount'];

            $created = parent::create($attributes);

            Purchasing::find($created->purchasing_id)->calculate();

        DB::commit();

        return $created;
    } 

    public function update(Array $attributes = [])
    {
        DB::beginTransaction();

            if (!isset($attributes['discount'])  || ! $attributes['discount']) $attributes['discount'] = 0;

            $attributes['purchase_price'] = $attributes['price'] / $attributes['converter'];

            $attributes['amount'] = $attributes['price'] * $attributes['quantity'] - $attributes['discount'];

            parent::update($attributes);

            Purchasing::find($this->purchasing_id)->calculate();

        DB::commit();

        return $this;
    } 

    public function delete(Array $attributes = [])
    {
        DB::beginTransaction();

            parent::delete($attributes);

            Purchasing::find($this->purchasing_id)->calculate();

        DB::commit();

        return $this;
    } 
}
