<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AdminLogin
{
    public function adminLogin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }
    }
}
