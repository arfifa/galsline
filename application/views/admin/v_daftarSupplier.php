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
  timer: 3000
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'Deleted!',
      'Data berhasil dihapus.',
      'success'
    );
    $(location).attr('href','<?php echo base_url()?>Admin/hapusSupplier/'+id);
  }
});
}
 </script>

<!-- Begin Page Content -->
<div class="container-fluid p-4">

  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Daftar Supplier</h2><hr class="mb-4">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Input data supplier</h4>
    </div>
    <div class="card-body">
      <?php if ($this->session->userdata('role_id') == 3): ?>
      <?php 
      $kode = 'SPL'.(rand(10,1000));
      ?>
      <form method="post" action="<?= base_url().'Admin/tambahSupplier' ?>">
          <div class="form-group row">
            <div class="col-sm-6 mb-5 mb-sm-0">
              <label for="kd_supplier">Kode Supplier</label>
              <input type="text" name="kd_supplier" class="form-control" id="kd_supplier" value="<?= $kode ?>" readonly>
              <?php echo form_error('kd_supplier','<small class="text-danger pl-3">','</small>'); ?> 
            </div>
            <div class="col-sm-6">
              <label for="no_telp">Nomor Telepon</label>
              <input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="Nomor telepon" min="0" value="<?= set_value('no_telp')?>">
               <?php echo form_error('no_telp','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            
          </div>
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="nama">Nama Supplier</label>
              <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama supplier"  value="<?= set_value('nama')?>">
               <?php echo form_error('nama','<small class="text-danger pl-3">','</small>'); ?>
            </div>
            <div class="col-sm-6">
                <label for="alamat">Alamat </label>
                <textarea type="textarea" name="alamat" class="form-control" id="alamat"  rows="3" value="<?= set_value('alamat')?>"><?= set_value('alamat');?>
                </textarea>
                <?php echo form_error('alamat','<small class="text-danger pl-3">','</small>'); ?>
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
  <?php endif ?>
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
              <th>Kode Supplier</th>
              <th>Nama Supplier</th>
              <th>No.Telepon</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Kode Supplier</th>
              <th>Nama Supplier</th>
              <th>No.Telepon</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>  
            <?php 
            $no = 1;
            foreach ($supplier as $p): ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $p->kd_supplier; ?></td>
              <td><?= $p->nama; ?></td>
              <td><?= $p->no_telp; ?></td>
              <td align="center" nowrap="nowrap">
                <a class="btn btn-success btn-xs" href="<?php echo base_url().'Admin/detailSupplier/'.$p->kd_supplier; ?>"><span class="fas fa-fw fa-search "></span></a>
                <?php if ($this->session->userdata('role_id') == 3): ?>
                <a class="btn btn-danger btn-xs" onclick="validate(this)" value="<?= $p->kd_supplier; ?>" name="hapus"><span class="fas fa-fw fa-trash"></span></a></td>
                <?php endif ?>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>