<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Go to Login Screen
     *
     * @return View
     */
    public function __invoke()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return view('login', [
            'error' => 'Sorry, those credentials don\'t match',
            'email' => $request->email
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}