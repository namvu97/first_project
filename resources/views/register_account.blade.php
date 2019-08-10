@extends("master_layout")
@section("content")
<div class="card card-header bg-primary text-white" style="padding:7px !important;">Đăng ký tài khoản nhân viên</div>
<div class="card-body">
    <!-- form -->
    <form method="post" action="" id="formRegister">
        @if(Request::get("err") == "username-exists")
        <div class="alert alert-danger" role="alert">
            <strong>Username đã tồn tại</strong>
        </div>
        @endif
        @if(Request::get("err") == "email-exists")
        <div class="alert alert-danger" role="alert">
            <strong>Email đã tồn tại</strong>
        </div>
        @endif
        @if(Request::get("err") == "pwd_repeat")
        <div class="alert alert-danger" role="alert">
            <strong>Mật khẩu không trùng khớp</strong>
        </div>
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
                <div class="col-md-3">Họ tên</div>
                <div class="col-md-8"><input type="text" name="full_name" class="form-control" placeholder="Nhập họ tên"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">Tài khoản</div>
                <div class="col-md-8"><input type="text" name="username" class="form-control" placeholder="Nhập tên tài khoản"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-3">Email</div>
                <div class="col-md-8"><input type="email" name="email" class="form-control" placeholder="Nhập tài khoản"></div>
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
                <div class="col-md-3" >Nhập lại mật khẩu</div>
                <div class="col-md-8"><input type="password" name="password_repeat" class="form-control" placeholder="Nhập lại mật khẩu"></div>
            </div>
        </div>
        <!-- end form group -->
        <!-- rows -->
        <div class="row" >
            <div class="col-md-3">Bộ phận</div>
            <div class="col-md-9">
                <select name="division_id" style="width:320px; text-align-last: center;">
                    @foreach($arr as $rows)
                    <option value="{{ $rows->id }}">{{ $rows->division_name }}</option>
                    @endforeach				
                </select>
            </div>
        </div>
        <!-- end rows -->
        <!-- form group -->
        <div class="form-group" style="margin-top:15px;">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <input type="submit" style="width:200px;" value="Đăng ký" class="btn btn-primary"> 
                </div>
            </div>
        </div>
        <!-- end form group -->
    </form>
    <!-- end form -->
</div>
<script>
    $(function () {
        $('#formRegister').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 6,
                    maxlength: 15,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 15,
                },
                password_repeat: {
                    required: true,
                },
                full_name: {
                    required: true,
                }
            },
            messages: {
                username: {
                    required: "Tài khoản không được để trống",
                    minlength: "Tài khoản phải có ít nhất 6 ký tự",
                    maxlength: "Tài khoản phải dưới 16 ký tự",
                },
                email: {
                    required: "Email không được để trống",
                    email: "Không đúng định dạng email",
                },
                password: {
                    required: "Mật khẩu không được để trống",
                    minlength: "Mật khẩu phải có ít nhất 6 ký tự",
                    maxlength: "Mật khẩu phải dưới 16 ký tự",
                },
                password_repeat: {
                    required: "Mật khẩu lặp lại không được để trống",
                },
                full_name: {
                    required: "Họ tên không được để trống",
                }
            }
        });
    });
</script>
@endsection