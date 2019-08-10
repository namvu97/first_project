<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Division;
use App\User;
use App\Http\Requests\AddEditDivisionRequest;

class DivisionController extends Controller
{

    function __construct(User $user, Division $division)
    {
        $this->user = $user;
        $this->division = $division;
    }

    public function listDivision(Request $request)
    {
        $data["arr"] = $this->division->orderBy("id", "desc")->paginate(4);
        return view("list_division", $data);
    }

    public function deleteDivision(Request $request, $id)
    {
        $this->division->where("id", "=", $id)->delete();
        return redirect(url('admin/division'));
    }

    public function detailDivision(Request $request, $id)
    {
        $data["record"] = $this->division->where('id', "=", $id)->first();
        return view("detail_division", $data);
    }
}
