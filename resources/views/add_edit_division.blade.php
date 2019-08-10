@extends("home_layout")
@section("content")
<div class="col-md-8 col-xs-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Thêm Sửa Bộ phận</div>
        <div class="panel-body">
            <form method="post" action="" id="formAddEditDivision">
                @if (Request::get("err") == "division_name-exists")
                <div style="margin-bottom: 5px;">
                    <strong><div class = "alert alert-danger"> Bộn phận đã tồn tại</div></strong>
                </div>
                @endif
                @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>{{$error}}</strong>
                </div>					
                @endforeach
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3">Tên bộ phận</div>
                    <div class="col-md-9">
                        <input type="text" value="{{ isset($record->division_name)?$record->division_name:'' }}" name="division_name" class="form-control" >
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3">Số điện thoại bộ phận</div>
                    <div class="col-md-9">
                        <input type="phone" id="division_phone" value="<?php echo isset($record->division_phone) ? $record->division_phone : ''; ?>"  name="division_phone" class="form-control" >
                    </div>
                </div>
                <!-- end rows -->
                <!-- form group -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3">Người quản lý</div>
                    <div class="col-md-9">
                        <select name="manager_name" style="text-align-last: center;">
                            @foreach($manager as $rows)
                            ?>
                            <option @if(isset($record->manager_name) && $record->manager_name == $rows->full_name) selected @endif value="<?php echo $rows->full_name; ?>"><?php echo $rows->full_name; ?></option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end form group -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <input type="submit" value="Lưu thông tin" class="btn btn-primary">
                    </div>
                </div>
                <!-- end rows -->
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#formAddEditDivision').validate({
            rules: {
                division_name: {
                    required: true,
                },
                division_phone: {
                    required: true,
                    minlength: 10,
                }
            },
            messages: {
                division_name: {
                    required: "Tên bộ phận không được để trống",
                },
                division_phone: {
                    required: "Số điện thoại của bộ phận không được để trống",
                    minlength: "Số điện thoại của bộ phận không đúng định dạng",
                }
            }
        });
    });
</script>
@endsection