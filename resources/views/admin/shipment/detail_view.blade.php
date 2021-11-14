@extends('layouts.be_master_view');

@section('title')
    <title>Thông tin đơn ship</title>
@endsection

@section('content')
<div class="row form-horizontal">
	<div class="col-lg-12">
		<h3>Thông tin đơn ship</h3>
	</div>
	<div class="col-lg-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px">
		<img src="{{ asset('images/data-loading.gif') }}" id="data-loading" style="display: none; width: 65px">
	</div>
	@if (isset($shipment) && $shipment)
		@foreach ($shipment as $result)
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Mã đơn hàng:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ $result->order_code }}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="">Mã vận đơn:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ $result->label }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Thời gian lấy dự kiến:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ $result->estimated_pick_time }}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Thời gian giao dự kiến:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ $result->estimated_deliver_time }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Phí giao hàng:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ convertPrice($result->fee) }}đ</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Phí bảo hiểm:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ convertPrice($result->insurance_fee) }}đ</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Trạng thái đơn:</label>
						</div>
						<div class="col-lg-8">
							<p>{{ statusOrder($result->status) }}</p>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@endif
	<div class="col-lg-12">
		<label for="">CHI TIẾT ĐƠN:</label>
	</div>
	@if (isset($shipment[0]->order->product) && $shipment[0]->order->product)
	@foreach ($shipment[0]->order->product as $result_product)
	<div class="col-lg-12">
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="" >Sản phẩm:</label>
				</div>
				<div class="col-lg-8">
					<p>{{ $result_product->name }}</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6 form-group">
			<div class="row">
				<div class="col-lg-4">
					<label for="" >Số lượng:</label>
				</div>
				<div class="col-lg-8">
					<p>{{ $result_product->quantity }}</p>
				</div>
			</div>
		</div>
	</div>
		@endforeach
	@endif
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
				<a id="delete" class="btn btn-primary" href="{{ route('admin.shipment.cancel', ['id' => $id]) }}"
				   style="background: #d20e0ed4; border-color:#d20e0ed4;" onclick="return confirm('Bạn muốn xóa khách hàng này không?')">Hủy đơn</a>
			</div>
		</div>
	</div>
</div>
@endsection
