@extends('layouts.be_master_view');

@section('title')
    <title>Quản lí website bán hàng</title>
@endsection

@section('content')
    <?php (isset($load_page) && $load_page) ? $this->load->view($load_page) : ''; ?>
@endsection
