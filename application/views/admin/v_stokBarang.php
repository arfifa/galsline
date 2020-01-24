<?php if($this->session->userdata('berhasil update') == "ok" ) : ?>
  <script>
  Swal.fire(
    'Stok berhasil diupdate!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
<div class="container-fluid p-4">

  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Daftar Stok Barang</h2><hr class="mb-4">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h4 class="m-0 text-gray-800">Update Stok Barang</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah Stok</th>
              <th>Status</th>
              <th>Detail/update</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah Stok</th>
              <th>Status</th>
              <th width="80px">Detail/update</th>
            </tr>
          </tfoot>
          <tbody>  
            <?php
             $no = 1;
             foreach ($stok as $s): 
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $s->kd_barang; ?></td>
              <td><?= $s->nama_barang; ?></td>
              <td><?= $s->stok; ?></td>
              <td><?php if($s->status == 0) : ?>
                Kosong
              <?php else: ?>
                Tersedia
              <?php endif; ?>
              </td>
              <td align="center" nowrap="nowrap"><a class="btn btn-success btn-xs" href="<?php echo base_url().'Admin/detailStok/'.$s->kd_barang; ?>"><span class="fas fa-fw fa-edit "></span></a>
              </td>
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