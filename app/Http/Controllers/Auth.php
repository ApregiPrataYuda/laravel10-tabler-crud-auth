<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Auth extends Controller
{
    public function login_page()
    {
       $data = [
           'title' => 'Login'
       ];
       return view('auth/login', $data);

    }
}
