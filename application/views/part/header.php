<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo $judul ?></title>

    <link href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>" rel="stylesheet">

    <!-- Core Stylesheet -->
    <link href="<?php echo base_url().'assets/style.css' ?>" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="<?php echo base_url().'assets/css/responsive.css' ?>" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="<?php echo base_url().'assets/js/dist/sweetalert2.all.min.js' ?>"></script>

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="colorlib-load"></div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area animated">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Menu Area Start -->
                <div class="col-12 col-lg-10">
                    <div class="menu_area">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <!-- Logo -->
                            <a class="navbar-brand" href="<?php base_url() ?>">Galsline</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <!-- Menu Area -->
                            <div class="collapse navbar-collapse" id="ca-navbar">
                                <ul class="navbar-nav ml-auto" id="nav">
                                    <li class="nav-item active"><a class="nav-link" href="#home">Beranda</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#about us">Tentang Kami</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#gallery">Galeri</a></li>
                                    
                                    <li class="nav-item"><a class="nav-link" href="#registrasi">Registrasi Retail</a></li>
                                </ul>
                                <div class="sing-up-button d-lg-none">
                                    <a href="<?= base_url().'login' ?>">Masuk Member</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Signup btn -->
                <div class="col-12 col-lg-2">
                    <div class="sing-up-button d-none d-lg-block">
                        <a href="<?= base_url().'Login' ?>">Masuk Member</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->