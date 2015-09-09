<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Purchasing extends BaseModel
{
    protected $fillable = ['transaction_no', 'bill_no', 'supplier_id', 'amount', 'discount', 'total_amount', 'created_by', 'updated_by'];
    
    protected $rules = [
        'supplier_id' => 'required|numeric',
        'amount' => 'required|numeric',
        'discount' => 'numeric',
        'total_amount' => 'required|numeric'
    ];

    protected $attributes = [
        'supplier_id' => 'ID Supplier',
        'amount' => 'Jumlah',
        'discount' => 'Diskon',
        'total_amount' => 'Total'
    ];
}