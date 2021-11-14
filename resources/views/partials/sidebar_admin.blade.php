<<?php $controller =''; ?>
<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li style="margin-top: 8px;">
                    <a href="<?php echo url('admin') ?>"
                       class="<?php echo(($controller == 'home') ? 'active' : '') ?>">
                        <i class="fa fa-home"></i>Trang chủ
                    </a>
                </li>

                <li>
                    <a href="#category" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">
                        <i class="fa fa-th"></i>QL.Danh mục
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="category" class="collapse">
                        <ul class="nav">
                            <li><a href="{{ route('admin.category.index') }}">Danh sách các danh mục</a>
                            </li>
                            <li><a href="{{ route('admin.category.add') }}">Thêm danh mục</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#product" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">
                        <i class="fa fa-dropbox"></i>QL.Sản phẩm
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="product" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/product/index') ?>" class="">Danh sách sản
                                    phẩm</a></li>
                            <li><a href="<?php echo url('admin/product/add') ?>" class="">Thêm sản phẩm</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#order" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">
                        <i class="fa fa-file-text"></i>QL.Đơn hàng
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="order" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/order/index') ?>" class="">Danh sách đơn
                                    hàng</a></li>
                            <li><a href="<?php echo url('admin/order/add') ?>" class="">Thêm đơn hàng</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#ship" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">
                        <i class="fa fa-truck"></i>QL.Ship hàng
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="ship" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/shipment/index') ?>" class="">Danh sách đơn</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#customer" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('customer')) ? 'active' : '') ?>">
                        <i class="fa fa-user"></i>QL.Khách hàng
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="customer" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/customer/index') ?>" class="">Danh sách khách
                                    hàng</a></li>
                            <li><a href="<?php echo url('admin/customer/add') ?>" class="">Thêm mới khách
                                    hàng</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#statistic" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">
                        <i class="fa fa-files-o"></i>Thống kê
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="statistic" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/statistic/product') ?>" class="">Thống kê sản phẩm</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#storage" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active' : '') ?>">
                        <i class="fa fa-university"></i>QL.Kho hàng
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="storage" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/repository/index') ?>" class="">Danh sách kho
                                    hàng</a></li>
                            <li><a href="<?php echo url('admin/repository/add') ?>" class="">Thêm mới kho
                                    hàng</a></li>
                            <li><a href="<?php echo url('admin/repository/store') ?>" class="">Nhập kho</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#discount" data-toggle="collapse"
                       class="collapsed <?php echo(in_array($controller, array('')) ? 'active-menu' : '') ?>">
                        <i class="fa fa-percent"></i>QL.Giảm giá
                        <i class="icon-submenu lnr lnr-chevron-left"></i>
                    </a>
                    <div id="discount" class="collapse">
                        <ul class="nav">
                            <li><a href="<?php echo url('admin/voucher/index') ?>" class="">Danh sách mã giảm
                                    giá</a></li>
                            <li><a href="<?php echo url('admin/voucher/add') ?>" class="">Thêm mã giảm giá</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->
