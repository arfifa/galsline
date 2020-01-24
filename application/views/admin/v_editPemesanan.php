<div class="container-fluid p-4">
    <!-- Page Heading -->
    <h2 class="font-weight-bold text-primary">Edit Data Pemesanan</h2><hr class="mb-4">
	
	<?php if ($detailPemesanan != []) { ?>
	<?php foreach ($dataPemesan as $d) : ?>
	<?php endforeach; ?>
	<div class="card shadow mb-4">
		<div class="card-header">
			<h4 class="m-0 text-gray-800">Data Pesanan</h4>
		</div>
		<div class="card-body">
			<?= $this->session->flashdata('gagal'); ?>
			<table width="100%" class="mb-5">
                <tr>
                  <th  width="30%">Nomor pemesanan </th><th >:</th><td><?= $d->no_pemesanan ?></td>
                </tr>
                <tr>
                  <th>Tanggal Pemesanan</th><th >:</th><td><?= $d->tgl_pemesanan ?></td>
                </tr>
                <tr>
                  <th>id_member</th><th >:</th><td><?= $d->id_member ?></td>
                </tr>
                <tr>
                  <th>Nama Pemesan<th>:</th><td><?= $d->nama_pemesan ?></td>
                </tr>
                 <tr>
                  <th>Alamat</th><th >:</th><td><?= $d->alamat ?></td>
                </tr>
                <tr>
                  <th>Nomor Telepon</th><th >:</th><td><?= $d->no_telp ?></td>
                </tr>
                <tr>
                  <th>Kode Pos</th><th >:</th><td><?= $d->kode_pos ?></td>
                </tr>
                <tr>
					<th>Status Pembayaran</th><th >:</th><td>
					<?php
					if ($d->status_pembayaran == 0) {
						echo "Menunggu Pembayaran";
					} else if ($d->status_pembayaran == 1) {
						echo "Telah Dikonfirmasi";
					} else if ($d->status_pembayaran == 2) {
						echo "Sedang Dikirim";
					} else {
						echo "Pesanan Selesai Diproses";
					}
					?>
                  </td>
                </tr>
            </table>
	        <h4 class="mb-3 text-gray-800">Data barang pesanan</h4>
	        <div class="table-responsive">
	        	<table class="table" width="100%">
	                <thead>
	                  <tr>
	                    <th>No</th>
	                    <th>Kode Barang</th>
	                    <th>Nama Barang</th>
	                    <th>Harga Satuan</th>
	                    <th class="text-center">Jumlah</th>
	                    <th class="text-center">Total</th>
	                  </tr>
	                </thead>
	                <tbody>
	                <?php 
					$no = 1;
					$total_bayar = 0;
					foreach ($detailPemesanan as $dp) :
						$total = $dp->harga_barang * $dp->jumlah;
					$total_bayar += $total; ?>
	                	<tr>
	                		<td><?= $no++ ?></td>
	                		<td><?= $dp->kd_barang ?></td>
	                		<td><?= $dp->nama_barang ?></td>
	                		<td><?= $dp->harga_barang ?></td>
	                		<td class="text-center"><?= $dp->jumlah ?></td>
	                		<td class="text-right"><?= $total ?></td>
	                	</tr>
	                <?php endforeach ?>
	                  	<tr>
			        		<td colspan="5" class="text-center"><b>Total Bayar</b></td>
			        		<td class="text-right">Rp. <?= number_format($total_bayar) ?></td>
		        		</tr>
	                </tbody>
             	</table>
	        </div>
		    <div class="text-right mr-3"><hr>
				<?php foreach ($pembayaran as $pb): ?>
				<table class="text-left text-primary m-auto" width="100%">
					<tr>
						<th colspan="3"><h2 class="font-weight-bold text-primary"><i>Telah Dikonfirmasi</i></h2></th>
					</tr>
					<tr>
						<th width="30%">Nomor Pembayaran </th><th width="2%"> : </th><th><?= $pb->no_pembayaran ?></th>
					</tr>
					<tr>
						<th>Jumlah Bayar yang Dinput </th><th> : </th><th>Rp.<?= number_format($pb->jumlah_tranfer);?></th>
					</tr>
					<tr>
						<th>Oleh Admin</th><th> : </th><th><?= $pb->nama_admin ?></th>
					</tr>
				</table>		
				<?php endforeach; ?>
			    <a href="" class="btn btn-primary editPembayaran" data-toggle="modal" data-target="#editPembayaran" data-id="<?= $d->id_pemesanan ?>" data-no="<?= $d->no_pemesanan ?>">Update Pembayaran</a>
			    <a href="<?= base_url() . 'Admin/pemesanan' ?>" class="btn btn-warning">Batal</a>
		 	</div>
		</div>
	</div>
	<?php } ?>
</div>
<div class="modal ml-5 fade" id="editPembayaran" tabindex="-1" role="dialog" aria-labelledby="editPembayaran" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="title"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            	<div class="modal-body">
	                <form action="<?= base_url() . 'Admin/bayarPemesananAct' ?>" method="post">
	                	<div class="form-group">
	                		<label for="no_pemesanan">Nomor Pemesanan</label>
			            	<input type="text" name="no_pemesanan" class="form-control" id="no_pemesanan"  readonly>
	                	</div>
	                	<div class="form-group">
	                		<label for="nama_bank">Nama Bank</label>
			            	<select name="nama_bank" class="form-control" id="nama_bank">
			            		<option value="BCA">BCA</option>
			            	</select>
	                	</div>
	                	<div class="form-group">
	                		<label for="jumlah_tranfer">Update Tranfer</label>
	                		<small class="text-danger">* jumlah tranfer harus sama dengan total bayar</small>
			            	<input type="number" name="jumlah_tranfer" class="form-control" id="jumlah_tranfer" min="0">
	                	</div>
	                	<div class="form-group">
	                		<label for="status_pembayaran">Status Pembayaran</label>
	                		<input type="text" class="form-control" readonly
	                		<?php if ($d->status_pembayaran == 1): ?>
	                			value = "Telah Dikonfirmasi"
	                		<?php endif; ?>
	                		>
				              	<select name="status_pembayaran" class="form-control">
				              		<option id="status_pembayaran">--Pilih Status Pembayaran--</option>
					                <option value="0">Menunggu Pembayaran</option>
					                <option value="1">Telah Dikonfirmasi</option>
					                <option value="2">Sedang Dikirim</option>
					                <option value="3">Pesanan Selesai Diproses</option>
				              	</select>
	                	</div>
	                	<input type="hidden" name="id_pemesanan" id="id_pemesanan">
	                	<input type="hidden" name="id_member" id="id_member">
            	</div>
                <div class="modal-footer">
					<button type="submit" class="btn btn-primary">Konfirmasi</button>
                  	<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                  	</form>
                </div> 		
        </div>
    </div>
</div> 