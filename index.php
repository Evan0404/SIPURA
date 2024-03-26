<?php 
    session_start();
    if (!isset($_SESSION['admin']['tps'])) {
        header("Location: login.php");
        exit();
    }
    if(isset($_GET['logout'])){
      // Hapus semua data sesi
      session_unset();
      // Hancurkan sesi
      session_destroy();
      // Redirect ke halaman login
      header("Location: login.php");
      exit();

    }
    include "function.php";
    
    $tps = $_SESSION['admin']['tps'];
    $kpps = $_SESSION['admin']['kpps'];
    $nama_user = $_SESSION['admin']['nama_user'];
    $vendor ="";
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $AppName?></title>
  <link rel="shortcut icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/433px-KPU_Logo.svg.png" />
  <link rel="stylesheet" href="app/src/assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
      .ck-editor__editable[role="textbox"] {
              /* Editing area */
              min-height: 200px;
      }
 </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <!-- <img src="app/src/assets/images/logos/dark-logo.svg" width="180" alt="" /> -->
            <h3 class="text-primary"><i class="bi bi-pin-angle"></i> <b><?= $AppName?></b></h3>
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?hal=dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Halaman Suara</span>
            </li>
            <?php if($kpps == '01' or $kpps == '04' or $kpps == '05'){?>
              <li class="sidebar-item">
                <a class="sidebar-link" href="index.php?hal=absensi" aria-expanded="false">
                  <span>
                    <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">Absensi</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="index.php?hal=surat-suara" aria-expanded="false">
                  <span>
                    <i class="ti ti-alert-circle"></i>
                  </span>
                  <span class="hide-menu">Surat Suara</span>
                </a>
              </li>
            <?php }?>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?hal=catatan" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Catatan Pintar</span>
              </a>
            </li>
            <?php if($tps == 'PPS' or $kpps == '01' or $kpps == '04' or $kpps == '05'){?>
              <li class="sidebar-item">
                <a class="sidebar-link" href="index.php?hal=warga" aria-expanded="false">
                  <span>
                    <i class="ti ti-file-description"></i>
                  </span>
                  <span class="hide-menu">Warga</span>
                </a>
              </li>
            <?php }?>
            <?php if($tps == 'PPS'){?>
              <li class="sidebar-item">
                <a class="sidebar-link" href="index.php?hal=user" aria-expanded="false">
                  <span>
                    <i class="bi bi-person-plus"></i>
                  </span>
                  <span class="hide-menu">User</span>
                </a>
              </li>
            <?php }?>
          </ul>
            

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            
          </ul>
          <marquee>Selamat Datang di SIPURA (Sistem Informasi Pemungutan Suara) 2024 Desa Tunjungrejo x WedangTeam</marquee>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <h6>
                      <?= $tps?>|<?= $kpps?>
                  </h6>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="index.php?logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4" style="text-transform: UPPERCASE;">
                <?php
                    if(isset($_GET['hal'])){
                        echo str_replace("-", " ", $_GET['hal']);
                    }else{
                        echo "dashboard";
                    }
                ?>
            </h5>
            <div class="row">
                <?php
                    if(isset($_GET['hal'])){
                        include "pages/$_GET[hal].php";
                    }else{
                        include "pages/dashboard.php";
                    }
                ?>
            </div>
          </div>
        </div>
          <!-- <div class="container-fluid"> -->
          <!-- </div> -->
      </div>
    </div>
  </div>
  <script src="app/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="app/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app/src/assets/js/sidebarmenu.js"></script>
  <script src="app/src/assets/js/app.min.js"></script>
  <script src="app/src/assets/libs/simplebar/dist/simplebar.js"></script>
  <?= $vendor;?>
</body>

</html>