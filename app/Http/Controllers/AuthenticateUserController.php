<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthenticateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::all()->where('level','2');
        //dd($user);
        return view ('authuser', ['user' => $user]);
    }

    public function verify($id)
    {
        $user = User::find($id);
        $user->is_verified = '1';
        $user->save();

        return redirect ('/authuser');
    }
}
