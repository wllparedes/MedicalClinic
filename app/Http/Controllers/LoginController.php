<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function _index()
    {
        return redirect()->route('login');
    }
}
