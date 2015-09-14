<?php

namespace livepos;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $class_name = null;

    protected $fillable = [];
    
    protected $rules = [];
    
    protected $error_messages = [];
    
    protected $attributes = [];

    protected $init_data = [];

    protected function get_model_config()
    {
        if ($this->class_name !== null) return;
        $class = new \ReflectionClass($this);
        $className = strtolower($class->getShortName());
        if ($attributes = config("livepos.model.{$className}.attributes")) $this->attributes = $attributes;
        if ($init_data = config("livepos.model.{$className}.init_data")) $this->init_data = $init_data;
        if ($error_messages = config("livepos.model.{$className}.error_messages")) $this->error_messages = $error_messages;

        $this->class_name = $className;
    }
    
    public function get_rules($id = 'null')
    {
        $rules = json_encode($this->rules);
        $rules = str_replace('__id__', $id, $rules);
        $rules = json_decode($rules, true);
        
        return $rules;
    }
    
    public function get_error_messages()
    {
        $this->get_model_config();
        return $this->error_messages;
    }
    
    public function get_attributes()
    {
        $this->get_model_config();
        return $this->attributes;
    }

    public function get_init_data()
    {
        $this->get_model_config();
        return $this->init_data;
    }
}
