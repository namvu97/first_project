<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use Mail;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
 
class AdminController extends Controller
{
    public function getLogin(){
        if(session()->has('username')==false){
            return view('login_account');
        }else return view('home_layout');
    }
    
    public function postLogin(LoginRequest $request){
        $userName = $request->username;
        $passWord = $request->password;
        //Verify login
        $user = User::where('username', $userName)->first();
        if(isset($user->username)){
            if($user->password == $passWord){
                $userName = $user->username;
                $isAdmin = $user->is_Admin;
                $createdAt = $user->created_at;
                session(['username' => $userName , 'is_Admin' => $isAdmin , 'created_at' => $createdAt]);
                if(session('created_at') == null){
                    return redirect(url("password/change"));
                }else
                    return redirect('home');
            }else return redirect(url('login?err=user-notexists'));
        }else return redirect(url('login?err=user-notexists'));
    }

    public function getRegister(){
        $division = new Division();
        $data["arr"] = $division->get();
        return view('register_account',$data);
    }

    public function postRegister(RegisterRequest $request){
        $user = new User();
        $userName = $request->username;
        $email = $request->email;
        $passWord = $request->password;
        $passWordRepeat = $request->password_repeat;
        $fullName = $request->full_name;
        $divisionId = $request->get("division_id");
        //Check if the username is available
        $checkUserName = $user->where("username","=",$userName)->get()->Count();
        if($checkUserName == 0){
            //Check if the email is available
            $checkEmail = $user->where("email","=",$email)->get()->Count();
            if($checkEmail ==0){
                if($passWord == $passWordRepeat){
                    $user->insert(array("username"=>$userName,"email"=>$email,"password"=>$passWord,"full_name"=>$fullName,"is_Admin"=>0,"division_id"=>$divisionId));
                    Mail::send('blanks',array('name'=>$userName,'email'=>$email,'password'=>$passWord), function($message) use ($email, $userName) {
                        $message->from('namvu9701@gmail.com', 'Nam Vũ');
                        $message->to($email, $userName)->subject('Đăng ký tài khoản!');
                    });
                }else 
                    return redirect(url('registry?err=pwd_repeat'));
            }else
                return redirect(url('registry?err=email-exists'));
        }else
            return redirect(url('registry?err=username-exists'));
        return redirect(url('login?reg=success'));
    }

    public function getLogout(){
        //detroy session
        session()->flush();
        return redirect('login');
    }
    
    public function getInfoUser(){
        $user = new User();
        $userName = session('username');
        $data['arr'] = $user->join('division','division_id','=','division.id')
        ->select('user.*','division.division_name','division.manager_name')
        ->where('username','=',$userName)
        ->first();
        return view('info_user',$data);
    }
}