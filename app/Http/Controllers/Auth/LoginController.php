<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	// by dafault use of email for autenthication but we use username for auth
/* 	public function username()
	{
		return 'username';
	}*/
/* 	public function guard()
	{
	//	return Auth::gaurd('gaurd-name');
	} */

    // authenticate user manually without use of laravel
    /*
    public funntion authenticate(Request $request)
    {
            $crditional = $request->only('email','password');
            if(Auth::attempt($crditional))
                // authentication passed
            return redirect()->intended();
    }
    */
}
