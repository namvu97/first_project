<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Mail;
use Carbon\Carbon;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\FindPasswordRequest;
class PasswordController extends Controller
{
    public function getChangePassword(){
        return view('change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request){
        $user = new User();
        $userName = session('username');
        $oldPassword = $request->get("old_password");
        $newPassword = $request->get("new_password");
        $newPasswordRepeat = $request->get("new_password_repeat");
        //Check if the old password is correct or incorrect
        $checkOldPassword = $user->where("username","=",$userName)->where("password","=",$oldPassword)->get()->Count();
        if($checkOldPassword == 1){
            if($newPassword == $newPasswordRepeat){
                $user->where("username","=",$userName)->update(array("password"=>$newPassword,"created_at"=>Carbon::now()));
                session(['created_at' => Carbon::now()]);
            }else{
                return redirect(url("password/change?err=password_notmatch"));
            }
            return redirect(url("password/change?mess=success"));
        }else{
            return redirect(url("password/change?err=password_incorrect"));
        }
    }

    public function getPassword(){
        return view('get_password');
    } 
    
    public function postPassword(FindPasswordRequest $request){
        $user = new User();
        $userName = $request->get("username");
        $email = $request->get("email");
        //Check if the username and email is invalid
        $checkInfoUser = $user->where("username","=",$userName)->where("email","=",$email)->get()->Count();
        if($checkInfoUser==1){
            $data = $user->where("username","=",$userName)->where("email","=",$email)->select('password')->first();
            $password = $data->password;
            Mail::send('blanks',array('name'=>$userName,'email'=>$email,'password'=>$password), function($message) use ($email, $userName) {
                $message->from('namvu9701@gmail.com', 'Nam Vũ');
                $message->to($email, $userName)->subject('Lấy lại mật khẩu!');
            });
            return redirect(url("password/find?mess=get_password"));
        }else{
            return redirect(url("password/find?err=email_incorrect"));
        }
    } 

    public function resetPassword(Request $request){
        $resetId = $request->input('resetid');
        $user = new User();
        $passWord = str_random(6);
        if($resetId != null){
            //Reset password for record request
            $user->whereIn('id',$resetId)->update(array("password"=>$passWord,"created_at"=>null));
            $resetUser = $user->whereIn('id',$resetId)->get();
            foreach ($resetUser as $rows) {
                $email = $rows->email;
                $username = $rows->username;
                $password = $rows->password;
                Mail::send('blanks',array('name'=>$username,'email'=>$email,'password'=>$password), function($message) use ($email, $username) {
                        $message->from('namvu9701@gmail.com', 'Nam Vũ');
                        $message->to($email, $username)->subject('Reset mật khẩu!');
                    });
            }
            return redirect(url('admin/user?mess=reset-password'));
        }else
        return redirect(url('admin/user'));
    }
}
