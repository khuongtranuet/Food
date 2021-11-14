@extends('layouts.be_master_view');

@section('title')
    <title>Danh sách sản phẩm</title>
@endsection

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    {{ method_field('PUT') }}
    @include('errors.error_message_view')
    <div class="row">
	<div class="col-lg-12">
		<h3>Danh sách sản phẩm</h3>
	</div>
	<div class="col-lg-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px">
		<img src="{{ asset('images/data-loading.gif') }}" id="data-loading"
			 style="display: none; width: 65px">
	</div>
	<div class="col-lg-12" style="margin-top: 20px;">
		<div class="row" style="margin-bottom: 5px">
			<!-- Tìm kiếm theo từ khóa -->
			<div class="col-lg-3">
				<input class="form-control" type="text" name="keyword" id="keyword" value=""
					   placeholder="Nhập để tìm kiếm">
			</div>
			<!-- Lọc theo phòng ban -->
			<div class="col-lg-2" style="margin-left: -15px">
				<select class="form-control" name="brand" id="brand">
					<option value="-1">Thương hiệu</option>
					<?php if (count($brand) > 0) : ?>
						<?php foreach ($brand as $data): ?>
							<option value="<?php echo $data->id; ?>"><?php echo $data->name; ?></option>
						<?php endforeach ?>
					<?php endif; ?>
				</select>
			</div>
			<div class="col-lg-2" style="margin-left: -15px">
				<select class="form-control" name="category" id="cate">
					<option value="-1">Danh mục</option>
					<?php if (count($category) > 0) : ?>
						<?php foreach ($category as $data): ?>
							<option value="<?php echo $data->id ?>"><?php echo $data->name ?></option>
						<?php endforeach ?>
					<?php endif; ?>
				</select>
			</div>
			<div class="col-lg-1">
				<a class="btn btn-primary" id="reset_search" style="margin-left: -15px;">Tải lại</a>
			</div>
			<!-- Thêm mới -->
			<div class="col-lg-2 col-lg-offset-2" style="float: right; text-align: right;">
				<a href="{{ route('admin.product.add') }}">
					<button class="btn btn-primary">Thêm mới</button>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div id="div-ajax">
		</div>
	</div>
	<script type="text/javascript">

		$(document).ready(function () {
			callAjax(1, window.ajax_url.product_list);
			var oldTimeout = '';
			$('#keyword').keyup(function () {
				$('#data-loading').show();

				clearTimeout(oldTimeout);
				oldTimeout = setTimeout(function () {
					callAjax(1, window.ajax_url.product_list);
				}, 250);
			});

			filterBySelectBox('brand', window.ajax_url.product_list);
			filterBySelectBox('cate', window.ajax_url.product_list);

			$('#reset_search').click(function () {
				$('#keyword').val('');
				$('#brand').val(-1);
				$('#cate').val(-1);
				callAjax(1, window.ajax_url.product_list)
			});
		});

		function filterBySelectBox(id, url_ajax) {
			$('#' + id).change(function () {
				callAjax(1, window.ajax_url.product_list);
			});
		}

		function changePage(page_index) {
			callAjax(page_index, window.ajax_url.product_list);
		}

		function callAjax(page_index, url_ajax) {
			$('#data-loading').show();
			var keyword = $('#keyword').val();
			var brand = $('#brand').val();
			var category = $('#cate').val();
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					keyword: keyword,
					brand: brand,
					category: category,
					page_index: page_index,
                    _token: "{{ csrf_token() }}",
				}
			}).done(function (result) {
				$('#data-loading').hide();
				$('#div-ajax').html(result);
			})
			$(document).ajaxError(function () {
				$('#data-loading').hide();
			});
		}
	</script>
</div>
@endsection

