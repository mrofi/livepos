<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Selling extends BaseModel
{
    protected $fillable = ['transaction_no', 'customer_id', 'amount', 'discount', 'total_amount', 'profit', 'done', 'created_by', 'updated_by'];
    
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

    protected $dependencies = ['customer', 'details'];

    public  function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(SellingDetail::class);
    }

    public function calculate()
    {
        if (!isset($this->id)) return false;

        $amount = 0;

        $profit = 0;

        foreach ($details = $this->details as $detail) 
        {
            $amount += $detail->amount;

            $profit += $detail->amount - ($detail->purchase_price * $detail->quantity * $detail->converter);
        }

        $this->amount = $amount;

        $this->total_amount = $this->amount - $this->discount;

        $this->profit = $profit - $this->discount;

        $this->save();

        return true;
    }

}
