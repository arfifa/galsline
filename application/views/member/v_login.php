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
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block text-center mt-4">
                <img src="<?= base_url() . 'assets/img/logoBrand.jpg' ?>" class="login-img">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h3 text-gray-900 mb-2">Selamat Datang.</h1>
                    <?= $this->session->flashdata('alert');
                    $this->session->flashdata('tryLogin'); ?>
                       <p>Silahkan masukan email dan password anda!<br>
                    <small class="text-info">jika belum mempunyai akun silahkan lakukan registrasi retail klik <a href="<?= base_url() . 'Galsline' ?>#registrasi" class="badge badge-primary">Disini</a></small></p>
                  <form class="user" method="post" action="<?= base_url() . 'login/loginActMember' ?>">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" value="<?= set_value('email'); ?>" aria-describedby="emailHelp" placeholder="Masukan email anda..">
                      <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                      <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user" style="width: 45%;">Login</button>
                    <a href="<?= base_url() ?>" class="btn btn-danger btn-user" style="width: 45%">Kembali</a>
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
  <script src="<?php echo base_url() . 'assets/vendor/jquery/jquery.min.js' ?>"></script>
  <script src=src="<?php echo base_url() . 'assets/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() . 'assets/vendor/jquery-easing/jquery.easing.min.js' ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() . 'assets/js/sb-admin-2.min.js' ?>"></script>

</body>

</html>
