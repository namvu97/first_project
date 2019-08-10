<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    function __construct(User $user, Division $division)
    {
        $this->user = $user;
        $this->division = $division;
    }

    public function getRegister()
    {
        $data["arr"] = $this->division->get();
        return view('register_account', $data);
    }

    public function postRegister(RegisterRequest $request)
    {
        $userName = $request->username;
        $email = $request->email;
        $passWord = $request->password;
        $passWordRepeat = $request->password_repeat;
        $fullName = $request->full_name;
        $divisionId = $request->get("division_id");
        $checkUserName = $this->user->where("username", "=", $userName)->get()->Count();
        if ($checkUserName == 0) {
            $checkEmail = $this->user->where("email", "=", $email)->get()->Count();
            if ($checkEmail == 0) {
                if ($passWord == $passWordRepeat) {
                    $this->user->insert(array("username" => $userName, "email" => $email, "password" => $passWord, "full_name" => $fullName, "is_Admin" => 0, "division_id" => $divisionId));
                    Mail::send('blanks', array('name' => $userName, 'email' => $email, 'password' => $passWord), function($message) use ($email, $userName) {
                        $message->from('namvu9701@gmail.com', 'Nam Vũ');
                        $message->to($email, $userName)->subject('Đăng ký tài khoản!');
                    });
                } else
                    return redirect(url('registry?err=pwd_repeat'));
            } else
                return redirect(url('registry?err=email-exists'));
        } else
            return redirect(url('registry?err=username-exists'));
        return redirect(url('login?reg=success'));
    }
}
