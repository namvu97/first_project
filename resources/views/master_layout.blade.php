<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
        <base href="{{asset('')}}">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="source/css/bootstrap.min.css">
        <script src="source/js/jquery-3.4.1.min.js"></script>
        <script src="source/js/jquery.validate.min.js"></script>
        <style>
            .error{
                color:red;
            }
        </style>
    </head>
    <body style="background-image:url({{url('source/bg/bg.jpg')}})">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <label class="nav-item active" style="margin-left: 1100px"></label>
                    <li class="nav-item active"><a class="nav-link font-weight-bold" href="{{ url('login') }}">Đăng nhập</a></li>
                    <li class="nav-item active"><a class="nav-link font-weight-bold" href="{{ url('registry') }}">Đăng ký</a></li>
                </ul>        
            </div>
        </nav>
        <div class="container" style="margin-top: 140px;">
            <div class="row justify-content-center" style="margin-top: 15px;">
                <div class="col-md-6">
                    <!-- card primary -->
                    <div class="card border-primary">
                        @yield('content')
                    </div>
                    <!-- end card primary -->
                </div>
            </div>
        </div>
    </body>
</html>