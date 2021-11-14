<table class="table table-bordered" id="tablecustomer">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Code</th>
		<th class="text-center">Giảm giá</th>
		<th class="text-center">Loại giảm giá</th>
		<th class="text-center">Điều kiện giảm</th>
		<th class="text-center">Loại mã</th>
		<th class="text-center">Trạng thái</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
	<?php  if (count($result_voucher) > 0 && is_array($result_voucher)):
		foreach ($result_voucher as $key => $voucher_list): ?>
			<tr>
				<td class="text-center"><?php echo ($from + $key + 1); ?></td>
				<td><?php echo $voucher_list['code']; ?></td>
				<td class="text-right"><?php echo $voucher_list['discount']; ?><?php echo ($voucher_list['discount_type'] == 1) ? '%' : '₫';?></td>
				<td><?php if ($voucher_list['discount_type'] == 1) echo 'Giảm giá phần trăm';
					else echo 'Giảm giá tiền'?></td>
				<td class="text-right"><?php echo $voucher_list['condition']; ?>₫</td>
				<td><?php if ($voucher_list['type'] == 1) echo 'Giảm giá vận chuyển';
					else echo 'Giảm giá hệ thống'?></td>
				<td><?php if (strtotime($voucher_list['expiration_date']) > time() && strtotime($voucher_list['effective_date']) < time() ) echo 'Có hiệu lực';
							elseif (strtotime($voucher_list['effective_date']) > time()) echo 'Chưa bắt đầu';
						else echo 'Hết hiệu lực'?></td>
				<td class="text-center " style="width: 110px;">
					<a href="<?php echo base_url('admin/voucher/detail/'.$voucher_list['id'].'') ?>"
					   title="Nhấn để xem chi tiết">
						<i class="fa fa-eye"></i>
					</a>&nbsp
					<a href="<?php echo base_url('admin/voucher/edit/'.$voucher_list['id'].'') ?>"
					   title="Nhấn để chỉnh sửa">
						<i class="fa fa-pencil-square"></i>
					</a>&nbsp
					<a href="<?php echo base_url('admin/voucher/delete/'.$voucher_list['id'].'') ?>"
					   title="Nhấn để xóa" style="color: red"
					   onclick="return confirm('Bạn muốn xóa mã giảm giá <?php echo $voucher_list['code']; ?> này không?')">
						<i class="fa fa-trash"></i>
					</a>&nbsp
				</td>
			</tr>
		<?php endforeach; ?>
	<?php elseif (count($result_voucher) == 0): ?>
		<tr>
			<td colspan="10">Không có dữ liệu</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
<div class="text-center" style="margin-bottom: 20px;">
	<?php echo $pagination_link; ?>
</div>
<?php die(); ?>
