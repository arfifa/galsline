<!DOCTYPE html>
<html>
<head>
	<title><?= $judul ?></title>
	 <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/') ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/') ?>css/style.css" rel="stylesheet">

  <!-- Sweet Alert -->
  <script src="<?php echo base_url().'assets/js/dist/sweetalert2.all.min.js' ?>"></script>
</head>
<body>
  <div class="checkout-wrapper">
    <header>
      <img src="<?= base_url().'assets/img/logoBrand.jpg' ?>">
    </header>
    <div class="card m-4 p-4">
    <h3>Data Pengiriman</h3><hr>
     <table>
        <tr>
          <th>Nama Penerima </th><th width="15px" class="text-center">:</th><th><?= $pemesan['nama'] ?></th>
        </tr>
        <tr>
          <th>Alamat</th><th width="15px" class="text-center">:</th><th><?= $pemesan['alamat'] ?></th>
        </tr>
        <tr>
          <th>No.Telepon</th><th width="15px" class="text-center">:</th><th><?= $pemesan['no_telp'] ?></th>
        </tr>
        <tr>
          <th>Kode Pos</th><th width="15px" class="text-center">:</th><th><?= $pemesan['kode_pos'] ?></th>
        </tr>
      </table><hr>
      <h3>Daftar Barang Pesanan</h3><br>
      <table width="100%">
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th class="text-center">Harga Satuan</th>
          <th class="text-center">Jumlah Barang</th>
          <th width="100" class="text-center">Total</th>
        </tr>
        <?php 
        $no = 1;
        $totalBayar = 0;
        foreach ($barang as $b) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $b->nama_barang ?></td>
          <td class="text-center"><?= number_format($b->harga_barang) ?></td>
          <td class="text-center"><?= $b->jumlah." ".$b->satuan ?></td>
          <td class="text-center"><?php
          $total = $b->harga_barang * $b->jumlah ;
          $totalBayar += $b->harga_barang * $b->jumlah ;
          echo number_format($total); ?></td>
        </tr>

        <?php endforeach; ?>
        <tr>
          <td colspan="5"><hr></td>
        </tr>
        <tr class="text-center">
          <td colspan="4"><h5> Total Bayar </h5></td>
          <td><h5><?php echo 'Rp.'.number_format($totalBayar); ?></h5></td>
        </tr>
      </table>
      <div class="text-right mt-5">
      <form action="<?= base_url().'Member/pesanBarang' ?>" method="post">
        <input type="hidden" name="nama" value="<?= $pemesan['nama'] ?>">
        <input type="hidden" name="alamat" value="<?= $pemesan['alamat'] ?>">
        <input type="hidden" name="no_telp" value="<?= $pemesan['no_telp'] ?>">
        <input type="hidden" name="kode_pos" value="<?= $pemesan['kode_pos'] ?>">
        <input type="hidden" name="total_bayar" value="<?= $totalBayar ?>">

        <button class="btn btn-primary p-3" style = "border-radius: 50px 50px 50px 0px; width: 200px; "><i class="fas fa-fw fa-check-circle"></i>Pesan barang</button>
        <a href="<?= base_url().'Member/keranjangPesanan' ?>" class="btn btn-danger p-3" style = "border-radius: 50px 50px 0px 50px; width: 200px;"><i class="fas fa-fw fa-times-circle"></i>Batal</a>
      </form>
      </div>
    </div>
  </div>

</div>
</body>
</html>