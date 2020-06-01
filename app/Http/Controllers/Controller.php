<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $BASE_IMAGE_PATH = 'https://storage.googleapis.com/dddesigns/';
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
