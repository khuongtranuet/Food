<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12 col-sm-12">
		<h3>Danh sách mã giảm giá</h3>
	</div>
	<div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
		<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading" style="display: none; width: 65px">
	</div>
	<div class="col-lg-12 col-sm-12" style="margin-top: 20px;">
		<div class="row" style="margin-bottom: 5px">
			<!-- Tìm kiếm theo từ khóa -->
			<div class="col-lg-3 col-sm-3 col-xs-12">
				<input class="form-control" type="text" name="keyword" id="keyword" value=""
					   placeholder="Nhập để tìm kiếm">
			</div>
			<!-- Lọc theo phòng ban -->
			<div class="col-lg- col-sm-2 col-xs-12 add" style="margin-left: -15px">
				<select class="form-control" name="discount_type" id="discount_type">s
					<option value="-1">- Loại giảm giá -</option>
					<option value="0">Giảm giá tiền</option>
					<option value="1">Giảm giá phần trăm</option>
				</select>
			</div>
			<div class="col-lg-2 col-sm-3 col-xs-12" style="margin-left: -15px">
				<select class="form-control" name="type" id="type">
					<option value="-1">- Loại mã -</option>
					<option value="0">Giảm giá hệ thống</option>
					<option value="1">Giảm giá vận chuyển</option>
				</select>
			</div>
			<div class="col-lg-1 col-sm-1 col-xs-6">
				<a class="btn btn-primary" id="reset_search" style="margin-left: -15px;">Tải lại</a>
			</div>
			<!-- Thêm mới -->
			<div class="col-lg-2 col-sm-2 col-xs-6" style="float: right; text-align: right;">
				<a href="<?php echo base_url('admin/voucher/add'); ?>">
					<button class="btn btn-primary">Thêm</button>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-sm-12">
		<div class="table-responsive" id="div-ajax">
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			callAjax(1, window.ajax_url.voucher_list);
			var oldTimeout = '';

			$('#keyword').keyup(function () {
				$('#data-loading').show();

				clearTimeout(oldTimeout);
				oldTimeout = setTimeout(function () {
					callAjax(1, window.ajax_url.voucher_list);
				}, 250);
			});

			filterBySelectBox('discount_type', window.ajax_url.voucher_list);
			filterBySelectBox('type', window.ajax_url.voucher_list);

			$('#reset_search').click(function () {
				$('#keyword').val('');
				$('#discount_type').val(-1);
				$('#type').val(-1);
				callAjax(1, window.ajax_url.voucher_list)
			});
		});

		function filterBySelectBox(id, url_ajax) {
			$('#' + id).change(function () {
				callAjax(1, window.ajax_url.voucher_list);
			});
		}

		function changePage(page_index) {
			callAjax(page_index, window.ajax_url.voucher_list);
		}

		function callAjax(page_index, url_ajax) {
			$('#data-loading').show();
			var keyword = $('#keyword').val();
			var type = $('#type').val();
			var discount_type = $('#discount_type').val();
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					keyword: keyword,
					type: type,
					discount_type: discount_type,
					page_index: page_index
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
<style>
	@media only screen and (max-width:767px) {
		.add {
			margin-left: 0px;
		}
	}
</style>
