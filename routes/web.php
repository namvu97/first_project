<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(array('middleware'=>'checkLogin'),function(){
	Route::get('/', function () {
	    return redirect('login');
	})->middleware('checkLogin');
	Route::get('login',"AdminController@getLogin");
	Route::post('login',"AdminController@postLogin");
	Route::get('registry',"AdminController@getRegister");
	Route::post('registry',"AdminController@postRegister");
});

Route::group(array('middleware'=>'checkLogon'),function(){
	Route::get('logout',"AdminController@getLogout");
	Route::get('home',function () {
	    return view('home_layout');
	});
	Route::get('info',"AdminController@getInfoUser");
});

//Group with tag password
Route::group(array("prefix"=>"password"),function(){
	Route::get('change',"PasswordController@getChangePassword")->middleware('checkLogon');
	Route::post('change',"PasswordController@postChangePassword");
	Route::get('find',"PasswordController@getPassword")->middleware('checkLogin');
	Route::post('find',"PasswordController@postPassword");
	Route::post('reset',"PasswordController@resetPassword");
});

//Group with tag admin/user, function for employee
Route::group(array("prefix"=>"admin/user",'middleware'=>'checkLogon'),function(){
	Route::get("/","UserController@listUser");
	Route::get("search","UserController@searchUser");
	Route::get('export',"ExportController@exportExcel");
});

//Group with tag admin/user, function for admin
Route::group(array("prefix"=>"admin/user",'middleware'=>'checkRole'),function(){
	Route::get("add","UserController@addUser");
	Route::post("add","UserController@doAddUser");
	Route::get("edit/{id}","UserController@editUser");
	Route::post("edit/{id}","UserController@doEditUser");
	Route::get("delete/{id}","UserController@deleteUser");
	Route::get("detail/{id}","UserController@detailUser");
});

//Group with tag admin/division, function for employee
Route::group(array("prefix"=>"admin/division",'middleware'=>'checkLogon'),function(){
	Route::get("/","DivisionController@listDivision");
});

//Group with tag admin/division, function for admin
Route::group(array("prefix"=>"admin/division",'middleware'=>'checkRole'),function(){
	Route::get("add","DivisionController@addDivision");
	Route::post("add","DivisionController@doAddDivision");
	Route::get("edit/{id}","DivisionController@editDivision");
	Route::post("edit/{id}","DivisionController@doEditDivision");
	Route::get("delete/{id}","DivisionController@deleteDivision");
	Route::get("detail/{id}","DivisionController@detailDivision");
});

//Group with tag admin/moving, function for admin
Route::group(array("prefix"=>"admin/moving",'middleware'=>'checkRole'),function(){
	Route::get("/","MovingController@listMoving");
	Route::get("delete/{id}","MovingController@deleteMoving");
	Route::get("detail/{id}","MovingController@detailMoving");
	Route::get("confirm/{id}","MovingController@confirmMoving");
});