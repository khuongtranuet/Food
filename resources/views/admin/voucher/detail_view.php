<div class="row form-horizontal">
	<div class="col-lg-12">
		<h3>Chi tiết mã giảm giá</h3>
	</div>
	<div class="col-lg-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px">
		<img src="<?php echo base_url('public/images/data-loading.gif') ?>" id="data-loading" style="display: none; width: 65px">
	</div>
	<?php if (isset($voucher) && $voucher): ?>
		<?php foreach ($voucher as $result): ?>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Tiêu đề:</label>
						</div>
						<div class="col-lg-8">
							<p><?php echo $result['name'] ?></p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="">Mã giảm giá:</label>
						</div>
						<div class="col-lg-8">
							<p><?php echo $result['code'] ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Nội dung:</label>
						</div>
						<div class="col-lg-8">
							<p><?php echo $result['information'] ?></p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="">Giá trị giảm giá:</label>
						</div>
						<div class="col-lg-8">
							<p><?php echo $result['discount'] ?>đ</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Loại giảm giá:</label>
						</div>
						<div class="col-lg-8">
							<p><?php if($result['discount_type'] == '0') echo 'Giảm tiền';
									else echo 'Giảm phần trăm'?></p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="">Điều kiện giảm giá (Giá trị đơn tối thiểu):</label>
						</div>
						<div class="col-lg-8">
							<p><?php echo $result['condition'] ?>đ</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Thời gian diễn ra:</label>
						</div>
						<div class="col-lg-8">
							<p><?php echo date("H:i:s d-m-Y",strtotime($result['effective_date'])).' đến '.
										date("H:i:s d-m-Y",strtotime($result['expiration_date'])) ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="col-lg-6 form-group">
					<div class="row">
						<div class="col-lg-4">
							<label for="" >Loại mã:</label>
						</div>
						<div class="col-lg-8">
							<p><?php if($result['type'] == '0') echo 'Giảm giá hệ thống';
									else echo 'Giảm giá vận chuyển';?></p>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: left">
				<a id="back" class="btn btn-primary" href="<?php echo base_url('admin/voucher/index') ?>">Quay lại</a>
			</div>
			<div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: center;">
				<a id="update" class="btn btn-primary" href="<?php echo base_url('admin/voucher/edit/'.$result['id'].'') ?>">Chỉnh sửa</a>
			</div>
			<div class="col-lg-4 col-sm-4 col-xs-4" style="text-align: right;">
				<a id="delete" class="btn btn-primary" href="<?php echo base_url('admin/voucher/delete/'.$result['id'].'') ?>"
				   style="background: #d20e0ed4; border-color:#d20e0ed4;" onclick="return confirm('Bạn muốn xóa mã giảm giá này không?')">Xóa</a>
			</div>
		</div>
	</div>
</div>
