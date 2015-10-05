<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Multilevel extends BaseModel
{
   	protected $fillable = ['customer_id', 'upline_id'];

    protected $rules = [
    	'customer_id' => 'required|numeric',
    	'upline_id' => 'numeric',
    ]; 

    protected $dependencies = ['customer'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public static function create(array $attributes = [])
    {
    	if ($attributes['upline_id'] == '') $attributes['upline_id'] = '0';

    	return parent::create($attributes);
    }

    public function getTotalCommisionAttribute()
    {
        return Commisions::where('Multilevel_id', $this->id)->where('redeem', '0')->sum('commisions');
    }
}
