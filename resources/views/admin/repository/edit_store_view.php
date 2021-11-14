<?php include('application/views/errors/error_message_view.php'); ?>
<div class="row">
	<?php if (isset($detail_repository) && $detail_repository): ?>
		<?php foreach ($detail_repository as $result_repository): ?>
			<div class="col-lg-12">
				<h3>Chỉnh sửa thông tin nhập kho</h3>
			</div>
			<div class="col-lg-12 col-sm-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px;">
				<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading"
					 style="display: none; width: 65px">
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<form action="" class="form-horizontal" method="POST" id="add_form">
		<div class="col-lg-12">
			<div class="col-lg-6 form-group">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="repository">Kho nhập<span
									style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<select class="form-control" name="repository" id="repository">
							<option value="-1">- Kho hàng -</option>
							<?php if (isset($repository) && $repository): ?>
								<?php foreach ($repository as $list_repository): ?>
									<option value="<?php echo $list_repository['id']; ?>"
											<?php if ($result_repository['repository_id'] == $list_repository['id']) echo 'selected'; ?>>
										<?php echo $list_repository['name']; ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-5 form-group" style="margin-left: 10px;">
				<div class="row">
					<div class="col-lg-4">
						<label class="control-label" for="import_date">Ngày nhập<span
									style="color: red;">(*)</span>:</label>
					</div>
					<div class="col-lg-8">
						<?php $result_repository['import_date'] = date("Y-m-d H:i:s", strtotime($result_repository['import_date']));
						$result_repository['import_date'] = str_replace(' ', 'T', $result_repository['import_date']) ?>
						<input type="datetime-local" class="form-control" id="import_date" name="import_date"
							   value="<?php echo $result_repository['import_date']; ?>">
					</div>
				</div>
			</div>
		</div>
		<div id="div-main">
			<?php if (isset($detail_product) && $detail_product): ?>
			<?php foreach ($detail_product as $list_product): ?>
			<div>
				<div class="col-lg-12 field_wrapper">
					<div class="col-lg-6 form-group">
						<div class="row">
							<div class="col-lg-4">
								<label class="control-label" for="product[]">Sản phẩm<span
											style="color: red;">(*)</span>:</label>
							</div>
							<div class="col-lg-8">
								<select class="form-control "
										name="product[]" id="product[]">
									<option value="-1">- Sản phẩm -</option>
									<?php if (isset($product) && $product): ?>
										<?php foreach ($product as $result_product): ?>
											<option value="<?php echo $result_product['id']; ?>"
													<?php if ($list_product['product_id'] == $result_product['id']) {
														echo 'selected';
													} ?>><?php echo $result_product['name']; ?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-5 form-group" style="margin-left: 10px;">
						<div class="row">
							<div class="col-lg-4">
								<label class="control-label" for="import_quantity[]">Số lượng<span
											style="color: red;">(*)</span>:</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="import_quantity[]"
									   name="import_quantity[]"
									   value="<?php echo $list_product['import_quantity']; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-1">
						<a class="btn btn-primary remove_button" id="minus" style="border-radius: 15px;">
							<i class="fa fa-minus"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="col-lg-6 form-group">
						<div class="row">
							<div class="col-lg-4">
								<label class="control-label" for="import_price[]">Đơn giá nhập<span
											style="color: red;">(*)</span>:</label>
							</div>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="import_price[]"
									   name="import_price[]"
									   value="<?php echo $list_product['import_price']; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="col-lg-12" id="div-ajax"></div>
		<div class="col-lg-12">
			<a class="btn btn-primary add_button" id="plus" style="border-radius: 15px;"><i class="fa fa-plus"></i></a>
		</div>
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12" style="text-align: center;">
					<button class="btn btn-primary" type="submit" name="submit">Lưu</button>
				</div>
			</div>
		</div>
	</form>
	<script type="text/html" id="addChild">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label" for="product[]">Sản phẩm<span
										style="color: red;">(*)</span>:</label>
						</div>
						<div class="col-lg-8">
							<select class="form-control netEmp1" name="product[]" id="product[]">
								<option value="-1">- Sản phẩm -</option>
								<?php if (isset($product) && $product): ?>
									<?php foreach ($product as $result_product): ?>
										<option value="<?php echo $result_product['id']; ?>"
												<?php if (set_value('product') == $result_product['id']) {
													echo 'selected';
												} ?>><?php echo $result_product['name']; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<?php echo form_error('product'); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-5 form-group" style="margin-left: 10px;">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label" for="import_quantity[]">Số lượng<span
										style="color: red;">(*)</span>:</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control netEmp" id="import_quantity[]"
								   name="import_quantity[]" value="<?php echo set_value('import_quantity'); ?>">
							<?php echo form_error('import_quantity'); ?>
						</div>
					</div>
				</div>
				<div class="col-lg-1">
					<a class="btn btn-primary remove_button" id="minus" style="border-radius: 15px;">
						<i class="fa fa-minus"></i>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label class="control-label" for="import_price[]">Đơn giá nhập<span
										style="color: red;">(*)</span>:</label>
						</div>
						<div class="col-lg-8">
							<input type="text" class="form-control netEmp2" id="import_price[]" name="import_price[]">
						</div>
					</div>
				</div>
			</div>
		</div>
	</script>
	<script>
		$(document).ready(function () {
			var i = 1;
			var template = jQuery.validator.format($.trim($("#addChild").html()));
			$("#plus").click(function (e) {
				$(template(i++)).appendTo("#div-ajax");
				$('.netEmp').each(function () {
					$(this).rules("add", {
						required: true,
						messages: {
							required: '<h5 style="color: red; height: 0px;">Trường này không được để trống!</h5>',
						}
					});
				});
				$('.netEmp1').each(function () {
					$(this).rules("add", {
						min: true,
						messages: {
							min: '<h5 style="color: red; height: 0px;">Vui lòng chọn trường này!</h5>',
						}
					});
				});
				$('.netEmp2').each(function () {
					$(this).rules("add", {
						required: true,
						messages: {
							required: '<h5 style="color: red; height: 0px;">Trường này không được để trống!</h5>',
						}
					});
				});
				e.preventDefault();
			});

			$("#add_form").validate({
				rules: {
					import_quantity: "required",
					product: "min",
					repository: "min",
					import_date: "required",
					import_price: "required",
				},
				messages: {
					import_quantity: '<h5 style="color: red; height: 0px;">Trường này không được để trống!</h5>',
					product: {
						min: '<h5 style="color: red; height: 0px;">Vui lòng chọn trường này!</h5>',
					},
					repository: {
						min: '<h5 style="color: red; height: 0px;">Vui lòng chọn trường này!</h5>',
					},
					import_date: '<h5 style="color: red; height: 0px;">Trường này không được để trống!</h5>',
					import_price: '<h5 style="color: red; height: 0px;">Trường này không được để trống!</h5>',
				}
			});
			$('#div-ajax').on('click', '.remove_button', function (e) {
				e.preventDefault();
				$(this).parent('div').parent('div').parent('div').remove(); //Remove field html
			});
			$('#div-main').on('click', '.remove_button', function (e) {
				e.preventDefault();
				$(this).parent('div').parent('div').parent('div').remove(); //Remove field html
			});
		});
	</script>
</div>

<style>
	.form-control {
		border-color: #cccccc;
	}
</style>
