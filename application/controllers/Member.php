<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	//member setelah login
	public function index()
	{
		$data['judul'] = 'Dasboard Pemesanan';
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
		$id = $data['user']['id_member'];

		$data['keranjang'] = $this->db->query("SELECT * FROM keranjang WHERE id_member = '$id' ")->result();
		$data['pemesanan'] = $this->db->query("SELECT * FROM detail_pemesanan WHERE id_member = '$id' ")->result();


		htmlspecialchars($keyword_barang = $this->input->post('keyword_barang', true));
		// pagination konfigurasi
		if (isset($keyword_barang)) {
			$data['barang'] = $this->db->query("SELECT * FROM barang B, stok_barang S WHERE B.kd_barang = S.kd_barang AND B.nama_barang LIKE '%$keyword_barang%' ")->result();
		} else {
			$jumlahDataPerHalaman = 6;
			$jumlahData = $this->db->query("SELECT * FROM barang B, stok_barang S WHERE B.kd_barang = S.kd_barang ")->num_rows();

			$data['jumlahHalaman'] = ceil($jumlahData / $jumlahDataPerHalaman);
			$data['halamanAktif'] = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
			$awalData = ($jumlahDataPerHalaman * $data['halamanAktif']) - $jumlahDataPerHalaman;

			$data['barang'] = $this->db->query("SELECT * FROM barang B, stok_barang S WHERE B.kd_barang = S.kd_barang ORDER BY stok DESC LIMIT $awalData, $jumlahDataPerHalaman ")->result();
		}

		$this->load->view('member/header', $data);
		$this->load->view('member/v_dasboard');
		$this->load->view('member/footer');
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"> Anda telah logout.</div>');
		redirect(base_url() . 'Login');
	}

	public function myProfileMember()
	{
		$data['judul'] = 'Profile Saya';
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('Member/header', $data);
		$this->load->view('Member/v_myProfile');
		$this->load->view('Member/footer');
	}

	public function editProfileMember()
	{
		htmlspecialchars($email = $this->input->post('email'));
		htmlspecialchars($nama = $this->input->post('nama'));
		htmlspecialchars($image = $this->input->post('image'));
		htmlspecialchars($alamat = $this->input->post('alamat'));
		htmlspecialchars($alamat_retail = $this->input->post('alamat_retail'));
		htmlspecialchars($no_ktp = $this->input->post('no_ktp'));
		htmlspecialchars($no_telp = $this->input->post('no_telp'));
		htmlspecialchars($nama_retail = $this->input->post('nama_retail'));

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);
		$this->form_validation->set_rules('alamat_retail', 'Alamat Retail', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct retail address.'
		]);
		$this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'trim|required|numeric|min_length[16]', [
			'min_length' => 'No.KTP to short!'
		]);
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'trim|required|numeric|min_length[7]|max_length[14]');
		$this->form_validation->set_rules('nama_retail', 'Nama Retail', 'trim|required');

		if ($this->form_validation->run() == true) {
			//configurasi upload gambar
			$config['upload_path'] = './assets/img/gambarUser/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'image' . time();

			$this->load->library('upload', $config);
			$where = array('email' => $email);
			$data = array(
				'nama' => $nama,
				'alamat' => $alamat,
				'alamat_retail' => $alamat_retail,
				'no_ktp' => $no_ktp,
				'no_telp' => $no_telp,
				'nama_retail' => $nama_retail,
				'image' => $image
			);

			$data1 = array(
				'name' => $nama
			);

			if ($this->upload->do_upload('image')) {
				$image = $this->upload->data();
				unlink('assets/img/gambarUser/' . $this->input->post('image', true));
				$data['image'] = $image['file_name'];
				$this->M_galsline->update_data('member', $data, $where);
				$this->M_galsline->update_data('user', $data1, $where);
			} else {
				$this->M_galsline->update_data('member', $data, $where);
				$this->M_galsline->update_data('user', $data1, $where);
			}
			$this->session->set_flashdata('berhasil edit', 'ok');
			redirect(base_url() . 'Member/myProfileMember');
		} else {
			$data['judul'] = 'My Profile';
			$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
			$this->load->view('Member/header', $data);
			$this->load->view('Member/v_myProfile');
			$this->load->view('Member/footer');
		}
	}

	public function gantiPassword()
	{
		$data['judul'] = 'Ganti Password';
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('Member/header', $data);
		$this->load->view('Member/v_gantiPassword');
		$this->load->view('Member/footer');
	}

	public function gantiPasswordAct()
	{
		htmlspecialchars($email = $this->input->post('email', true));
		htmlspecialchars($password = $this->input->post('password', true));
		htmlspecialchars($password2 = $this->input->post('password2', true));
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'min_length' => 'password to short.',
			'matches' => 'password dont matches.'
		]);
		$this->form_validation->set_rules('password2', 'password2', 'required|trim');

		if ($this->form_validation->run() == true) {
			$where = array('email' => $email);
			$data = array(
				'password' => password_hash($password, PASSWORD_DEFAULT)
			);

			$this->M_galsline->update_data('user', $data, $where);
			$this->session->set_flashdata('ganti password', 'ok');
			redirect(base_url() . 'Member/gantiPassword');
		} else {
			$data['judul'] = 'Changed Password';
			$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
			$this->load->view('Member/header', $data);
			$this->load->view('Member/v_gantiPassword');
			$this->load->view('Member/footer');
		}
	}

	public function tambahKeranjang()
	{
		htmlspecialchars($jumlah_barang = $this->input->post('jumlah_barang', true));
		htmlspecialchars($nama_barang = $this->input->post('nama_barang', true));
		htmlspecialchars($kd_barang = $this->input->post('kd_barang', true));
		htmlspecialchars($harga_barang = $this->input->post('harga_barang', true));
		htmlspecialchars($id_member = $this->input->post('id_member', true));

		$this->form_validation->set_rules('jumlah_barang', 'Jumlah Barang', 'trim|required|numeric');

		if ($this->form_validation->run() == true) {

			$cek = $this->db->query("SELECT * FROM keranjang WHERE kd_barang  = '$kd_barang' AND id_member = '$id_member' ")->row_array();
			$jumlah = $cek['jumlah'] + $jumlah_barang;
			$where = array(
				'kd_barang' => $kd_barang,
				'id_member' => $id_member
			);
			$data = array(
				'jumlah' => $jumlah
			);
			if ($cek) {
				$this->M_galsline->update_data('keranjang', $data, $where);
			} else {
				$data = array(
					'kd_barang' => $kd_barang,
					'id_member' => $id_member,
					'nama_barang' => $nama_barang,
					'harga_barang' => $harga_barang,
					'jumlah' => $jumlah_barang
				);

				$this->M_galsline->insert_data($data, 'keranjang');
			}

			$this->session->set_flashdata('jumlahBarang', 'yes');
			redirect(base_url() . 'Member');
		} else {
			$this->session->set_flashdata('jumlahBarang', 'no');
			redirect(base_url() . 'Member');
		}
	}

	public function keranjangPesanan()
	{
		$data['judul'] = 'Daftar Belanja';
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
		$id = $data['user']['id_member'];
		$data['keranjang'] = $this->db->query("SELECT `stok_barang`.`kd_barang`, `stok`, `id_keranjang`, `id_member`,
												`keranjang`.`nama_barang`, `harga_barang`, `jumlah`, `image`
						                      FROM `stok_barang` join `keranjang` join `barang`
						                      WHERE `stok_barang`.`kd_barang` = `keranjang`.`kd_barang` 
						                      AND `barang`.`kd_barang` = `keranjang`.`kd_barang` AND `id_member` = $id ")->result();
		$this->load->view('Member/header', $data);
		$this->load->view('Member/v_keranjangBelanja');
		$this->load->view('Member/footer');
	}

	public function updateJumlah($id_keranjang, $kd_barang)
	{
		htmlspecialchars($minus = $this->input->post('minus', true));
		htmlspecialchars($plus = $this->input->post('plus', true));
		htmlspecialchars($jumlah = $this->input->post('jumlah', true));

		if (isset($minus)) {
			if ($jumlah - 1 == 0) {
				$this->session->set_flashdata('jumlahKosong', 'yes');
				redirect(base_url() . 'Member/keranjangPesanan');
			} else {
				$where = array('id_keranjang' => $id_keranjang,);
				$data = array('jumlah' => $jumlah - 1);

				$this->M_galsline->update_data('keranjang', $data, $where);
			}

			redirect(base_url() . 'Member/keranjangPesanan');
		} else if (isset($plus)) {
			$where = array('kd_barang' => $kd_barang);
			$stok = $this->M_galsline->edit_data($where, 'stok_barang')->row_array();
			if ($jumlah + 1 > $stok['stok']) {
				$this->session->set_flashdata('inventoryOrder', 'kurang');
				redirect(base_url() . 'Member/keranjangPesanan');
			} else {
				$where = array('id_keranjang' => $id_keranjang,);
				$data = array('jumlah' => $jumlah + 1);

				$this->M_galsline->update_data('keranjang', $data, $where);
			}

			redirect(base_url() . 'Member/keranjangPesanan');
		} else {
			$data['judul'] = 'Daftar Belanja';
			$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
			$id = $data['user']['id_member'];
			$id_member = array(
				'id_member' => $id
			);
			$data['keranjang'] = $this->M_galsline->edit_data($id_member, 'keranjang')->result();

			$this->load->view('Member/header', $data);
			$this->load->view('Member/v_keranjangBelanja');
			$this->load->view('Member/footer');
		}
	}

	public function hapusPesanan($kd_barang)
	{
		$data['judul'] = 'Daftar Belanja';
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();

		$where = array('kd_barang' => $kd_barang);
		$this->M_galsline->delete_data($where, 'keranjang');
		$this->session->set_flashdata('deletePesanan', 'ok');
		redirect(base_url() . 'Member/keranjangPesanan');
	}

	public function kosongkanKeranjang($id_member)
	{
		$data['judul'] = 'Daftar Belanja';
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();

		$where = array('id_member' => $id_member);
		$this->M_galsline->delete_data($where, 'keranjang');
		$this->session->set_flashdata('kosongkanKeranjang', 'ok');
		redirect(base_url() . 'Member/keranjangPesanan');
	}

	public function checkout()
	{

		htmlspecialchars($id_member = $this->input->post('id_member'));
		htmlspecialchars($nama = $this->input->post('nama'));
		htmlspecialchars($alamat = $this->input->post('alamat'));
		htmlspecialchars($no_telp = $this->input->post('no_telp'));
		htmlspecialchars($kode_pos = $this->input->post('kode_pos'));

		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required');

		if ($this->form_validation->run() == true) {
			$data['pemesan'] = array(
				'id_member' => $id_member,
				'nama' => $nama,
				'alamat' => $alamat,
				'no_telp' => $no_telp,
				'kode_pos' => $kode_pos
			);

			$data['judul'] = 'Pemesanan';
			$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();

			$id_member = $data['user']['id_member'];


			$data['barang'] = $this->db->query("SELECT * FROM keranjang K, Barang B WHERE K.kd_barang = B.kd_barang AND K.id_member = '$id_member' ")->result();

			if ($data['barang'] !== []) {
				$this->load->view('member/v_pemesanan', $data);
			} else {
				$this->session->set_flashdata('keranjangKosong', 'yes');
				redirect(base_url() . 'Member/keranjangPesanan');
			}
		} else {
			$data['judul'] = 'Daftar Belanja';
			$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
			$id = $data['user']['id_member'];
			$data['keranjang'] = $this->db->query("SELECT `stok_barang`.`kd_barang`, `stok`, `id_keranjang`, `id_member`,
													`keranjang`.`nama_barang`, `harga_barang`, `jumlah`, `image`
							                      FROM `stok_barang` join `keranjang` join `barang`
							                      WHERE `stok_barang`.`kd_barang` = `keranjang`.`kd_barang` 
							                      AND `barang`.`kd_barang` = `keranjang`.`kd_barang` AND `id_member` = $id ")->result();
			$this->load->view('Member/header', $data);
			$this->load->view('Member/v_keranjangBelanja');
			$this->load->view('Member/footer');
		}
	}

	public function pesanBarang()
	{
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();

		$id_member = $data['user']['id_member'];

		htmlspecialchars($nama = $this->input->post('nama', true));
		htmlspecialchars($alamat = $this->input->post('alamat', true));
		htmlspecialchars($no_telp = $this->input->post('no_telp', true));
		htmlspecialchars($kode_pos = $this->input->post('kode_pos', true));
		htmlspecialchars($total_bayar = $this->input->post('total_bayar', true));

		$data = array(
			'no_pemesanan' => $this->M_galsline->kode_tranfer(),
			'tgl_pemesanan' => date('Y-m-d'),
			'id_member' => $id_member,
			'nama_pemesan' => $nama,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'kode_pos' => $kode_pos,
			'total_bayar' => $total_bayar,
			'status_pembayaran' => '0'
		);

		$no_pemesanan = $data['no_pemesanan'];

		$this->M_galsline->insert_data($data, 'pemesanan');

		$jumlahPesanan = $this->db->query("SELECT * FROM keranjang WHERE id_member = '$id_member' ")->num_rows();
		$keranjang = $this->db->query("SELECT * FROM keranjang WHERE id_member = '$id_member' ")->result_array();
		foreach ($keranjang as $k) {

			for ($p = 0; $p < $jumlahPesanan; $p++) {
				$isi = array(
					'no_pemesanan' => $no_pemesanan,
					'id_member' => $k['id_member'],
					'kd_barang' => $k['kd_barang'],
					'nama_barang' => $k['nama_barang'],
					'harga_barang' => $k['harga_barang'],
					'jumlah' => $k['jumlah']
				);
			}


			$this->M_galsline->insert_data($isi, 'detail_pemesanan');
		}

		$this->db->query("DELETE FROM keranjang WHERE id_member = '$id_member' ");

		redirect(base_url() . 'Member/daftarPemesanan');
	}

	public function daftarPemesanan()
	{
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
		$data['judul'] = "Daftar Pemesanan";
		$id_member = $data['user']['id_member'];
		$data['pemesanan'] = $this->db->query("SELECT * FROM pemesanan WHERE id_member = '$id_member' ")->result();

		$this->load->view('member/header', $data);
		$this->load->view('member/v_daftarPemesanan');
		$this->load->view('member/footer');
	}

	public function detailPemesanan()
	{
		$data['user'] = $this->db->get_where('member', ['email' => $this->session->userdata('email')])->row_array();
		$data['judul'] = "Detail Pemesanan";
		$id_member = $data['user']['id_member'];
		$no_pemesanan = $_POST['id'];
		$detail = $this->db->query("SELECT * FROM pemesanan P, detail_pemesanan D WHERE P.id_member = '$id_member' AND P.no_pemesanan = D.no_pemesanan AND P.no_pemesanan = '$no_pemesanan' ")->result_array();

		echo json_encode($detail);
	}
}
