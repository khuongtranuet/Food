<option value="-1">Chọn địa chỉ</option>
@if (count($address) > 0)
	@foreach ($address as $data)
		<option value="{{ $data->id }}"
			{{ (old('address') == $data->id) ? 'selected' : '' }}
		>{{ $data->$address . ' ' . $data->ward->full_location }}</option>
	@endforeach
@endif
@php(die())
