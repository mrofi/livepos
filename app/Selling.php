<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Selling extends BaseModel
{
    protected $fillable = ['transaction_no', 'customer_id', 'amount', 'discount', 'total_amount', 'created_by', 'updated_by'];
    
     protected $rules = [
        'customer_id' => 'required|numeric',
        'amount' => 'required|numeric',
        'discount' => 'numeric',
        'total_amount' => 'required|numeric'
    ];

    protected $attributes = [
        'customer_id' => 'ID Customer',
        'amount' => 'Jumlah',
        'discount' => 'Diskon',
        'total_amount' => 'Total'
    ];
}
