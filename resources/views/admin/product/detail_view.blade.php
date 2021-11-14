@extends('layouts.be_master_view');

@section('title')
<title>Chi tiết sản phẩm</title>
@endsection

@section('content')
<h3>Chi tiết sản phẩm</h3>
<form action="" id="form" method="POST" enctype="multipart/form-data" novalidate>
	<div class="row">
		<div class="form-group col-lg-6">
			<div class="row">
				<label class="col-lg-4" for="name">Tên sản phẩm(*):</label>
				<div class="col-lg-8" style="padding-top: 7px">{{ $product->name }}</div>
			</div>
		</div>
		@if ($product->parent_id == null)
			<div class="form-group col-lg-6">
				<div class="row">
					<label class="col-lg-4" for="brand_id">Thương hiệu:</label>
					<div class="col-lg-8" style="padding-top: 7px">
                        @if (isset($product->brand->name) && $product->brand->name) {{ $product->brand->name }}
                        @else {{ 'Thương hiệu khác' }}
                        @endif
					</div>
				</div>
			</div>
		@endif
	</div>
	<div class="row">
		<div class="form-group col-lg-6">
			<div class="row">
				<label class="col-lg-4" for="price">Giá sản phẩm(*):</label>
				<div class="col-lg-8" style="padding-top: 7px">
					{{ convertPrice($product->price).' VNĐ' }}
				</div>
			</div>
		</div>
        @if ($product->parent_id == null)
			<div class="form-group col-lg-6">
				<div class="row">
					<label class="col-lg-4" for="category_id">Danh mục:</label>
					<div class="col-lg-8" style="padding-top: 7px">
                        @if (isset($product->category->name) && $product->category->name) {{ $product->category->name }}
                        @else {{ 'Danh mục khác' }}
                        @endif
					</div>
				</div>
			</div>
		@endif
	</div>
    @if ($product->parent_id == null)
		<div class="form-group row">
			<label class="col-lg-12" for="description">Mô tả:</label>
			<div class="col-lg-12">
				<div id="description">
                    @if(isset($product->description) && $product->description) {!! nl2br($product->description) !!}
                    @else {{ 'Chưa có thông tin' }}
                    @endif
				</div>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-lg-12" id="container">
				<table class="table table-bordered" style="color: black">
					<thead>
					<th class="text-center">Thông số</th>
					<th class="text-center">Thông tin</th>
					</thead>
					<tbody>
					@if (count($product->attributes) > 0)
						@foreach ($product->attributes as $data)
							<tr>
								<td>{{ $data->name }}</td>
								<td>{{ $data->pivot->value }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="2" class="text-center">Sản phẩm chưa có thông số</td>
						</tr>
					@endif
					</tbody>
				</table>
			</div>
		</div>
	@endif
	<div class="form-group row">
		<label class="col-lg-2" for="main_img">Ảnh chính:</label>
		<div class="col-lg-9">
			@if (isset($main_img) && $main_img)
				<img src="{{ asset('uploads/product_images/' . $main_img) }}" alt="Ảnh chính"
					 height="200" width="250" style="border-radius: 5px">
			@else
				<p>Không có ảnh</p>
			@endif
		</div>
	</div>
    @if ($product->parent_id == null)
		<div class="form-group row">
			<label class="col-lg-2" for="img">Ảnh phụ:</label>
			<div class="col-lg-9">
				<div class="row">
					@if (count($img) > 0)
						@foreach ($img as $data)
							<div class="col-lg-4" style="padding-top: 7px">
								<img src="{{ asset('uploads/product_images/' . $data->path) }}"
									 alt="Ảnh phụ"
									 height="200" width="250" style="border-radius: 5px;">
							</div>
						@endforeach
					@else
						<div class="col-lg-4">Không có ảnh</div>
					@endif
				</div>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2" for="priority">Nổi bật:</label>
			<div class="col-lg-3">
				{{ $product->priority == 1 ? 'Sản phẩm nổi bật' : 'Sản phẩm thường' }}
			</div>
		</div>
	@endif
	<div class="form-group row">
		<label class="col-lg-2" for="color">Màu sắc:</label>
        @if ($product->parent_id == null)
			@if (count($child) > 0)
				<ul class="col-lg-9">
					@foreach ($child as $data)
						<li>
							<a href="{{ route('admin.product.detail', ['id' => $data->id ])}}">
								{{ $data->name }}
							</a>
						</li>
					@endforeach
				</ul>
			@else
				<p>Sản phẩm chưa có màu sắc khác</p>
			@endif
		@else
			<p>{{ $product['color'] }}</p>
		@endif
	</div>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-6">
			<div class="row">
				<div class="col-lg-4">
					<a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-success">Cập
						nhật</a>
				</div>
				<div class="col-lg-4">
					<a href="{{ route('admin.product.delete', ['id' => $product->id]) }}" type="reset"
					   class="btn btn-danger">Xoá</a>
				</div>
			</div>
		</div>
	</div>
</form>
<style>
	.errors {
		color: red;
	}
	#description {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		width: 100%;
		border-radius: 5px;
		border: lightgray 1px solid;
		overflow: scroll;
		resize: vertical;
		max-height: 250px;
	}
</style>
@endsection

