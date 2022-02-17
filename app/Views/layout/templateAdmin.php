<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> <?= $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <!-- <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="shortcut icon" href="/assets/dist/img/Logo Dishub.png" type="image/x-icon">
    <!-- Morris chart -->
    <!-- <link href="/assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" /> -->
    <!-- jvectormap -->
    <!-- <link href="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <!-- <link href="/assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" /> -->
    <!-- Theme style -->
    <link href="/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <link href="/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTable -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css"> -->

</head>

<body class="skin-blue">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="/pjlp/admin/" class="logo"><b>PJLP</b>Administrator</a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/assets/img/pjlp/<?= (session("image") == null ? 'no-photo.jpg' : '' . session("image")); ?>" class="user-image" alt="User Image" />
                                <span class="hidden-xs"><?= session('name'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/assets/img/pjlp/<?= (session("image") == null ? 'no-photo.jpg' : '' . session("image")); ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= session('name'); ?>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                    </div>
                                    <div class="pull-right">
                                        <a href="/login/logout/" class="btn btn-default btn-flat" onclick="return confirm('Apakah Anda Yakin ?')">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?= $this->include("layout/sideNavigation"); ?>
        <?php $this->renderSection("content"); ?>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <a href="#">Dinas Perhubungan Provinsi DKI Jakarta</a>
            </div>
            <strong>Copyright &copy; 2014 - 2021 All rights reserved.</strong>
        </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 3.6 -->
    <script src="/assets/bootstrap/js/jquery.min.js" type="text/javascript"></script>
    <!-- DataTable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- bootstrap -->
    <script src="/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="/assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- SweetAlert -->
    <script src="/assets/sweetalert/sweetalert2.all.js"></script>
</body>

</html>