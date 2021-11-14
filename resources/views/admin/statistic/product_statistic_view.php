<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12 col-sm-12">
		<h3>Thống kê sản phẩm</h3>
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
<!--			<div class="col-lg-3 col-sm-3 col-xs-12 add" style="margin-left: -15px">-->
<!--				<select class="form-control" name="type" id="type">-->
<!--					<option value="-1">- Loại thống kê -</option>-->
<!--					<option value="0">Sản phẩm bán chạy</option>-->
<!--					<option value="1">Người dùng hệ thống</option>-->
<!--				</select>-->
<!--			</div>-->
			<div class="col-lg-2 col-sm-3 col-xs-12" style="margin-left: -15px">
				<select class="form-control" name="cate" id="cate">
					<option value="-1">- Danh mục -</option>
					<?php if (isset($category) && $category): ?>
					<?php foreach ($category as $cate): ?>
					<option value="<?php echo $cate['id'] ?>"><?php echo $cate['name'] ?></option>
					<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>
			<div class="col-lg-1 col-sm-1 col-xs-6">
				<a class="btn btn-primary" id="reset_search" style="margin-left: -15px;">Tải lại</a>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-sm-12">
		<div class="row" style="margin-bottom: 5px">
			<div class="col-lg-3 col-sm-12 col-xs-12">
				<div class="row">
					<div class="col-lg-3 col-sm-4 col-xs-12">
						<p style="padding-top: 5px;">Từ :</p>
					</div>
					<div class="col-lg-9 col-sm-8 col-xs-12">
						<input type="date" class="form-control" id="start_date" name="start_date" value="">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-12 col-xs-12" style="margin-left: -15px">
				<div class="row">
					<div class="col-lg-3 col-sm-4 col-xs-12">
						<p style="padding-top: 5px;">Đến :</p>
					</div>
					<div class="col-lg-9 col-sm-8 col-xs-12">
						<input type="date" class="form-control" id="end_date" name="end_date" value="">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-sm-12">
		<div class="table-responsive" id="div-ajax">
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			callAjax(1, window.ajax_url.product_statistic_list);
			var oldTimeout = '';

			$('#keyword').keyup(function () {
				$('#data-loading').show();

				clearTimeout(oldTimeout);
				oldTimeout = setTimeout(function () {
					callAjax(1, window.ajax_url.product_statistic_list);
				}, 250);
			});

			filterBySelectBox('type', window.ajax_url.product_statistic_list);
			filterBySelectBox('cate', window.ajax_url.product_statistic_list);
			filterBySelectBox('start_date', window.ajax_url.product_statistic_list);
			filterBySelectBox('end_date', window.ajax_url.product_statistic_list);

			$('#reset_search').click(function () {
				$('#keyword').val('');
				$('#type').val(-1);
				$('#cate').val(-1);
				$('#start_date').val('');
				$('#end_date').val('');
				callAjax(1, window.ajax_url.product_statistic_list)
			});
		});

		function filterBySelectBox(id, url_ajax) {
			$('#' + id).change(function () {
				callAjax(1, window.ajax_url.product_statistic_list);
			});
		}

		function changePage(page_index) {
			callAjax(page_index, window.ajax_url.product_statistic_list);
		}

		function callAjax(page_index, url_ajax) {
			$('#data-loading').show();
			var keyword = $('#keyword').val();
			var type = $('#type').val();
			var cate = $('#cate').val();
			var start_date = $('#start_date').val();
			var end_date = $('#end_date').val();
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					keyword: keyword,
					type: type,
					cate: cate,
					start_date: start_date,
					end_date : end_date,
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

