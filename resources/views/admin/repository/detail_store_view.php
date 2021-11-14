<div class="row">
	<?php if (isset($detail_repository) && $detail_repository): ?>
	<?php foreach ($detail_repository as $repository): ?>
	<div class="col-lg-12">
		<h3><?php echo $repository['repository_name']; ?></h3>
	</div>
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4">
						<label>Địa chỉ:</label>
					</div>
					<div class="col-lg-8">
						<p><?php echo $repository['address']; ?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4">
						<label>Số điện thoại:</label>
					</div>
					<div class="col-lg-8">
						<p><?php echo $repository['mobile']; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-2">
				<h4>Danh sách nhập kho:</h4>
			</div>
			<div class="col-lg-2">
<!--				<h4>--><?php //echo date("H:m:s d-m-Y", strtotime($repository['import_date'])); ?><!--</h4>-->
				<h4><?php echo $repository['import_date']; ?></h4>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
	<div class="col-lg-12">
		<table class="table table-bordered">
			<thead>
			<tr>
				<th class="text-center">STT</th>
				<th class="text-center">Tên sản phẩm</th>
				<th class="text-center">Số lượng</th>
				<th class="text-center">Đơn giá nhập</th>
			</tr>
			</thead>
			<tbody>
			<?php  if (count($detail_product) > 0 && is_array($detail_product)):
				foreach ($detail_product as $key => $product): ?>
					<tr>
						<td class="text-center"><?php echo ($key + 1); ?></td>
						<td><?php echo $product['product_name']; ?></td>
						<td class="text-right"><?php echo $product['import_quantity']; ?></td>
						<?php $str_reverse = strrev($product['import_price']);
						$total_trim = ceil(strlen($product['import_price'])/3);
						$str_final = '';
						for($i=0; $i < $total_trim; $i++) {
							$str_trim = substr($str_reverse, ($i)*3, 3);
							if($i < $total_trim - 1) {
								$str_final .= $str_trim . '.';
							}else{
								$str_final .= $str_trim;
							}
						}
						$product['import_price'] = strrev($str_final); ?>
						<td class="text-right"><?php echo $product['import_price']; ?>₫</td>
					</tr>
				<?php endforeach; ?>
			<?php elseif (count($detail_product) == 0): ?>
				<tr>
					<td colspan="7">Không có dữ liệu</td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</div>
