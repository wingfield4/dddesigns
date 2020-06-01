<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JoinController extends Controller
{
    /**
     * Go to Join Screen
     *
     * @return View
     */
    public function __invoke()
    {
        if (Auth::check()) {
          Auth::logout();
        }

        return view('join');
    }

    public function submit(Request $request)
    {
        $user = new User;
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;

        //Emails don't match
        if($user->email != $request->confirmEmail)
        {
            return view('join', [
                'error' => 'Emails did not match',
                'user' => $user
            ]);
        }

        //Passwords don't match
        if($request->password != $request->confirmPassword)
        {
            return view('join', [
                'error' => 'Passwords did not match',
                'user' => $user
            ]);
        }

        //password too short
        if(strlen($request->password) < 6) {
            return view('join', [
                'error' => 'Please provide a password of at least 6 characters',
                'user' => $user
            ]);
        }

        //check existing user
        $duplicateUser = User::where('email', $user->email)->first();
        if(!is_null($duplicateUser)) {
            return view('join', [
                'error' => 'A user with this email address already exists. Try Logging in or using a different email address.',
                'user' => $user
            ]);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        if (Auth::attempt([ 'email' => $user->email, 'password' => $request->password ])) {
            return redirect()->to('welcome');
        }

        //someting failed
        abort(500);
    }
}