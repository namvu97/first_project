<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Moving;

class MovingController extends Controller
{

    function __construct(Moving $moving)
    {
        $this->moving = $moving;
    }

    public function listMoving(Request $request)
    {
        $data["arr"] = $this->moving->join('user', 'user_id', '=', 'user.id')
            ->select('moving.*', 'user.username', 'user.division_id')
            ->join('division', 'division_id', '=', 'division.id')
            ->select('moving.*', 'user.full_name', 'user.username', 'division.division_name')
            ->orderBy("id", "desc")
            ->paginate(4);
        return view("list_moving", $data);
    }

    public function deleteMoving(Request $request, $id)
    {
        $this->moving->where("id", "=", $id)->delete();
        return redirect(url('admin/moving'));
    }

    public function detailMoving(Request $request, $id)
    {
        $data["record"] = $this->moving->where('moving.id', "=", $id)
            ->join('user', 'user_id', '=', 'user.id')
            ->select('moving.*', 'user.username', 'user.division_id')
            ->join('division', 'user.division_id', '=', 'division.id')
            ->select('moving.*', 'user.full_name', 'user.username', 'division.division_name', 'division.manager_name')
            ->first();
        return view("detail_moving", $data);
    }

    public function confirmMoving(Request $request, $id)
    {
        $data["record"] = $this->moving->where('id', "=", $id)
            ->update(array("status" => "Đã chuyển"));
        return redirect(url('admin/moving'));
    }
}
