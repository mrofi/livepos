<?php

namespace livepos;

use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Selling extends BaseModel
{
    protected static $created;

    private $mutation_type = 'selling';

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
                if ($attributes['pay'] < $this->total_amount) return;

                $details = SellingDetail::where('selling_id', $this->id)->get();

                foreach ($details as $detail) 
                {
                    $product = Product::find($detail->product_id);

                    if ($product)
                    {
                        $stock = Stock::create([
                            'product_id' => $product->id,
                            'mutation_type' => $this->mutation_type, // detail of selling
                            'reff' => $detail->id, // detail id
                            'unit' => $product->unit, // unit of product
                            'quantity' => $detail->quantity * $detail->converter * -1, // quantity * converter
                            'description' => trans('livepos.stock.description.selling', ['id' => $this->id]),
                            'created_by' => auth()->user()->id,
                            'updated_by' => auth()->user()->id,
                        ]);

                        $stock->created_at = $this->created_at;

                        $stock->save();

                        if (! $stock->id ) 
                        {
                            DB::rollback();
                            return $stock['error'];
                        }
                        
                    }


                }
                
                $this->cash = $attributes['pay'];
                $this->change = $attributes['pay'] - $this->total_amount;
                // $this->save();

                $this->done = '1';

                $this->save();

                if (is_numeric($this->customer_id))
                {
                    $multilevel = Multilevel::where('customer_id', $this->customer_id)->first();
                    
                    if ($multilevel)
                    {
                        Commision::where('selling_id', $this->id)->where('redeem', '0')->delete();
                        Commision::create([
                            'selling_id' => $this->id,
                            'multilevel_id' => $multilevel->id,
                            'commision' => $this->getPointAttribute(),
                        ]);
                        
                    }

                    $this->multilevel = $this->getPointAttribute();

                    $this->save();
                }

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
