@extends('layouts.be_master_view');

@section('title')
    <title>Chỉnh sửa thông tin khách hàng</title>
@endsection

@section('content')
    @include('errors.error_message_view')
    <div class="row">
        <div class="col-lg-12">
            <h3>Chỉnh sửa thông tin người dùng</h3>
        </div>
        <div class="col-lg-12">
            <h5>Ghi chú: Tên người nhận là tên người nhận hàng khi đặt hàng, số điện thoại nhận là số điện thoại nhận hàng khi đặt hàng</h5>
        </div>
        <div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
            <img src="{{ asset('images/data-loading.gif') }}" id="data-loading" style="display: none; width: 65px">
        </div>
        @if (isset($customer) && $customer)
        @foreach ($customer as $result)
            @if(isset($result->customer))
                @php $result_customer = $result->customer @endphp
            @else
                @php $result_customer = $result @endphp
            @endif
        <form action="{{ route('admin.customer.update', ['id' => $result_customer->id]) }}" class="form-horizontal" method="POST">
            @csrf
            <div class="col-lg-12">
                <div class="col-lg-6 form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label class="control-label" for="fullname">Tên người dùng<span style="color: red;">(*)</span>:</label>
                        </div>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                   value="@if(old('fullname')){{ old('fullname') }}@else{{ $result_customer->fullname }}@endif">
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
                            <input type="date" class="form-control" id="birthday" name="birthday"
                                   value="<?php if (old('birthday')) echo old('birthday');
                                                else echo date("Y-m-d", strtotime($result_customer->birthday)); ?>">
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
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                   value="@if(old('mobile')){{ old('mobile') }}@else{{ $result_customer->mobile }}@endif">
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
                            <input type="text" class="form-control" id="email" name="email"
                                   value="@if(old('email')){{ old('email') }}@else{{ $result_customer->email }}@endif">
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
                                <option value="1" {{ $gender = old('gender') }}
                                    @if($gender)  @if(old('gender') == '1') {{ 'selected' }} @endif
                                    @else @if($result_customer->gender == '1') {{ 'selected' }} @endif
                                    @endif>Nam</option>
                                <option value="0" @if($gender) @if(old('gender') == '0') {{ 'selected' }} @endif
                                    @else @if($result_customer->gender == '0') {{ 'selected' }} @endif
                                    @endif>Nữ</option>
                                <option value="2" @if($gender) @if(old('gender') == '2') {{ 'selected' }} @endif
                                    @else @if($result_customer->gender == '2') {{ 'selected' }} @endif
                                    @endif>Khác</option>
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
                            <input type="text" class="form-control" id="password" name="password"
                                   value="@if(old('password')){{ old('password') }}@else{{ $result_customer->password }}@endif">
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
                                <option value="0" {{ $status = old('status') }}
                                    @if($status)  @if(old('status') == '0') {{ 'selected' }} @endif
                                    @else @if($result_customer->status == '0') {{ 'selected' }} @endif
                                    @endif>Chưa kích hoạt</option>
                                <option value="1" @if($status)  @if(old('status') == '1') {{ 'selected' }} @endif
                                    @else @if($result_customer->status == '1') {{ 'selected' }} @endif
                                    @endif>Kích hoạt</option>
                                <option value="2" @if($status)  @if(old('status') == '2') {{ 'selected' }} @endif
                                    @else @if($result_customer->status == '2') {{ 'selected' }} @endif
                                    @endif>Tạm khóa</option>
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
                                        <option value="{{ $result_province->id }}"
                                                @if(isset($result->province) && $result->province->id == $result_province->id) {{ 'selected' }} @endif>{{ $result_province->name }}</option>
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
                                @if(isset($district) && $district)
                                @foreach ($district as $result_district)
                                        <option value="{{ $result_district->id }}"
                                            @if(isset($result->district) && $result->district->id == $result_district->id) {{ 'selected' }} @endif>{{ $result_district->name }}</option>
                                @endforeach
                                @endif
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
                                @if(isset($ward) && $ward)
                                    @foreach ($ward as $result_ward)
                                        <option value="{{ $result_ward->id }}"
                                                @if(isset($result->ward) && $result->ward->id == $result_ward->id) {{ 'selected' }} @endif>{{ $result_ward->name }}</option>
                                    @endforeach
                                @endif
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
                            <input type="text" class="form-control" id="address" name="address"
                                   value="<?php if (old('address')) echo old('address');
                                                elseif (isset($result->address) && $result->address) echo $result->address;
                                                else echo '';
                                                ?>">
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
                            <input type="text" class="form-control" id="fullname_address" name="fullname_address"
                                   value="<?php if (old('fullname_address')) echo old('fullname_address');
                                   else {
                                       if (isset($result->fullname) && $result->fullname) echo $result->fullname;
                                       else echo '';
                                   }?>">
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
                            <input type="text" class="form-control" id="mobile_address" name="mobile_address"
                                   value="<?php if (old('mobile_address')) echo old('mobile_address');
                                   else {
                                       if (isset($result->mobile) && $result->mobile) echo $result->mobile;
                                       else echo '';
                                   }?>">
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
                                                @if(old('type_address')) @if(old('type_address') == '0') {{ 'checked' }} @endif
                                                @else @if(isset($result->type) && $result->type == '0') {{ 'checked'}} @endif
                                                @endif>Nhà riêng/Chung cư</label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="radio-inline"><input type="radio" name="type_address" value="1"
                                        @if(old('type_address')) @if(old('type_address') == '1') {{ 'checked' }} @endif
                                            @else @if(isset($result->type) && $result->type == '1') {{ 'checked'}} @endif
                                            @endif>Cơ quan/Công ty</label>
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
                                        @if(old('status_address')) @if(old('status_address') == '1') {{ 'checked' }} @endif
                                            @else @if(isset($result->status) && $result->status == '1') {{ 'checked'}} @endif
                                            @endif>Địa chỉ mặc định</label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="radio-inline"><input type="radio" name="status_address" value="0"
                                        @if(old('status_address')) @if(old('status_address') == '0') {{ 'checked' }} @endif
                                            @else @if(isset($result->status) && $result->status == '0') {{ 'checked'}} @endif
                                            @endif>Địa chỉ phụ</label>
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
                    <div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: left">
                        <a id="back" class="btn btn-primary" href="{{ route('admin.customer.index') }}">Quay lại</a>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: center;">
                        <button class="btn btn-primary" type="submit" name="submit">Lưu</button>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
        @endif
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
                        id_address: id_address
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

