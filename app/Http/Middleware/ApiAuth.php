<?php

namespace livepos\Http\Middleware;

use Closure;
use livepos\User;
use Illuminate\Contracts\Auth\Guard;

class ApiAuth
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            $publicKey = $request->input('public_key', null);
            $apiKey = $request->input('api_key', null);
            $password = $request->input('password', null);
            if ( ! $user = User::getUserByKey($publicKey, $apiKey, $password) ) return response('Unauthorized.', 401);
            $this->auth->setUser($user);
        }

        return $next($request);
    }
}
