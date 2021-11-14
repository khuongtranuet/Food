<option value="-1">Chọn voucher</option>
@if (count($voucher) > 0)
	@foreach ($voucher as $data)
		<option value="{{ $data->id }}">{{ $data->name }}</option>
	@endforeach
@endif
@php(die())
