<table class="table table-bordered" id="tableuser" style="color: black">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Tên danh mục</th>
		<th class="text-center">Mô tả</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
	@if (count($result_category) > 0 && $result_category)
		@foreach ($result_category as $key => $category_list)
			<tr>
				<td class="text-center">{{ ($from + $key + 1) }}</td>
				<td>{{ $category_list->name }}</td>
				<td>{{ $category_list->description }}</td>
				<td class="text-center " style="width: 110px;">
					<a href="{{ route('admin.category.detail', ['id' => $category_list->id ]) }}"
					   title="Nhấn để xem chi tiết">
						<i class="fa fa-eye"></i>
					</a>&nbsp
					<a href="{{ route('admin.category.edit', ['id' => $category_list->id ]) }}"
					   title="Nhấn để chỉnh sửa">
						<i class="fa fa-pencil-square"></i>
					</a>&nbsp
					<a href="{{ route('admin.category.delete', ['id' => $category_list->id ]) }}"
					   title="Nhấn để xóa" style="color: red"
					   onclick="return confirm('Bạn muốn xóa danh mục {{ $category_list->name }} này không?')">
						<i class="fa fa-trash"></i>
					</a>&nbsp
				</td>
			</tr>
		@endforeach
	@elseif (count($result_category) == 0)
		<tr>
			<td colspan="7">Không có dữ liệu</td>
		</tr>
	@endif
	</tbody>
</table>
<div class="text-center" style="margin-bottom: 20px ">
	{!! $pagination_link !!}
</div>
@php(die())
