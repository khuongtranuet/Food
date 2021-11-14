<!-- NAVBAR -->
<!--    --><?php //if (($controller != IGNORE_CONTROLLER && $action != IGNORE_ACTION) ||
//    ( $controller ==  IGNORE_CONTROLLER && $action != IGNORE_ACTION)): ?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand" style="width: 260px;">
        <a href="<?php echo url('admin') ?>"><span style="font-size: 20px;">QUẢN LÍ WEBSITE</span></a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        <!--			<form class="navbar-form navbar-left">-->
        <!--				<div class="input-group">-->
        <!--					<input type="text" value="" class="form-control" placeholder="Nhập để tìm kiếm . . . . .">-->
        <!--					<span class="input-group-btn"><button type="button" class="btn btn-primary">Tìm kiếm</button></span>-->
        <!--				</div>-->
        <!--			</form>-->
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">
                <!--					<li class="dropdown">-->
                <!--						<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">-->
                <!--							<i class="lnr lnr-alarm"></i>-->
                <!--							<span class="badge bg-danger">5</span>-->
                <!--						</a>-->
                <!--						<ul class="dropdown-menu notifications">-->
                <!--							<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>-->
                <!--							<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>-->
                <!--							<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>-->
                <!--							<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>-->
                <!--							<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>-->
                <!--							<li><a href="#" class="more">See all notifications</a></li>-->
                <!--						</ul>-->
                <!--					</li>-->
                <!--					<li class="dropdown">-->
                <!--						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Trợ giúp</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>-->
                <!--						<ul class="dropdown-menu">-->
                <!--							<li><a href="#">Basic Use</a></li>-->
                <!--							<li><a href="#">Working With Data</a></li>-->
                <!--							<li><a href="#">Security</a></li>-->
                <!--							<li><a href="#">Troubleshooting</a></li>-->
                <!--						</ul>-->
                <!--					</li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo url('images/favicon.ico') ?>" class="img-circle" alt="Avatar">
                        <span><?php if (isset($_SESSION['fullname_admin']) && $_SESSION['fullname_admin']) echo $_SESSION['fullname_admin'];
                            else echo 'Tài khoản'; ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="lnr lnr-user"></i> <span>Thông tin</span></a></li>
                        <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Tin nhắn</span></a></li>
                        <li><a href="#"><i class="lnr lnr-cog"></i> <span>Cài đặt</span></a></li>
                        <li><a href="<?php echo url('admin/home/logout') ?>" onclick="return confirm('Bạn chắc chắn muốn đăng xuất?')">
                                <i class="lnr lnr-exit"></i> <span>Thoát</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->
