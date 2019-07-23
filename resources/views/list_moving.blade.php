@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
	@if(session('created_at') == null)
		<div class="alert alert-danger">Bạn chưa thay đổi mật khẩu mặc định</div>
	@endif
	<div style="margin-top:10px;" class="panel panel-primary">
		<div class="panel-heading">Danh sách điều chỉnh nhân viên</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-striped">
				<tr >
					<th class="text-md-center">STT</th>
					<th class="text-md-center">Nhân viên</th>
					<th class="text-md-center">Tài khoản</th>
					<th class="text-md-center">Trạng thái</th>
					<th class="text-md-center">Bộ phận cũ</th>
					<th class="text-md-center">Bộ phận chuyển đến</th>
					<th class="text-md-center" style="width:200px;">Hành động</th>
				</tr>
				@foreach($arr as $key => $rows)
				<tr>
					<td class="text-md-center">{{ ++$key }}</td>
					<td class="text-md-center">{{ $rows->full_name }}</td>
					<td class="text-md-center">{{ $rows->username }}</td>
					<td class="text-md-center"><strong style="color: red;">{{ $rows->status }}</strong></td>
					<td class="text-md-center">{{ $rows->old_division }}</td>
					<td class="text-md-center">{{ $rows->division_name }}</td>
					<td style="text-align:center;">
						<a class="btn btn-info" href="{{ url('admin/moving/detail/'.$rows->id) }}">Chi tiết</a>&nbsp;
						<a class="btn btn-danger" href="{{ url('admin/moving/delete/'.$rows->id) }}" onclick="return window.confirm('Bạn có chắc không?');">Xóa</a>
					</td>
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