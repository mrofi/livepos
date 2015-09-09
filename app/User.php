<?php

namespace livepos;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'public_key', 'api_key'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'api_key', 'public_key', 'email'];
    
    protected static $api_type = null;
    
    public static function create(Array $data = array())
    {
        $data['api_key'] = str_random(64);
        $data['public_key'] = 'KEY-'.str_random(64);
        
        return parent::create($data);
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    
    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }
     
    public function revokeRole($role)
    {
        return $this->roles()->detach($role);
    }
    
    public function hasRole($role)
    {
        foreach($this->roles as $role)
        {
            if ($role->name === $name) return true;
        }
         
        return false;
    }
    
    public function hasForbidden($area)
    {
        foreach($this->roles as $role)
        {
            if ($role->forbidden == null) return false;
            
            foreach((Array) unserialize($role->forbidden) as $forbidden)
            {
                if ($forbidden === $area) return true;    
            }
        }
         
        return false;
    }
    
    public static function getUserByKey($public_key = null, $api_key = null, $password = null)
    {
        if ($user = parent::where('api_key', $api_key)->where('password', $password)->first()) 
        {
            static::$api_type = 'private';
            return $user;
        }
        
        if ($user = parent::where('public_key', $public_key)->first())
        {
            static::$api_type = 'public';
            return $user;
        }
        
        return false;
    }
    
}
