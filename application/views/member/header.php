<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $judul ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/') ?>css/style.css" rel="stylesheet">

  <!-- Sweet Alert -->
    <script src="<?php echo base_url() . 'assets/js/dist/sweetalert2.all.min.js' ?>"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" >

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url() . 'Member' ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-truck-moving"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Galsline</div>
      </a>

      <!-- Query Menu -->
      <?php 
      $role_id = $this->session->userdata('role_id');
      $queryMenu = "SELECT `user_menu`.`id`, `menu`
                      FROM `user_menu` JOIN `user_access_menu`
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                     WHERE `user_access_menu`.`role_id` = $role_id
                  ORDER BY `user_access_menu`.`menu_id` ASC
                  ";
      $menu = $this->db->query($queryMenu)->result_array();
      ?>
      
      <!-- Looping Menu -->
      <?php foreach ($menu as $m) : ?>

         <!-- Divider -->
      <hr class="sidebar-divider ">
      <div class="sidebar-heading">
          <?= $m['menu']; ?>
      </div>

   

      <!-- Siapkan sub-menu sesuai menu -->
      <?php 
      $menuId = $m['id'];
      $querySubMenu = "SELECT * FROM `user_sub_menu`  
                        WHERE `menu_id` = $menuId
                          AND `is_active` = 1
                  ";
      $subMenu = $this->db->query($querySubMenu)->result_array();
      ?>

      
      <?php foreach ($subMenu as $sb) : ?>
      <?php if ($judul == $sb['title']) : ?>
      <li class="nav-item active">
      <?php else : ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
      <?php endif; ?>
        <a class="nav-link" href="<?php echo base_url() . $sb['url']; ?>">
          <i class="<?= $sb['icon'] ?>"></i>
          <span><?= $sb['title']; ?></span></a>
      </li>
        
      <?php endforeach; ?>

      <?php endforeach; ?>
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-gradient-warning topbar static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item mx-1">
      <a class="nav-link text-dark" href="<?= base_url() . 'Member/keranjangPesanan' ?>"><i class="fas fa-fw fa-shopping-cart"></i>  Daftar Belanja</a>
    </li>
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle text-dark" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">3+</span>
      </a>
      <!-- Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Alerts Center
        </h6>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">December 12, 2019</div>
            <span class="font-weight-bold">A new monthly report is ready to download!</span>
          </div>
        </a>
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-900 small"><?= $this->session->userdata('nama'); ?></span>
        <img class="img-profile rounded-circle" src="<?= base_url() . 'assets/img/gambarUser/' . $user['image']; ?>" >
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?= base_url() . 'Member/myProfileMember' ?>">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>

</nav>
<!-- End of Topbar -->