<div class="container-fluid p-4">

  <!-- card untuk detail barang -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Detail data barang</h4>
    </div>
    <div class="card-body">
      <?php foreach ($detail as $d ):?>
      <?php endforeach; ?>
      <?= form_open_multipart('Admin/editBarang'); ?>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="kd_barang">Kode Barang</label>
            <input type="text" name="kd_barang" class="form-control" id="kd_barang" value="<?= $d->kd_barang ?>" readonly> 
          </div>
          <div class="col-sm-6">
            <label for="kd_supplier">Kode Supplier</label>
            <input type="text" name="kd_supplier" class="form-control" id="kd_supplier" value="<?= $d->kd_supplier ?>" readonly> 
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="nama">Nama Supplier</label>
            <input type="text" class="form-control" id="nama" value="<?= $d->nama ?>" disabled> 
            <select name="nama" id="nama" class="form-control"  required>
              <option value="<?= $d->nama ?>">--pilih Supplier--</option>
              <?php foreach ($supplier as $p): ?>
                <option value="<?= $p->nama; ?>"><?= $p->nama; ?></option>
              <?php endforeach ?>
            </select>
          </div>
           <div class="col-sm-6">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="<?= $d->nama_barang ?>">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="image">Gambar Barang</label>
            <div class = "col-sm-5 mb-1">
              <img src="<?= base_url('assets/upload/imageBarang/'). $d->image; ?>" class="img-thumbnail">
            </div>
            <div class="custom-file">
                <input type="hidden" name="image" value="<?= $d->image ?>" >
                <input type="file" class="custom-file-input"  id="image" name="image">
                <label class="custom-file-label" for="image">Choose file</label>
            </div>
          </div>
          <div class="col-sm-6">
            <label for="satuan">Satuan</label>
            <input  class="form-control" value="<?= $d->satuan ?>" disabled> 
            <select name="satuan" id="satuan" class="form-control">
              <option value="<?= $d->satuan ?>">--pilih satuan--</option>
              <option value="Kardus">Kardus</option>
              <option value="Karung">Karung</option>
              <option value="Pcs">Pcs</option>
              <option value="Galon">Galon</option>
              <option value="Tabung">Tabung</option>
            </select>
            <label for="harga_beli">Harga Beli</label>
            <input type="number" name="harga_beli" class="form-control" id="harga_beli" value="<?= $d->harga_beli; ?>"> 
            <label for="harga_jual">Harga Jual</label>
            <input type="number" name="harga_jual" class="form-control" id="harga_jual" value="<?= $d->harga_jual; ?>" > 
          </div>
        </div>
        <a href="<?= base_url().'Admin/daftarBarang' ?>" class="btn btn-warning" style="width: 150px;">Kembali</a>
        <button class="btn btn-primary" style="width: 150px;" type="submit">Edit</button>
        <hr>
      </form>
    </div>
  </div>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>