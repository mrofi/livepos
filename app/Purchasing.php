<?php

namespace livepos;

use DB;
use Carbon\Carbon;
use livepos\PurchasingDetail;
use livepos\Supplier;
use Illuminate\Database\Eloquent\Model;

class Purchasing extends BaseModel
{
    protected static $created;

    protected $fillable = ['transaction_no', 'bill_no', 'bill_date', 'supplier_id', 'amount', 'discount', 'total_amount', 'done', 'created_by', 'updated_by'];
    
    protected $rules = [
        'bill_no' => 'required|string|max:50|unique:purchasings,bill_no,__id__',
        'bill_date' => 'required|date',
        'supplier_id' => 'required|numeric',
        'amount' => 'numeric',
        'discount' => 'numeric',
        'total_amount' => 'numeric'
    ];

    protected $attributes = [
        'supplier_id' => 'ID Supplier',
        'amount' => 'Jumlah',
        'discount' => 'Diskon',
        'total_amount' => 'Total'
    ];

    public static function create(Array $attributes = [])
    {
        DB::transaction(function () use ($attributes) {
            $attributes['bill_date'] = livepos_dateToDB($attributes['bill_date']);
            $purchasing = parent::create($attributes);
            $transaction_no = trans('livepos.transactionNumberFormat', [
                'type' => trans('livepos.purchasing.codeName'), 
                'id' => $purchasing->id,
                'month' => Carbon::now()->month,
                'year' => Carbon::now()->year,
            ]);

            $purchasing->transaction_no = $transaction_no;
            $purchasing->save();
            
            static::$created = $purchasing;
        });

        return static::$created;
    }

    public function update(Array $attributes = []) 
    {
        if ($this->done == '1') return ['error' => 'Not Allowed'];
        
        if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $attributes['bill_date'])) $attributes['bill_date'] = livepos_dateToDB($attributes['bill_date']);
        
        $updated = parent::update($attributes);

        $this->calculate();

        return $updated;
    }

    public function delete()
    {
        if ($this->done == '1') return ['error' => 'Not Allowed'];

        DB::transaction(function () {

            PurchasingDetail::where('purchasing_id', $this->id)->delete();

            $deleted = parent::delete();

            return $deleted;

        });
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchasing_details()
    {
        return $this->hasMany(PurchasingDetail::class);
    }

    public function calculate()
    {
        DB::beginTransaction();

            $details = PurchasingDetail::where('purchasing_id', $this->id)->get();

            $amount = 0;

            foreach ($details as $row) 
            {
                $amount += $row->amount;        
            }

            $this->amount = $amount;

            $this->total_amount = $amount - $this->discount;

            $this->save();

        DB::commit();
    }
}