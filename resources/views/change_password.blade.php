@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">Thay đổi mật khẩu</div>
		<div class="panel-body">
		<!-- form -->
            <form method="post" action="" id="formChangepassword">
            @if(Request::get("err") == "password_incorrect")
                <div class="alert alert-danger" role="alert">
                    <strong>Mật khẩu hiện tại không chính xác</strong>
                </div>
            @endif
            @if(Request::get("err") == "password_notmatch")
                <div class="alert alert-danger" role="alert">
                    <strong>Mật khẩu mới không trùng khớp</strong>
                </div>
            @endif
            @if(Request::get("mess") == "success")
                <div class="alert alert-success" role="alert">
                    <strong>Thay đổi mật khẩu thành công</strong>
                </div>
            @endif
            @if(count($errors)>0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>{{$error}}</strong>
                </div>                  
                @endforeach
            @endif
            @csrf
                <!-- form group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3" >Mật khẩu hiện tại</div>
                        <div class="col-md-9"><input type="password" name="old_password" class="form-control" placeholder="Nhập mật khẩu"></div>
                    </div>
                </div>
                <!-- end form group -->
                <!-- form group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3" >Mật khẩu mới</div>
                        <div class="col-md-9"><input type="password" name="new_password" class="form-control" placeholder="Nhập mật khẩu"></div>
                    </div>
                </div>
                <!-- end form group -->
                <!-- form group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3" >Nhập lại mật khẩu mới</div>
                            <div class="col-md-9"><input type="password" name="new_password_repeat" class="form-control" placeholder="Nhập lại mật khẩu"></div>
                    </div>
                </div>
                <!-- end form group -->
                <!-- form group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <input type="submit" style="width:200px;" value="Thay đổi mật khẩu" class="btn btn-primary"> 
                            </div>
                    </div>
                </div>
            <!-- end form group -->
            </form>
            <!-- end form -->
		</div>
	</div>
</div>
<script>
    $(function(){
        $('#formChangepassword').validate({
            rules : {
                old_password : {
                    required : true,
                    minlength : 6,
                    maxlength : 15,
                },
                new_password : {
                    required : true,
                    minlength : 6,
                    maxlength : 15,
                }
                ,
                new_password_repeat : {
                    required : true,
                }
            },
            messages : {
                old_password : {
                    required : "Mật khẩu không được để trống",
                    minlength : "Mật khẩu phải có ít nhất 6 ký tự",
                    maxlength : "Mật khẩu phải dưới 15 ký tự",
                },
                new_password : {
                    required : "Mật khẩu không được để trống",
                    minlength : "Mật khẩu phải có ít nhất 6 ký tự",
                    maxlength : "Mật khẩu phải dưới 15 ký tự",
                },
                new_password_repeat : {
                    required : "Mật khẩu không được để trống",
                }
            }
        });
    });
</script>
@endsection