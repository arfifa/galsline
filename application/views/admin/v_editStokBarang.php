<div class="container-fluid p-4">

  <!-- card untuk detail barang -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Detail Stok barang</h4>
    </div>
    <div class="card-body">
      <?php foreach ($stok as $s ):?>
      <?php endforeach; ?>
      <form action="<?= base_url().'Admin/updateStok' ?>" method="post">
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="kd_barang">Kode Barang</label>
            <input type="text" name="kd_barang" class="form-control" id="kd_barang" value="<?= $s->kd_barang ?>" readonly> 
          </div>
          <div class="col-sm-6">
            <label for="kd_supplier">Kode Supplier</label>
            <input type="text" name="kd_supplier" class="form-control" id="kd_supplier" value="<?= $s->kd_supplier ?>" readonly> 
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="<?= $s->nama_barang ?>" readonly>
          </div>
          <div class="col-sm-6">
            <label for="satuan">Satuan</label>
            <input  class="form-control" value="<?= $s->satuan ?>" readonly> 
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="harga_beli">Harga Beli</label>
            <input type="text" name="harga_beli" class="form-control" id="harga_beli" value="<?='Rp.'.number_format($s->harga_beli) ?>" readonly> 
          </div>
          <div class="col-sm-6">
            <label for="harga_jual">Harga Jual</label>
            <input type="text" name="harga_jual" class="form-control" id="harga_jual" value="<?='Rp.'. number_format($s->harga_jual) ?>" readonly> 
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="image">Gambar Barang</label>
            <div class = "col-sm-6 mb-1">
              <img src="<?= base_url('assets/upload/imageBarang/'). $s->image; ?>" class="img-thumbnail">
            </div>
          </div>
          <div class="col-sm-6">
            <label for="stok">Update Stok barang</label>
            <input type="number" name="stok" class="form-control mb-3" id="stok" min="0" value="<?= $s->stok ?>">
            <label for="status">Status Barang</label>
            <?php if($s->status == 1){
              $status = 'Tersedia';
            }else{
              $status = 'Kosong';
            }

            ?>
            <input class="form-control" value="<?= $status ?>" readonly> 
            <select name="status" id="status" class="form-control">
              <option value="<?= $s->status ?>">--pilih status--</option>
              <option value="1">Tersedia</option>
              <option value="0">Tidak Tersedia</option>
            </select>
          </div>
        </div>
        <a href="<?= base_url().'Admin/stokBarang' ?>" class="btn btn-warning" style="width: 150px;">Kembali</a>
        <button class="btn btn-primary" style="width: 150px;" type="submit">Edit</button>
        <hr>
      </form>
    </div>
  </div>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>