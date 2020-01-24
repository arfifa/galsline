<?php if ($this->session->userdata('add_subMenu') == "ok") : ?>
  <script>
  Swal.fire(
    'Berhasil menambah submenu baru!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
<?php if ($this->session->userdata('berhasil_editSubmenu') == "ok") : ?>
  <script>
  Swal.fire(
    'Submenu berhasil diubah!',
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
  title: 'Anda yakin ingin hapus submenu ini?',
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
   $(location).attr('href','<?php echo base_url() ?>Menu/hapus_subMenu/'+id);
  }
});
}
 </script>
 </script>
<?php if ($this->session->userdata('hapus_subMenu') == "ok") : ?>
  <script>
  Swal.fire(
    'Submenu telah dihapus!',
    '',
    'success'
  );
  </script>
<?php endif; ?>
<!-- content -->
<div class="container-fluid p-4">
  <!-- Page Heading -->
	<h2 class="font-weight-bold text-primary"><?= $judul ?></h2><hr class="mb-4">
  <!-- card -->
  <div class="row">
	<?php if ($this->session->userdata('edit_subMenu') == "tampil") : ?>
	<div class="col-lg-8">
		<div class="card shadow mb-4 p-3">
			<div class="card-header">
				<h4>Edit Submenu</h4>
			</div>
			<?php foreach ($dataSubMenu as $dsm) : ?>
			<form action="<?= base_url() . 'Menu/edit_subMenuAct/' . $dsm->title ?>" method="post" class="p-3">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="submenu">Title Submenu</label>
						<input type="hidden" name="id" value=" <?= $dsm->id; ?>">
						<input type="text" name="title" class="form-control" id="submenu" placeholder="Masukan nama submenu" value="<?= $dsm->title ?>"> 
	          			<?php echo form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label for="menu">Menu</label>
							<input type="text" class="form-control" value="<?= $dsm->menu ?>" readonly>
							<select name="menu" id="menu" class="form-control" id="menu">
								<option value="<?= $dsm->menu_id ?>">--Pilih menu--</option>
								<?php foreach ($menu as $m) : ?>
								<option value="<?= $m->id ?>"><?= $m->menu ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="url">URL</label>
							<input type="text" name="url"class="form-control" id="url" placeholder="Masukan URL" value="<?= $dsm->url ?>" > 
		          			<?php echo form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label for="icon">Masukan Icon</label>
							<input type="text" name="icon"class="form-control" id="icon" placeholder="Masukan nama icon" value="<?= $dsm->icon ?>" > 
		          			<?php echo form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check">
								<input type="checkbox" value="1" name="is_active" id="is_active" checked>
								<label class="form-check-label" for="is_active">Active?</label>
							</div>
						</div>
					</div>
				</div>			
				<div class="text-right">
				<button type="submit" class="btn btn-success">Edit Menu</button>
				</div>
				<?php endforeach; ?>
				</form>
			</div>
		</div>
		<?php endif; ?>
  	<div class="col-lg-8">
		<div class="card shadow mb-4 p-3">
			<div class="card-header">
				<h4>Tambah Submenu Baru</h4>
			</div>
			<form action="<?= base_url() . 'Menu/subMenu' ?>" method="post" class="p-3">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="submenu">Title Submenu</label>
						<input type="text" name="title" class="form-control" id="submenu" placeholder="Masukan nama submenu" > 
	          			<?php echo form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label for="menu">Menu</label>
							<select name="menu" id="menu" class="form-control" id="menu">
								<option value="">--Pilih menu--</option>
								<?php foreach ($menu as $m) : ?>
								<option value="<?= $m->id ?>"><?= $m->menu ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="url">URL</label>
							<input type="text" name="url"class="form-control" id="url" placeholder="Masukan URL" > 
		          			<?php echo form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group">
							<label for="icon">Masukan Icon</label>
							<input type="text" name="icon"class="form-control" id="icon" placeholder="Masukan nama icon" > 
		          			<?php echo form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="form-check">
								<input type="checkbox" value="1" name="is_active" id="is_active" checked>
								<label class="form-check-label" for="is_active">Active?</label>
							</div>
						</div>
					</div>
				</div>
				<div class="text-right">
					<button type="submit" class="btn btn-primary">Tambah Submenu</button>
				</div>
			</form>
		</div>
	</div>
	</div>
  <div class="row">
  	<div class="col-12">
		<div class="card shadow mb-4 p-3">
			<div class="card-header mb-4">
				<h4>Daftar submenu</h4>
			</div>
			<div class="table-responsive">
				<table class="table table-hover" id="dataTable">
		  			<thead>
		 				<tr>
			  				<th scope="col">No</th>
			  				<th scope="col">Menu</th>
			  				<th scope="col">Title</th>
			  				<th scope="col">Url</th>
			  				<th scope="col">Icon</th>
			  				<th scope="col">Action</th>
			  			</tr>
		  			</thead>
		  			<tbody>
		  				<?php
							$no = 1;
							foreach ($submenu as $sm) :
							?>
		  				<tr>
		  					<td><?= $no++; ?></td>
		  					<td><?= $sm->menu; ?></td>
		  					<td><?= $sm->title; ?></td>
		  					<td><?= $sm->url ?></td>
		  					<td><?= $sm->icon; ?></td>
		  					<td nowrap="nowrap">
		  						<a href="<?= base_url() . 'Menu/subMenu/' . $sm->id; ?>" class="badge badge-success">edit</a>
		  						<a class="badge badge-danger" onclick="validate(this)" value="<?= $sm->id; ?>" name="hapus"><span>delete</span></a>
		  					</td>
		  				</tr>
		  				<?php endforeach; ?>
		  			</tbody>
	  			</table>	
			</div>
	  		
		</div>  
	</div>		

  </div>
  	

</div>


