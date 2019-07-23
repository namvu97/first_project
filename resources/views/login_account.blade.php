@extends("master_layout")
@section("content")
<div class="card card-header bg-primary text-white" style="padding:7px !important;">Đăng nhập</div>
<div class="card-body">
	<!-- form -->
	<form method="post" action="" id="formLogin">
	@if(Request::get("err") == "user-notexists")
		<div class="alert alert-danger">Tài Khoản hoặc mật khẩu không chính xác</div>
	@endif
	@if(Request::get("reg") == "success")
		<div class="alert alert-info">Đăng ký tài khoản nhân viên thành công</div>
	@endif
	@if(count($errors)>0)
		@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			<strong>{{$error}}</strong>
		</div>					
		@endforeach
	@endif
		<!-- form group -->
		@csrf
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">Tài khoản</div>
				<div class="col-md-8"><input type="text" name="username" class="form-control" placeholder="Nhập tài khoản"></div>
			</div>
		</div>
		<!-- end form group -->
		<!-- form group -->
		<div class="form-group">
			<div class="row">
				<div class="col-md-3" >Mật khẩu</div>
				<div class="col-md-8"><input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu"></div>
			</div>
		</div>
		<!-- end form group -->
		<!-- form group -->
		<div class="form-group">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-9">
					<input type="submit" style="width:100px;" value="Đăng nhập" class="btn btn-primary"> 
					<input type="reset" style="width:100px;" value="Đặt lại" class="btn btn-primary">
				</div>
				<a href ="{{ url('password/find') }}" style="margin-top:10px; margin-left: 200px;">Lấy mật khẩu </a>
			</div>
		</div>
		<!-- end form group -->
	</form>
	<!-- end form -->
</div>
<script>
	$(function(){
		$('#formLogin').validate({
			rules : {
				username : {
					required : true,
					minlength : 6,
					maxlength : 15,
				},
				password : {
					required : true,
					minlength : 6,
					maxlength : 15,
				}
			},
			messages : {
				username : {
					required : "Tài khoản không được để trống",
					minlength : "Tài khoản phải có ít nhất 6 ký tự",
					maxlength : "Tài khoản phải dưới 15 ký tự",
				},
				password : {
					required : "Mật khẩu không được để trống",
					minlength : "Mật khẩu phải có ít nhất 6 ký tự",
					maxlength : "Mật khẩu phải dưới 15 ký tự",
				}
			}
		});
	});
</script>
@endsection