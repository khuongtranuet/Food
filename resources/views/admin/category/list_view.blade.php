@extends('layouts.be_master_view');

@section('title')
    <title>Danh sách danh mục</title>
@endsection

@section('content')
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    {{ method_field('PUT') }}
    @include('errors.error_message_view')
    <div class="row">
        <div class="col-lg-12">
            <h3>Danh sách các danh mục</h3>
        </div>
        <div class="col-lg-12" style="margin-bottom: 5px">
            <a href="{{ route('admin.category.add') }}" class="btn btn-primary">
                Thêm mới
            </a>
        </div>
        <div class="col-lg-12 text-center mb-1" style="position: absolute; top: 110px; right: 0px">
            <img src="{{ asset('images/data-loading.gif') }}" id="data-loading"
                 style="display: none; width: 65px">
        </div>
        <div class="col-lg-12">
            <div id="div-ajax">
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            callAjax(1, window.ajax_url.category_list);
            var oldTimeout = '';

            $('#keyword').keyup(function () {
                $('#data-loading').show();

                clearTimeout(oldTimeout);
                oldTimeout = setTimeout(function () {
                    callAjax(1, window.ajax_url.category_list);
                }, 250);
            });

            // filterBySelectBox('type', window.ajax_url.category_list);
            //
            // $('#reset_search').click(function () {
            // 	$('#keyword').val('');
            // 	$('#type').val(-1);
            // 	callAjax(1, window.ajax_url.category_list)
            // });
        });

        // function filterBySelectBox(id, url_ajax) {
        // 	$('#' + id).change(function () {
        // 		callAjax(1, window.ajax_url.category_list);
        // 	});
        // }

        function changePage(page_index) {
            callAjax(page_index, window.ajax_url.category_list);
        }

        function callAjax(page_index, url_ajax) {
            $('#data-loading').show();
            var keyword = $('#keyword').val();
            var type = $('#type').val();
            $.ajax({
                url: url_ajax,
                type: 'POST',
                dataType: 'html',
                data: {
                    keyword: keyword,
                    type: type,
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
@endsection


