<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Supplier extends BaseModel
{
    protected $fillable = ['name', 'created_by', 'updated_by'];
    
    protected $rules = [
        'name' => 'required|string|max:50'
    ];

    protected $error_messages = [
        'name.required' => 'Nama Supplier harus diisi maksimal 50 karakter'
    ];
    
    protected $attributes = [
        'name' => 'Nama Supplier'
    ];
}
