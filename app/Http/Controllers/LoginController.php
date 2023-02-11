<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
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

    //use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
            Auth::logout();
    return redirect('/login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
            // Authentication passed...
            if(Auth::user()->is_verified==1){
                if (Auth::user()->level==1){
                return redirect()->route('user.index');
                }else if (Auth::user()->level==3){
                    return redirect()->route('cashier.index');
                }
            }else{
                return redirect('/unverified');
            }
        }else{
            return redirect('/wrong');
        }
        
    }

    //user unverified
    public function unverify()
    {
        Session::flash('message', 'Wait until your account is verified before you can login.');
            return view('Auth.login'); 
    }

    //wrong authentication
    public function wrong()
    {
        Session::flash('message', 'Username or password is incorrect');
            return view('Auth.login'); 
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }
}
