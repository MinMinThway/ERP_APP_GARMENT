<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }

    protected function redirectTo(){
        $roles = auth()->user()->getRoleNames();    
        // var_dump($roles[0]);
        // die();
        // Chekc user roles
        switch ($roles[0]) {
            case 'production/warehouse':
                return '/production/warehouse/home';
                break;
            case 'production/staff':
                return '/production/staff/home';
                break;
            case 'production/admin':
                return '/production/admin/home';
                break;
            case 'procurement/staff':
                return '/procurement/staff/home';
                break;
            case 'procurement/admin':
                return '/procurement/admin/home';
                break;
            case 'finance/staff':
                return '/finance/staff/home';
                break;
            case 'finance/admin':
                return '/finance/admin/home';
        }
    }
}
