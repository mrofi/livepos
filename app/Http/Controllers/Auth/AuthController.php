<?php

namespace livepos\Http\Controllers\Auth;

use Auth;
use View;
use Validator;
use livepos\User;
use Illuminate\Http\Request;
use livepos\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    protected $user;
    
    protected $username;
    
    protected $credentialText;
    
    protected $redirectTo = '/dashboard';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->credentialText = 'username'.(config('livepos.useremail') ? ' / email' : '');
        View::share('credentialText', $this->credentialText);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->user->get_rules(), $this->user->get_attributes());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function postLogging(Request $request)
    {
        $credential = $request->input('credential', '');
        $thepassword = $request->input('thepassword', '');
        $password = livepos_password($thepassword);
        
        if ($credential == '') return redirect($this->loginPath())->withInput($request->except('thepassword'))
                        ->withErrors(['credential' => trans('auth.emptyCredential', ['credential' => $this->credentialText])]);
                        
        if ($thepassword == '') return redirect($this->loginPath())->withInput($request->except('thepassword'))
                        ->withErrors(['credential' => trans('auth.emptyPassword')]);
        
        $validator = Validator::make($request->only('credential'), ['credential' => 'email']);
        $this->username = $credential_type = (! $validator->fails() && config('livepos.useremail')) ? 'email' : 'username';
        
        $request->session()->flash('credential', $credential_type);
        
        $request->merge($credentials = [$credential_type => $credential, 'password' => $password]);
        
        return $this->postLogin($request);
    }
}
