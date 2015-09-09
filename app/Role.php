<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'forbidden'];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public static function create(Array $data = array())
    {
        if (isset($data['forbidden'])) $data['forbidden'] = serialize($data['forbidden']);
        
        return parent::create($data);
    }
}
