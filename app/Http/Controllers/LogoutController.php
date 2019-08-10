<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{

    public function getLogout()
    {
        session()->flush();
        return redirect('login');
    }
}
