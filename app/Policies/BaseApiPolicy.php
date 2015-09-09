<?php

namespace livepos\Policies;

use User;
use Illuminate\Database\Eloquent\Model;

class BaseApiPolicy
{
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function index(User $user, Model $model)
    {
        // exit(print_r($model));
        // $forbiddenArea = get_class($model). '.index';
        // return $user->hasForbidden($forbiddenArea);
    }
}
