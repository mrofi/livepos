<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;
use livepos\Purchasing;

class Supplier extends BaseModel
{
    protected $fillable = ['supplier', 'address', 'contact1' ,'contact2', 'created_by', 'updated_by'];
    
    protected $rules = [
        'supplier' => 'required|string|max:50'
    ];

    protected $error_messages = [
        'supplier.required' => 'Nama Supplier harus diisi maksimal 50 karakter'
    ];
    
    protected $attributes = [
        'supplier' => 'Nama Supplier'
    ];

    public function purchasings()
    {
        return $this->hasMany(Purchasing::class);
    }
}
