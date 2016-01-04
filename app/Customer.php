<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    protected $fillable = ['customer', 'id_no', 'id_type', 'address', 'contact1' ,'contact2', 'created_by', 'updated_by'];
    
    protected $rules = [
        'customer' => 'required|string|max:50',
        'id_no' => 'required|string|max:25',
        'id_type' => 'required|string|max:10',
        'address' => 'string',
        'contact1' => 'numeric',
        'contact2' => 'numeric',
    ];

    protected $attributes = [
        'customer' => 'Nama Customer',
        'id_no' => 'No identitas',
        'id_type' => 'Jenis identitas',
        'address' => 'Alamat Lengkap',
        'contact1' => 'Telp / Hp #1',
        'contact2' => 'Telp / Hp #2',
    ];


    public function multilevel()
    {
        return $this->hasOne(Multilevel::class);
    }

    public function getTotalPointAttribute()
    {
        if ( ! $multilevel = Multilevel::where('customer_id', $this->id)->first() ) return 0;

        return $multilevel->totalCommision;
    }
}