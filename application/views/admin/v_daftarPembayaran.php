<!-- Begin Page Content -->
<div class="container-fluid p-4">

  	<!-- Page Heading -->
  	<h2 class="font-weight-bold text-primary">Daftar Pembayaran</h2><hr class="mb-4">

  	<div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h4 class="m-0 text-gray-800">Table Pembayaran</h4>
	    </div>
	    <div class="card-body">
			<div class="table-responsive">
        		<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
        		<thead class="text-center">
        			<tr>
        				<th>No</th>
        				<th>No. Pembayaran</th>
        				<th>No. Pemesanan</th>
        				<th>Tgl. Bayar</th>
        				<th>Jumlah Tranfer</th>
        				<th>Sunting</th>
        			</tr>
        		</thead>
        		<tbody class="text-center">
        			<?php 
        			$no = 1;
        			foreach ($pembayaran as $p): ?>
        			<tr>
        				<td><?= $no++ ?></td>
        				<td><?= $p->no_pembayaran ?></td>
        				<td><?= $p->no_pemesanan ?></td>
        				<td><?= date('d F Y', $p->tgl_bayar) ?></td>
        				<td class="text-right">Rp. <?= number_format($p->jumlah_tranfer) ?></td>
        				<td>
        					<a class="btn btn-success btn-xs" href="<?php echo base_url().'Admin/detailPembayaran/'.$p->no_pembayaran.'/'.$p->id_pembayaran; ?>"><span class="fas fa-fw fa-search "></span></a>
        					<a class="btn btn-primary btn-xs" href="<?php echo base_url().'Admin/cetakPembayaran/'.$p->no_pembayaran.'/'.$p->id_pembayaran; ?>"><span class="fas fa-fw fa-print "></span></a>
        				</td>
        			</tr>
        			<?php endforeach ?>
        		</tbody>
        		</table>
        	</div>
	    </div>
	</div>

<!-- end of container-fluid -->
</div>
<!-- end of content -->
</div>