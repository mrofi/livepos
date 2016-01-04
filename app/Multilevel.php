<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Multilevel extends BaseModel
{
   	protected $fillable = ['customer_id', 'level', 'upline_id'];

    protected $rules = [
    	'customer_id' => 'required|numeric',
    	'upline_id' => 'numeric',
    ]; 

    protected $dependencies = ['customer'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

    public function upline()
    {
        return $this->hasOne(static::class, 'upline_id');
    }

    public static function create(array $attributes = [])
    {
    	if ($attributes['upline_id'] == '') 
        {
            $attributes['level'] = '1';
            $attributes['upline_id'] = '0';
        }
        else
        {
            $attributes['level'] = (int) static::find($attributes['upline_id'])->level + 1;
        }

    	return parent::create($attributes);
    }

    public function update(array $attributes = [])
    {
        if ($attributes['upline_id'] == '' || $attributes['upline_id'] == '0') 
        {
            $attributes['level'] = '1';
            $attributes['upline_id'] = '0';
        }
        else
        {
            $attributes['level'] = (int) static::find($attributes['upline_id'])->level + 1;
        }

        return parent::update($attributes);
    }

    public function getTotalCommisionAttribute()
    {
        return Commision::where('Multilevel_id', $this->id)->where('redeem', '0')->sum('commision');
    }
}
