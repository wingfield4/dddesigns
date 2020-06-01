<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    /**
     * Go to Welcome Screen
     *
     * @return View
     */
    public function __invoke()
    {
        $user = Auth::user();
        return view('about', [
          'user' => $user
        ]);
    }
}