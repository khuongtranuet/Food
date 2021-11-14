<table class="table table-bordered" id="tablerepository">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Tên kho</th>
		<th class="text-center">Thời gian nhập</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
	<?php  if (count($store) > 0 && is_array($store)):
		foreach ($store as $key => $result_store): ?>
			<tr>
				<td class="text-center"><?php echo ($from + $key + 1); ?></td>
				<td><?php echo $result_store['repository_name']; ?></td>
				<td class="text-center"><?php echo $result_store['import_date']; ?></td>
<!--				<td class="text-center">--><?php //echo date("H:m:s d-m-Y", strtotime($result_store['import_date'])); ?><!--</td>-->
				<td class="text-center " style="width: 110px;">
					<a href="<?php echo base_url('admin/repository/detail_store/'.$result_store['repository_id'].'?date='.$result_store['import_date'].'') ?>"
					   title="Nhấn để xem chi tiết">
						<i class="fa fa-eye"></i>
					</a>&nbsp
					<a href="<?php echo base_url('admin/repository/edit_store/'.$result_store['repository_id'].'?date='.$result_store['import_date'].'') ?>"
					   title="Nhấn để chỉnh sửa">
						<i class="fa fa-pencil-square"></i>
					</a>&nbsp
					<a href="<?php echo base_url('admin/repository/delete_store/'.$result_store['repository_id'].'?date='.$result_store['import_date'].'') ?>"
					   title="Nhấn để xóa" style="color: red"
					   onclick="return confirm('Bạn có muốn xóa lần nhập kho này không?')">
						<i class="fa fa-trash"></i>
					</a>&nbsp
				</td>
			</tr>
		<?php endforeach; ?>
	<?php elseif (count($store) == 0): ?>
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
