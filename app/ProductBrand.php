<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends BaseModel
{
    protected $fillable = ['brand', 'created_by', 'updated_by'];
    
    protected $rules = ['brand' => 'required|string|max:30|unique:product_brands,brand,__id__'];
    
    protected $attributes = ['brand' => 'Merk'];

    public function delete()
    {
    	if ($this->id == 1) return false;

    	return parent::delete();
    }

    public function update(Array $attributes = array())
    {
    	if ($this->id == 1) return false;

    	return parent::update($attributes);
    }
}
