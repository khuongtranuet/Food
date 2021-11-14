@extends('layouts.be_master_view');

@section('title')
    <title>Danh sách đơn hàng</title>
@endsection

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    {{ method_field('PUT') }}
    @include('errors.error_message_view')
    <div class="row">
        <div class="col-lg-12">
            <h3>Danh sách đơn hàng</h3>
        </div>
        <div class="col-lg-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px">
            <img src="{{ asset('images/data-loading.gif') }}" id="data-loading"
                 style="display: none; width: 65px">
        </div>
        <div class="col-lg-12" style="margin-top: 20px;">
            <div class="row" style="margin-bottom: 5px">
                <div class="col-lg-3">
                    <input class="form-control" type="text" name="keyword" id="keyword" value=""
                           placeholder="Nhập để tìm kiếm">
                </div>
                <div class="col-lg-3" style="margin-left: -15px">
                    <select class="form-control" id="payment_status">
                        <option value="2">Trạng thái thanh toán</option>
                        <option value="1">Đã thanh toán</option>
                        <option value="-1">Chưa thanh toán</option>
                    </select>
                </div>
                <div class="col-lg-3" style="margin-left: -15px">
                    <input type="date" class="form-control" id="order_date" >
                </div>
                <div class="col-lg-1">
                    <a class="btn btn-primary" id="reset_search" style="margin-left: -15px;">Tải lại</a>
                </div>
                <!-- Thêm mới -->
                <div class="col-lg-2" style="float: right; text-align: right;">
                    <a href="{{ route('admin.order.add') }}">
                        <button class="btn btn-primary">Thêm mới</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div id="div-ajax">
            </div>
        </div>
        <script type="text/javascript">

            $(document).ready(function () {
                callAjax(1, window.ajax_url.order_list);
                var oldTimeout = '';
                $('#keyword').keyup(function () {
                    $('#data-loading').show();

                    clearTimeout(oldTimeout);
                    oldTimeout = setTimeout(function () {
                        callAjax(1, window.ajax_url.order_list);
                    }, 250);
                });

                filterBySelectBox('order_date', window.ajax_url.order_list);
                filterBySelectBox('payment_status', window.ajax_url.order_list);

                $('#reset_search').click(function () {
                    $('#keyword').val('');
                    $('#payment_status').val(2);
                    $('#order_date').val('');
                    callAjax(1, window.ajax_url.order_list)
                });
            });

            function filterBySelectBox(id, url_ajax) {
                $('#' + id).change(function () {
                    callAjax(1, window.ajax_url.order_list);
                });
            }

            function changePage(page_index) {
                callAjax(page_index, window.ajax_url.order_list);
            }

            function callAjax(page_index, url_ajax) {
                $('#data-loading').show();
                var keyword = $('#keyword').val();
                var order_date = $('#order_date').val();
                var payment_status = $('#payment_status').val();
                $.ajax({
                    url: url_ajax,
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        keyword: keyword,
                        order_date: order_date,
                        payment_status: payment_status,
                        page_index: page_index,
                        _token: "{{ csrf_token() }}",
                    }
                }).done(function (result) {
                    $('#data-loading').hide();
                    $('#div-ajax').html(result);
                })
                $(document).ajaxError(function () {
                    $('#data-loading').hide();
                });
            }
        </script>
    </div>
@endsection


