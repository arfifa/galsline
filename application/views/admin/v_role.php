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
<?php if ($this->session->userdata('hapusRole') == "ok") : ?>
<script>
Swal.fire(
	'Role Berhasil Dihapus!',
    '',
    'success'
)
</script>
<?php endif; ?>
<!-- content -->
<div class="container-fluid p-4">
  <!-- Page Heading -->
	<h2 class="font-weight-bold text-primary">Akses Role</h2><hr class="mb-4">
  <!-- card -->
  <div class="row">
  	<div class="col-lg-7">
  		<?= $this->session->userdata('berhasil_tambah'); ?>

        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Tambah Role</a>
		<div class="card shadow mb-4 p-3">
			<div class="card-header mb-4">
				<h4>Daftar Role</h4>
			</div>
            <?= form_error('role', '<div class="text-danger mb-2">', '</div>'); ?>
			<div class="table-responsive">
				<table class="table table-hover" id="dataTable">
		  			<thead>
		 				<tr>
			  				<th scope="col">#</th>
			  				<th scope="col">Role</th>
			  				<th scope="col">Action</th>
			  			</tr>
		  			</thead>
		  			<tbody>
		  				<?php
							$no = 1;
							foreach ($role as $r) :
							?>
		  				<tr>
		  					<td><?= $no++ ?></td>
		  					<td><?= $r->role ?></td>
		  					<td nowrap="nowrap">
                                <a href="<?= base_url() . 'Admin/roleAccess/' . $r->id; ?>" class="badge badge-warning">access</a>
		  						<a href="<?= base_url() . 'Admin/edit_role/' . $r->id; ?>" class="badge badge-success">edit</a>
		  						<a class="badge badge-danger" onclick="validate(this)" value="<?= $r->id; ?>" name="hapus"><span>delete</span></a>
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
<!-- Mulai content modal  -->
<div class="modal ml-5 fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="title">Tambah Role Baru</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            	<div class="modal-body">
	                <form action="<?= base_url() . 'Admin/role' ?>" method="post">
	                	<div class="form-group">
	                		<label for="role">Nama Role</label>
			            	<input type="text" name="role" class="form-control" id="role" placeholder="Masukan nama role">
	                	</div>
            	</div>
                <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Tambah Role</button>
                  	<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                  	</form>
                </div> 		
        </div>
    </div>
</div> 