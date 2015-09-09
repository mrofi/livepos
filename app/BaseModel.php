<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $rules = array();
    
    protected $error_messages = array();
    
    protected $attributes = array();
    
    public function get_rules($id = 'null')
    {
        $rules = json_encode($this->rules);
        $rules = str_replace('__id__', $id, $rules);
        $rules = json_decode($rules, true);
        
        return $rules;
    }
    
    public function get_error_messages()
    {
        return $this->error_messages;
    }
    
    public function get_attributes()
    {
        return $this->attributes;
    }
}
