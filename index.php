<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo-icon.png" />
  <?php
  @$page = $_GET['halaman'];
  session_start();
  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
  }
  ?>
  <title>Kasir App | <?= $page ?></title>
  <!-- Custom CSS -->
  <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet" />
  <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet" />
  <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="dist/css/style.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="dist/css/sweet-alert.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
      <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-brand" style="display: flex; align-items: center;">
            <!-- Logo icon -->
            <a href="?halaman=welcome" style="display: flex; align-items: center;">
              <b class="logo-icon">
                <img src="assets/images/logo.png" alt="homepage" class="dark-logo" style="width: 70%" />
              </b>
              <!--End Logo icon -->
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
            <!-- ============================================================== -->
            <!-- create new -->
            <!-- ============================================================== -->
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-right">
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="assets/images/Admin/admin.jpg" alt="user" class="rounded-circle" width="40" />
                <span class="ml-2 d-none d-lg-inline-block"><span>Halo,</span>
                  <span class="text-dark"><?php echo $_SESSION["user"]["username"]; ?></span></span>
              </a>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item">
              <a class="sidebar-link sidebar-link" href="?halaman=welcome" aria-expanded="false">
                <i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="list-divider"></li>
            <li class="nav-small-cap">
              <span class="hide-menu">Produk</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link sidebar-link" href="?halaman=dataproduk" aria-expanded="false">
                <i data-feather="folder" class="feather-icon"></i><span class="hide-menu">Data Produk</span>
              </a>
            </li>

            <?php if ($_SESSION["user"]["level"] == "admin") : ?>
              <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="?halaman=barangmasuk" aria-expanded="false">
                  <i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Barang Masuk</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="?halaman=supplier" aria-expanded="false">
                  <i data-feather="bell" class="feather-icon"></i><span class="hide-menu">Supplier</span>
                </a>
              </li>
              <li class="list-divider"></li>
              <li class="nav-small-cap">
                <span class="hide-menu">Transaksi</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="?halaman=kasir" aria-expanded="false">
                  <i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Kasir</span>
                </a>
              </li>
              <li class="list-divider"></li>
              <li class="nav-small-cap">
                <span class="hide-menu">Admin</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="?halaman=laporan" aria-expanded="false">
                  <i data-feather="briefcase" class="feather-icon"></i><span class="hide-menu">Laporan</span>
                </a>
              </li>
              <li class="list-divider"></li>
              <li class="nav-small-cap">
                <span class="hide-menu">Pengguna</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="?halaman=pengguna" aria-expanded="false">
                  <i data-feather="user" class="feather-icon"></i><span class="hide-menu">Pengguna</span>
                </a>
              </li>
            <?php elseif ($_SESSION["user"]["level"] == "kasir") : ?>
              <li class="list-divider"></li>
              <li class="nav-small-cap">
                <span class="hide-menu">Transaksi</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link sidebar-link" href="?halaman=kasir" aria-expanded="false">
                  <i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Kasir</span>
                </a>
              </li>
            <?php endif; ?>

            <li class="list-divider"></li>
            <li class="sidebar-item pb-4">
              <a class="sidebar-link sidebar-link" href="?action=logout" aria-expanded="false">
                <i data-feather="arrow-left-circle" class="feather-icon text-danger"></i>
                <span class="hide-menu text-danger font-weight-medium">Keluar</span>
              </a>
            </li>
          </ul>
        </nav>

        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb">
        <div class="row">
          <!-- <div class="col-7 align-self-center">
              <h3
                class="page-title text-truncate text-dark font-weight-medium mb-1"
              >
                Selamat Datang Jason!
              </h3>
              <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item">
                      <a href="?halaman=welcome">Dashboard</a>
                    </li>
                  </ol>
                </nav>
              </div>
            </div> -->
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <?php

      // if ($page == "welcome" || $page == null) {
      //   include "dashboard.php";
      // } elseif ($page == "dataproduk") {
      //   include "view/dataproduk.php";
      // } elseif ($page == "supplier") {
      //   include "view/supplier.php";
      // } elseif ($page == "laporan") {
      //   include "view/laporan.php";
      // } elseif ($page == "pengguna") {
      //   include "view/pengguna.php";
      // } elseif ($page == "kasir") {
      //   include "view/kasirTransaksi.php";
      // } elseif ($page == "pembayaran") {
      //   include "view/pembayaran.php";
      // } elseif ($page == "barangmasuk") {
      //   include "view/barangmasuk.php";
      // } elseif ($page == "kasirPembayaran") {
      //   include "view/kasirPembayaran.php";
      // } elseif ($page == "struk") {
      //   include "view/strukTransaksi.php";
      // } elseif ($page == "cari") {
      //   include "view/cari_kode_barang.php";
      // }

      $userLevel = $_SESSION["user"]["level"];

      if ($userLevel == "admin") {
        // Admin memiliki akses ke semua halaman
        if ($page == "welcome" || $page == null) {
          include "dashboard.php";
        } elseif ($page == "dataproduk") {
          include "view/dataproduk.php";
        } elseif ($page == "supplier") {
          include "view/supplier.php";
        } elseif ($page == "laporan") {
          include "view/laporan.php";
        } elseif ($page == "pengguna") {
          include "view/pengguna.php";
        } elseif ($page == "kasir") {
          include "view/kasirTransaksi.php";
        } elseif ($page == "pembayaran") {
          include "view/pembayaran.php";
        } elseif ($page == "barangmasuk") {
          include "view/barangmasuk.php";
        } elseif ($page == "kasirPembayaran") {
          include "view/kasirPembayaran.php";
        } elseif ($page == "struk") {
          include "view/strukTransaksi.php";
        } elseif ($page == "cari") {
          include "view/cari_kode_barang.php";
        }
      } elseif ($userLevel == "kasir") {
        // Operator memiliki akses terbatas
        if ($page == "welcome" || $page == null) {
          include "dashboard.php";
        } elseif ($page == "dataproduk") {
          include "view/dataproduk.php";
        } elseif ($page == "kasir") {
          include "view/kasirTransaksi.php";
        } elseif ($page == "pembayaran") {
          include "view/pembayaran.php";
        } elseif ($page == "kasirPembayaran") {
          include "view/kasirPembayaran.php";
        } elseif ($page == "struk") {
          include "view/strukTransaksi.php";
        } elseif ($page == "keluar") {
          include "login.php";
        } else {
          // Tampilkan alert untuk akses tidak sah
          echo '<script>alert("Akses tidak sah!");</script>';
          // Redirect ke halaman welcome
          header("Location: index.php?halaman=welcome");
          exit();
        }
      }
      if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        echo '<script>
                    window.location.href="?halaman=keluar";
                  </script>';
        exit();
      }
      ?>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center text-muted">
        All Rights Reserved by Giraldo Nainggolan.
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- apps -->
  <!-- apps -->
  <script src="dist/js/app-style-switcher.js"></script>
  <script src="dist/js/feather.min.js"></script>
  <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="dist/js/custom.min.js"></script>
  <!--This page JavaScript -->
  <script src="assets/extra-libs/c3/d3.min.js"></script>
  <script src="assets/extra-libs/c3/c3.min.js"></script>
  <script src="assets/libs/chartist/dist/chartist.min.js"></script>
  <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
  <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
  <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
  <script src="js/sweetalert.min.js"></script>

</body>

</html>