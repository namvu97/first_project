<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use App\Moving;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;

class AddEditUserController extends Controller
{

    function __construct(User $user, Division $division, Moving $moving)
    {
        $this->user = $user;
        $this->division = $division;
        $this->moving = $moving;
    }

    public function addUser(Request $request)
    {
        $data["arr"] = $this->division->getListDivision();
        return view("add_edit_user", $data);
    }

    public function doAddUser(AddUserRequest $request)
    {
        $userName = $request->get("username");
        $email = $request->get("email");
        $password = $request->get("password");
        $divisionId = $request->get("division_id");
        $fullName = $request->get("full_name");
        $checkAddUserName = $this->user->where("username", "=", $userName)->get()->Count();
        if ($checkAddUserName == 0) {
            $checkAddEmail = $this->user->where("email", "=", $email)->get()->Count();
            if ($checkAddEmail == 0) {
                if ($request->has('profile_image')) {
                    $profileImage = $request->file('profile_image');
                    $getPhoto = time() . '_' . $profileImage->getClientOriginalName();
                    $destinationPath = public_path('upload/photo');
                    $profileImage->move($destinationPath, $getPhoto);
                    $this->user->insert(array("username" => $userName, "email" => $email, "password" => $password, "full_name" => $fullName, "is_Admin" => 0, "photo" => $getPhoto, "division_id" => $divisionId));
                } else
                    $this->user->insert(array("username" => $userName, "email" => $email, "password" => $password, "full_name" => $fullName, "is_Admin" => 0, "division_id" => $divisionId));
            } else
                return redirect(url('admin/user/add?err=email-exists'));
        } else
            return redirect(url('admin/user/add?err=username-exists'));
        return redirect(url('admin/user'));
    }

    public function editUser(Request $request, $id)
    {
        $data["arr"] = $this->division->getListDivision();
        $data["record"] = $this->user->where("id", "=", $id)->first();
        return view("add_edit_user", $data);
    }

    public function doEditUser(EditUserRequest $request, $id)
    {
        $userName = $request->get("username");
        $email = $request->get("email");
        $divisionId = $request->get("division_id");
        $fullName = $request->get("full_name");
        $checkEditUserName = $this->user->where("username", "=", $userName)->where("id", "<>", $id)->get()->Count();
        if ($checkEditUserName == 0) {
            $checkEditEmail = where("email", "=", $email)->where("id", "<>", $id)->get()->Count();
            if ($checkEditEmail == 0) {
                $checkMoving = where("id", "=", $id)->where("division_id", "<>", $divisionId)->get()->Count();
                if ($checkMoving == 1) {
                    $oldDivision = $this->user->where("user.id", "=", $id)
                            ->join('division', 'division_id', '=', 'division.id')
                            ->select('division.division_name')->first();
                    $this->moving->insert(array("status" => "Đang xử lý", "old_division" => $oldDivision->division_name, "user_id" => $id));
                }
                $this->user->where("id", "=", $id)->update(array("username" => $userName, "email" => $email, "full_name" => $fullName, "division_id" => $divisionId));
                $password = $request->get("password");
                if ($password != "") {
                    $this->user->where("id", "=", $id)->update(array("password" => $password));
                }
                if ($request->has('profile_image')) {
                    $profileImage = $request->file('profile_image');
                    $getPhoto = time() . '_' . $profileImage->getClientOriginalName();
                    $destinationPath = public_path('upload/photo');
                    $profileImage->move($destinationPath, $getPhoto);
                    $this->user->where("id", "=", $id)->update(array("photo" => $getPhoto));
                }
                return redirect(url('admin/user'));
            } else
                return redirect(url("admin/user/edit/$id?err=email-exists"));
        } else
            return redirect(url('admin/user/edit/$id?err=username-exists'));
    }
}
