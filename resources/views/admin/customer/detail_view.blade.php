@extends('layouts.be_master_view');

@section('title')
    <title>Thông tin chi tiết khách hàng</title>
@endsection

@section('content')
    <div class="row form-horizontal">
	<div class="col-lg-12">
		<h3>Thông tin khách hàng</h3>
	</div>
	<div class="col-lg-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px">
		<img src="{{ asset('images/data-loading.gif') }}" id="data-loading" style="display: none; width: 65px">
	</div>
	@if (isset($customer) && $customer)
	@foreach ($customer as $result)
	<div class="col-lg-12">
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="" >Họ và tên:</label>
				</div>
				<div class="col-lg-8">
					<p>{{ $result->fullname }}</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="">Địa chỉ email:</label>
				</div>
				<div class="col-lg-8">
					<p>{{ $result->email }}</p>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="" >Số điện thoại:</label>
				</div>
				<div class="col-lg-8">
					<p>{{ $result->mobile }}</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="">Giới tính:</label>
				</div>
				<div class="col-lg-8">
					<p>@if($result->gender == '1') {{ 'Nam' }}
							 @elseif($result->gender == '0') {{ 'Nữ' }}
							 @else {{ 'Khác' }}
                        @endif</p>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endif
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12 form-group">
				<div class="col-lg-12">
					<label for="">Địa chỉ:</label>
				</div>
				@if (isset($address) && $address)
				@foreach ($address as $result)
				<div class="col-lg-2">
				</div>
				<div class="col-lg-10">
                    <p>{{ '+'.$result->address.', '.$result->ward->full_location }}</p>
						@if($result->status == '1') {{ ' (Địa chỉ giao hàng mặc định)' }} @endif</p>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
	@if (isset($customer) && $customer)
	@foreach ($customer as $result)
	<div class="col-lg-12">
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="">Loại tài khoản:</label>
				</div>
				<div class="col-lg-8">
					<p>@if ($result->type == '1') {{ 'Người dùng hệ thống' }}
							 @elseif($result->type == '0') {{ 'Khách vãng lai' }}
                        @endif</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="">Trạng thái:</label>
				</div>
				<div class="col-lg-8">
					<p>@if($result->status == '0') {{ 'Chưa kích hoạt' }}
							 @elseif($result->status == '1') {{ 'Kích hoạt' }}
							 @else {{ 'Tạm khóa' }}
                        @endif</p>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endif
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: left">
				<a id="back" class="btn btn-primary" href="{{ route('admin.customer.index') }}">Quay lại</a>
			</div>
			<div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: center;">
				<a id="update" class="btn btn-primary" href="{{ route('admin.customer.edit', ['id' => $id]) }}">Chỉnh sửa</a>
			</div>
			<div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: right;">
				<a id="delete" class="btn btn-primary" href="{{ route('admin.customer.delete', ['id' => $id]) }}"
				   style="background: #d20e0ed4; border-color:#d20e0ed4;" onclick="return confirm('Bạn muốn xóa khách hàng này không?')">Xóa</a>
			</div>
		</div>
	</div>
</div>
@endsection
