<table class="table table-bordered" id="tableuser" style="color: black">
	<thead>
	<tr>
		<th class="text-center">STT</th>
		<th class="text-center">Tên sản phẩm</th>
		<th class="text-center">Thương hiệu</th>
		<th class="text-center">Danh mục</th>
		<th class="text-center">Đơn giá(VNĐ)</th>
		<th class="text-center">Tình trạng</th>
		<th class="text-center">Đã bán</th>
		<th class="text-center">Xử lý</th>
	</tr>
	</thead>
	<tbody>
    @forelse($data as $key => $item)
			<tr>
{{--				<td>{{ (optional($item->brand)->name) }}</td>--}}
                <td class="text-center">{{ $from + $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>@if (isset($item->brand->name) && $item->brand->name) {{ $item->brand->name }}
                    @else {{ 'Thương hiệu khác' }}
                    @endif</td>
                <td>@if (isset($item->category->name) && $item->category->name) {{ $item->category->name }}
                    @else {{ 'Danh mục khác' }}
                    @endif</td>
                <td style="text-align: right">{{ convertPrice($item->price) }}</td>
                <td>@if (isset($item->status))
                        @if($item->status == 0)
                            {{ 'Hết hàng' }}
                        @else
                            {{ 'Còn hàng' }}
                        @endif
                    @else
                        {{ 'Sản phẩm chưa có trong kho' }}
                    @endif
                </td>
                <td style="text-align: right">{{ $item->sold }}</td>
                <td class="text-center " style="width: 110px;">
                    <a href="{{ route('admin.product.detail', ['id' => $item->id ]) }}"
                       title="Nhấn để xem chi tiết">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp
                    <a href="{{ route('admin.product.edit', ['id' => $item->id ]) }}"
                       title="Nhấn để chỉnh sửa">
                        <i class="fa fa-pencil-square"></i>
                    </a>&nbsp
                    <a href="{{ route('admin.product.delete', ['id' => $item->id ]) }}"
                       title="Nhấn để xóa" style="color: red"
                       onclick="return confirm('Bạn muốn xóa người dùng {{ $item->name }} này không?')">
                        <i class="fa fa-trash"></i>
                    </a>&nbsp
                </td>
			</tr>
        @empty
            <tr><td colspan="10">Không có dữ liệu</td></tr>
        @endforelse
	</tbody>
</table>
<div class="text-center" style="margin-bottom: 20px ">
    {!! $pagination_link !!}
</div>
<?php die(); ?>
