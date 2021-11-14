@extends('layouts.be_master_view');

@section('title')
    <title>Chi tiết danh mục</title>
@endsection

@section('content')
    <h3>Chi tiết danh mục</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-lg-2" for="name">Tên danh mục:</label>
            <div class="col-lg-4">
                <p>{{ $data_category['result']->name }}</p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2" for="image">Ảnh danh mục:</label>
            <div class="col-lg-3">
                @if (!empty($data_category['result']->image_path))
                    <img src="{{ asset('uploads/category_images/' . $data_category['result']->image_path) }}"
                         style="width: 100px; height: 100px;padding-top: 7px">
                @else
                    <p>Chưa có dữ liệu</p>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2" for="description">Mô tả:</label>
            <div class="col-lg-10">
                <p class="read"
                >{{ !empty($data_category['result']->description) ? nl2br($data_category['result']->description) : 'Chưa có dữ liệu' }}</p>
            </div>
        </div>
{{--        <div class="form-group row">--}}
{{--            <label class="col-lg-2">Hiển thị:</label>--}}
{{--            <div class="col-lg-3">--}}
{{--                <p>{{ $data_category['result']->status == 1 ? 'Có' : 'Không' }}</p>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">
                <div class="row">
                    <div class="col-lg-4">
                        <a href="{{ route('admin.category.edit', ['id' => $data_category['result']->id]) }}" class="btn btn-success">Cập
                            nhật</a>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{ route('admin.category.delete', ['id' => $data_category['result']->id]) }}"
                           title="Nhấn để xóa" class="btn btn-danger"
                           onclick="return confirm('Bạn muốn xóa danh mục {{ $data_category['result']->name }} này không?')"
                        >Xoá</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <style>
        .read {
            border-radius: 5px;
            overflow: auto;
            width: auto;
            height: auto;
            max-height: 170px;
        }
    </style>
@endsection

