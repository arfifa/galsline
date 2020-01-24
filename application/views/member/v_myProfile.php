 <!-- Begin Page Content -->
 <div class="container-fluid p-4">
   <?php if ($this->session->userdata('berhasil edit') == "ok") : ?>
     <script>
       Swal.fire(
         'Profile berhasil diubah!',
         '',
         'success'
       );
     </script>
   <?php endif; ?>

   <!-- Page Heading -->
   <h2 class="font-weight-bold text-primary">My Profile</h2>
   <hr class="mb-4">
   <div class="card shadow mb-3 border-bottom-warning" style="max-width: 100%;">
     <div class="row no-gutters">
       <div class="col-sm-3">
         <img src="<?= base_url('assets/img/gambarUser/') . $user['image'] ?>" class="card-img" alt="Image Profile">
         <?= form_open_multipart('Member/editProfileMember'); ?>
         <input type="hidden" name="email" value="<?= $user['email']; ?>">
         <div class="form-group">
           <div class="custom-file">
             <input type="hidden" name="image" value="<?= $user['image'] ?>">
             <input type="file" class="custom-file-input" id="image" name="image">
             <label class="custom-file-label" for="image">Choose File</label>
           </div>
         </div>
         <h5 class="card-title text-center mt-4"><?= $user['nama'] ?></h5>
         <p class="card-text text-center mb-4"><small class="text-muted">Member sejak <?= date('d F Y', $user['date_created']); ?></small></p>
       </div>
       <div class="col-sm-9">
         <div class="card-body">
           <div class="row">
             <!-- baris pertama -->
             <div class="col-md-6">
               <div class="form-group">
                 <label for="nama">Nama Lengkap</label>
                 <input type="text" class="form-control" name="nama" id="nama" pattern=".{1,}[a-z]" title="isi dengan huruf kecil" value="<?= $user['nama'] ?>">
                 <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
               <div class="form-group">
                 <label for="alamat">Alamat </label>
                 <textarea name="alamat" class="form-control" id="alamat" rows="3" pattern=".{10,}" title="Alamat Harus Lengkap"><?= $user['alamat'] ?></textarea>
                 <?php echo form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
               <div class="form-group">
                 <label for="alamat_retail">Alamat Retail</label>
                 <textarea name="alamat_retail" class="form-control" id="alamat_retail" rows="3" placeholder="Alamat Lengkap Retail" pattern=".{15,}" title="Alamat retail harus lengkap"><?= $user['alamat_retail'] ?></textarea>
                 <?php echo form_error('alamat_retail', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label for="no_ktp">No. KTP</label>
                 <input type="text" name="no_ktp" class="form-control" id="no_ktp" value="<?= $user['no_ktp'] ?>">
                 <?php echo form_error('no_ktp', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
               <div class="form-group">
                 <label for="no_telp">No. Telepon</label>
                 <input type="tel" class="form-control" name="no_telp" id="no_telp" value="<?= $user['no_telp'] ?>">
                 <?php echo form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
               <div class="form-group">
                 <label for="nama_retail">Nama Retail</label>
                 <input type="text" class="form-control" name="nama_retail" id="nama_retail" placeholder="Nama Retail Anda" value="<?= $user['nama_retail'] ?>" pattern=".{5,}" title="Nama Retail harus benar">
                 <?php echo form_error('nama_retail', '<small class="text-danger pl-3">', '</small>'); ?>
               </div>
             </div>
           </div>
           <button class="btn btn-success btn-user" type="submit" style="width: 100px;">Edit </button>
           <a href="<?= base_url() . 'Member' ?>" class="btn btn-warning " style="width: 100px;">Kembali</a>
           </form>
         </div>
       </div>
     </div>
   </div>
   <!-- end container-fluid -->
 </div>
 <!-- end content -->
 </div>