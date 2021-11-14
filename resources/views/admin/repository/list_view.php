<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12 col-sm-12">
		<h3>Danh sách kho hàng</h3>
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
			<!-- Thêm mới -->
			<div class="col-lg-2 col-sm-2 col-xs-6" style="float: right; text-align: right;">
				<a href="<?php echo base_url('admin/repository/add'); ?>">
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
			callAjax(1, window.ajax_url.repository_list);
			var oldTimeout = '';

			$('#keyword').keyup(function () {
				$('#data-loading').show();

				clearTimeout(oldTimeout);
				oldTimeout = setTimeout(function () {
					callAjax(1, window.ajax_url.repository_list);
				}, 250);
			});
		});

		function changePage(page_index) {
			callAjax(page_index, window.ajax_url.repository_list);
		}

		function callAjax(page_index, url_ajax) {
			$('#data-loading').show();
			var keyword = $('#keyword').val();
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					keyword: keyword,
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
