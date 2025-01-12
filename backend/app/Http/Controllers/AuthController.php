<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('auth.login');
        }
    }

    public function doLogin(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 1) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('login')->with('message', 'Email or Password is Invalid');
        }

        return redirect()->route('login')->with('message', 'Email or Password is Invalid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
