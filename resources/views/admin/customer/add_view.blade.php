@extends('layouts.be_master_view');

@section('title')
    <title>Thêm mới khách hàng</title>
@endsection

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    {{ method_field('PUT') }}
    @include('errors.error_message_view')
    <div class="row">
        <div class="col-lg-12">
            <h3>Thêm người dùng</h3>
        </div>
        <div class="col-lg-12">
            <h5>Ghi chú: Tên người nhận là tên người nhận hàng khi đặt hàng, số điện thoại nhận là số điện thoại nhận hàng khi đặt hàng</h5>
        </div>
        <div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
            <img src="{{ asset('images/data-loading.gif') }}" id="data-loading" style="display: none; width: 65px">
        </div>
        <form action="{{ route('admin.customer.store') }}" class="form-horizontal" method="POST">
            @csrf
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="fullname">Tên người dùng<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                            @error('fullname')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-group" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="birthday">Ngày sinh:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{ old('birthday') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="mobile">Số điện thoại<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}">
                            @error('mobile')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-group" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="email">Email<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="gender">Giới tính:</label>
                        </div>
                        <div class="col-lg-8">
                            <select class="form-control" name="gender" id="gender">
                                <option value="-1">- Giới tính -</option>
                                <option value="1" @if(old('gender') == '1') {{ 'selected' }} @endif>Nam</option>
                                <option value="0" @if(old('gender') == '0') {{ 'selected' }} @endif>Nữ</option>
                                <option value="2" @if(old('gender') == '2') {{ 'selected' }} @endif>Khác</option>
                            </select>
                            @error('gender')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-group" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="password">Mật khẩu<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            @error('password')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="status">Trạng thái<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <select class="form-control" name="status" id="status">
                                <option value="-1">- Trạng thái -</option>
                                <option value="0" @if(old('status') == '0') {{ 'selected' }} @endif>Chưa kích hoạt</option>
                                <option value="1" @if(old('status') == '1') {{ 'selected' }} @endif>Kích hoạt</option>
                                <option value="2" @if(old('status') == '2') {{ 'selected' }} @endif>Tạm khóa</option>
                            </select>
                            @error('status')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="province">Tỉnh/Thành phố<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <select class="form-control" name="province" id="province">
                                <option value="-1">- Tỉnh/TP -</option>
                                @if(isset($province) && $province)
                                @foreach ($province as $result_province)
                                <option value="{{ $result_province->id }}">{{ $result_province->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('province')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-group" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="district">Quận/Huyện<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8" id="ajax_district">
                            <select class="form-control" name="district" id="district">
                                <option value="-1">- Quận/Huyện -</option>
                            </select>
                            @error('district')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="ward">Xã/Phường/Thị trấn<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8" id="ajax_ward">
                            <select class="form-control" name="ward" id="ward">
                                <option value="-1">- Xã/Phường/Thị trấn -</option>
                            </select>
                            @error('ward')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-group" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="address">Địa chỉ<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                            @error('address')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="fullname_address">Tên người nhận<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="fullname_address" name="fullname_address" value="{{ old('fullname_address') }}">
                            @error('fullname_address')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-group" style="margin-left: 10px;">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="mobile_address">Số điện thoại nhận<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="mobile_address" name="mobile_address" value="{{ old('mobile_address') }}">
                            @error('mobile_address')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="type_address">Loại địa chỉ<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="radio-inline"><input type="radio" name="type_address" value="0"
                                        @if(old('type_address') == '0') {{ 'checked' }} @endif>Nhà riêng/Chung cư</label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="radio-inline"><input type="radio" name="type_address" value="1"
                                        @if(old('type_address') == '1') {{ 'checked' }} @endif>Cơ quan/Công ty</label>
                                </div>
                            </div>
                            @error('type_address')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="status_address">Cài đặt địa chỉ<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="radio-inline"><input type="radio" name="status_address" value="1"
                                        @if(old('status_address') == '1') {{ 'checked' }} @endif>Địa chỉ mặc định</label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="radio-inline"><input type="radio" name="status_address" value="0"
                                       @if(old('status_address') == '0') {{ 'checked' }} @endif>Địa chỉ phụ</label>
                                </div>
                            </div>
                            @error('status_address')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
                        <button class="btn btn-primary" type="submit" name="submit">Thêm</button>
                    </div>
                </div>
            </div>
        </form>
        <script type="text/javascript">
            $(document).ready(function () {
                filterAddress('province', window.ajax_url.district_list);
                filterAddress('district', window.ajax_url.ward_list);
            });

            function filterAddress(id, url_ajax) {
                $('#' + id).change(function () {
                    var id_address = $('#' + id).val();
                    callAjax(id_address, url_ajax);
                });
            }

            function callAjax(id_address, url_ajax) {
                $.ajax({
                    url: url_ajax,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        id_address: id_address,
                        _token: "{{ csrf_token() }}",
                    }
                }).done(function (result) {
                    if (url_ajax == window.ajax_url.district_list) {
                        $('#district').html(result);
                        var html = '';
                        html += '<option value="-1">- Xã/Phường/Thị trấn -</option>';
                        $('#ward').html(html);
                    }
                    if (url_ajax == window.ajax_url.ward_list) {
                        $('#ward').html(result);
                    }
                })
                $(document).ajaxError(function () {
                });
            }
        </script>
    </div>
    <style>
        .form-control {
            border-color: #9d9d9d;
        }
    </style>
@endsection

