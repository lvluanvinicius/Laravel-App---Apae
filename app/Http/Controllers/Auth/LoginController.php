<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.index');
        }

        if (Auth::guard('client')->check()) {
            return redirect()->route('client.index');
        }

        return view('pages.login.index')->with([
            'title' => "Login"
        ]);
    }
}
