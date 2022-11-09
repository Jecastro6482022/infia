<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_user' => ['require,email,string'],
            'contraseña_user' => ['required', 'string']
        ]);
        if (Auth::attempt($credentials)) {
            return view('main');
        }
        return view('login');
    }
}
