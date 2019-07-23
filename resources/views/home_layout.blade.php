<!DOCTYPE html>
<html>
<head>
    <title>Admin page</title>
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="source/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="text/javascript" type="text/css" href="source/js/jquery/jquery-3.4.1.min.js">
    <script src="source/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="source/ckeditor/ckeditor.js"></script>
    <script src="source/js/bootstrap.min.js"></script>
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
        <li class="brand nav-item font-weight-bold"><a class="nav-link" href="{{ url('home') }}">Hệ thống quản lý nhân viên<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item font-weight-bold active"><a class="nav-link" href="{{ url('admin/user') }}">Quản lý nhân viên</a></li>
        <li class="nav-item font-weight-bold active" ><a class="nav-link" href="{{ url('admin/division') }}">Quản lý bộ phận nhân viên</a></li>
        @if(session('is_Admin') == '0')
        <span style="width: 580px;"></span>
        @else
        <li class="nav-item font-weight-bold active"><a class="nav-link" href="{{ url('admin/moving') }}">Di chuyển nhân viên bộ phận</a></li>
        <span style="width: 380px;"></span>
        @endif
        <li class="nav-item ">
          <div class="nav-link dropdown">
              @if(session('is_Admin') == '1')
              <button class=" btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Quản trị viên {{ session('username') }}
              </button>
              @else
              <button class=" btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Nhân viên {{ session('username') }}
              </button>
              @endif
              <ul style="margin-left: 5px;" class="dropdown-menu">
                <li><a href="{{ url('info') }}">Hồ sơ</a></li>
                <li><a href="{{ url('password/change') }}">Đổi mật khẩu</a></li>
                <li><a href="{{ url('logout') }}">Đăng xuất</a></li>
              </ul>
          </div>
        </li>
      </ul>        
    </div>
  </nav>
  <div class="container" style="margin-top:10px;">
    @yield('content')
   </div>
</body>
</html>
