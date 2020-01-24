$(function () {

	$('.detailPemesanan').on('click', function () {
		$('#titleDetailPemesanan').html('Detail Pemesanan Barang');
		$('#detailBarang').html('');

		function formatNumber(num) {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
		}

		const id = $(this).data('id');
		var no = 0;

		$.ajax({
			url: 'http://localhost/galsline/Member/detailPemesanan',
			data: {
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (detail) {
				$.each(detail, function (i, data) {
					$('#nama_pemesan').html(data.nama_pemesan)
					$('#tgl_pemesanan').html(data.tgl_pemesanan)
					$('#no_pemesanan').html(data.no_pemesanan)
					$('#alamat').html(data.alamat)
					$('#no_telp').html(data.no_telp)
					$('#kode_pos').html(data.kode_pos)
					$('#total_bayar').html('Rp. ' + formatNumber(data.total_bayar))
					no++
					var total = data.harga_barang * data.jumlah
					$('#detailBarang').append(`
			<tr>
				<td>` + no + `</td>
				<td>` + data.nama_barang + `</td>
				<td>` + `Rp. ` + formatNumber(data.harga_barang) + `</td>
				<td>` + data.jumlah + `</td>
				<td width="20%">` + `Rp. ` + formatNumber(total) + `</td>
			</tr>`)

				})
			}
		})

	});


	$('.pembayaran').on('click', function () {
		$('#title').html('Input Pembayaran');

		const no = $(this).data('no');
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/galsline/Admin/getPembayaran',
			data: {
				no: no,
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (detail) {
				$.each(detail, function (i, data) {
					$('#id_pemesanan').val(data.id_pemesanan)
					$('#no_pemesanan').val(data.no_pemesanan)
					$('#id_member').val(data.id_member)

				})
			}

		})
	})

	$('.editPembayaran').on('click', function () {
		$('#title').html('Edit Data Pemesanan');

		const no = $(this).data('no');
		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/galsline/Admin/getEditPembayaran',
			data: {
				no: no,
				id: id
			},
			method: 'post',
			dataType: 'json',
			success: function (detail) {
				$.each(detail, function (i, data) {
					$('#id_pemesanan').val(data.id_pemesanan)
					$('#no_pemesanan').val(data.no_pemesanan)
					$('#id_member').val(data.id_member)
					$('#status_pembayaran').val(data.status_pembayaran)
					$('#jumlah_tranfer').val(data.jumlah_tranfer)

				})
			}

		})
	})

});
