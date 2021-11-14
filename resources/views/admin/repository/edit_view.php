<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12" style="text-align: center;">
		<h3>Chỉnh sửa thông tin kho hàng</h3>
	</div>
	<div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
		<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading" style="display: none; width: 65px">
	</div>
	<?php if (isset($repository) && $repository): ?>
	<?php foreach ($repository as $result): ?>
	<form action="" class="form-horizontal" method="POST">
		<div class="col-lg-12">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="name">Tên kho hàng<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="name" name="name"
							   value="<?php $name = set_value('name');
							   if($name) {echo $name;} else {echo $result['name'];}?>">
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
						<input type="text" class="form-control" id="mobile" name="mobile"
							   value="<?php $mobile = set_value('mobile');
							   if($mobile) {echo $mobile;} else {echo $result['mobile'];}?>">
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
									<option value="<?php echo $result_province['id']; ?>"
											<?php if($result['province_id'] == $result_province['id']) {echo 'selected';} ?>><?php echo $result_province['name']; ?></option>
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
							<?php if(isset($district) && $district): ?>
								<?php foreach ($district as $result_district):?>
									<option value="<?php echo $result_district['id']; ?>"
											<?php if($result['district_id'] == $result_district['id']) {echo 'selected';} ?>><?php echo $result_district['name']; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
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
							<?php if(isset($ward) && $ward): ?>
								<?php foreach ($ward as $result_ward):?>
									<option value="<?php echo $result_ward['id']; ?>"
											<?php if($result['ward_id'] == $result_ward['id']) {echo 'selected';} ?>><?php echo $result_ward['name']; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
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
						<input type="text" class="form-control" id="address" name="address"
							   value="<?php $address = set_value('address');
							   if($address) {echo $address;} else {echo $result['address'];}?>">
						<?php echo form_error('address'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
					<button class="btn btn-primary" type="submit" name="submit">Lưu</button>
				</div>
			</div>
		</div>
	</form>
	<?php endforeach; ?>
	<?php endif; ?>
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
