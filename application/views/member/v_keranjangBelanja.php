<script>
  function validate(barang) {
    var id = barang.getAttribute('value');
    Swal.fire({
      title: 'Anda yakin ingin menghapus barang pesanan ini?',
      text: "",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
    }).then((result) => {
      if (result.value) {
        $(location).attr('href', '<?php echo base_url() ?>Member/hapusPesanan/' + id);
      }
    });
  }

  function kosongkan(KosongkanKeranjang) {
    var id = KosongkanKeranjang.getAttribute('value');
    Swal.fire({
      title: 'Kosongkan Keranjang',
      text: "Anda yakin ingin mengosongkan keranjang?",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Kosongkan',
    }).then((result) => {
      if (result.value) {
        $(location).attr('href', '<?php echo base_url() ?>Member/KosongkanKeranjang/' + id);
      }
    });
  }
</script>

<?php if ($this->session->userdata('kosongkanKeranjang') == "ok") : ?>
  <script>
    Swal.fire(
      'Berhasil!',
      'Keranjang anda sudah kosong.',
      'success'
    );
  </script>
<?php endif; ?>

<?php if ($this->session->userdata('deletePesanan') == "ok") : ?>
  <script>
    Swal.fire(
      'Barang telah dihapus!',
      'barang telah dikeluarkan dari keranjang.',
      'success'
    );
  </script>
<?php endif; ?>



<?php if ($this->session->userdata('jumlahKosong') == "yes") : ?>
  <script>
    Swal.fire(
      'Jumlah barang tidak boleh kosong!',
      'Hapus barang jika ingin membatalkan pesanan.',
      'warning'
    );
  </script>
<?php endif; ?>

<?php if ($this->session->userdata('inventoryOrder') == "kurang") : ?>
  <script>
    Swal.fire(
      'Jumlah pesanan melebihi stok yang tersedia!',
      'mohon inputkan tambahan jumlah pesanan sesuai stok yang ada dihalaman dashboard pemesanan.',
      'warning'
    );
  </script>
<?php endif; ?>

<?php if ($this->session->userdata('keranjangKosong') == "yes") : ?>
  <script>
    Swal.fire(
      'Keranjang Masih Kosong!',
      'Silahkan pilih barang pesananan didasboard pemesanan.',
      'warning'
    );
  </script>
<?php endif; ?>
<!-- Begin Page Content -->
<div class="container-fluid p-4">
  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Daftar Belanja</h2>
  <hr class="mb-4">
  <div class="row">
    <div class="col-sm-12">
      <div class="card shadow  border-bottom-info mb-2">
        <div class="card-body">
          <div class="card-header">
            <h4><i class="fas fa-fw fa-shopping-cart"></i> Daftar pesanan anda</h4>
          </div>
          <div class="text-primary m-3">
            * Periksa kembali barang pesanan anda. Anda dapat menambahkan / mengurangi jumlah barang pesanan disini.<br>
            * Anda dapat mengubah jumlah pesanan barang anda dikolom jumlah barang dengan menekan tombol yang ada dibawah form jumlah barang.<br>
            * jumlah dari beberapa pesanan mungkin berubah sesuai stok yang tersedia. <br>
          </div>
          <div class="text-right">
            <a onclick="kosongkan(this)" value="<?= $user['id_member'] ?>" class="btn btn-danger text-light mb-3 mr-2"><i class="fas fa-fw fa-trash"></i>Kosongkan keranjang</a>
          </div>
          <?php echo form_error('jumlah', '<h4 class = "text-danger"> ', '</h4>'); ?>
          <div class="table-responsive">
            <table class="table table-no-border">
              <thead class="text-center">
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Gambar</th>
                  <th>Harga Satuan</th>
                  <th>Jumlah Barang</th>
                  <th>Total</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php
                $total_bayar = 0;
                $no = 1;
                foreach ($keranjang as $k) : ?>
                  <tr>
                    <?php if ($k->stok - $k->jumlah >= -$k->stok) : ?>
                      <td><?= $no++ ?></td>
                      <td><?= $k->nama_barang ?></td>
                      <td><img src="<?= base_url('assets/upload/imageBarang/') . $k->image ?>" style="width: 150px; height: 150px"></td>
                      <td>Rp. <?= number_format($k->harga_barang) ?></td>
                      <td align="center">
                        <div class="form-group">
                          <form action="<?= base_url() . 'Member/updateJumlah/' . $k->id_keranjang . '/' . $k->kd_barang ?>" method="post">
                            <?php if ($k->stok >= $k->jumlah) : ?>
                              <input name="jumlah" class="form-control text-center" min="1" ; value="<?= $k->jumlah; ?>" style="width:70px;" readonly>
                            <?php else : ?>
                              <input name="jumlah" class="form-control text-center" min="1" ; value="<?= $k->stok; ?>" style="width:70px;" readonly>
                            <?php endif; ?>
                            <button type="submit" class="badge badge-primary" name="minus"><i class="fa fa-fw fa-minus"></i></button>
                            <button type="submit" class="badge badge-primary" name="plus"><i class="fa fa-fw fa-plus"></i></button>
                          </form>
                        </div>
                      </td>
                      <td>Rp.
                        <?php
                        $jumlah = $k->harga_barang * $k->jumlah;
                        $total_bayar += $k->harga_barang * $k->jumlah;
                        echo number_format($jumlah);
                        ?>
                      </td>
                      <td class="nowrap"><a class="text-danger" onclick="validate(this)" value="<?= $k->kd_barang; ?>" name="hapus"><span class="fa fa-times-circle fa-2x"></span></a></td>
                  </tr>
                <?php else : ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $k->kd_barang ?></td>
                    <td><?= $k->nama_barang ?></td>
                    <td colspan="3" class="text-danger text-center">
                      <h5>Maaf stok barang ini sedang kosong</h5>
                    </td>
                    <td class="nowrap"><a class="text-danger" onclick="validate(this)" value="<?= $k->kd_barang; ?>" name="hapus"><span class="fa fa-times-circle fa-2x"></span></a></td>
                  </tr>
                <?php endif; ?>

              <?php endforeach; ?>
              <tr>
                <th colspan="5" class="text-center">Total Bayar :</th>
                <th colspan="2" class="text-left">Rp. <?= number_format($total_bayar) ?></th>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card shadow  border-bottom-warning mt-4">
        <div class="card-body">
          <div class="card-header py-3">
            <h4 class="m-0"><i class="fa fa-fw fa-list"></i> Data pengiriman</h4>
          </div>
          <div class="text-primary m-3">
            * Periksa kembali seluruh data pengiriman anda. pastikan semua terisi dengan benar.<br>
            * Jika terdapat perubahan data pengiriman, anda dapat mengubahnya pada form dibawah ini.<br>
          </div>
          <table class="table table-no-border">
            <tr>
              <form action="<?= base_url() . 'Member/checkout' ?>" method="post">
                <th width="30%">Nama Pemesan</th>
                <th width="5%"> : </th>
                <th>
                  <div class="form-group">
                    <input type="hidden" name="id_member" value="<?= $user['id_member'] ?>">
                    <input type="text" class="form-control" name="nama" pattern=".{1,}[a-z]" title="isi dengan huruf kecil" value="<?= $user['nama'] ?>" required>
                    <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </th>
            </tr>
            <tr>
              <th width="30%">Alamat Pengiriman</th>
              <th width="5%"> : </th>
              <th>
                <div class="form-group">
                  <textarea name="alamat" class="form-control" rows="3" pattern=".{10,}" title="Alamat Harus Lengkap" required><?= $user['alamat'] ?></textarea>
                  <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </th>
            </tr>
            <tr>
              <th width="30%">No.Telepon</th>
              <th width="5%"> : </th>
              <th>
                <div class="form-group">
                  <input type="tel" class="form-control" name="no_telp" value="<?= $user['no_telp'] ?>" required>
                  <?php echo form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </th>
            </tr>
            <tr>
              <th width="30%">Kode Pos</th>
              <th width="5%"> : </th>
              <th>
                <div class="form-group">
                  <input type="number" class="form-control" name="kode_pos" required>
                  <?php echo form_error('kode_pos', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </th>
            </tr>
          </table>
          <div class="text-right">
            <button type="submit" class="btn btn-success my-3 mr-5 p-3" style="border-radius: 50px 50px 50px 0px "><i class="fas fa-fw fa-check-circle"></i>Checkout</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  </div>
  <!-- end container-fluid -->
</div>
<!-- end content -->
</div>