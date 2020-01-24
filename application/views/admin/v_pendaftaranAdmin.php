<div class="container-fluid p-4">
   <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Pendaftaran Admin</h2><hr class="mb-4">
  <div class="card o-hidden border-0 shadow-lg">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Form input daftar admin baru</h4>
    </div>
    <div class="card-body p-3">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block p-3 text-justify text-danger">
          <h5 class="ml-3">Panduan Registrasi Admin!</h5><hr>
          <ol>
            <li>Registrasi Admin baru harus dengan sepengetahuan manajer atau supervisor</li>
            <li>Jika Ada yang melakukan registrasi tanpa sepengetahuan yang bersangkutan maka akan diberikan sanksi menurut aturan yang berlaku!</li>
          </ol>
        
        </div>
        <div class="col-lg-7">
          <div class="p-3">
            <div class="text-center">
              <h1 class="h3 text-gray-900">Registrasi Admin</h1>
              <hr>
              <?= $this->session->flashdata('alert'); ?>
            </div>
             <h5 class="h5 text-gray-900 mb-4">Isi data dengan benar!</h5>
            <form method="post" action="<?= base_url().'Pendaftaran/daftarAdminAct' ?>">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" name="nama"class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nama')?>"> 
                  <?php echo form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="no_ktp" class="form-control" placeholder="Nomor KTP" value="<?= set_value('no_ktp')?>"> 
                  <?php echo form_error('no_ktp','<small class="text-danger pl-3">','</small>'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea type="textarea" name="alamat" class="form-control" id="alamat" ><?=set_value('alamat')?>
                </textarea>
                 <?php echo form_error('alamat','<small class="text-danger pl-3">','</small>'); ?>
              </div>
               <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" name="no_telp" class="form-control" placeholder="Nomor Telepon" value="<?= set_value('no_telp')?>">
                   <?php echo form_error('no_telp','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <select name="role_id" id="role_id" class="form-control">
                    <option value="<?= set_value('role_id'); ?>">--Pilih Role--</option>
                    <?php foreach ($role as $r): ?>
                    <option value="<?= $r->id ?>"><?= $r->role ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="form-group ">
                <input type="text" name="username" class="form-control " placeholder="Username" value="<?= set_value('username')?>">
               <?php echo form_error('username','<small class="text-danger pl-3">','</small>'); ?>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                   <?php echo form_error('password','<small class="text-danger pl-3">','</small>'); ?>
                </div>
                <div class="col-sm-6">
                  <input type="password" name="password1" class="form-control " placeholder="Konfirmasi Password">
                </div>
              </div>
              <button class="btn btn-success" style="width: 150px;" type="submit">Registrasi</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>