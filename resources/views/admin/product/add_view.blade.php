@extends('layouts.be_master_view');

@section('title')
    <title>Thêm mới sản phẩm</title>
@endsection

@section('content')
<h3>Thêm sản phẩm</h3>
<form action="{{ route('admin.product.store') }}" id="form" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
	<div class="row">
		<div class="form-group col-lg-6">
			<div class="row">
				<label class="col-lg-4" for="name">Tên sản phẩm(*):</label>
				<div class="col-lg-8">
					<input type="text" class="form-control" id="name" name="name"
						   value="{{ old('name') }}">
                    @error('name')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
		<div class="form-group col-lg-6">
			<div class="row">
				<label class="col-lg-4" for="brand_id">Thương hiệu:</label>
				<div class="col-lg-8">
					<select class="form-control" name="brand_id" id="brand_id">
						<option value="-1">Chọn thương hiệu</option>
						@if (isset($brand) && $brand)
							@foreach ($brand as $data)
								<option value="{{ $data->id }}"
										{{ (old('brand_id') == $data->id) ? 'selected' : '' }}
								>{{ $data->name }}</option>
							@endforeach
						@endif
					</select>
                    @error('brand_id')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="row form-group">
				<label class="col-lg-4" for="price">Giá sản phẩm(*):</label>
				<div class="col-lg-8">
					<input type="number" class="form-control" id="price" name="price"
						   value="{{ old('price') }}">
                    @error('price')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="row form-group">
				<label class="col-lg-4" for="category_id">Danh mục:</label>
				<div class="col-lg-8">
					<select class="form-control" name="category_id" id="category_id">
						<option value="-1">Chọn danh mục</option>
						@if (isset($category) && $category)
							@foreach ($category as $data)
								<option value="{{ $data->id }}"
										{{ (old('category_id') == $data->id) ? 'selected' : '' }}
								>{{ $data->name }}</option>
							@endforeach
						@endif
					</select>
                    @error('category_id')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="row form-group">
				<label class="col-lg-4" for="color">Màu sắc:</label>
				<div class="col-lg-8">
					<input class="form-control" type="text" id="status" name="color"
						   value="{{ old('color') }}">
                    @error('color')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="row form-group">
				<label class="col-lg-4" for="weight">Cân nặng(kg):</label>
				<div class="col-lg-8">
					<input class="form-control" type="number" id="weight" name="weight"
						   value="{{ old('weight') }}">
                    @error('weight')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="row form-group">
				<label class="col-lg-4" for="kind_id">Sản phẩm cùng loại:</label>
				<div class="col-lg-8">
					<select class="form-control" name="kind_id" id="kind_id">
						<option value="-1">Chọn sản phẩm</option>
						@if (isset($kind_id) && $kind_id)
							@foreach ($kind_id as $kind)
								<option value="{{ $kind->id }}"
										{{ (old('category_id') == $kind->id) ? 'selected' : '' }}
								>{{ $kind->name }}</option>
							@endforeach
						@endif
					</select>
                    @error('kind_id')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
{{--		<div class="col-lg-6">--}}
{{--			<div class="row form-group">--}}
{{--				<label class="col-lg-4" for="slug">Đường dẫn tìm kiếm:</label>--}}
{{--				<div class="col-lg-8">--}}
{{--					<input class="form-control" type="text" id="slug" name="slug"--}}
{{--						   value="{{ old('slug') }}">--}}
{{--                    @error('slug')--}}
{{--                    <div style="color: red">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-lg-4" for="main_img">Ảnh chính:</label>
				<div class="col-lg-8">
					<input class="form-control" type="file" id="main_img" name="main_img">
                    @error('main_img')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-lg-4" for="img">Ảnh phụ:</label>
				<div class="col-lg-8">
					<input class="form-control" type="file" name="img[]" id="img" multiple>
                    @error('img')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-12" for="description">Mô tả:</label>
		<div class="col-lg-12">
				<textarea
						style="border-radius:5px;resize: vertical;border: 1px solid lightgray"
						name="description" id="description">{{ old('description') }}</textarea>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-12" for="attribute_id">Thông số:</label>
		<div class="col-lg-12" id="container">
			<a href="javascript:void(0)" class="text-center col-lg-12" id="add"
			   style="background: lightgray;border-radius: 5px"
			>
				<i class="fa fa-plus" style="color: gray"></i>
			</a>
			<div class="row">
				<div class="col-lg-5">
                    @error('attribute_id')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
				<div class="col-lg-5">
                    @error('value')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
				</div>
			</div>
				@if (old('attribute_id') != null && count(old('attribute_id')) > 0 && count(old('value')) > 0)
					@php $count = count(old('attribute_id')); @endphp
					@for ($i = 0; $i < $count; $i++)
					<div class="row" style="padding-top:7px">
						<div class="col-lg-5">
							<select class="form-control" name="attribute_id[]">
								<option value="-1">Chọn thông số</option>
								@if (isset($attribute) && $attribute)
									@foreach ($attribute as $data)
										<option value="{{ $data->id }}"
												{{ (old('attribute_id')[$i] == $data->id) ? 'selected' : '' }}
										>{{ $data->name }}</option>
									@endforeach
								@endif
							</select>
						</div>
						<div class="col-lg-5">
							<input type="text" name="value[]" class="form-control"
								   value="{{ old('value')[$i] }}">
						</div>
						<div class="col-lg-2 add_container">
							<a href="javascript:void(0)" class="btn btn-danger" id="delete">Xoá</a>
						</div>
					</div>
				@endfor
				@endif
		</div>
	</div>
	<div class="form-group row">
		<label class="col-lg-2" for="priority">Nổi bật:</label>
		<div class="col-lg-3">
			<input type="checkbox" value="1" name="priority" class="radio"
					{{ (old('priority') == 1) ? 'checked' : '' }}>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-6">
			<div class="row">
				<div class="col-lg-4">
					<button type="submit" class="btn btn-success">Thêm</button>
				</div>
			</div>
		</div>
	</div>
</form>
<style>
	#description {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;

		width: 100%;
	}

	.errors {
		color: red;
	}
</style>
<script>
	$('document').ready(function (e) {
		var html = '<div class="row" style="padding-top:7px;">' +
				'<div class="col-lg-5">' +
				'<select class="form-control" name="attribute_id[]">' +
				'<option value="-1">Chọn thông số</option>' +
				'@if (isset($attribute) && $attribute)' +
				'@foreach($attribute as $data) ' +
				'<option value="{{ $data->id}} ">{{ $data->name }}</option>' +
				'@endforeach ' +
				'@endif ' +
				'</select>' +
				'</div>' +
				'<div class="col-lg-5">' +
				'<input type="text" name="value[]" class="form-control">' +
				'</div>' +
				'<div class="col-lg-2">' +
				'<a href="javascript:void(0)" class="btn btn-danger" id="delete">Xoá</a>' +
				'</div>' +
				'</div>'
		$('#add').click(function (e) {
			$('#container').append(html);
		})

		$('#container').on('click', '#delete', function (e) {
			$(this).parent().parent('div').remove();
		})
	})
</script>
@endsection

