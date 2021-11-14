@extends('layouts.be_master_view');

@section('title')
    <title>Thêm mới đơn hàng</title>
@endsection

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    {{ method_field('PUT') }}
    @include('errors.error_message_view')
    <h3>Thêm đơn hàng</h3>
    <form action="{{ route('admin.order.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Đơn giá</th>
                    <th class="text-center">Tổng tiền</th>
                    <th class="text-center">Xử lý</th>
                    </tr>
                    </thead>
                    <tbody id="container">
                        @if (old('product_id') && old('quantity'))
                            @for ($i = 0; $i < count(old('product_id')); $i++)
                                <tr>
                                    <td>
                                        <select name="product_id[]" id="{{ 'product_id'.$i }}  "
                                                class="form-control">
                                            <option value="-1">Chọn sản phẩm</option>
                                            @if (count($product) > 0)
                                                @foreach ($product as $data)
                                                    <option value="{{ $data->id }}"
                                                        @if (old('product_id')[$i] == $data->id)
                                                                {{ 'selected' }}
                                                        @endif
                                                    >{{ $data->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="quantity[]"
                                               id="{{ 'quantity'.$i }} "
                                               value="{{ old('quantity')[$i] }}"
                                        >
                                    </td>
                                    <td></td>
                                    <td id="{{ 'total_each'.$i }}"></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="delete">
                                            <i class="fa fa-trash fa-2x" style="color: red"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
            <a href="javascript:void(0)" class="btn col-lg-8 col-lg-offset-2 text-center"
               style="margin-top: -15px; background: lightgray" id="add">
                <i class="fa fa-plus" style="color: gray"></i>
            </a>
        </div>

        <div class="row">
            <label class="col-lg-4" for="address">Tổng giá trị đơn hàng:</label>
            <div class="col-lg-8">
                <p style="text-decoration: underline solid 1px" id="total_money">0 VNĐ</p>
                @error('product_id')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="customer">Khách hàng(*):</label>
                    <div class="col-lg-8">
                        <select name="customer_id" id="customer_id" class="form-control">
                            <option value="-1">Chọn khách hàng</option>
                            @if (count($customer) > 0)
                            @foreach ($customer as $data)
                                <option value="{{ $data->id }}"
                                        {{ old('customer_id') == $data->id ? 'selected' : '' }}
                                >{{ $data->fullname }}</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="repository_id">Chọn kho hàng(*):</label>
                    <div class="col-lg-8">
                        <select name="repository_id" id="repository_id" class="form-control">
                            <option value="-1">Chọn kho hàng</option>
                            @if (count($repository) > 0)
                                @foreach ($repository as $data)
                                    <option value="{{ $data->id }}"
                                            {{ old('repository_id') == $data->id ? 'selected' : '' }}
                                    >{{ $data->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('repository_id')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="address">Địa chỉ khách hàng(*):</label>
                    <div class="col-lg-8">
                        <select name="address" id="address" class="form-control">
                            <option value="-1">Chọn địa chỉ</option>
                        </select>
                        @error('address')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4" for="voucher_id">Mã giảm giá sản phẩm:</label>
                    <div class="col-lg-8">
                        <select name="voucher_id" id="voucher_id" class="form-control">
                            <option value="-1">Chọn voucher</option>
                        </select>
                        @error('voucher_id')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4">Phương thức thanh toán(*):</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="form-check col-lg-6">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_method1"
                                       value="1" {{ old('payment_method') == 1 ? 'checked' : '' }} >
                                <label class="form-check-label" for="payment_method1">VN Pay</label>
                            </div>
                            <div class="form-check col-lg-6">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_method2"
                                       value="2" {{ old('payment_method') == 2 ? 'checked' : '' }} >
                                <label class="form-check-label" for="payment_method2">Ship COD</label>
                            </div>
                            <div class="col-lg-12">
                                @error('payment_method')
                                <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-lg-6">
                <div class="row">
                    <label class="col-lg-4">Trạng thái thanh toán(*):</label>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="form-check col-lg-6">
                                <input class="form-check-input" type="radio" name="payment_status" id="payment_status1"
                                       value="1" {{ old('payment_status') == 1 ? 'checked' : '' }} >
                                <label class="form-check-label" for="payment_status1">Đã thanh toán</label>
                            </div>
                            <div class="form-check col-lg-6">
                                <input class="form-check-input" type="radio" name="payment_status" id="payment_status2"
                                       value="-1" {{ old('payment_status') == -1 ? 'checked' : '' }} >
                                <label class="form-check-label" for="payment_status2">Chưa thanh toán</label>
                            </div>
                            @error('payment_status')
                            <div style="color: red">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-offset-2 col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success">Thêm</button>
                </div>
            </div>
        </div>
    </form>
    </div>
    <style>
        .errors {
            color: red;
        }
    </style>
    <script>
        $('document').ready(function () {
            $('#customer_id').change(function () {
                customer_ajax();
                voucher_ajax();
            });
            $('#customer_id').trigger('change')
            var count = $('#container tr').length
            if (count > 0) {
                for (i = 0; i < count; i++) {
                    product_change('product_id' + i, 'quantity' + i);
                    $('#product_id' + i).trigger('change');
                }
            }
            if (count > 0) {
                var x = count + 1;
            } else {
                var x = 0;
            }

            $('#add').click(function (e) {
                var html = '<tr>' +
                        '<td>' +
                        '<select name="product_id[]" id="product_id' + x + '" class="form-control">' +
                        '<option value="-1">Chọn sản phẩm</option>' +
                        '@if (count($product) > 0)' +
                        '@foreach ($product as $data)' +
                        '<option value="{{ $data->id }}">{{ $data->name }}</option>' +
                        '@endforeach' +
                        '@endif' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<input type="number" value = 1 class="form-control" name="quantity[]" id = "quantity' + x + '">' +
                        '</td>' +
                        '<td></td>' +
                        '<td id = "total_each' + x + '"></td>' +
                        '<td class="text-center">' +
                        '<a href="javascript:void(0)" id="delete">' +
                        '<i class="fa fa-trash fa-2x" style="color: red"></i>' +
                        '</a>' +
                        '</td>' +
                        '</tr>'
                $('#container').append(html);
                product_change('product_id' + x, 'quantity' + x);
                x++;
            })

            $('#container').on('click', '#delete', function (e) {
                $(this).parent().parent('tr').remove();
            })
        })

        function product_change(id, quantity) {
            $('#' + id).change(function () {
                if ($('#' + id).val() != -1) {
                    product_ajax(id, $('#' + quantity));
                }
            });
        }

        function total_price() {
            var count = $('#container tr').length
            var total = 0;
            var remove_vnd;
            var remove_dot;
            if (count > 0) {
                for (i = 0; i < count; i++) {
                    if ($('#product_id' + i).val() == -1 || $('#quantity' + i).val() < 0) {
                        continue;
                    }
                    remove_vnd = $('#total_each' + i).text().replace(' VNĐ', '');
                    remove_dot = remove_vnd.split('.').join('')
                    total += parseInt(remove_dot);
                }
                total = String(total);
                if (total.length > 3) {
                    i = total.length - 1;
                    var new_str = '';
                    for (i; i >= 0; i--) {
                        if (new_str.length % 4 === 0) {
                            new_str += '.' + total[i];
                        } else {
                            new_str += total[i];
                        }
                    }
                    new_str = new_str.split('').reverse().join('').substring(0, new_str.length - 1);
                    $('#total_money').html(new_str + ' VNĐ');
                } else {
                    $('#total_money').html(total + ' VNĐ');
                }
            }
        }

        function quantity_chage(result, quantity) {
            quantity.on('input', function () {
                if (quantity.val() > 0) {
                    var total = result * quantity.val();
                    total = String(total);
                    if (total.length > 3) {
                        i = total.length - 1;
                        var new_str = '';
                        for (i; i >= 0; i--) {
                            if (new_str.length % 4 === 0) {
                                new_str += '.' + total[i];
                            } else {
                                new_str += total[i];
                            }
                        }
                        new_str = new_str.split('').reverse().join('').substring(0, new_str.length - 1);
                        quantity.parent().parent('tr').children()[3].innerHTML = new_str + ' VNĐ';
                    } else {
                        quantity.parent().parent('tr').children()[3].innerHTML = total + ' VNĐ';
                    }
                    total_price();
                }
            });
        }

        function customer_ajax() {
            var customer_id = $('#customer_id').val();
            $.ajax({
                url: window.ajax_url.customer_id,
                type: 'POST',
                dataType: 'html',
                data: {
                    customer_id: customer_id,
                    _token: "{{ csrf_token() }}",
                }
            }).done(function (result) {
                $('#address').html(result);
            })
        }

        function voucher_ajax() {
            var customer_id = $('#customer_id').val();
            $.ajax({
                url: window.ajax_url.get_voucher,
                type: 'POST',
                dataType: 'html',
                data: {
                    customer_id: customer_id,
                    _token: "{{ csrf_token() }}",
                }
            }).done(function (result) {
                $('#voucher_id').html(result);

            })
        }

        function product_ajax(id, quantity) {
            var product_id = $('#' + id).val();
            $.ajax({
                url: window.ajax_url.product_id,
                type: 'POST',
                dataType: 'html',
                data: {
                    product_id: product_id,
                    _token: "{{ csrf_token() }}",
                }
            }).done(function (result) {
                if (result.length > 3) {
                    i = result.length - 1;
                    var new_str = '';
                    for (i; i >= 0; i--) {
                        if (new_str.length % 4 === 0) {
                            new_str += '.' + result[i];
                        } else {
                            new_str += result[i];
                        }
                    }
                    new_str = new_str.split('').reverse().join('').substring(0, new_str.length - 1);
                    $('#' + id).parent().parent('tr').children()[2].innerHTML = new_str + ' VNĐ';
                    quantity_chage(parseInt(result), quantity);
                    quantity.trigger('input');
                } else {
                    $('#' + id).parent().parent('tr').children()[2].innerHTML = result + ' VNĐ';
                    quantity_chage(parseInt(result), quantity);
                    quantity.trigger('input');
                }
            })
        }
    </script>
@endsection
