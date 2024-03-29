<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setting;
use App\Currency;
use Auth;
use Session;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){

        return view('auth.login');
    }




    public function authenticate(Request $request)
    {

        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
 
            $setting = Setting::first()->toArray();
            return redirect()->intended('dashboard');
        }

        return back()->withInput()->withErrors(['email' => "Invalid Username & Password"]);
    }

    /**
     * logout operation.
     *
     * @return redirect login page view
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }

}
