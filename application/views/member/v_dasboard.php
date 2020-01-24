<?php if($this->session->userdata('jumlahBarang') == "no" ) : ?>
  <script>
  Swal.fire(
    'Input jumlah pesanan barang!',
    '',
    'warning'
  );
  </script>
<?php endif; ?>
<?php if($this->session->userdata('jumlahBarang') == "yes" ) : ?>
  <script>
  Swal.fire(
    'Barang sudah ditambahkan ke keranjang belanja anda.',
    '',
    'success'
  );
  </script>
<?php endif; ?>

 <h2 class="font-weight-bold text-primary ml-4 mt-4">Daftar Barang
    <small>Silahkan pilih barang pesanan dibawah ini.</small><hr>
  </h2>
 <!-- Begin Page Content -->
 <div class="container-fluid p-4" style="background-color: #edfff1 ">
  <form action="<?= base_url('Member') ?>" method="post">
  <div class="input-group md-form form-sm form-2 mb-4">
    <input class="form-control my-0 py-1 amber-border" type="text" name="keyword_barang" placeholder="Masukan keyword nama barang..." autofocus aria-label="Search" autocomplete="off">
    <div class="input-group-append">
      <button type="submit" name="cari" class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
          aria-hidden="true"></i></button>
    </div>
  </div>
  <marquee class="my-3 text-danger"><h4><b>Silahkan lihat seluruh pesanan barang anda di menu Daftar Belanja</b></h4></marquee>
  </form>
  	<div class="row">
  	<!-- looping product-->
  	<?php foreach ($barang as $b): ?>
  	<div class="col-lg-4 col-sm-6 mb-5">
      <div class="card h-100">
        <img src="<?= base_url();?>assets/upload/imageBarang/<?=$b->image; ?>" >
         <h5 class="card-header"><?= $b->nama_barang ?></h5>
        <div class="card-body ">
          <div class="table-responsive">
            <table class="table-no-bordered">
              <tr class="nowrap">
                <td>Harga</td>
                <td> : </td>
                <td> Rp. <?= number_format($b->harga_jual); ?> / <?= $b->satuan ?></td>
              </tr>
              <tr class="nowrap">
                <td>Jumlah stok</td>
                <td width="10">:</td>
                <td> 
                <!-- status stok barang -->
                <?php
                $batasPesanan = $b->stok;
                
                if($batasPesanan <= 0){
                  $batasPesanan = "Barang kosong" ;
                  echo $batasPesanan;
                }else if( $batasPesanan > 0 && $batasPesanan != "Barang kosong" ){

                  if($pemesanan != []){
                    foreach ($pemesanan as $p) {
                      $kd_barang = $p->kd_barang;
                      if($b->kd_barang == $kd_barang){
                        $batasPesanan -= $p->jumlah;
                      }
                    }

                    foreach ($keranjang as $k) {
                       if($b->kd_barang == $k->kd_barang){
                          $batasPesanan -= $k->jumlah;
                       }   
                    }

                    if($batasPesanan <= 0){
                      $batasPesanan = 0 ;
                    }                      
        
                  echo $batasPesanan ." $b->satuan";

                  }else{
                    foreach ($keranjang as $k) {
                      $kd_barang = $k->kd_barang;
                      if($b->kd_barang == $kd_barang){
                        $batasPesanan -= $k->jumlah;
                        if($batasPesanan <= 0){
                          $batasPesanan = 0 ;
                        }
                      }
                    }

                    echo $batasPesanan ." $b->satuan";
                  }
                }

                ?>
                </td>
              </tr>
          </table>
          </div>
        </div>
        <div class="card-footer">
          <form class="form-inline" action="<?= base_url().'member/tambahKeranjang' ?>" method="post">
            <label for="jumlah_barang" class="mr-2">Jumlah Pesan</label>
            <div class="form-group jumlah mr-1 mb-2">
            <?php if ( $batasPesanan <= 0 && $batasPesanan == "Barang kosong" ) : ?>
            <input type="number" name="jumlah_barang" class="form-control" min="0" id="jumlah_barang" readonly>
            <?php else : ?>
            <input type="number" name="jumlah_barang" class="form-control" min="1" max="<?= $batasPesanan ?>" id="jumlah_barang">
            <button type="submit" class="btn btn-primary">Tambah<span class="fas fa-fw fa-cart-plus"></span></button>
            <?php endif ; ?>
            <input type="hidden" name="nama_barang" value="<?= $b->nama_barang; ?>">
            <input type="hidden" name="kd_barang" value="<?= $b->kd_barang; ?>">
            <input type="hidden" name="harga_barang" value="<?= $b->harga_jual; ?>">
            <input type="hidden" name="id_member" value="<?= $user['id_member']; ?>">
            </div>

          </form>
        </div>
      </div>
    </div>
  	<?php endforeach; ?>
   </div>
  <!-- /.row -->	

  <!-- Navigation Pagination -->
<?php if(!isset($_POST['cari'])) : ?>
  <ul class="pagination justify-content-center">
     <li class="page-item">
      <a class="page-link" href="?halaman=1">
        <span aria-hidden="true">Awal</span>
      </a>
    </li>
<?php if( $halamanAktif > 1 ) :  ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
<?php endif; ?>
<?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) :  ?>
  <?php if( $i == $halamanAktif ) : ?>
    <li class="page-item active">
      <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i ?></a>
    </li>
  <?php else : ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i ?></a>
    </li> 
  <?php endif ; ?>
<?php endfor; ?>

<?php if( $halamanAktif < $jumlahHalaman ) : ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
<?php endif ?>
    <li class="page-item">
      <a class="page-link" href="?halaman=<?=$jumlahHalaman ?>">
        <span aria-hidden="true">Akhir</span>
      </a>
    </li>
  </ul>
<?php endif ; ?>
<!-- end container-fluid -->
</div>
<!-- end content -->
</div>
