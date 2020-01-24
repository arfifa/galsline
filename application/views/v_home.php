<!-- ***** Wellcome Area Start ***** -->
<?php 
if ($this->session->userdata('gagal') == "ok") :
?>
<script>
Swal.fire(
  'Registrasi Gagal!',
  'Cek kembali data yang anda masukan. pastikan semua data telah terisi.',
  'warning'
)
</script>
<?php endif; ?>

    <section class="wellcome_area clearfix" id="home">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 col-md">
                    <div class="wellcome-heading">
                        <img src="<?php echo base_url() . 'assets/img/logoBrand.jpg' ?>" style = "width:400px; height: 200px; border-radius: 50px 50px 50px 0px">
                        <h3>GL</h3>
                        <h2>Mari Bergabung Menjadi Mitra Kami Untuk Kemudahan Usaha Anda</h2>
                    </div>
                    <div class="get-start-area">
            
                    </div>
                </div>
            </div>
        </div>
        <!-- Welcome thumb -->
        <div class="welcome-thumb wow fadeInDown" data-wow-delay="0.5s">
            <img src="<?php echo base_url() . 'assets/img/bg-img/gas.png' ?>" alt="gas" >
        </div>
    </section>
    <!-- ***** Wellcome Area End ***** -->

    <!-- ***** Special Area Start ***** -->
    <section class="special-area bg-white section_padding_100" id="about us">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading Area -->
                    <div class="section-heading text-center">
                        <h2>Tentang Kami</h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.2s">
                        <div class="single-icon">
                            <i class="ti-map-alt" area-hidden="true"></i>
                        </div>
                        <h4>Jangkauan kami</h4>
                        <p>Kami menjangkau seluruh area diwilayah kota bekasi dan kabupaten bekasi.</p>
                    </div>
                </div>
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
                        <div class="single-icon">
                            <i class="ti-truck" aria-hidden="true"></i>
                        </div>
                        <h4>Distribusi</h4>
                        <p>Kami siap menjadi distributor dari usaha penjualan gas dan galon anda, dengan jumlah persediaan stok kami.</p>
                    </div>
                </div>
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.6s">
                        <div class="single-icon">
                            <i class="ti-headphone-alt" aria-hidden="true"></i>
                        </div>
                        <h4>Layanan konsumen</h4>
                        <p>Costumer service kami siap melayani anda jika terjadi keterlambatan dalam pengiriman pesanan anda.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Special Description Area -->
        <div class="special_description_area mt-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="special_description_img">
                            <img src="<?php echo base_url() . 'assets/img/bg-img/gas1.jpg' ?> ">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-5 ml-xl-auto">
                        <div class="special_description_content">
                            <h2>Layanan dan Proposisi Terbaik Kami Untuk Anda!</h2>
                            <p><i style="font-size: 30px">Galsline </i>  merupakan perusahaan distributor galon dan gas dengan sistem internet online berdiri pada tahun 2018. sebagai perusahaan yang masih baru kami terus pengembangkan kinerja pelayanan kami kepada konsumen karena kepuasan konsumen merupakan prioritas kami. untuk menunjang itu kami terus memperbaiki sistem distributor kami agar bisa efisien dan efektif. dengan visi & misi yang kami punya, kami yakin menjadi perusahaan   distributor galon dan gas nomor satu di Indonesia. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Special Area End ***** -->

<!-- ***** gallery ***** -->
    <section class="our-Team-area bg-white section_padding_0_100 clearfix" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <!-- Heading Text  -->
                    <div class="section-heading p-0">
                        <h2>Galeri Barang</h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12 text-center">
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/aqua.jpg' ?>" alt="aqua">
                </div>
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/gas1.jpg' ?>" alt="gas 12kg">
                </div>
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/gasmelon.jpg' ?>" alt="gas melon">
                </div>
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/indomiegoreng.jpg' ?>" alt="Indomie Goreng Original">
                </div>          
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/ades.jpg' ?>" alt="Ades air mineral">
                </div>
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/indomieSoto.jpg' ?>" alt="Indomie Soto">
                </div>
                <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/indomieayambawang.jpg' ?>" alt="Indomie Ayam Bawang">
                </div>
                 <div class="member-image">
                    <img src="<?php echo base_url() . 'assets/img/barang-img/vitAirMineral.png' ?>" alt="Vit Air Mineral">
                </div>
              </div>
            </div>
        </div>
    </section>
    <!-- ***** gallery ***** -->


    <!-- ***** Contact Us Area Start ***** -->
    <section class="footer-contact-area section_padding_100 clearfix" id="registrasi">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2>kemudahan berjualan ada ditangan anda. </h2>
                        <div class="line-shape"></div>
                    </div>
                    <div class="footer-text">
                        <p>berjualan tanpa takut khawatir kehabisan stok.</p>
                    </div>
                    <div class="address-text">
                        <p><span>Address : </span> Jl.Pelabuhan Ratu no.14 Rawa Lumbu Kota Bekasi</p>
                    </div>
                    <div class="phone-text">
                        <p><span>Phone & WhatsApps : </span> 085695703761</p>
                    </div>
                    <div class="email-text">
                        <p><span>Email : </span> galsline@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-6">
                     <h2>Registrasi Retail</h2><hr>
                     <p>Silahkan isi form di bawah ini dengan benar!</p>

                    <!-- Form Start-->
                    <div class="contact_from">
                        <form action="<?php echo base_url() . 'Pendaftaran/pendaftaranRetail' ?>" method="post">
                            <!-- Message Input Area Start -->
                            <div class="contact_input_area">
                                <div class="row">
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" pattern=".{1,}[a-z]" title="isi dengan huruf kecil" value="<?= set_value('nama') ?>" >
                                            <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                             <label for="noKtp">NO.KTP</label>
                                            <input type="text"name="noKtp" class="form-control" id="noKtp"  placeholder="Nomor KTP" value="<?= set_value('noKtp') ?>">
                                            <?php echo form_error('noKtp', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                             <label for="alamat">Alamat </label>
                                            <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="4" placeholder="Alamat Lengkap" pattern=".{10,}" title="Alamat Harus Lengkap"><?= set_value('alamat') ?></textarea>
                                            <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="namaRetail">Nama Retail</label>
                                            <input type="text" class="form-control" name="namaRetail" id="namaRetail" placeholder="Nama Retail Anda" value="<?= set_value('namaRetail') ?>" pattern=".{5,}" title="Nama Retail harus benar">
                                            <?php echo form_error('namaRetail', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                     <div class="col-12">
                                        <div class="form-group">
                                             <label for="alamatRetail">Alamat Retail</label>
                                            <textarea name="alamatRetail" class="form-control" id="alamatRetail" cols="30" rows="4" placeholder="Alamat Lengkap Retail" pattern=".{15,}" title="Alamat retail harus lengkap"> <?= set_value('alamatRetail') ?></textarea>
                                            <?php echo form_error('alamatRetail', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="noTlpn">No. Telepon</label>
                                            <input type="tel" class="form-control" name="noTlpn" id="noTlpn" placeholder="Nomor Telepon" value="<?= set_value('noTlpn') ?>">
                                            <?php echo form_error('noTlpn', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="email">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Masukan email" value="<?= set_value('email') ?>">
                                            <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password">
                                            <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                     <div class="col-md-12">
                                        <div class="form-group">
                                             <label for="password2">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="password2" id="password2" placeholder="Konfirmasi Password">
                                        </div>
                                    </div>
                                    <!-- Single Input Area Start -->
                                    <div class="col-12">
                                        <button type="submit" class="btn submit-btn">Daftar</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Message Input Area End -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area End ***** -->

  
