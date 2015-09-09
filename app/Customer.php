<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    protected $fillable = ['name', 'id_no', 'id_type', 'created_by', 'updated_by'];
    
    protected $rules = [
        'name' => 'required|string|max:50',
        'id_no' => 'required|string|max:25',
        'id_type' => 'required|string|max:10'
    ];

    protected $attributes = [
        'name' => 'Nama',
        'id_no' => 'No identitas',
        'id_type' => 'Jenis identitas'
    ];
}