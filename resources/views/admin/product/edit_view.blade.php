@extends('layouts.be_master_view');

@section('title')
    <title>Chỉnh sửa thông tin sản phẩm</title>
@endsection

@section('content')
    <h3>Cập nhật sản phẩm</h3>
    <form action="{{ route('admin.product.update', ['id' => $product->id]) }}" id="form" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if ($product->parent_id)
            <input type="hidden" name="parent_id" value="{{ $product->parent_id }}">
            <input type="hidden" name="father_name" value="{{ $data['father_name'] }}">
            <input type="hidden" name="old_color" value="{{ $data['old_color'] }}">
        @endif
        <input type="hidden" name="old_img" value="{{ isset($data['main_img']) ? $data['main_img'] : '' }}">
        <input type="hidden" name="old_name" value="{{ $product->name }}">
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="row">
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="name">Tên sản phẩm(*):</label>
                    <div class="col-lg-8">
                        @if (!$product->parent_id)
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('name') : $product->name }}">
                            @error('name')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        @else
                            <p>{{ $product->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-6">
                @if (!$product->parent_id)
                    <div class="row">
                        <label class="col-lg-4" for="brand_id">Thương hiệu:</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="brand_id" id="brand_id">
                                <option value="-1">Chọn thương hiệu</option>
                                @if (isset($data['brand']) && $data['brand'])
                                    @foreach ($data['brand'] as $item)
                                        <option value="{{ $item->id }}"
                                                @if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                    {{ (old('brand_id') == $item->id) ? 'selected' : '' }}
                                                @else
                                                    @if ($product['brand_id'])
                                                    {{ ($product->brand_id == $item->id) ? 'selected' : '' }}
                                                    @endif
                                                @endif
                                        >{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
               @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="price">Giá sản phẩm(*):</label>
                    <div class="col-lg-8">
                        <input type="number" class="form-control" id="price" name="price"
                               value="{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('price') : $product->price }}">
                        @error('price')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-6">
                @if (!$product->parent_id)
                    <div class="row">
                        <label class="col-lg-4" for="category_id">Danh mục:</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="-1">Chọn danh mục</option>
                                @if (isset($data['category']) && $data['category'])
                                    @foreach ($data['category'] as $item)
                                        <option value="{{ $item->id }}"
                                                @if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                    {{ (old('category_id') == $item->id) ? 'selected' : '' }}
                                                @else
                                                    @if ($product['category_id'])
                                                        {{ ($product->category_id == $item->id) ? 'selected' : '' }}
                                                    @endif
                                                @endif
                                        >{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-lg-4" for="color">
                        {{ !$product->parent_id ? 'Thêm màu sắc:' : 'Thay đổi màu sắc:' }}
                    </label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="status" name="color"
                               value="{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('color') : $product->color }}">
                        @error('color')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            @if (!$product->parent_id)
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4" for="weight">Cân nặng:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="weight" name="weight"
                                   value="{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('weight') : $product->weight }}">
                            @error('weight')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if (!$product->parent_id)
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="category_id">Sản phẩm cùng loại:</label>
                    <div class="col-lg-8">
                        <select class="form-control" name="kind_id" id="kind_id">
                            <option value="-1">Chọn sản phẩm</option>
                            @if (isset($data['kind_id']) && $data['kind_id'])
                                @foreach ($data['kind_id'] as $item)
                                    <option value="{{ $item->id }}"
                                            @if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                {{ (old('kind_id') == $item->id) ? 'selected' : '' }}
                                            @else
                                                @if ($product->category_id)
                                                    {{ ($product->kind_id == $item->id) ? 'selected' : '' }}
                                                @endif
                                            @endif
                                    >{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
{{--            <div class="col-lg-6">--}}
{{--                <div class="row form-group">--}}
{{--                    <label class="col-lg-4" for="slug">Đường dẫn tìm kiếm(*):</label>--}}
{{--                    <div class="col-lg-8">--}}
{{--                        <input type="text" class="form-control" id="slug" name="slug"--}}
{{--                               value="{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('slug') : $product->slug }}">--}}
{{--                        @error('slug')--}}
{{--                        <div style="color: red">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-lg-4" for="main_img">Ảnh chính:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="file" id="main_img" name="main_img">
                        @error('main_img')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            @if (!$product->parent_id)
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-lg-4" for="img">Ảnh phụ:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="file" name="img[]" id="img" multiple>
                            @error('img')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif
        </div>
            @if (!$product->parent_id)
            <div class="row form-group">
                <label class="col-lg-12" for="description">Mô tả:</label>
                <div class="col-lg-12">
                    <textarea id="description" name="description"
                              style="border-radius:5px;resize: vertical;border: 1px solid lightgray">{{ $_SERVER['REQUEST_METHOD'] == 'POST' ? old('description') : $product['description'] }}</textarea>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-lg-12" for="attribute_id">Thông số:</label>
                <div class="col-lg-12" id="container">
                    <a href="javascript:void(0)" class="text-center col-lg-12" id="add"
                       style="background: lightgray;border-radius: 5px"
                    >
                        <i class="fa fa-plus" style="color: gray"></i>
                    </a>
                    <div class="row">
                        <div class="col-lg-5"> @error('attribute_id')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-5"> @error('value')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        @if (old('attribute_id') != null && count(old('attribute_id')) > 0 && count(old('value')) > 0)
                            @for ($i = 0; $i < count(old('attribute_id')); $i++)
                                <div class="row" style="padding-top:7px">
                                    <div class="col-lg-5">
                                        <select class="form-control" name="attribute_id[]">
                                            <option value="-1">Chọn thông số</option>
                                            @if (isset($data['attribute']) && $data['attribute'])
                                                @foreach ($data['attribute'] as $item)
                                                    <option value="{{ $item->id }}"
                                                            @if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                                {{ (old('attribute_id')[$i] == $item->id) ? 'selected' : '' }}
                                                            @endif
                                                    >{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" name="value[]" class="form-control"
                                               value="{{ ($_SERVER['REQUEST_METHOD'] == 'POST') ? old('value')[$i] : '' }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <a href="javascript:void(0)" class="btn btn-danger" id="delete">Xoá</a>
                                    </div>
                                </div>
                           @endfor
                        @endif
                    @elseif (count($data['old_attribute']) > 0)
                        @for ($i = 0; $i < count($data['old_attribute']); $i++)
                            <div class="row" style="padding-top:7px">
                                <div class="col-lg-5">
                                    <select class="form-control" name="attribute_id[]">
                                        <option value="-1">Chọn thông số</option>
                                        @if (isset($data['attribute']) && $data['attribute'])
                                            @foreach ($data['attribute'] as $item)
                                                <option value="{{ $item->id }}"
                                                        @if ($data['old_attribute'][$i]->attribute_id == $item->id)
                                                            {{ 'selected' }}
                                                        @endif
                                                >{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <input type="text" name="value[]" class="form-control"
                                           value="{{ $data['old_attribute'][$i]->value }}">
                                </div>
                                <div class="col-lg-2">
                                    <a href="javascript:void(0)" class="btn btn-danger" id="delete">Xoá</a>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        @endif
        @if (!$product->parent_id)
            <div class="form-group row">
                <label class="col-lg-2" for="priority">Nổi bật:</label>
                <div class="col-lg-3">
                    <input type="checkbox" value="1" name="priority" class="radio"
                            @if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                {{ old('priority') == 1 ? 'checked' : '' }}
                            @else
                                {{ $product->priority == 1 ? 'checked' : '' }}
                            @endif>
                </div>
            </div>
        @endif
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-6">
                <div class="row">
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <style>
        .errors {
            color: red;
        }
        #description {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 100%;
        }
    </style>
    <script>
        $('document').ready(function (e) {
            var html = '<div class="row" style="padding-top:7px;">' +
                    '<div class="col-lg-5">' +
                    '<select class="form-control" name="attribute_id[]">' +
                    '<option value="-1">Chọn thông số</option>' +
                    '@if (isset($data['attribute']) && $data['attribute']) ' +
                    '@foreach($data['attribute'] as $item) ' +
                    '<option value="{{ $item->id }}">{{ $item->name }}</option>' +
                    '@endforeach ' +
                    '@endif ' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-lg-5">' +
                    '<input type="text" name="value[]" class="form-control">' +
                    '</div>' +
                    '<div class="col-lg-2">' +
                    '<a href="javascript:void(0)" class="btn btn-danger" id="delete">Xoá</a>' +
                    '</div>' +
                    '</div>'

            $('#add').click(function (e) {
                $('#container').append(html);
            })

            $('#container').on('click', '#delete', function (e) {
                $(this).parent().parent('div').remove();
            })
        })
    </script>
@endsection


