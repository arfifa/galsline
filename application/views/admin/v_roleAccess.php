<script>
function validate(hapus)
{
  var id = hapus.getAttribute('value');
  Swal.fire({
  title: 'Anda yakin ingin hapus Role ini?',
  text: "",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Hapus',
}).then((result) => {
  if (result.value) {
   $(location).attr('href','<?php echo base_url() ?>admin/hapusRole/'+id);
  }
});
}
 </script>
<!-- content -->
<div class="container-fluid p-4">
  <!-- Page Heading -->
	<h2 class="font-weight-bold text-primary">Akses Role</h2><hr class="mb-4">
  <!-- card -->
  <div class="row">
  	<div class="col-lg-7">
  		<?= $this->session->userdata('aksesBerubah'); ?>

		<div class="card shadow mb-4 p-3">
			<div class="card-header mb-3">
				<h4>Daftar Menu Access</h4><hr>
                <h5 class="font-weight-bold text-primary mb-3">Role : <?= $role['role']; ?></h5>
			</div>
            <?= form_error('role'); ?>
			<div class="table-responsive">
				<table class="table table-hover" id="dataTable" >
		  			<thead>
		 				<tr>
			  				<th>#</th>
			  				<th>Menu</th>
			  				<th class="text-center">Access</th>
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
		  					<td class="text-center">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m->id); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m->id ?>">
                  </div>
		  					</td>
		  				</tr>
		  				<?php endforeach; ?>
		  			</tbody>
	  			</table>
			</div>
		</div>  
	</div>
  </div>
 <!-- end container-fluid  -->
</div>
<!-- end content -->
</div>
