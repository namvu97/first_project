<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use Carbon\Carbon;
use App\Http\Requests\FindPasswordRequest;

class ChangePasswordController extends Controller
{

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getChangePassword()
    {
        return view('change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $userName = session('username');
        $oldPassword = $request->get("old_password");
        $newPassword = $request->get("new_password");
        $newPasswordRepeat = $request->get("new_password_repeat");
        //Check if the old password is correct or incorrect
        $checkOldPassword = $this->user->where("username", "=", $userName)->where("password", "=", $oldPassword)->get()->Count();
        if ($checkOldPassword == 1) {
            if ($newPassword == $newPasswordRepeat) {
                $this->user->where("username", "=", $userName)->update(array("password" => $newPassword, "created_at" => Carbon::now()));
                session(['created_at' => Carbon::now()]);
            } else {
                return redirect(url("password/change?err=password_notmatch"));
            }
            return redirect(url("password/change?mess=success"));
        } else {
            return redirect(url("password/change?err=password_incorrect"));
        }
    }
}
