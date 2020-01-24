 <!-- Begin Page Content -->
<div class="container-fluid p-4">
<?php if($this->session->userdata('berhasil edit') == "ok" ) : ?>
  <script>
  Swal.fire(
    'Profile berhasil diubah!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">My Profile</h2><hr class="mb-4">
  <div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-3">
      <img src="<?= base_url('assets/img/gambarUser/').$user['image']?>" class="card-img" alt="image Profile">
      <?= form_open_multipart('Admin/editProfileAdmin'); ?>
      <input type="hidden" name="username" value="<?= $user['username']; ?>">
        <div class="form-group">
          <div class="custom-file">
              <input type="hidden" name="image" value="<?= $user['image'] ?>" >
              <input type="file" class="custom-file-input"  id="image" name="image">
              <label class="custom-file-label" for="image">Choose file</label>
          </div>
        </div>
      <h5 class="card-title text-center mt-4"><?= $user['nama'] ?></h5>
      <p class="card-text text-center mb-4"><small class="text-muted">Admin sejak <?= date('d F Y', $user['date_created']); ?></small></p>
    </div>
    <div class="col-md-9">
      <div class="card-body">
          <div class="row">
      	   <!-- baris pertama -->
          	<div class="col-md-6">
              <div class="form-group">
                  <label for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" id="nama" pattern=".{1,}[a-z]" title="isi dengan huruf kecil" value="<?= $user['nama'] ?>" readonly>
                  <?php echo form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group">
                   <label for="alamat">Alamat </label>
                  <textarea name="alamat" class="form-control" id="alamat"  rows="3"  pattern=".{10,}" title="Alamat Harus Lengkap"><?= $user['alamat'] ?></textarea>
                  <?php echo form_error('alamat','<small class="text-danger pl-3">','</small>'); ?>
              </div>
          	</div>
          	<div class="col-md-6">
            	<div class="form-group">
                    <label for="noKtp">No. KTP</label>
                    <input type="text" name="noKtp" class="form-control" id="noKtp" value="<?= $user['no_ktp'] ?>"
                    readonly>
                    <?php echo form_error('noKtp','<small class="text-danger pl-3">','</small>'); ?>
            	</div>
            	<div class="form-group">
                  <label for="no_telp">No. Telepon</label>
                  <input type="tel" class="form-control" name="no_telp" id="no_telp" value="<?= $user['no_telp'] ?>">
                  <?php echo form_error('no_telp','<small class="text-danger pl-3">','</small>'); ?>
              </div>
          	</div>
        	</div>
        	<button class="btn btn-success btn-user" type="submit" style="width: 100px;">Edit </button>
        	<a href="<?= base_url().'Admin' ?>" class="btn btn-warning " style="width: 100px;">Kembali</a>
        </form>
    </div>
 </div>
</div>
</div>

<!-- end container-fluid -->
</div>
<!-- end content -->
</div>
