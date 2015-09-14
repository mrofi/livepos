<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends BaseModel
{
    protected $fillable = ['category', 'created_by', 'updated_by'];
    
    protected $rules = ['category' => 'required|string|max:30|unique:product_categories,category,__id__'];
    
    protected $attributes = ['category' => 'Kategori'];

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

