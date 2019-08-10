<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;

class AdminController extends Controller
{

    public function getMaster()
    {
        return redirect('login');
    }

    public function getHome()
    {
        return view('home_layout');
    }

    public function getInfoUser()
    {
        $user = new User();
        $userName = session('username');
        $data['arr'] = $user->join('division', 'division_id', '=', 'division.id')
            ->select('user.*', 'division.division_name', 'division.manager_name')
            ->where('username', '=', $userName)
            ->first();
        return view('info_user', $data);
    }
}
