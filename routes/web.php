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

Route::group(array('middleware' => 'checkLogin'), function() {
    Route::get('/', "AdminController@getMaster");
    Route::get('login', "LoginController@getLogin");
    Route::post('login', "LoginController@postLogin");
    Route::get('registry', "RegisterController@getRegister");
    Route::post('registry', "RegisterController@postRegister");
});

Route::group(array('middleware' => 'checkLogon'), function() {
    Route::get('logout', "LogoutController@getLogout");
    Route::get('home', "AdminController@getHome");
    Route::get('info', "AdminController@getInfoUser");
});

Route::group(array("prefix" => "password"), function() {
    Route::get('change', "ChangePasswordController@getChangePassword")->middleware('checkLogon');
    Route::post('change', "ChangePasswordController@postChangePassword");
    Route::get('find', "ForgotPasswordController@getPassword")->middleware('checkLogin');
    Route::post('find', "ForgotPasswordController@postPassword");
    Route::post('reset', "ResetPasswordController@resetPassword");
});

Route::group(array("prefix" => "admin/user", 'middleware' => 'checkLogon'), function() {
    Route::get("/", "UserController@listUser");
    Route::get("search", "UserController@searchUser");
    Route::get('export', "ExportController@exportExcel");
});

Route::group(array("prefix" => "admin/user", 'middleware' => 'checkRole'), function() {
    Route::get("add", "AddEditUserController@addUser");
    Route::post("add", "AddEditUserController@doAddUser");
    Route::get("edit/{id}", "AddEditUserController@editUser");
    Route::post("edit/{id}", "AddEditUserController@doEditUser");
    Route::get("delete/{id}", "UserController@deleteUser");
    Route::get("detail/{id}", "UserController@detailUser");
});

Route::group(array("prefix" => "admin/division", 'middleware' => 'checkLogon'), function() {
    Route::get("/", "DivisionController@listDivision");
});

Route::group(array("prefix" => "admin/division", 'middleware' => 'checkRole'), function() {
    Route::get("add", "AddEditDivisionController@addDivision");
    Route::post("add", "AddEditDivisionController@doAddDivision");
    Route::get("edit/{id}", "AddEditDivisionController@editDivision");
    Route::post("edit/{id}", "AddEditDivisionController@doEditDivision");
    Route::get("delete/{id}", "DivisionController@deleteDivision");
    Route::get("detail/{id}", "DivisionController@detailDivision");
});

Route::group(array("prefix" => "admin/moving", 'middleware' => 'checkRole'), function() {
    Route::get("/", "MovingController@listMoving");
    Route::get("delete/{id}", "MovingController@deleteMoving");
    Route::get("detail/{id}", "MovingController@detailMoving");
    Route::get("confirm/{id}", "MovingController@confirmMoving");
});
