<?php include ('application/views/errors/error_message_view.php');?>
<div class="row">
	<div class="col-lg-12">
		<h3>Chỉnh sửa mã giảm giá</h3>
	</div>
	<div class="col-lg-12">
		<h5>Ghi chú: Giá trị giảm theo % nằm trong khoảng (0-100)%, Điều kiện giảm giá là giá trị đơn hàng tối thiểu</h5>
	</div>
	<div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
		<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading" style="display: none; width: 65px">
	</div>
	<?php if (isset($voucher) && $voucher): ?>
	<?php foreach ($voucher as $result): ?>
	<form action="" class="form-horizontal" method="POST">
		<div class="col-lg-12">
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="name">Tiêu đề<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="name" name="name" value="<?php $name = set_value('name');
						if($name) {echo $name;} else {echo $result['name'];}?>">
						<?php echo form_error('name'); ?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 form-group" style="margin-left: 10px;">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="code">Mã giảm giá<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="code" name="code" value="<?php $code = set_value('code');
						if($code) {echo $code;} else {echo $result['code'];}?>">
						<?php echo form_error('code'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="description">Nội dung<span style="color: red;"></span>:</label>
					</div>
					<div class="col-lg-8">
						<textarea class="form-control" name="description" id="description" cols="30" rows="10"
								  style="resize: none;width: 350px;height: 68px;"><?php $description = set_value('description');
							if($description) {echo $description;} else {echo $result['information'];}?></textarea>
						<?php echo form_error('description'); ?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 form-group" style="margin-left: 10px;">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="discount">Giá trị giảm giá<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="discount" name="discount" value="<?php $discount = set_value('discount');
						if($discount) {echo $discount;} else {echo $result['discount'];}?>">
						<?php echo form_error('discount'); ?>
						<h5 style="color: red"><?php echo isset($error) ? $error : ''; ?></h5>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="discount_type">Loại giảm giá<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<div class="row">
							<div class="col-lg-6">
								<label class="radio-inline"><input type="radio" name="discount_type" value="0"
											<?php $discount_type = set_value('discount_type');
											if($discount_type){ if(set_value('discount_type') == '0') {echo 'checked';}}
											else {if($result['discount_type'] == '0') {echo 'checked';} }?>>Giảm tiền</label>
							</div>
							<div class="col-lg-6">
								<label class="radio-inline"><input type="radio" name="discount_type" value="1"
											<?php	if($discount_type){ if(set_value('discount_type') == '1') {echo 'checked';}}
											else {if($result['discount_type'] == '1') {echo 'checked';} }?>>Giảm phần trăm</label>
							</div>
						</div>
						<?php echo form_error('discount_type'); ?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 form-group" style="margin-left: 10px;">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="condition">Điều kiện giảm giá<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<input type="text" class="form-control" id="condition" name="condition" value="<?php $condition = set_value('condition');
						if($condition) {echo $condition;} else {echo $result['condition'];}?>">
						<?php echo form_error('condition'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="effective_date">Thời gian bắt đầu<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<?php $result['effective_date'] = date("Y-m-d H:i:s", strtotime($result['effective_date']));
						$result['effective_date'] = str_replace(' ', 'T', $result['effective_date']) ?>
						<input type="datetime-local" class="form-control" id="effective_date" name="effective_date"
							   value="<?php $effective_date = set_value('effective_date');
							   if($effective_date) {echo $effective_date;} else {echo $result['effective_date'];}?>">
						<?php echo form_error('effective_date'); ?>
					</div>
				</div>
			</div>
			<div class="col-lg-6 form-group" style="margin-left: 10px;">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="expiration_date">Thời gian kết thúc<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<?php $result['expiration_date'] = date("Y-m-d H:i:s", strtotime($result['expiration_date']));
						$result['expiration_date'] = str_replace(' ', 'T', $result['expiration_date']) ?>
						<input type="datetime-local" class="form-control" id="expiration_date" name="expiration_date"
							   value="<?php $expiration_date = set_value('expiration_date');
							   if($expiration_date) {echo $expiration_date;} else {echo $result['expiration_date'];}?>">
						<?php echo form_error('expiration_date'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="type">Loại mã<span style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="type" id="type">
							<option value="-1">- Loại mã -</option>
							<option value="0" <?php $type = set_value('type');
							if($type){ if(set_value('type') == '0') {echo 'selected';}}
							else {if($result['type'] == '0') {echo 'selected';} }?>>Giảm giá hệ thống</option>
							<option value="1" <?php	if($type){ if(set_value('type') == '1') {echo 'selected';}}
							else {if($result['type'] == '1') {echo 'selected';} }?>>Giảm giá vận chuyển</option>
						</select>
						<?php echo form_error('type'); ?>
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
</div>
<style>
	.form-control {
		border-color: #9d9d9d;
	}
</style>

