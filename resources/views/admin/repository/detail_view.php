<div class="row">
	<?php if (isset($repository) && $repository): ?>
	<?php foreach ($repository as $result): ?>
	<div class="col-lg-12">
		<h3><?php echo $result['name']; ?></h3>
		<input type="hidden" value="<?php echo $result['id']; ?>" id="repository_id" name="repository_id">
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
			<!-- Lọc theo danh mục -->
			<div class="col-lg-2 col-sm-3 col-xs-12" style="margin-left: -15px">
				<select class="form-control" name="categories" id="categories">
					<option value="-1">- Danh mục -</option>
					<?php if(isset($category) && $category):?>
					<?php foreach ($category as $result_category): ?>
					<option value="<?php echo $result_category['id']; ?>"><?php echo $result_category['name']; ?></option>
					<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>
			<div class="col-lg-2 col-sm-2 col-xs-12" style="margin-left: -15px">
				<select class="form-control" name="brand" id="brand">
					<option value="-1">- Thương hiệu -</option>
					<?php if(isset($brand) && $brand):?>
						<?php foreach ($brand as $result_brand): ?>
							<option value="<?php echo $result_brand['id']; ?>"><?php echo $result_brand['name']; ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>
			<div class="col-lg-2 col-sm-3 col-xs-12" style="margin-left: -15px">
				<select class="form-control" name="sort" id="sort">
					<option value="-1">- Sắp xếp -</option>
					<option value="0">Số lượng tăng dần</option>
					<option value="1">Số lượng giảm dần</option>
				</select>
			</div>
			<div class="col-lg-1 col-sm-1 col-xs-6">
				<a class="btn btn-primary" id="reset_search" style="margin-left: -15px;">Tải lại</a>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
	<div class="col-lg-12 col-sm-12">
		<div class="table-responsive" id="div-ajax">
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			callAjax(1, window.ajax_url.detail_repository_list);
			var oldTimeout = '';

			$('#keyword').keyup(function () {
				$('#data-loading').show();

				clearTimeout(oldTimeout);
				oldTimeout = setTimeout(function () {
					callAjax(1, window.ajax_url.detail_repository_list);
				}, 250);
			});

			filterBySelectBox('categories', window.ajax_url.detail_repository_list);
			filterBySelectBox('sort', window.ajax_url.detail_repository_list);
			filterBySelectBox('brand', window.ajax_url.detail_repository_list);

			$('#reset_search').click(function () {
				$('#keyword').val('');
				$('#categories').val(-1);
				$('#sort').val(-1);
				$('#brand').val(-1);
				callAjax(1, window.ajax_url.detail_repository_list)
			});
		});

		function filterBySelectBox(id, url_ajax) {
			$('#' + id).change(function () {
				callAjax(1, window.ajax_url.detail_repository_list);
			});
		}

		function changePage(page_index) {
			callAjax(page_index, window.ajax_url.detail_repository_list);
		}

		function callAjax(page_index, url_ajax) {
			$('#data-loading').show();
			var keyword = $('#keyword').val();
			var category = $('#categories').val();
			var sort = $('#sort').val();
			var brand = $('#brand').val();
			var repository_id = $('#repository_id').val();
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					keyword: keyword,
					category: category,
					sort: sort,
					brand: brand,
					repository_id: repository_id,
					page_index: page_index,
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
