<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Division;
use App\User;
use App\Http\Requests\AddEditDivisionRequest;

class AddEditDivisionController extends Controller
{

    function __construct(User $user, Division $division)
    {
        $this->user = $user;
        $this->division = $division;
    }

    public function addDivision(Request $request)
    {
        $manager = $this->user->where("email", "<>", "namvpn23121997@gmail.com")->get();
        return view("add_edit_division", compact('manager'));
    }

    public function doAddDivision(AddEditDivisionRequest $request)
    {
        $divisionName = $request->get("division_name");
        $divisionPhone = $request->get("division_phone");
        $managerName = $request->get("manager_name");
        $checkAddDivision = $this->division->where("division_name", "=", $divisionName)->get()->Count();
        if ($checkAddDivision == 0) {
            $this->division->insert(array("division_name" => $divisionName, "division_phone" => $divisionPhone, "manager_name" => $managerName));
        } else
            return redirect(url('admin/division/add?err=division_name-exists'));
        return redirect(url('admin/division'));
    }

    public function editDivision(Request $request, $id)
    {
        $data["record"] = $this->division->where("id", "=", $id)->first();
        $manager = $this->user->where("email", "<>", "admin@gmail.com")->get();
        return view("add_edit_division", $data, compact('manager'));
    }

    public function doEditDivision(AddEditDivisionRequest $request, $id)
    {
        $divisionName = $request->get("division_name");
        $divisionPhone = $request->get("division_phone");
        $managerName = $request->get("manager_name");
        $checkEditDivision = $this->division->where("division_name", "=", $divisionName)->where("id", "<>", $id)->get()->Count();
        if ($checkEditDivision == 0) {
            $this->division->where("id", "=", $id)->update(array("division_phone" => $divisionPhone, "division_name" => $divisionName, "manager_name" => $managerName));
            return redirect(url('admin/division'));
        } else {
            return redirect(url("admin/division/edit/$id?err=division_name-exists"));
        }
    }
    
}
