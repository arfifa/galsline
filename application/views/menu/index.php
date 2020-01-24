<?php if ($this->session->userdata('add_menu') == "ok") : ?>
  <script>
  Swal.fire(
    'Berhasil menambah menu baru!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
<script>
function validate(hapus)
{
  var id = hapus.getAttribute('value');
  Swal.fire({
  title: 'Anda yakin ingin hapus menu ini?',
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
   $(location).attr('href','<?php echo base_url() ?>Menu/hapusMenu/'+id);
  }
});
}
 </script>
 </script>
<?php if ($this->session->userdata('hapusMenu') == "ok") : ?>
  <script>
  Swal.fire(
    'Menu telah dihapus!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
<!-- content -->
<div class="container-fluid p-4">
  <!-- Page Heading -->
	<h2 class="font-weight-bold text-primary">Menu Management</h2><hr class="mb-4">
  <!-- card -->
  <div class="row">
  	<div class="col-lg-7">
  		<?= $this->session->userdata('berhasil_edit'); ?>
		<div class="card shadow mb-4 p-3">
			<div class="card-header mb-4">
				<h4>Daftar menu</h4>
			</div>
			<div class="table-responsive">
				<table class="table table-hover" id="dataTable">
		  			<thead>
		 				<tr>
			  				<th scope="col">No</th>
			  				<th scope="col">Menu</th>
			  				<th scope="col">Action</th>
			  			</tr>
		  			</thead>
		  			<tbody>
		  				<?php
							$no = 1;
							foreach ($menu as $m) :
							?>
		  				<tr>
		  					<td><?= $no++ ?></td>
		  					<td><?= $m->menu ?></td>
		  					<td nowrap="nowrap">
		  						<a href="<?= base_url() . 'Menu/index/' . $m->id; ?>" class="badge badge-success">edit</a>
		  						<a class="badge badge-danger" onclick="validate(this)" value="<?= $m->id; ?>" name="hapus"><span>delete</span></a>
		  					</td>
		  				</tr>
		  				<?php endforeach; ?>
		  			</tbody>
	  			</table>
			</div>
	  		
		</div>  
	</div>		
  	<div class="col-lg-5">
		<div class="card shadow mb-4 p-3">
			<div class="card-header">
				<h4>Tambah menu baru</h4>
			</div>
			<form action="" method="post" class="p-3">
				<div class="form-group">
					<input type="text" name="menu"class="form-control" id="menu" placeholder="Masukan nama Menu" > 
          			<?php echo form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-primary">Tambah Menu</button>
				</div>
			</form>
		</div>
		<?php if ($this->session->userdata('edit_menu') == "tampil") : ?>
			<?php foreach ($datamenu as $dm) : ?>
			<div class="card shadow mb-4 p-3">
			<div class="card-header">
				<h4>Edit Menu</h4>
			</div>
			<form action="<?= base_url() . 'Menu/editMenuAct/' . $dm->menu; ?>" method="post" class="p-3">
				<div class="form-group">
					<input type="hidden" name="id" value=" <?= $dm->id; ?>">
					<input type="text" name="menu"class="form-control" id="menu" placeholder="Masukan nama menu baru" value="<?= $dm->menu; ?>"> 
          			<?php echo form_error('menu', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-success">Edit Menu</button>
				</div>
			</form>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
  	</div>
  </div>
  	

</div>


