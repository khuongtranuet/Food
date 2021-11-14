@if (isset($district))
	<option value="-1">- Quận/Huyện -</option>
	@if (isset($district) && $district)
	@foreach ($district as $result_district)
	<option value="{{ $result_district->id }}">{{ $result_district->name }}</option>
	@endforeach
	@endif
@endif

@if (isset($ward))
	<option value="-1">- Xã/Phường/Thị trấn -</option>
    @if (isset($ward) && $ward)
        @foreach ($ward as $result_ward)
            <option value="{{ $result_ward->id }}">{{ $result_ward->name }}</option>
        @endforeach
    @endif
@endif
@php(die())
