@extends("home_layout")
@section("content")

<div class="col-md-11 col-xs-offset-1" >
    @if(session('created_at') == null)
    <div class="alert alert-danger">Bạn chưa thay đổi mật khẩu mặc định</div>
    @endif
    @if(session('is_Admin') == '1')
    <span style="margin-bottom:50px; margin-right:10px;">
        <a href="{{ url('admin/user/add') }}" class="btn btn-primary">Thêm nhân viên mới</a>
    </span>
    @endif	
    <span class="export">
        <a href ="{{ url('admin/user/export') }}" class="btn btn-primary"> Xuất danh sách nhân viên </a>
    </span>
    @if(Request::get("err") == "email-exists")
    <div class="alert alert-danger">Email này đã tồn tại</div>
    @endif
    @if(Request::get("mess") == "reset-password")
    <div style="margin-top: 10px;" class="alert alert-success">Reset mật khẩu thành công</div>
    @endif
    <div style="margin-top:10px;" class="panel panel-primary">
        <div class="panel-heading">Danh sách nhân viên</div>
        <div class="panel-body" >
            <form style="margin-bottom:20px;" action="{{ url('admin/user/search') }}" class="form-inline" id="indexForm" method="get" accept-charset="utf-8">
                <div class="form-group">
                    <input style="margin-right: 5px;" name="nameUser" class="form-control" placeholder="Tên nhân viên" type="text" value="" id="name">
                    <select style="height: 35px; margin-right: 20px; width: 150px;" name="division_id" class="form-control">
                        @foreach($record as $rows)
                        <option value="{{ $rows->id }}">{{ $rows->division_name }}</option>
                        @endforeach
                    </select>        
                </div>
                <button class="btn btn-success" type="submit">Tìm kiếm</button>
            </form>
            <form action="{{ url('password/reset') }}" method="post" >
                {{csrf_field() }}
                <table class="table table-bordered table-hover table-striped" >
                    <tr >
                        @if(session('is_Admin') == '1')
                        <th></th>
                        @endif
                        <th class="text-md-center">STT</th>
                        <th class="text-md-center">Hình ảnh</th>
                        <th class="text-md-center">Họ tên</th>
                        <th class="text-md-center">Tài khoản</th>
                        <th class="text-md-center">Email</th>
                        <th class="text-md-center">Bộ phận</th>
                        @if(session('is_Admin') == '1')
                        <th class="text-md-center" style="width:300px;">Hành động</th>
                        @endif
                    </tr>
                    @foreach($arr as $key => $rows)
                    <tr>
                        @if(session('is_Admin') == '1')
                        <td class="text-md-center"><input type='checkbox' name='resetid[]' value="{{ $rows->id }}" /></td>
                        @endif
                        <td class="text-md-center">{{ ++$key }}</td>
                        <td class="text-md-center">
                            @if($rows->photo != '')
                            <img src="upload/photo/{{$rows->photo}}" style="width: 100px;">
                            @endif
                        </td>
                        <td class="text-md-center">{{ $rows->full_name }}</td>
                        <td class="text-md-center">{{ $rows->username }}</td>
                        <td class="text-md-center">{{ $rows->email }}</td>
                        <td class="text-md-center">{{ $rows->division_name }}</td>
                        @if(session('is_Admin') == '1')
                        <td style="text-align:center;">
                            <a class="btn btn-success" href="{{ url('admin/user/detail/'.$rows->id) }}">Xem nhân viên</a>&nbsp;
                            <a class="btn btn-info" href="{{ url('admin/user/edit/'.$rows->id) }}">Sửa</a>&nbsp;
                            <a class="btn btn-danger" href="{{ url('admin/user/delete/'.$rows->id) }}" onclick="return window.confirm('Bạn có chắc không?');">Xóa</a>
                        </td>

                        @endif
                    </tr>
                    @endforeach
                </table>
                <style type="text/css">
                    .pagination{padding:0px; margin:0px;}
                </style>
                {{ $arr->render() }}
                @if(session('is_Admin') == '1')
                <button style="margin-left: 540px; margin-bottom: 17px;" type="submit" onclick="return window.confirm('Bạn có chắc không?');" class="btn btn-danger export">Đặt lại mật khẩu</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection