<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12" style="text-align: center;">
		<h3>Thêm mới kho hàng</h3>
	</div>
	<div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
		<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading" style="display: none; width: 65px">
	</div>
	<form action="" class="form-horizontal" method="POST">
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="name">Tên kho hàng<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
						<?php echo form_error('name'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="mobile">Số điện thoại<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo set_value('mobile'); ?>">
						<?php echo form_error('mobile'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="mobile">Tỉnh/Thành phố<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="province" id="province">
							<option value="-1">- Tỉnh/TP -</option>
							<?php if(isset($province) && $province):?>
								<?php foreach ($province as $result_province):?>
									<option value="<?php echo $result_province['id']; ?>"><?php echo $result_province['name']; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
						<?php echo form_error('province'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="district">Quận/Huyện<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8" id="ajax_district">
						<select class="form-control" name="district" id="district">
							<option value="-1">- Quận/Huyện -</option>
						</select>
						<?php echo form_error('district'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="ward">Xã/Phường/Thị trấn<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8" id="ajax_ward">
						<select class="form-control" name="ward" id="ward">
							<option value="-1">- Xã/Phường/Thị trấn -</option>
						</select>
						<?php echo form_error('ward'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="address">Địa chỉ<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address'); ?>">
						<?php echo form_error('address'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
					<button class="btn btn-primary" type="submit" name="submit">Thêm</button>
				</div>
			</div>
		</div>
	</form>
	<script type="text/javascript">
		$(document).ready(function () {
			filterAddress('province', window.ajax_url.district_list);
			filterAddress('district', window.ajax_url.ward_list);
		});

		function filterAddress(id, url_ajax) {
			$('#' + id).change(function () {
				var id_address = $('#' + id).val();
				callAjax(id_address, url_ajax);
			});
		}

		function callAjax(id_address, url_ajax) {
			$.ajax({
				url: url_ajax,
				type: 'POST',
				dataType: 'html',
				data: {
					id_address: id_address
				}
			}).done(function (result) {
				if (url_ajax == window.ajax_url.district_list) {
					$('#district').html(result);
					var html = '';
					html += '<option value="-1">- Xã/Phường/Thị trấn -</option>';
					$('#ward').html(html);
				}
				if (url_ajax == window.ajax_url.ward_list) {
					$('#ward').html(result);
				}
			})
			$(document).ajaxError(function () {
			});
		}
	</script>
</div>
<style>
	.form-control {
		border-color: #9d9d9d;
	}
</style>
