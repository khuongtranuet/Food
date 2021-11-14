<table class="table table-bordered" id="tablerepository">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Tên sản phẩm</th>
		<th class="text-center">Danh mục</th>
		<th class="text-center">Thương hiệu</th>
		<th class="text-center">Số lượng</th>
	</tr>
	</thead>
	<tbody>
	<?php  if (count($detail_repository) > 0 && is_array($detail_repository)):
		foreach ($detail_repository as $key => $repository_list): ?>
			<tr>
				<td class="text-center"><?php echo ($from + $key + 1); ?></td>
				<td><?php echo $repository_list['product_name']; ?></td>
				<td><?php echo $repository_list['category_name']; ?></td>
				<td><?php echo $repository_list['brand_name']; ?></td>
				<td class="text-right"><?php echo $repository_list['total']; ?></td>
			</tr>
		<?php endforeach; ?>
	<?php elseif (count($detail_repository) == 0): ?>
		<tr>
			<td colspan="7">Không có dữ liệu</td>
		</tr>
	<?php endif; ?>
	</tbody>
</table>
<div class="text-center" style="margin-bottom: 20px;">
	<?php echo $pagination_link; ?>
</div>
<?php die(); ?>
