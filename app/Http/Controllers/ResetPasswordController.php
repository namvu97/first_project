<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;

class ResetPasswordController extends Controller
{

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function resetPassword(Request $request)
    {
        $resetId = $request->input('resetid');
        $passWord = str_random(6);
        if ($resetId != null) {
            //Reset password for record request
            $this->user->whereIn('id', $resetId)->update(array("password" => $passWord, "created_at" => null));
            $resetUser = $this->user->whereIn('id', $resetId)->get();
            foreach ($resetUser as $rows) {
                $email = $rows->email;
                $username = $rows->username;
                $password = $rows->password;
                Mail::send('blanks', array('name' => $username, 'email' => $email, 'password' => $password), function($message) use ($email, $username) {
                    $message->from('namvu9701@gmail.com', 'Nam Vũ');
                    $message->to($email, $username)->subject('Reset mật khẩu!');
                });
            }
            return redirect(url('admin/user?mess=reset-password'));
        } else
            return redirect(url('admin/user'));
    }
}
