<table class="table table-bordered" id="tablestatistic">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Tên sản phẩm</th>
		<th class="text-center">Ngày bán</th>
		<th class="text-center">Số lượng</th>
		<th class="text-center">Đơn giá (VNĐ)</th>
		<th class="text-center">Tổng cộng (VNĐ)</th>
	</tr>
	</thead>
	<tbody>
	<?php $revenue = 0; if (count($product_statistic) > 0 && is_array($product_statistic)):
		foreach ($product_statistic as $key => $result): ?>
		<?php $revenue += $result['total_price']; ?>
			<tr>
				<td class="text-center"><?php echo ($from + $key + 1); ?></td>
				<td><?php echo $result['name']; ?></td>
				<td><?php echo $result['order_date']; ?></td>
				<td class="text-right"><?php echo $result['quantity']; ?></td>
				<td class="text-right"><?php echo convertPrice($result['unit_price']); ?></td>
				<td class="text-right"><?php echo convertPrice($result['total_price']); ?></td>
			</tr>
		<?php endforeach; ?>
	<?php elseif (count($product_statistic) == 0): ?>
		<tr>
			<td colspan="7">Không có dữ liệu</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
<div class="text-right" style="font-size: 20px">
	<label for="">Doanh thu:</label>
	<span><?php echo convertPrice($revenue); ?> VNĐ</span>
</div>
<div class="text-center" style="margin-bottom: 20px;">
	<?php echo $pagination_link; ?>
</div>
<?php die(); ?>
