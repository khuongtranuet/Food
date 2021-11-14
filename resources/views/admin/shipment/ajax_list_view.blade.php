<table class="table table-bordered" id="tablecustomer" style="color: black">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Mã đơn hàng</th>
		<th class="text-center">Mã vận đơn</th>
		<th class="text-center">Phí ship (VNĐ)</th>
		<th class="text-center">Dự kiến lấy hàng</th>
		<th class="text-center">Dự kiến giao hàng</th>
		<th class="text-center">Trạng thái</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
	@if (count($result_ship) > 0 && ($result_ship))
		@foreach ($result_ship as $key => $result)
			<tr>
				<td class="text-center">{{ ($from + $key + 1) }}</td>
				<td>{{ $result->order_code }}</td>
				<td>{{ $result->label }}</td>
				<td class="text-right">{{ $result->fee }}</td>
				<td>{{ $result->estimated_pick_time }}</td>
				<td>{{ $result->estimated_deliver_time }}</td>
				<td>{{ statusOrder($result->status) }}</td>
				<td class="text-center " style="width: 110px;">
						<a href="{{ route('admin.shipment.detail', ['id' => $result->id ]) }}"
						   title="Nhấn để xem chi tiết">
							<i class="fa fa-eye"></i>
						</a>&nbsp
						<a href="{{ route('admin.shipment.cancel', ['id' => $result->id ]) }}"
						   title="Nhấn để hủy đơn" style="color: red"
						   onclick="return confirm('Bạn muốn xóa người dùng {{ $result->order_code }} này không?')">
							<i class="fa fa-trash"></i>
						</a>&nbsp
				</td>
			</tr>
		@endforeach
	@elseif (count($result_ship) == 0)
		<tr>
			<td colspan="10">Không có dữ liệu</td>
		</tr>
	@endif
	</tbody>
</table>
<div class="text-center" style="margin-bottom: 20px;">
	{!! $pagination_link !!}
</div>
@php(die())
