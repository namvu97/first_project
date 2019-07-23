<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Moving;
class MovingController extends Controller
{
    public function listMoving(Request $request){
        $moving = new Moving();
        //Get all records, div for 4 record per one page
        $data["arr"] = $moving->join('user','user_id','=','user.id')
        ->select('moving.*','user.username','user.division_id')
        ->join('division','division_id','=','division.id')
        ->select('moving.*','user.full_name','user.username','division.division_name')
        ->orderBy("id","desc")
        ->paginate(4);
        return view("list_moving",$data);
    }
    
    public function deleteMoving(Request $request,$id){
        $moving = new Moving();
        //Remove record match with id requested
    	$moving->where("id","=",$id)->delete();
    	return redirect(url('admin/moving'));
    }
    
    public function detailMoving(Request $request,$id){
        $moving = new Moving();
        //View detail record match with id requested
        $data["record"] = $moving->where('moving.id',"=",$id)
        ->join('user','user_id','=','user.id')
        ->select('moving.*','user.username','user.division_id')
        ->join('division','user.division_id','=','division.id')
        ->select('moving.*','user.full_name','user.username','division.division_name','division.manager_name')
        ->first();
        return view("detail_moving",$data);
    }

    public function confirmMoving(Request $request,$id){
        $moving = new Moving();
        //Update confirm moving
        $data["record"] = $moving->where('id',"=",$id)
        ->update(array("status"=>"Đã chuyển"));
        return redirect(url('admin/moving'));
    }
}