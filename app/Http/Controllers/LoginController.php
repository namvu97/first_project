<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{

    public function getLogin()
    {
        if (session()->has('username') == false) {
            return view('login_account');
        } else
            return view('home_layout');
    }

    public function postLogin(LoginRequest $request)
    {
        $userName = $request->username;
        $passWord = $request->password;
        $user = User::where('username', $userName)->first();
        if (isset($user->username)) {
            if ($user->password == $passWord) {
                $userName = $user->username;
                $isAdmin = $user->is_Admin;
                $createdAt = $user->created_at;
                session(['username' => $userName, 'is_Admin' => $isAdmin, 'created_at' => $createdAt]);
                if (session('created_at') == null) {
                    return redirect(url("password/change"));
                } else
                    return redirect('home');
            } else
                return redirect(url('login?err=user-notexists'));
        } else
            return redirect(url('login?err=user-notexists'));
    }
}
