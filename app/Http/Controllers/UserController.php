<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Division;
use App\Moving;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
class UserController extends Controller
{
    public function listUser(Request $request){
        $user = new User();
        $division = new Division();
        $divisionId = $request->get("division_id");
        $data["record"] = $division->get();
        //Get all records, div for 4 record per one page
        $data["arr"] = $user->join('division','division_id','=','division.id')
        ->select('user.*','division.division_name')
        ->orderBy("id","desc")
        ->where('email','<>','namvpn23121997@gmail.com')
        ->paginate(4);
        return view("list_user",$data);
    }

    public function addUser(Request $request){
        $division = new Division();
        $data["arr"] = $division->get();
        return view("add_edit_user",$data);
    }

    public function doAddUser(AddUserRequest $request){
        $user = new User();
        $userName = $request->get("username");
        $email = $request->get("email");
        $password = $request->get("password");
        $divisionId = $request->get("division_id");
        $fullName = $request->get("full_name");
        //Check if the username already exists
        $checkUserName = $user->where("username","=",$userName)->get()->Count();
        if($checkUserName == 0){
            //Check if the email already exists
            $checkEmail = $user->where("email","=",$email)->get()->Count();
            if($checkEmail == 0){
                //Kiem tra photo co ton tai khong
                if ($request->has('profile_image')) {
                    $profileImage = $request->file('profile_image');
                    $getPhoto = time().'_'.$profileImage->getClientOriginalName();
                    $destinationPath = public_path('upload/photo');
                    $profileImage->move($destinationPath, $getPhoto);
                    $user->insert(array("username"=>$userName,"email"=>$email,"password"=>$password,"full_name"=>$fullName,"is_Admin"=>0,"photo"=>$getPhoto,"division_id"=>$divisionId));
                }else 
                    $user->insert(array("username"=>$userName,"email"=>$email,"password"=>$password,"full_name"=>$fullName,"is_Admin"=>0,"division_id"=>$divisionId));
            }else
                return redirect(url('admin/user/add?err=email-exists'));
        }else
            return redirect(url('admin/user/add?err=username-exists'));
        return redirect(url('admin/user'));
    }

    public function editUser(Request $request, $id){
        $user = new User();
        $division = new Division();
        $data["arr"] = $division->get();
    	$data["record"] = $user->where("id","=",$id)->first();
    	return view("add_edit_user",$data);
    }

    public function doEditUser(EditUserRequest $request, $id){
        $user = new User();
        $moving = new Moving();
    	$userName = $request->get("username");
        $email = $request->get("email");
        $divisionId = $request->get("division_id");
        $fullName = $request->get("full_name");
        //Check if the username already exists
        $checkUserName = $user->where("username","=",$userName)->where("id","<>",$id)->get()->Count();
        if($checkUserName == 0){
            //Check if the email already exists
            $checkEmail = $user->where("email","=",$email)->where("id","<>",$id)->get()->Count();
            if($checkEmail == 0){
                $checkMoving = $user->where("id","=",$id)->where("division_id","<>",$divisionId)->get()->Count();
                if($checkMoving == 1){
                    $oldDivision = $user->where("user.id","=",$id)
                                        ->join('division','division_id','=','division.id')
                                        ->select('division.division_name')->first();
                    $moving->insert(array("status"=>"Đang xử lý","old_division"=>$oldDivision->division_name,"user_id"=>$id));
                } 
                $user->where("id","=",$id)->update(array("username"=>$userName,"email"=>$email,"full_name"=>$fullName,"division_id"=>$divisionId));
                $password = $request->get("password");
                if($password != ""){
                    $user->where("id","=",$id)->update(array("password"=>$password));
                }
                if ($request->has('profile_image')) {
                    $profileImage = $request->file('profile_image');
                    $getPhoto = time().'_'.$profileImage->getClientOriginalName();
                    $destinationPath = public_path('upload/photo');
                    $profileImage->move($destinationPath, $getPhoto);
                    $user->where("id","=",$id)->update(array("photo"=>$getPhoto));
                } 
                return redirect(url('admin/user'));
            }else
                return redirect(url("admin/user/edit/$id?err=email-exists"));
        }else
            return redirect(url('admin/user/edit/$id?err=username-exists'));
    }

    public function deleteUser(Request $request,$id){
        $user = new User();
    	$user->where("id","=",$id)->delete();
    	return redirect(url('admin/user'));
    }

    public function detailUser(Request $request,$id){
        $user = new User();
        //view detail record match with id requested
        $data["record"] = $user->join('division','division_id','=','division.id')
        ->select('user.*','division.division_name','division.manager_name')
        ->where('user.id',"=",$id)->first();
        return view("detail_user",$data);
    }

    public function searchUser(Request $request){
        $user = new User();
        $division = new Division();
        $nameUser = $request->nameUser;
        $divisionId = $request->get("division_id");
        $data["record"] = $division->get();
        //Get all records, div for 4 record per one page
        $data["arr"] = $user->join('division','division_id','=','division.id')
        ->select('user.*','division.division_name')
        ->orderBy("id","desc")
        ->where('user.username','like',"%$nameUser%")
        ->where('division.id','=',$divisionId)
        ->paginate(4);
        return view("list_user",$data);
    }
}