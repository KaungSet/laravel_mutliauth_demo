<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Traits\AdminLogin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiUserLoginController extends Controller
{
    use AdminLogin, AuthenticatesUsers;
    public function showLoginForm()
    {
        if (Auth::guard('web')->check() || Auth::guard('admin')->check()) {
            return redirect()->route('dashboard')->with('error', 'Another guard already login');
        }
        return view('multiuserlogin');
    }

    public function multiuserLogin(Request $request)
    {
        $is_admin = false;

        if (Admin::where('email', $request->email)->first()) {
            $is_admin = true;
        }

        if ($is_admin) {
            $this->adminLogin($request);
        } else {
            $this->login($request);
        }
    }
}
