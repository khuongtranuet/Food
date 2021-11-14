<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12">
		<h3>Danh sách nhập kho</h3>
	</div>
	<div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
		<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading" style="display: none; width: 65px">
	</div>
	<div class="col-lg-12 col-sm-12" style="margin-top: 20px;">
		<div class="row" style="margin-bottom: 5px">
			<!-- Tìm kiếm theo từ khóa -->
			<div class="col-lg-3 col-sm-12 col-xs-12">
				<input class="form-control" type="text" name="keyword" id="keyword" value=""
					   placeholder="Nhập để tìm kiếm">
			</div>
			<!-- Lọc theo phòng ban -->
			<div class="col-lg-3 col-sm-12 col-xs-12" style="margin-left: -15px">
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
			<div class="col-lg-1 col-sm-6 col-xs-6">
				<a class="btn btn-primary" id="reset_search" style="margin-left: -15px;">Tải lại</a>
			</div>
			<!-- Thêm mới -->
			<div class="col-lg-2 col-sm-6 col-xs-6" style="float: right; text-align: right;">
				<a href="<?php echo base_url('admin/repository/add_store'); ?>">
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
			callAjax(1, window.ajax_url.store_list);
			var oldTimeout = '';

			$('#keyword').keyup(function () {
				$('#data-loading').show();

				clearTimeout(oldTimeout);
				oldTimeout = setTimeout(function () {
					callAjax(1, window.ajax_url.store_list);
				}, 250);
			});

			filterBySelectBox('start_date', window.ajax_url.store_list);
			filterBySelectBox('end_date', window.ajax_url.store_list);

			$('#reset_search').click(function () {
				$('#keyword').val('');
				$('#start_date').val('');
				$('#end_date').val('');
				callAjax(1, window.ajax_url.store_list)
			});
		});

		function filterBySelectBox(id, url_ajax) {
			$('#' + id).change(function () {
				callAjax(1, window.ajax_url.store_list);
			});
		}

		function changePage(page_index) {
			callAjax(page_index, window.ajax_url.store_list);
		}

		function callAjax(page_index, url_ajax) {
			$('#data-loading').show();
			var keyword = $('#keyword').val();
			var start_date = $('#start_date').val();
			var end_date = $('#end_date').val();
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					keyword: keyword,
					start_date: start_date,
					end_date: end_date,
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
