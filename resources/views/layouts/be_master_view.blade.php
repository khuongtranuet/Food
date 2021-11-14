<?php $controller = ''; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/vicon.png') }}">

    @yield('title')
{{--    <title>Quản lí website bán hàng</title>--}}

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('dist/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dist/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendor/linearicons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/vendor/chartist/css/chartist-custom.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/main.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

    <!--	 IE10 viewport hack for Surface/desktop Windows 8 bug-->
    <link href="{{ asset('assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- FontAwesome Styles-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom Styles-->
    <link rel="stylesheet" href="{{ asset('dist/assets/css/customize.css') }}">
    <link href="{{ asset('dist/css/customize.css') }}" rel="stylesheet">
    <script src="{{ asset('dist/js/jquery-3.6.0.js') }}"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]>
	<script src="{{ asset('assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->
    <script src="{{ asset('assets/js/ie-emulation-modes-warning.js') }}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.ajax_url = {
            'customer_list': '<?php echo url("admin/customer/ajax_list") ?>',
            'category_list': '<?php echo url("admin/category/ajax_list") ?>',
            'product_list': '<?php echo url("admin/product/ajax_list")?>',
            'voucher_list': '<?php echo url("admin/voucher/ajax_list")?>',
            'repository_list': '<?php echo url("admin/repository/ajax_list") ?>',
            'detail_repository_list': '<?php echo url("admin/repository/ajax_detail_list") ?>',
            'district_list': '<?php echo url("admin/home/ajax_district") ?>',
            'ward_list': '<?php echo url("admin/home/ajax_ward") ?>',
            'store_list': '<?php echo url("admin/repository/ajax_store_list") ?>',
            'product_store': '<?php echo url("admin/repository/ajax_product_store") ?>',
            'product_id': '<?php echo url("admin/order/get_price") ?>',
            'customer_id' : '<?php echo url("admin/order/get_address") ?>',
            'get_voucher' : '<?php echo url("admin/order/get_voucher") ?>',
            'order_list' : '<?php echo url("admin/order/ajax_list")  ?>',
            'ship_list' : '<?php echo url("admin/shipment/ajax_list")  ?>',
            'product_statistic_list': '<?php echo url("admin/statistic/ajax_product_statistic") ?>',
        }
    </script>
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
    @include('partials.header_admin')
    @include('partials.sidebar_admin')
{{--    <!-- NAVBAR -->--}}
{{--<!--    --><?php //if (($controller != IGNORE_CONTROLLER && $action != IGNORE_ACTION) ||--}}
{{--//    ( $controller ==  IGNORE_CONTROLLER && $action != IGNORE_ACTION)): ?>--}}
{{--    <nav class="navbar navbar-default navbar-fixed-top">--}}
{{--        <div class="brand" style="width: 260px;">--}}
{{--            <a href="<?php echo url('admin') ?>"><span style="font-size: 20px;">QUẢN LÍ WEBSITE</span></a>--}}
{{--        </div>--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="navbar-btn">--}}
{{--                <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>--}}
{{--            </div>--}}
{{--            <!--			<form class="navbar-form navbar-left">-->--}}
{{--            <!--				<div class="input-group">-->--}}
{{--            <!--					<input type="text" value="" class="form-control" placeholder="Nhập để tìm kiếm . . . . .">-->--}}
{{--            <!--					<span class="input-group-btn"><button type="button" class="btn btn-primary">Tìm kiếm</button></span>-->--}}
{{--            <!--				</div>-->--}}
{{--            <!--			</form>-->--}}
{{--            <div id="navbar-menu">--}}
{{--                <ul class="nav navbar-nav navbar-right">--}}
{{--                    <!--					<li class="dropdown">-->--}}
{{--                    <!--						<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">-->--}}
{{--                    <!--							<i class="lnr lnr-alarm"></i>-->--}}
{{--                    <!--							<span class="badge bg-danger">5</span>-->--}}
{{--                    <!--						</a>-->--}}
{{--                    <!--						<ul class="dropdown-menu notifications">-->--}}
{{--                    <!--							<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>-->--}}
{{--                    <!--							<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>-->--}}
{{--                    <!--							<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>-->--}}
{{--                    <!--							<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>-->--}}
{{--                    <!--							<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>-->--}}
{{--                    <!--							<li><a href="#" class="more">See all notifications</a></li>-->--}}
{{--                    <!--						</ul>-->--}}
{{--                    <!--					</li>-->--}}
{{--                    <!--					<li class="dropdown">-->--}}
{{--                    <!--						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Trợ giúp</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>-->--}}
{{--                    <!--						<ul class="dropdown-menu">-->--}}
{{--                    <!--							<li><a href="#">Basic Use</a></li>-->--}}
{{--                    <!--							<li><a href="#">Working With Data</a></li>-->--}}
{{--                    <!--							<li><a href="#">Security</a></li>-->--}}
{{--                    <!--							<li><a href="#">Troubleshooting</a></li>-->--}}
{{--                    <!--						</ul>-->--}}
{{--                    <!--					</li>-->--}}
{{--                    <li class="dropdown">--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo url('images/favicon.ico') ?>" class="img-circle" alt="Avatar">--}}
{{--                            <span><?php if (isset($_SESSION['fullname_admin']) && $_SESSION['fullname_admin']) echo $_SESSION['fullname_admin'];--}}
{{--                                        else echo 'Tài khoản'; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a href="#"><i class="lnr lnr-user"></i> <span>Thông tin</span></a></li>--}}
{{--                            <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Tin nhắn</span></a></li>--}}
{{--                            <li><a href="#"><i class="lnr lnr-cog"></i> <span>Cài đặt</span></a></li>--}}
{{--                            <li><a href="<?php echo url('admin/home/logout') ?>" onclick="return confirm('Bạn chắc chắn muốn đăng xuất?')">--}}
{{--                                    <i class="lnr lnr-exit"></i> <span>Thoát</span></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--    <!-- END NAVBAR -->--}}
{{--    <!-- LEFT SIDEBAR -->--}}
{{--    <div id="sidebar-nav" class="sidebar">--}}
{{--        <div class="sidebar-scroll">--}}
{{--            <nav>--}}
{{--                <ul class="nav">--}}
{{--                    <li style="margin-top: 8px;">--}}
{{--                        <a href="<?php echo url('admin') ?>"--}}
{{--                           class="<?php echo(($controller == 'home') ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-home"></i>Trang chủ--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#category" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-th"></i>QL.Danh mục--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="category" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href=<?php echo url('admin/category/index') ?>>Danh sách các danh mục</a>--}}
{{--                                </li>--}}
{{--                                <li><a href=<?php echo url('admin/category/add') ?>>Thêm danh mục</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#product" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-dropbox"></i>QL.Sản phẩm--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="product" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/product/index') ?>" class="">Danh sách sản--}}
{{--                                        phẩm</a></li>--}}
{{--                                <li><a href="<?php echo url('admin/product/add') ?>" class="">Thêm sản phẩm</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#order" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-file-text"></i>QL.Đơn hàng--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="order" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/order/index') ?>" class="">Danh sách đơn--}}
{{--                                        hàng</a></li>--}}
{{--                                <li><a href="<?php echo url('admin/order/add') ?>" class="">Thêm đơn hàng</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#ship" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-truck"></i>QL.Ship hàng--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="ship" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/shipment/index') ?>" class="">Danh sách đơn</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#customer" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('customer')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-user"></i>QL.Khách hàng--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="customer" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/customer/index') ?>" class="">Danh sách khách--}}
{{--                                        hàng</a></li>--}}
{{--                                <li><a href="<?php echo url('admin/customer/add') ?>" class="">Thêm mới khách--}}
{{--                                        hàng</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#statistic" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-files-o"></i>Thống kê--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="statistic" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/statistic/product') ?>" class="">Thống kê sản phẩm</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#storage" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">--}}
{{--                            <i class="fa fa-university"></i>QL.Kho hàng--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="storage" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/repository/index') ?>" class="">Danh sách kho--}}
{{--                                        hàng</a></li>--}}
{{--                                <li><a href="<?php echo url('admin/repository/add') ?>" class="">Thêm mới kho--}}
{{--                                        hàng</a></li>--}}
{{--                                <li><a href="<?php echo url('admin/repository/store') ?>" class="">Nhập kho</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}

{{--                    <li>--}}
{{--                        <a href="#discount" data-toggle="collapse"--}}
{{--                           class="collapsed <?php echo(in_array($controller, array('')) ? 'active-menu' : '') ?>">--}}
{{--                            <i class="fa fa-percent"></i>QL.Giảm giá--}}
{{--                            <i class="icon-submenu lnr lnr-chevron-left"></i>--}}
{{--                        </a>--}}
{{--                        <div id="discount" class="collapse">--}}
{{--                            <ul class="nav">--}}
{{--                                <li><a href="<?php echo url('admin/voucher/index') ?>" class="">Danh sách mã giảm--}}
{{--                                        giá</a></li>--}}
{{--                                <li><a href="<?php echo url('admin/voucher/add') ?>" class="">Thêm mã giảm giá</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- END LEFT SIDEBAR -->--}}
    <!-- MAIN -->
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
<!--            --><?php //endif; ?>
            <div class="container-fluid" style="color: black; background-color: white">
                @yield('content')
{{--                <?php (isset($load_page) && $load_page) ? $this->load->view($load_page) : ''; ?>--}}
            </div>
<!--            --><?php //if (($controller != IGNORE_CONTROLLER && $action != IGNORE_ACTION) ||
//            ( $controller ==  IGNORE_CONTROLLER && $action != IGNORE_ACTION)): ?>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
<?php //endif; ?>
<!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <p class="copyright">&copy; 2017 <a href="https://www.themeineed.com" target="_blank">Theme I Need</a>. All
                Rights Reserved.</p>
        </div>
    </footer>
</div>
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="{{ asset('dist/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dist/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('dist/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
{{--<!--<script src="--><?php //echo base_url('dist/assets/vendor/chartist/js/chartist.min.js') }}<!--"></script>-->--}}
<script src="{{ asset('dist/assets/scripts/klorofil-common.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
</body>
</html>
