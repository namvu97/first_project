<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;

class UserController extends Controller
{

    function __construct(User $user, Division $division)
    {
        $this->user = $user;
        $this->division = $division;
    }

    public function listUser(Request $request)
    {
        $divisionId = $request->get("division_id");
        $data["record"] = $this->division->get();
        $data["arr"] = $this->user->join('division', 'division_id', '=', 'division.id')
            ->select('user.*', 'division.division_name')
            ->orderBy("id", "desc")
            ->where('email', '<>', 'namvpn23121997@gmail.com')
            ->paginate(4);
        return view("list_user", $data);
    }

    public function deleteUser(Request $request, $id)
    {
        $this->user->where("id", "=", $id)->delete();
        return redirect(url('admin/user'));
    }

    public function detailUser(Request $request, $id)
    {
        $data["record"] = $this->user->join('division', 'division_id', '=', 'division.id')
                ->select('user.*', 'division.division_name', 'division.manager_name')
                ->where('user.id', "=", $id)->first();
        return view("detail_user", $data);
    }

    public function searchUser(Request $request)
    {
        $nameUser = $request->nameUser;
        $divisionId = $request->get("division_id");
        $data["record"] = $this->division->get();
        $data["arr"] = $this->user->join('division', 'division_id', '=', 'division.id')
            ->select('user.*', 'division.division_name')
            ->orderBy("id", "desc")
            ->where('user.username', 'like', "%$nameUser%")
            ->where('division.id', '=', $divisionId)
            ->paginate(4);
        return view("list_user", $data);
    }
}
