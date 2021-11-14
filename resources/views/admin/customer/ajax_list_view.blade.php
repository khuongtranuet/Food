<table class="table table-bordered" id="tablecustomer" style="color: black">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Họ và tên</th>
		<th class="text-center">Email</th>
		<th class="text-center">Số điện thoại</th>
		<th class="text-center">Loại</th>
		<th class="text-center">Trạng thái</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
	@if (count($result_customer) > 0 && $result_customer)
		@foreach ($result_customer as $key => $customer_list)
			<tr>
				<td class="text-center">{{ ($from + $key + 1) }}</td>
				<td>{{ $customer_list->fullname }}</td>
				<td>{{ $customer_list->email }}</td>
				<td>{{ $customer_list->mobile }}</td>
				<td>@if ($customer_list->type == 1) {{ 'Người dùng hệ thống' }}
					@else {{ 'Khách vãng lai' }}
                    @endif</td>
				<td>@if ($customer_list->status == 0 ) {{ 'Chưa kích hoạt' }}
					@elseif ($customer_list->status == 1) {{ 'Đã kích hoạt' }}
					@else {{ 'Tạm khóa' }}
                    @endif</td>
				<td class="text-center " style="width: 110px;">
						<a href="{{ route('admin.customer.detail', ['id' => $customer_list->id]) }}"
						   title="Nhấn để xem chi tiết">
							<i class="fa fa-eye"></i>
						</a>&nbsp
						<a href="{{ route('admin.customer.edit', ['id' => $customer_list->id]) }}"
						   title="Nhấn để chỉnh sửa">
							<i class="fa fa-pencil-square"></i>
						</a>&nbsp
						<a href="{{ route('admin.customer.delete', ['id' => $customer_list->id]) }}"
						   title="Nhấn để xóa" style="color: red"
						   onclick="return confirm('Bạn muốn xóa người dùng {{ $customer_list->fullname }} này không?')">
							<i class="fa fa-trash"></i>
						</a>&nbsp
				</td>
			</tr>
		@endforeach
	@elseif (count($result_customer) == 0)
		<tr>
			<td colspan="7">Không có dữ liệu</td>
		</tr>
	@endif
	</tbody>
</table>
<div class="text-center" style="margin-bottom: 20px;">
	{!! $pagination_link !!}
</div>
@php(die())
