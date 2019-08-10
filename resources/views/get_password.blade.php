@extends("master_layout")
@section("content")
<div class="card card-header bg-primary text-white" style="padding:7px !important;">Lấy lại mật khẩu</div>
<div class="card-body">
    @if(Request::get("mess") == "get_password")
    <div class="alert alert-info" role="info">
        <strong>Mật khẩu đã được gửi tới email của bạn</strong>
    </div>
    @endif
    @if(Request::get("err") == "email_incorrect")
    <div class="alert alert-danger" role="alert">
        <strong>Username và email không trùng khớp</strong>
    </div>
    @endif
    <!-- form -->
    <form method="post" action="" id="formGetpassword">
        @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <strong>{{$error}}</strong>
        </div>					
        @endforeach
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- rows -->
        <div class="row" style="margin-top:5px;">
            <div class="col-md-3">Username</div>
            <div class="col-md-6">
                <input type="text" name="username" class="form-control">
            </div>
        </div>
        <!-- end rows -->
        <!-- rows -->
        <div class="row" style="margin-top:5px;">
            <div class="col-md-3">Email</div>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control">
            </div>
            <input type="submit" value="Check email" class="btn btn-primary">
        </div>
        <!-- end rows -->
    </form>
    <!-- end form -->
</div>
<script>
    $(function () {
        $('#formGetpassword').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 6,
                    maxlength: 15,
                },
                email: {
                    required: true,
                    email: true,
                }
            },
            messages: {
                username: {
                    required: "Tài khoản không được để trống",
                    minlength: "Tài khoản phải có ít nhất 6 ký tự",
                    maxlength: "Tài khoản phải dưới 15 ký tự",
                },
                email: {
                    required: "Email không được để trống",
                    email: "Email không đúng định dạng",
                }
            }
        });
    });
</script>
@endsection