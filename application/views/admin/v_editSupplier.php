<div class="container-fluid p-4">

  <!-- card untuk detail barang -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Detail data supplier</h4>
    </div>
    <div class="card-body">
      <?php foreach ($detail as $d ):?>
      <?php endforeach; ?>
      <form method="post" action="<?= base_url().'Admin/editSupplier' ?>">
          <div class="form-group row">
            <div class="col-sm-6 mb-5 mb-sm-0">
              <label for="kd_supplier">Kode Supplier</label>
              <input type="text" name="kd_supplier" class="form-control" id="kd_supplier" value="<?= $d->kd_supplier ?>" readonly> 
            </div>
            <div class="col-sm-6">
              <label for="no_telp">Momor Telepon</label>
              <input type="text" name="no_telp" class="form-control" id="no_telp" value="<?= $d->no_telp ?>"> 
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-5 mb-sm-0">
              <label for="nama">Nama Supplier</label>
              <input type="text" name="nama" class="form-control" id="nama" value="<?= $d->nama ?>" > 
            </div>
            <div class="col-sm-6">
              <label for="alamat">Alamat </label>
              <textarea name="alamat" class="form-control" id="alamat"  rows="3" value="<?= $d->alamat ?>"><?= $d->alamat ?></textarea>
              <?php echo form_error('alamat','<small class="text-danger pl-3">','</small>'); ?>
            </div>
          </div>
          <a href="<?= base_url().'Admin/supplier' ?>" class="btn btn-warning" style="width: 150px;">Kembali</a>
          <button class="btn btn-primary" style="width: 150px;" type="submit">Edit</button>
          <hr>
      </form>
    </div>
  </div>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>
