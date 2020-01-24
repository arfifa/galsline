<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $judul ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet"> 
  <link href="<?= base_url('assets/css/login.css') ?>" rel="stylesheet"> 

</head>

<body class="bg-galsline">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-4">
            <!-- Nested Row within Card Body -->
            <h1 class="text-gray-900 text-center">Halaman Admin</h1><hr>
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block text-center mt-3">
                <img src="<?= base_url().'assets/img/logoBrand.jpg' ?>" class="login-img">
              </div>
              <div class="col-lg-6">
                <div class="p-3">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang! </h1>
                    <?= 
                    $this->session->flashdata('alert');
                    $this->session->flashdata('tryLogin'); 
                    ?>
                    Silahkan masukan Password dan Username Anda! <br><br>
                  <form class="user" method="post" action="<?= base_url().'login/loginActAdmin' ?>">
                    <div class="form-group">
                      <input type="text" name="email" class="form-control form-control-user" id="exampleInputEmail" value="<?= set_value('email'); ?>" title="Masukan Username" placeholder="Username">
                      <?php echo form_error('email','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" title="Masukan Password">
                      <?php echo form_error('password','<small class="text-danger pl-3">','</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url().'assets/vendor/jquery/jquery.min.js' ?>"></script>
  <script src=src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url().'assets/vendor/jquery-easing/jquery.easing.min.js' ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url().'assets/js/sb-admin-2.min.js' ?>"></script>

</body>

</html>
