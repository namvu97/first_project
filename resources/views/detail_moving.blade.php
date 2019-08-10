@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">Chi tiết điều chỉnh</div>
        <div class="panel-body">
            @if($record->status=='Đã chuyển')
            <div style="margin-bottom: 5px;"><a href="{{ url('admin/moving/confirm/'.$record->id) }}" class="btn btn-danger">Nhân viên đã chuyển sang bộ phận mới</a></div>
            @else
            <div style="margin-bottom: 5px;"><a href="{{ url('admin/moving/confirm/'.$record->id) }}" class="btn btn-danger">Xác nhận nhân viên đã chuyển sang bộ phận mới</a></div>
            @endif
            <table class="table table-striped">
                <tr>
                    <th>Họ tên</th>
                    <td>{{ $record->full_name }}</td>
                </tr>    
                <tr>
                    <th>Tài khoản</th>
                    <td>{{ $record->username }}</td>
                </tr>
                <tr>
                    <th>Bộ phận cũ</th>
                    <td>{{ $record->old_division }}</td>
                </tr>
                <tr>
                    <th>Bộ phận mới</th>
                    <td>{{ $record->division_name }}</td>
                </tr>
                <tr>
                    <th>Người quản lý</th>
                    <td>{{ $record->manager_name }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="margin-bottom:5px; ">
        <a href="{{ url('admin/moving') }}" class="btn btn-primary">Trở lại</a>
    </div>
</div>
@endsection