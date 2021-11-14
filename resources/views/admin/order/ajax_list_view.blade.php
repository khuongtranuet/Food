<table class="table table-bordered" id="tableuser" style="color: black;">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Mã đơn hàng</th>
		<th class="text-center">Khách hàng</th>
		<th class="text-center">Tổng số tiền(VNĐ)</th>
		<th class="text-center">Ngày đặt hàng</th>
		<th class="text-center">Trạng thái</th>
		<th class="text-center">Ship</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
	@if (count($result_order) > 0 && ($result_order))
		@foreach ($result_order as $key => $data)
			<tr>
				<td class="text-center">{{ $from + $key + 1 }}</td>
				<td class="text-center">{{ $data->code }}</td>
				<td>{{ $data->customer->fullname }}</td>
				<td class="text-right">{{ convertPrice($data->total_pay) }}
				</td>
				<td class="text-center">{{ $data->order_date }}</td>
				<td>
					@if ($data->payment_status == 1)
                        {{ 'Đã thanh toán' }}
                    @else
                        {{ 'Chưa thanh toán' }}
                    @endif
				</td>
				<td>@if ($data->type == 1) {{ 'Đã gửi đơn' }} @endif</td>
				<td class="text-center " style="width: 110px;">
					<a href="{{ route('admin.order.detail', ['id' => $data->id]) }}"
					   title="Nhấn để xem chi tiết">
						<i class="fa fa-eye"></i>
					</a>&nbsp
					<a href="{{ route('admin.order.edit', ['id' => $data->id]) }}"
					   title="Nhấn để chỉnh sửa">
						<i class="fa fa-pencil-square"></i>
					</a>&nbsp
{{--					<a href="{{ route('admin.order.delete', ['id' => $data->id]) }}"--}}
{{--					   title="Nhấn để xóa" style="color: red"--}}
{{--					   onclick="return confirm('Bạn muốn xóa đơn hàng {{ $data->code }} này không?')">--}}
{{--						<i class="fa fa-trash"></i>--}}
{{--					</a>&nbsp--}}
				</td>
			</tr>
		@endforeach
	@elseif (count($result_order) == 0)
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
