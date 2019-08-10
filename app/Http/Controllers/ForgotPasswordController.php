<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use App\Http\Requests\FindPasswordRequest;

class ForgotPasswordController extends Controller
{

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getPassword()
    {
        return view('get_password');
    }

    public function postPassword(FindPasswordRequest $request)
    {
        $userName = $request->get("username");
        $email = $request->get("email");
        //Check if the username and email is invalid
        $checkInfoUser = $this->user->where("username", "=", $userName)->where("email", "=", $email)->get()->Count();
        if ($checkInfoUser == 1) {
            $data = $this->user->where("username", "=", $userName)->where("email", "=", $email)->select('password')->first();
            $password = $data->password;
            Mail::send('blanks', array('name' => $userName, 'email' => $email, 'password' => $password), function($message) use ($email, $userName) {
                $message->from('namvu9701@gmail.com', 'Nam Vũ');
                $message->to($email, $userName)->subject('Lấy lại mật khẩu!');
            });
            return redirect(url("password/find?mess=get_password"));
        } else {
            return redirect(url("password/find?err=email_incorrect"));
        }
    }
}
