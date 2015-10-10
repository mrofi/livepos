<?php

namespace livepos;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Selling extends BaseModel
{
    protected static $created;

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

    public $additionalAttributes = ['point', 'customerPoint'];

    protected $dependencies = ['customer', 'details'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(SellingDetail::class);
    }

    public function getPointAttribute()
    {
        $shopCommision = Session::get('commision_of_shop', 0) / 100 * $this->profit;

        $customerCommision = Session::get('commision_of_customer', 0) / 100 * ($this->profit - $shopCommision);

        return $customerCommision;
    }

    public function getCustomerPointAttribute()
    {
        $customer = Customer::find($this->customer_id);

        if (!$customer) return 0;

        return $customer->totalPoint;
    }

    public static function create(Array $attributes = [])
    {
        DB::transaction(function () use ($attributes) {
            $selling = parent::create($attributes);
            $transaction_no = trans('livepos.transactionNumberFormat', [
                'type' => trans('livepos.selling.codeName'), 
                'id' => $selling->id,
                'month' => Carbon::now()->month,
                'year' => Carbon::now()->year,
            ]);

            $selling->transaction_no = $transaction_no;
            $selling->save();
            
            static::$created = $selling;
        });

        return static::$created;
    }

    public function update(Array $attributes = []) 
    {        
        DB::transaction(function () use ($attributes) {

            $updated = parent::update($attributes);

            $this->calculate();

            if (isset($attributes['pay']) && is_numeric($attributes['pay']))
            {
                $this->cash = $attributes['pay'];
                $this->change = $attributes['pay'] - $this->total_amount;
                $this->save();

            }

            return $updated;
        });
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

        if ($this->discount > $this->amount) $this->discount = $this->amount;

        $this->total_amount = $this->amount - $this->discount;

        $this->profit = $profit - $this->discount;

        $this->save();

        return true;
    }

}
