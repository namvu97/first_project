@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
	
	<div class="panel panel-primary">
		<div class="panel-heading">Thông tin bộ phận</div>
		<div class="panel-body">
			<table class="table table-striped">
            <tr>
                <th>Tên bộ phận</th>
                <td>{{$record->division_name}}</td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td>{{$record->division_phone}}</td>
            </tr>
            <tr>
                <th>Người quản lý bộ phận</th>
                <td>{{$record->manager_name}}</td>
            </tr>
        	</table>
		</div>
	</div>
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/division') }}" class="btn btn-primary">Trở lại</a>
	</div>
</div>
@endsection