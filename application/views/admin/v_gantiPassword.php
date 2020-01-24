<!-- Begin Page Content -->
<div class="container-fluid p-4">
<?php if($this->session->userdata('ganti password') == "ok" ) : ?>
  <script>
  Swal.fire(
    'password berhasil diubah!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Ganti Password</h2><hr class="mb-4">
  <div class="row">
  <div class="col-md-3 col-sm-0"></div>
  <div class="col-md-6 col-sm-12">
  <div class="card mb-1" style="max-width: 100%;">
    <div class="card-body">
    <form method="post" action="<?= base_url().'Admin/gantiPasswordAct' ?>">
      <input type="hidden" name="username" value="<?= $user['username'] ?>">
      <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password">
          <?php echo form_error('password','<small class="text-danger pl-3">','</small>'); ?>
      </div>
      <div class="form-group">
          <label for="password2">Konfirmasi Password</label>
          <input type="password" class="form-control" name="password2" id="password2">
          <?php echo form_error('password2','<small class="text-danger pl-3">','</small>'); ?>
      </div>
        <button class="btn btn-success btn-user" type="submit">Ganti Password</button>
    </form>
    </div>
  </div>
  </div>
  </div>
  <div class="col-md-3 col-sm-0"></div>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>
