<script>
function validate(a)
{
  var id = a.getAttribute('value');
  Swal.fire({
  title: 'Anda yakin ingin hapus data ini?',
  text: "",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Hapus',
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Deleted!',
      'Data berhasil dihapus.',
      'success',
    );
   $(location).attr('href','<?php echo base_url()?>Admin/hapusBarang/'+id);
  }
});
}
 </script>

<!-- Begin Page Content -->
<div class="container-fluid p-4">

  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Daftar Barang</h2><hr class="mb-4">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Input data barang</h4>
    </div>
    <div class="card-body">
      <?php 
      $kode = 'BRG'.(rand(10,100));
      ?>
      <?= form_open_multipart('Admin/tambahBarang'); ?>
          <div class="form-group row">
            <div class="col-sm-6 mb-5 mb-sm-0">
              <label for="kd_barang">Kode Barang</label>
              <input type="text" name="kd_barang" class="form-control" id="kd_barang" value="<?= $kode ?>" readonly>
                <?php echo form_error('kd_barang','<small class="text-danger pl-3">','</small>'); ?> 
            </div>
            <div class="col-sm-6">
              <label for="nama_supplier">Nama Supplier</label>
              <select name="nama_supplier" id="nama_supplier" class="form-control" required>
                <?php foreach ($supplier as $p): ?>
                  <option value="<?= $p->nama; ?>"><?= $p->nama; ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-5 mb-sm-0">
              <label for="nama_barang">Nama Barang</label>
              <input type="text" name="nama_barang"class="form-control" id="nama_barang" placeholder="Masukan nama barang" value="<?= set_value('nama_barang')?>"> 
              <?php echo form_error('nama_barang','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="col-sm-6">
              <label for="satuan">Satuan</label>
              <select name="satuan" id="satuan" class="form-control">
                <option value="Kardus">Kardus</option>
                <option value="Karung">Karung</option>
                <option value="Pcs">Pcs</option>
                <option value="Galon">Galon</option>
                <option value="Tabung">Tabung</option>
              </select>
                <?php echo form_error('satuan','<small class="text-danger pl-3">','</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="harga_beli">Harga Beli</label>
              <input type="number" name="harga_beli" class="form-control" placeholder="Harga beli" min="0" id="harga_beli" value="<?= set_value('harga_beli')?>">
               <?php echo form_error('harga_beli','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="col-sm-6">
              <label for="harga_jual">Harga Jual</label>
              <input type="number" name="harga_jual" id="harga_jual" class="form-control" placeholder="Harga jual" min="0" value="<?= set_value('harga_jual')?>">
               <?php echo form_error('harga_jual','<small class="text-danger pl-3">','</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="image">Gambar Barang</label>
              <div class="custom-file">
                  <input type="file" class="custom-file-input"  id="image" name="image">
                  <label class="custom-file-label" for="image">Choose file</label>
              </div>
              <?= $this->session->flashdata('no picture'); ?>
            </div>
          </div>
          <button class="btn btn-primary" style="width: 150px;" type="submit">Tambah</button>
          <hr>
      </form>
      <?php if($this->session->userdata('alert') == "ok" ) : ?>
        <script>
        Swal.fire(
          'Data berhasil ditambahkan!',
          '',
          'success'
        );
        </script>
      <?php endif; ?>
      <?php if($this->session->userdata('berhasil edit') == "ok" ) : ?>
        <script>
        Swal.fire(
          'Data berhasil diubah!',
          '',
          'success'
        );
        </script>
      <?php endif; ?>
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Kode Supplier</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Kode Supplier</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Harga Beli</th>
              <th>Harga Jual</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>  
            <?php
             $no = 1;
             foreach ($barang as $b): 
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $b->kd_barang; ?></td>
              <td><?= $b->kd_supplier; ?></td>
              <td><?= $b->nama_barang; ?></td>
              <td><?= $b->satuan; ?></td>
              <td><?= 'Rp.'.number_format($b->harga_beli); ?></td>
              <td><?= 'Rp.'.number_format($b->harga_jual); ?></td>
              <td align="center" nowrap="nowrap">
                <a class="btn btn-success btn-xs" href="<?php echo base_url().'Admin/detailBarang/'.$b->kd_barang; ?>"><span class="fas fa-fw fa-search "></span></a>
                <a class="btn btn-danger btn-xs" onclick="validate(this)" value="<?= $b->kd_barang; ?>" name="hapus"><span class="fas fa-fw fa-trash"></span></a></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>
