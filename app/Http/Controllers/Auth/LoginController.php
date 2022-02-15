<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            return '/admin/dashboard';
        } else if ($user->isAdmin()) {
            return '/admin/marketer';
        } else if ($user->isMarketer()) {
            return '/marketer/dashboard';
        }else if($user->isAdviser()){
            return '/adviser/orders';
        }else if($user->isAccountant()){
            return '/accountant/payments';
        }
    }


    public function username(){
        return 'phone';
    }




}
