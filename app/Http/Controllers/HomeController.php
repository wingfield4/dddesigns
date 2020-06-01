<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Go to Login Screen
     *
     * @return View
     */
    public function __invoke()
    {
        $user = Auth::user();
        return view('home', [
          'user' => $user
        ]);
    }
}