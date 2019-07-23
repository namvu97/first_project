@extends("home_layout")
@section("content")
<div class="col-md-8 col-xs-offset-2">
	<div class="panel panel-primary">
		<div class="panel-heading">Thêm Sửa Nhân Viên</div>
		<div class="panel-body">
			<form method="post" action="" enctype="multipart/form-data" id="formAddEditUser">
				@if(Request::get("err") == "email-exists")
				<div >
					<strong><div class = "alert alert-danger" role="alert"> Email đã tồn tại</div></strong>
				</div>
				@endif
				@if(Request::get("err") == "username-exists")
				<div>
					<strong><div class = "alert alert-danger" role="alert"> Username đã tồn tại</div></strong>
				</div>
				@endif
				@if (count($errors)>0)
					@foreach ($errors->all() as $error)
					<div class="alert alert-danger" role="alert">
						<strong>{{$error}}</strong>
					</div>					
					@endforeach
				@endif
				@csrf
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Họ tên</div>
					<div class="col-md-10">
						<input type="text" value="{{ isset($record->full_name)?$record->full_name:'' }}" name="full_name" class="form-control">
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Tài khoản</div>
					<div class="col-md-10">
						<input type="text" value="{{ isset($record->username)?$record->username:'' }}" name="username" class="form-control">
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Email</div>
					<div class="col-md-10">
						<input type="email" id="email" value="<?php echo isset($record->email)?$record->email:''; ?>"  name="email" class="form-control">
					</div>
					<!-- <div class="col-md-2"><input type="button" id = "btn-check-email" class="btn btn-success" value="Check email">
					</div> -->
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Mật khẩu</div>
					<div class="col-md-10">
						<input type="password" name="password" class="form-control" @if(isset($record->email)) placeholder="Không đổi password thì không nhập thông tin vào ô textbox này" @endif>
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2">Bộ phận</div>
					<div class="col-md-10">
						<select name="division_id" style="width:90px; text-align-last: center;" >
						@foreach($arr as $rows)
							<option @if(isset($record->division_id) && $record->division_id == $rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->division_name }}</option>
						@endforeach				
						</select>
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2 ">Hình đại diện</div>
					<div class="col-md-10" >
						<input type="file" name="profile_image">
					</div>
				</div>
				<!-- end rows -->
				<!-- rows -->
				<div class="row" style="margin-top:5px;">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<input type="submit" value="Lưu thông tin" class="btn btn-primary">
					</div>
				</div>
				<!-- end rows -->
			</form>
		</div>
	</div>
</div>
<script>
	$(function(){
		$('#formAddEditUser').validate({
			rules : {
				username : {
					required : true,
					minlength : 6,
					maxlength : 15,
				},
				email : {
					required : true,
					email : true,
				},
				password : {
					@if(!isset($record->id))
					required : true,
					@endif
					minlength : 6,
					maxlength : 15,
				},
				full_name : {
					required : true,
				}
			},
			messages : {
				username : {
					required : "Tài khoản không được để trống",
					minlength : "Tài khoản phải có ít nhất 6 ký tự",
					maxlength : "Tài khoản phải dưới 15 ký tự",
				},
				email : {
					required : "Email không được để trống",
					email : "Email không đúng định dạng",
				},
				password : {
					required : "Mật khẩu không được để trống",
					minlength : "Mật khẩu phải có ít nhất 6 ký tự",
					maxlength : "Mật khẩu phải dưới 15 ký tự",
				},
				full_name : {
					required : "Họ tên không được để trống",
				}
			}
		});
	});
</script>
@endsection