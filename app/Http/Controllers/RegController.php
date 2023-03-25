<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store (Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'integer', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'is_verified' => '0',
            'level' => '2',
            'password' => Hash::make($data['password']),
        ]);

        return redirect('/login/regsuccess');

    }
}
