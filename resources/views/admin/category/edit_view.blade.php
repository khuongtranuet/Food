@extends('layouts.be_master_view');

@section('title')
    <title>Chỉnh sửa danh mục</title>
@endsection

@section('content')
    <h3>Cập nhật danh mục</h3>
    <form action="{{ route('admin.category.update', ['id' => $old_value->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id"
               value="{{ $old_value->id }}">
        <input type="hidden" name="old_name" id="old_name"
                value="{{ $old_value->name }}" >
        <input type="hidden" name="old_image" id="old_image"
                value="{{ $old_value->image }}">
        <div class="form-group row">
            <label class="col-lg-2" for="name">Tên danh mục(*):</label>
            <div class="col-lg-4">
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('name') : $old_value->name }}">
                @error('name')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
        </div>
{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-2" for="category_id">Thuộc danh mục:</label>--}}
{{--            <div class="col-lg-4">--}}
{{--                <select class="form-control" id="parent_id" name="parent_id">--}}
{{--                    <option value="-1 ">Danh mục gốc</option>--}}
{{--                    @foreach ($category_id as $data)--}}
{{--                        <option value="{{ $data->id }}"--}}
{{--                            @if ($_SERVER['REQUEST_METHOD'] == 'POST')--}}
{{--                                @if (old('parent_id') == $data->id)--}}
{{--                                    {{'selected'}}--}}
{{--                                @endif--}}
{{--                            @else--}}
{{--                                @if ($old_value->parent_id == $data->id)--}}
{{--                                    {{'selected'}}--}}
{{--                                @endif--}}
{{--                            @endif--}}
{{--                        >{{ $data->name }}</option>--}}
{{--                    @endforeach--}}
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
            <div class="col-lg-10">
                <textarea id="description" name="description" cols="58" rows="5" style="resize: vertical">{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('description') : $old_value->description }}</textarea>
            </div>
        </div>
{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-2">Hiển thị:</label>--}}
{{--            <div class="col-lg-3">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="radio" style="margin-top: 0">--}}
{{--                            <label><input type="radio" value="1" name="status"--}}
{{--                                @if ($_SERVER['REQUEST_METHOD'] == 'POST') {--}}
{{--                                    @if (old('status') == 1)--}}
{{--                                        {{'checked'}}--}}
{{--                                    @endif--}}
{{--                                @else--}}
{{--                                    @if ($old_value->status  == 1)--}}
{{--                                        {{'checked'}}--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                                >Có</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="radio" style="margin-top: 0">--}}
{{--                            <label><input type="radio" value="-1" name="status"--}}
{{--                                @if ($_SERVER['REQUEST_METHOD'] == 'POST') {--}}
{{--                                    @if (old('status') == -1)--}}
{{--                                        {{ 'checked' }}--}}
{{--                                    @endif--}}
{{--                                @else {--}}
{{--                                    @if ($old_value->status  == -1)--}}
{{--                                        {{'checked'}}--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                                >Không</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group row">
            <div class="col-lg-offset-2 col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
