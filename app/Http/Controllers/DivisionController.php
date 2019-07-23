<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Division;
use App\User;
use App\Http\Requests\AddEditDivisionRequest;
class DivisionController extends Controller
{
    public function listDivision(Request $request){
        $division = new Division();
        //Get all records, div for 4 record per one page
        $data["arr"] = $division->orderBy("id","desc")->paginate(4);
        return view("list_division",$data);
    }
    
    public function addDivision(Request $request){
        $user = new User();
        $manager = $user->where("email","<>","namvpn23121997@gmail.com")->get();
        return view("add_edit_division",compact('manager'));
    }

    public function doAddDivision(AddEditDivisionRequest $request){
        $division = new Division();
        $divisionName = $request->get("division_name");
        $divisionPhone = $request->get("division_phone");
        $managerName = $request->get("manager_name");
        //Check if the division name is available
        $checkDivision = $division->where("division_name","=",$divisionName)->get()->Count();
        if($checkDivision == 0){
            $division->insert(array("division_name"=>$divisionName,"division_phone"=>$divisionPhone,"manager_name"=>$managerName));
        }else
            return redirect(url('admin/division/add?err=division_name-exists'));
        return redirect(url('admin/division'));
    }
    
    public function editDivision(Request $request, $id){
        $division = new Division();
        $user = new User();
    	$data["record"] = $division->where("id","=",$id)->first();
        $manager = $user->where("email","<>","admin@gmail.com")->get();
    	return view("add_edit_division",$data,compact('manager'));
    }
    
    public function doEditDivision(AddEditDivisionRequest $request, $id){
        $division = new Division();
        $divisionName = $request->get("division_name");
    	$divisionPhone = $request->get("division_phone");
        $managerName = $request->get("manager_name");
        //Check if the division name is available
        $check = $division->where("division_name","=",$divisionName)->where("id","<>",$id)->get()->Count();
        if($check == 0){
            //update record match with id requested
            $division->where("id","=",$id)->update(array("division_phone"=>$divisionPhone,"division_name"=>$divisionName,"manager_name"=>$managerName));
            return redirect(url('admin/division'));
        }else{
            return redirect(url("admin/division/edit/$id?err=division_name-exists"));
        }
    }
    
    public function deleteDivision(Request $request,$id){
        $division = new Division();
    	$division->where("id","=",$id)->delete();
    	return redirect(url('admin/division'));
    }
    
    public function detailDivision(Request $request,$id){
        $division = new Division();
        //view detail record match with id requested
        $data["record"] = $division->where('id',"=",$id)->first();
        return view("detail_division",$data);
    }
}