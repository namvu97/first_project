@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
	@if(session('created_at') == null)
		<div class="alert alert-danger">Bạn chưa thay đổi mật khẩu mặc định</div>
	@endif
	@if(session('is_Admin') == '1')
	<div style="margin-bottom:5px;">
		<a href="{{ url('admin/division/add') }}" class="btn btn-primary">Thêm bộ phận làm việc</a>
	</div>
	@endif
	<div class="panel panel-primary">
		<div class="panel-heading">Danh sách bộ phận</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th class="text-md-center">STT</th>
					<th class="text-md-center">Tên bộ phận</th>
					<th class="text-md-center">Số điện thoại bộ phận</th>
					<th class="text-md-center">Người quản lý bộ phận</th>
					@if(session('is_Admin') == '1')
					<th class="text-md-center" style="width:300px;">Hành động</th>
					@endif
				</tr>
				@foreach($arr as $key=>$rows)
				<tr>
					<td class="text-md-center">{{ ++$key }}</td>
					<td class="text-md-center">{{$rows->division_name}}</td>
					<td class="text-md-center">{{$rows->division_phone}}</td>
					<td class="text-md-center">{{$rows->manager_name}}</td>
					@if(session('is_Admin') == '1')
					<td style="text-align:center;">
						<a class="btn btn-success" href="{{ url('admin/division/detail/'.$rows->id) }}">Xem bộ phận</a>&nbsp;
						<a class="btn btn-info" href="{{ url('admin/division/edit/'.$rows->id) }}">Sửa</a>&nbsp;
						<a class="btn btn-danger" href="{{ url('admin/division/delete/'.$rows->id) }}" onclick="return window.confirm('Bạn có chắc không?');">Xóa</a>
					</td>
					@endif
				</tr>
				@endforeach
			</table>
			<style type="text/css">
				.pagination{padding:0px; margin:0px;}
			</style>
			{{ $arr->render() }}
		</div>
	</div>
</div>
@endsection