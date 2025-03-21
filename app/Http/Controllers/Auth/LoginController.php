<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    /**
     * Where to redirect users after login.
     * 
     * @return string
     */
    public function redirectTo()
    {
        if (Auth::user()->role_id == '1') {
            return '/admin-dashboard';
        }
        if (Auth::user()->role_id == '2') {
            return '/bac-dashboard';
        }
        if (Auth::user()->role_id == '3') {
            return '/budget-office-dashboard';
        }
        if (Auth::user()->role_id == '4') {
            return '/user-dashboard';
        }
    }
}
