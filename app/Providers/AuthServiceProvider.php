<?php

namespace livepos\Providers;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'livepos\BaseModel' => 'App\Policies\BaseApiPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
        
        $gate->define('api-authorization', function ($user, $area) {
            return ! $user->hasForbidden($area);
        });
    }
}