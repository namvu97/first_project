@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
	<div class="panel panel-primary">
		<div class="panel-heading">Thông tin nhân viên</div>
		<div class="panel-body">
			<table class="table table-striped">
            <tr>
                <th>Username</th>
                <td>{{$record->username}}</td>
            </tr>
            <tr>
                <th>Địa chỉ Email</th>
                <td>{{$record->email}}</td>
            </tr>
            <tr>
                <th>Bộ phận</th>
                <td>{{$record->division_name}}</td>
            </tr>
            <tr>
                <th>Người quản lý</th>
                <td>{{$record->manager_name}}</td>
            </tr>
        	</table>
		</div>
	</div>
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/user') }}" class="btn btn-primary">Trở lại</a>
	</div>
</div>
@endsection