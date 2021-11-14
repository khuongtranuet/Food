@extends('layouts.be_master_view');

@section('title')
    <title>Thêm mới danh mục</title>
@endsection

@section('content')
    <h3>Thêm danh mục</h3>
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label class="col-lg-2" for="name">Tên danh mục(*):</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
        </div>
{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-2" for="parent_id">Thuộc danh mục:</label>--}}
{{--            <div class="col-lg-4">--}}
{{--                <select class="form-control" id="parent_id" name="parent_id">--}}
{{--                    <option value="-1 ">Danh mục gốc</option>--}}
{{--                    @if (isset($category_id) && $category_id)--}}
{{--                        @foreach ($category_id as $data)--}}
{{--                            <option value="{{ $data->id }}"--}}
{{--                                @if (old('parent_id') == $data->id)--}}
{{--                                    {{ 'selected' }}--}}
{{--                                @endif--}}
{{--                            >{{ $data->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group row">
            <label class="col-lg-2" for="image">Ảnh danh mục:</label>
            <div class="col-lg-4">
                <input type="file" id="image" name="image" class="form-control">
                @error('image')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2" for="description">Mô tả:</label>
            <div class="col-lg-4">
			<textarea id="description" name="description" cols="58"
                      rows="5">{{ old('description') }}</textarea>
            </div>
        </div>
{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-2">Hiển thị:</label>--}}
{{--            <div class="col-lg-3">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="radio" style="margin-top:0">--}}
{{--                            <label><input type="radio" value="1" name="status" checked--}}
{{--                                {{ (old('status') == 1) ? 'checked' : '' }}>Có</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="radio" style="margin-top:0">--}}
{{--                            <label><input type="radio" value="-1" name="status"--}}
{{--                                {{ (old('status') == 1) ? 'checked' : '' }}>Không</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group row">
            <div class="col-lg-offset-2 col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <style>
        .errors {
            color: red;
        }
    </style>
@endsection
