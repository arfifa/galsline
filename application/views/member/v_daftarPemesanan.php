<div class="container-fluid p-4">
  <!-- Page Heading -->
  <h2 class="font-weight-bold text-primary">Daftar Pemesanan</h2><hr class="mb-4">
  <div class="row">
  <div class="col-12">
    <div class="bank-bca">
      <img src="<?= base_url('assets/') . 'img/src/BCA.jpg' ?>" alt=""> Rekening BCA : 17238492<br>
      Masukan nomor pesananan didalam berita tranfer agar kami dapat mengetahui pesanan anda.
    </div>
     <p class="text-light p-4" style="background-color: rgba(28, 200, 138, 0.9) !important; border-radius: 50px 50px 0px 50px;">
      * Pengantaran barang pesanan dilakukan setelah anda mentranfer biaya pembelian.<br>
      * Batas Transfer paling lambat 2 hari dari saat pemesanan dilakukan.<br>
      * Pastikan anda mengisi berita tranfer dengan Nomor pemesanan anda.<br>
      * Jika Tranfer belum dilakukan sesuai batas yang telah ditentukan maka pesanan barang dianggap batal.<br>
      * Kami hanya mempunyai satu rekening tranfer melalui bank BCA.<br>
      * Hubungi kami jika terjadi masalah saat pengiriman melalu contact yang ada di menu panduan Pemesanan.
      </p>
    <div class="card shadow mb-1  border-bottom-info" style="max-width: 100%;">
      <div class="card-body">
        <div class="card-header">
          <h4><i class="fas fa-fw fa-truck"></i> Daftar pemesanan anda</h4>
        </div>
        <div>
        <hr>
        <?php 
        foreach ($pemesanan as $p) :
          $batas_tranfer = strtotime($p->tgl_pemesanan) + 60 * 60 * 48; ?>
          <table width="100%" class="mb-5">
              <tr>
                <th width="35%">No.Pemesanan</th><td>:</td><td><?= $p->no_pemesanan ?></td>
              </tr>
              <tr>
                 <th>Tgl.Pemesanan</th><td>:</td><td><?= $p->tgl_pemesanan ?></td>
              </tr>
              <tr>
                <th>Batas Tranfer</th><td>:</td><td><?= date('Y-m-d', $batas_tranfer) . ' Jam ' . date('H:s', $batas_tranfer) ?></td>
              </tr>
              <tr>
                <th>Nama Pemesan</th><td>:</td><td><?= $p->nama_pemesan ?></td>
              </tr>
              <tr>
                <th>Status</th><td>:</td><td><?php
                                            if ($p->status_pembayaran == 0) {
                                              echo "Menunggu pembayaran";
                                            } else if ($p->status_pembayaran == 1) {
                                              echo "Telah dikonfirmasi";
                                            } else if ($p->status_pembayaran == 2) {
                                              echo "Sedang dikirim";
                                            } else {
                                              echo "Pesanan selesai di proses";
                                            }
                                            ?></td>
              </tr>
              <tr>
                 <th></th><td></td><td><a href="" class="btn btn-success detailPemesanan" data-toggle="modal" data-target="#newSubMenuModal" data-id="<?= $p->no_pemesanan ?>"><i class="fa fa-fw fa-search"></i> Detail Pemesanan</a>
                  <?php if ($p->status_pembayaran != 0) : ?>
                  <a href="" class="btn btn-primary"><i class="fa fa-fw fa-print"></i>Cetak Bukti</a> 
                  <?php endif ?>
                </td>
              </tr>
          </table><hr>
         <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  </div>
<!-- end content -->
</div>
<!-- end container-fluid -->
</div>
<!-- Modal -->
<div class="modal ml-5 fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="titleDetailPemesanan"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="modal-body">
                <div class="card p-3">
                  <h4 class="font-weight-bold text-primary">Data Pengiriman</h4><hr>
                  <table width="100%">
                    <tr>
                      <th>Nama Penerima </th><th >:</th><td id="nama_pemesan"></td>
                    </tr>
                    <tr>
                      <th>Nomor pemesanan </th><th >:</th><td id="no_pemesanan"></td>
                    </tr>
                    <tr>
                      <th>Tanggal Pemesanan</th><th >:</th><td id="tgl_pemesanan"></td>
                    </tr>
                     <tr>
                      <th>Alamat</th><th >:</th><td id="alamat"></td>
                    </tr>
                    <tr>
                      <th>Nomor Telepon</th><th >:</th><td id="no_telp"></td>
                    </tr>
                    <tr>
                      <th>Kode Pos</th><th >:</th><td id="kode_pos"></td>
                    </tr>
                    <tr>
                      <th>Total Bayar</th><th >:</th><td id="total_bayar"></td>
                    </tr>
                  </table>
                  <hr>
                  <h4 class="font-weight-bold text-primary">Daftar Barang Pesanan</h4><br>
                  <table width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah Barang</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody id="detailBarang">
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
        </div>
    </div>
</div>


