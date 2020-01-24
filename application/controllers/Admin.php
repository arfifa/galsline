<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	//cek login
		is_logged_in();
	}

	public function index()
	{
		$data['judul'] = 'Dashboard';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_dashboardAdmin');
		$this->load->view('admin/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert"> Anda telah logout!</div>');
		redirect(base_url() . 'Galsline/adminGalsline');
	}

	public function role()
	{
		htmlspecialchars($role = $this->input->post('role', true));
		htmlspecialchars($username = $this->input->post('username', true));

		$this->form_validation->set_rules('role', 'Role', 'required|trim', [
			'required' => 'Nama Role Wajib Diisi.'
		]);

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Role';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['role'] = $this->M_galsline->get_data('user_role')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_role');
			$this->load->view('admin/footer');
		} else {
			$data = array('role' => $role);
			$this->M_galsline->insert_data($data, 'user_role');
			redirect(base_url() . 'Admin/role');
		}
	}

	public function hapusRole($id)
	{
		$where = array('id' => $id);
		$this->M_galsline->delete_data($where, 'user_role');
		$this->session->set_flashdata('hapusRole', 'ok');
		redirect(base_url() . 'Admin/role');
	}

	public function roleAccess($role_id)
	{
		$data['judul'] = 'Role';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 3);
		$data['menu'] = $this->db->get('user_menu')->result();

		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_roleAccess');
		$this->load->view('admin/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$where = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->M_galsline->edit_data($where, 'user_access_menu')->num_rows();

		if ($result < 1) {
			$this->M_galsline->insert_data($where, 'user_access_menu');
		} else {
			$this->M_galsline->delete_data($where, 'user_access_menu');
		}

		$this->session->set_flashdata('aksesBerubah', '<div class="alert alert-success" role="alert">Akses Telah Diubah!</div>');
	}

	public function pendaftaranAdmin()
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 3) {
			$data['judul'] = 'Pendaftaran Admin';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['role'] = $this->M_galsline->get_data('user_role')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_pendaftaranAdmin');
			$this->load->view('admin/footer');
		} else {
			redirect(base_url() . 'Admin');
		}

	}

	public function myProfileAdmin()
	{
		$data['judul'] = 'Profile Saya';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/v_myProfile');
		$this->load->view('Admin/footer');
	}

	public function editProfileAdmin()
	{
		htmlspecialchars($username = $this->input->post('username', true));
		htmlspecialchars($image = $this->input->post('image', true));
		htmlspecialchars($alamat = $this->input->post('alamat', true));
		htmlspecialchars($no_telp = $this->input->post('no_telp', true));
		$this->form_validation->set_rules('image', 'Gambar', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');
		if ($this->form_validation->run() == true) {
			//configurasi upload gambar
			$config['upload_path'] = './assets/img/gambarUser/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'image' . time();

			$this->load->library('upload', $config);
			$where = array('username' => $username);
			$data = array(
				'image' => $image,
				'alamat' => $alamat,
				'no_telp' => $no_telp,
			);

			if ($this->upload->do_upload('image')) {
				$image = $this->upload->data();
				unlink('assets/img/gambarUser/' . $this->input->post('image', true));
				$data['image'] = $image['file_name'];
				$this->M_galsline->update_data('admin', $data, $where);
			} else {
				$this->M_galsline->update_data('admin', $data, $where);
			}
			$this->session->set_flashdata('berhasil edit', 'ok');
			redirect(base_url() . 'Admin/myProfileAdmin');
		} else {
			$data['judul'] = 'My Profile';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$this->load->view('Admin/header', $data);
			$this->load->view('Admin/v_myProfile');
			$this->load->view('Admin/footer');
		}
	}

	public function gantiPassword()
	{
		$data['judul'] = 'Ganti Password';
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$this->load->view('Admin/header', $data);
		$this->load->view('Admin/v_gantiPassword');
		$this->load->view('Admin/footer');
	}

	public function gantiPasswordAct()
	{
		htmlspecialchars($username = $this->input->post('username', true));
		htmlspecialchars($password = $this->input->post('password', true));
		htmlspecialchars($password2 = $this->input->post('password2', true));
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'min_length' => 'password to short.',
			'matches' => 'password dont matches.'
		]);
		$this->form_validation->set_rules('password2', 'password2', 'required|trim');

		if ($this->form_validation->run() == true) {
			$where = array('email' => $username);
			$data = array(
				'password' => password_hash($password, PASSWORD_DEFAULT)
			);

			$this->M_galsline->update_data('user', $data, $where);
			$this->session->set_flashdata('ganti password', 'ok');
			redirect(base_url() . 'Admin/gantiPassword');
		} else {
			$data['judul'] = 'Changed Password';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$this->load->view('Admin/header', $data);
			$this->load->view('Admin/v_gantiPassword');
			$this->load->view('Admin/footer');
		}
	}

	public function daftarBarang()
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 3) {
			$data['judul'] = 'Daftar Barang';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['supplier'] = $this->M_galsline->get_data('supplier')->result();
			$data['barang'] = $this->M_galsline->get_data('barang')->result();
			$this->load->view('Admin/header', $data);
			$this->load->view('Admin/v_daftarBarang');
			$this->load->view('Admin/footer');
		} else {
			redirect(base_url() . 'Admin');
		}
	}


	public function tambahBarang()
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 3) {
			htmlspecialchars($kd_barang = $this->input->post('kd_barang', true));
			htmlspecialchars($nama_supplier = $this->input->post('nama_supplier', true));
			htmlspecialchars($nama_barang = $this->input->post('nama_barang', true));
			htmlspecialchars($satuan = $this->input->post('satuan', true));
			htmlspecialchars($harga_beli = $this->input->post('harga_beli', true));
			htmlspecialchars($harga_jual = $this->input->post('harga_jual', true));

			$this->form_validation->set_rules('kd_barang', 'Kode Supplier', 'required|is_unique[barang.kd_barang]', [
				'is_unique' => 'input again.Kode barang already exist!'
			]);
			$this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'required|trim');
			$this->form_validation->set_rules('nama_barang', 'Nama barang', 'required|trim');
			$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim');
			$this->form_validation->set_rules('harga_beli', 'Harga beli', 'required|trim|numeric');
			$this->form_validation->set_rules('harga_jual', 'Harga jual', 'required|numeric|trim');

			if ($this->form_validation->run() == true) {
				//configurasi upload gambar
				$config['upload_path'] = './assets/upload/imageBarang';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['file_name'] = 'image' . time();

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$image = $this->upload->data();


					$kd_sup = $this->db->query("SELECT * FROM supplier WHERE nama = '$nama_supplier'")->row_array();
					$kd_supplier = $kd_sup['kd_supplier'];
					$data = array(
						'kd_barang' => $kd_barang,
						'kd_supplier' => $kd_supplier,
						'nama_barang' => $nama_barang,
						'satuan' => $satuan,
						'harga_jual' => $harga_jual,
						'harga_beli' => $harga_beli,
						'image' => $image['file_name']
					);

					$data2 = array(
						'kd_barang' => $kd_barang,
						'nama_barang' => $nama_barang,
						'stok' => '0',
						'status' => '0'
					);

					$this->M_galsline->insert_data($data, 'barang');
					$this->M_galsline->insert_data($data2, 'stok_barang');
					$this->session->set_flashdata('alert', 'ok');
					redirect(base_url() . 'Admin/daftarBarang');

				} else {
					$this->session->set_flashdata('no picture', '<div class="alert alert-danger" role="alert">Gambar barang harus ada. Isi file gambar pada form diatas!</div>');
					$data['judul'] = "Daftar Barang";
					$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
					$data['barang'] = $this->M_galsline->get_data('barang')->result();
					$data['supplier'] = $this->M_galsline->get_data('supplier')->result();
					$this->load->view('admin/header', $data);
					$this->load->view('admin/v_daftarBarang');
					$this->load->view('admin/footer');
				}

			} else {
				$data['judul'] = "Daftar Barang";
				$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
				$data['barang'] = $this->M_galsline->get_data('barang')->result();
				$data['supplier'] = $this->M_galsline->get_data('supplier')->result();
				$this->load->view('admin/header', $data);
				$this->load->view('admin/v_daftarBarang');
				$this->load->view('admin/footer');
			}

		} else {
			redirect(base_url() . 'Admin');
		}
	}

	public function detailBarang($kd)
	{
		$role_id = $this->session->userdata['role_id'];
		if ($role_id == 3) {
			$data['judul'] = "Daftar Barang";
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['detail'] = $this->db->query("SELECT * FROM barang B, supplier S WHERE B.kd_supplier = S.kd_supplier AND kd_barang = '$kd'")->result();
			$data['supplier'] = $this->M_galsline->get_data('supplier')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_editBarang');
			$this->load->view('admin/footer');
		} else {
			redirect(base_url() . 'Admin');
		}
	}

	public function editBarang()
	{
		$role_id = $this->session->userdata['role_id'];
		if ($role_id == 3) {
			htmlspecialchars($kd_barang = $this->input->post('kd_barang', true));
			htmlspecialchars($nama_barang = $this->input->post('nama_barang', true));
			htmlspecialchars($nama = $this->input->post('nama', true));
			htmlspecialchars($satuan = $this->input->post('satuan', true));
			htmlspecialchars($harga_beli = $this->input->post('harga_beli', true));
			htmlspecialchars($harga_jual = $this->input->post('harga_jual', true));
			$image = $this->input->post('image', true);

			$this->form_validation->set_rules('nama_barang', 'Nama barang', 'required|trim');
			$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim');
			$this->form_validation->set_rules('harga_beli', 'Harga beli', 'required|trim');
			$this->form_validation->set_rules('harga_jual', 'Harga jual', 'required|trim');


			if ($this->form_validation->run() == true) {
				//configurasi upload gambar
				$config['upload_path'] = './assets/upload/imageBarang';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['file_name'] = 'image' . time();

				$this->load->library('upload', $config);

				$kd_sup = $this->db->query("SELECT * FROM supplier WHERE nama = '$nama'")->row_array();
				$kd_supplier = $kd_sup['kd_supplier'];
				$where = array('kd_barang' => $kd_barang);
				$data = array(
					'nama_barang' => $nama_barang,
					'kd_supplier' => $kd_supplier,
					'satuan' => $satuan,
					'harga_jual' => $harga_jual,
					'harga_beli' => $harga_beli,
					'image' => $image
				);

				$data2 = array(
					'nama_barang' => $nama_barang
				);

				if ($this->upload->do_upload('image')) {
			          //proses upload gambar
					$image = $this->upload->data();
					unlink('assets/upload/imageBarang' . $this->input->post('image', true));
					$data['image'] = $image['file_name'];
					$this->M_galsline->update_data('barang', $data, $where);
					$this->M_galsline->update_data('stok_barang', $data2, $where);
				} else {
					$this->M_galsline->update_data('barang', $data, $where);
					$this->M_galsline->update_data('stok_barang', $data2, $where);
				}
				$this->session->set_flashdata('berhasil edit', 'ok');
				redirect(base_url() . 'Admin/daftarBarang');

			} else {
				$data['judul'] = "Daftar Barang";
				$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
				$data['detail'] = $this->db->query("SELECT * FROM barang B, supplier S WHERE B.kd_supplier = S.kd_supplier AND kd_barang = '$kd_barang'")->result();
				$this->load->view('admin/header', $data);
				$this->load->view('admin/v_editBarang');
				$this->load->view('admin/footer');
			}
		} else {
			redirect(base_url() . 'Admin');
		}
	}

	public function hapusBarang($kd)
	{
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 3) {
			$where = array('kd_barang' => $kd);
			$this->M_galsline->delete_data($where, 'barang');
			$this->M_galsline->delete_data($where, 'stok_barang');
			redirect(base_url() . 'Admin/daftarBarang');
		} else {
			redirect(base_url() . 'Admin');
		}
	}

	public function supplier()
	{
		$role_id = $this->session->userdata('role_id');

		$data['judul'] = "Daftar Supplier";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$data['supplier'] = $this->M_galsline->get_data('supplier')->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_daftarSupplier');
		$this->load->view('admin/footer');
	}

	public function tambahSupplier()
	{
		htmlspecialchars($kd_supplier = $this->input->post('kd_supplier', true));
		htmlspecialchars($nama = $this->input->post('nama', true));
		htmlspecialchars($no_telp = $this->input->post('no_telp', true));
		htmlspecialchars($alamat = $this->input->post('alamat', true));


		$this->form_validation->set_rules('kd_supplier', 'Kode Supplier', 'required|is_unique[barang.kd_supplier]', [
			'is_unique' => 'Refresh this page.Kode Supplier already exist!'
		]);
		$this->form_validation->set_rules('nama', 'Nama Supplier', 'required|trim');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric|min_length[8]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);
		if ($this->form_validation->run() == true) {

			$data = array(
				'kd_supplier' => $kd_supplier,
				'nama' => $nama,
				'no_telp' => $no_telp,
				'alamat' => $alamat,
			);


			$this->M_galsline->insert_data($data, 'supplier');
			$this->session->set_flashdata('alert', 'ok');
			redirect(base_url() . 'Admin/supplier');

		} else {
			$data['judul'] = "Daftar Supplier";
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['supplier'] = $this->M_galsline->get_data('supplier')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_daftarSupplier');
			$this->load->view('admin/footer');
		}
	}

	public function detailSupplier($sp)
	{
		$data['judul'] = "Daftar Supplier";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$data['detail'] = $this->db->query("SELECT * FROM supplier WHERE kd_supplier = '$sp'")->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_editSupplier');
		$this->load->view('admin/footer');
	}

	public function editSupplier()
	{
		htmlspecialchars($kd_supplier = $this->input->post('kd_supplier', true));
		htmlspecialchars($nama = $this->input->post('nama', true));
		htmlspecialchars($no_telp = $this->input->post('no_telp', true));
		htmlspecialchars($alamat = $this->input->post('alamat', true));


		$this->form_validation->set_rules('kd_supplier', 'Kode Supplier', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama Supplier', 'required|trim');
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric|min_length[8]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);

		if ($this->form_validation->run() == true) {
			$where = array('kd_supplier' => $kd_supplier);
			$data = array(
				'kd_supplier' => $kd_supplier,
				'nama' => $nama,
				'no_telp' => $no_telp,
				'alamat' => $alamat,
			);


			$this->M_galsline->update_data('supplier', $data, $where);
			$this->session->set_flashdata('berhasil edit', 'ok');
			redirect(base_url() . 'Admin/supplier');

		} else {
			$data['judul'] = "Daftar Supplier";
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['detail'] = $this->M_galsline->get_data('supplier')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_editSupplier');
			$this->load->view('admin/footer');
		}
	}

	public function hapusSupplier($sp)
	{
		$role_id = $this->session->userdata('role_id');

		if($role_id == 3) {
		$where = array('kd_supplier' => $sp);
		$this->M_galsline->delete_data($where, 'supplier');
		redirect(base_url() . 'Admin/Supplier');
		} else {
			redirect(base_url().'Admin');
		}
	}

	public function stokBarang()
	{
		$data['judul'] = "Stok Barang";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$data['stok'] = $this->M_galsline->get_data('stok_barang')->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_stokBarang');
		$this->load->view('admin/footer');
	}

	public function detailStok($kd)
	{
		$data['judul'] = "Stok Barang";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$data['stok'] = $this->db->query("SELECT * FROM stok_barang S, barang B WHERE S.kd_barang = B.kd_barang AND S.kd_barang = '$kd' ")->result();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_editStokBarang');
		$this->load->view('admin/footer');
	}

	public function updateStok()
	{
		$data['judul'] = "Stok Barang";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();

		htmlspecialchars($kd_barang = $this->input->post('kd_barang', true));
		htmlspecialchars($stok = $this->input->post('stok', true));
		htmlspecialchars($status = $this->input->post('status', true));

		$this->form_validation->set_rules('stok', 'Stok', 'required|trim');
		$this->form_validation->set_rules('status', 'Status Barang', 'required|trim');

		if ($this->form_validation->run() == true) {
			$where = array('kd_barang' => $kd_barang);

			$data = array(
				'stok' => $stok,
				'status' => $status
			);

			$this->M_galsline->update_data('stok_barang', $data, $where);
			$this->session->set_flashdata('berhasil update', 'ok');
			redirect(base_url() . 'Admin/stokBarang');
		} else {
			$data['judul'] = "Stok Barang";
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['stok'] = $this->M_galsline->get_data('stok_barang')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_stokBarang');
			$this->load->view('admin/footer');
		}
	}

	public function pemesanan($noPemesanan = 0, $idPemesanan = 0)
	{
		$role_id = $this->session->userdata('role_id');
		$data['judul'] = "Daftar Pemesanan";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$data['detailPemesanan'] = $this->db->query("SELECT * FROM detail_pemesanan WHERE no_pemesanan = '$noPemesanan'  ")->result();
		$data['dataPemesan'] = $this->db->query("SELECT * FROM pemesanan WHERE no_pemesanan = '$noPemesanan' AND id_pemesanan = '$idPemesanan' ")->result();
		$data['pembayaran'] = $this->db->query("SELECT * FROM pembayaran WHERE no_pemesanan = '$noPemesanan' AND id_pemesanan = '$idPemesanan' ")->result();
		$data['pemesanan'] = $this->M_galsline->get_data('pemesanan')->result();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_pemesanan');
			$this->load->view('admin/footer');
	}

	public function getPembayaran()
	{
		$no = $_POST['no'];
		$id = $_POST['id'];
		$data = $this->db->query("SELECT * FROM pemesanan WHERE no_pemesanan = '$no' AND id_pemesanan = '$id' ")->result();

		echo json_encode($data);
	}

	public function getEditPembayaran()
	{
		$no = $_POST['no'];
		$id = $_POST['id'];

		$data = $this->db->query("SELECT * FROM pemesanan P, pembayaran PB WHERE P.no_pemesanan = '$no' AND P.id_pemesanan = '$id' AND PB.id_pemesanan = '$id' ")->result();

		echo json_encode($data);
	}

	public function bayarPemesananAct()
	{
		$admin = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();

		htmlspecialchars($id_pemesanan = $this->input->post('id_pemesanan', true));
		htmlspecialchars($no_pemesanan = $this->input->post('no_pemesanan', true));
		htmlspecialchars($id_member = $this->input->post('id_member', true));
		htmlspecialchars($jumlah_tranfer = $this->input->post('jumlah_tranfer', true));
		htmlspecialchars($nama_bank = $this->input->post('nama_bank', true));
		htmlspecialchars($status_pembayaran = $this->input->post('status_pembayaran', true)); 

		$this->form_validation->set_rules('id_pemesanan', 'ID Pemesanan', 'trim|required');
		$this->form_validation->set_rules('no_pemesanan', 'Nomor Pemesanan', 'trim|required');
		$this->form_validation->set_rules('id_member', 'ID Member', 'trim|required');
		$this->form_validation->set_rules('jumlah_tranfer', 'Jumlah Tranfer', 'trim|required|numeric',[
			'required' => 'Anda Belum Mengisi Jumlah Tranfer. Isikan Jumlah Tranfer Dan Pastikan Jumlah Tranfer Sesuai dengan Total Bayar Pemesanan.'
		]);
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('gagal','<div class="alert alert-danger pl-3" role="alert">'. form_error('jumlah_tranfer').form_error('nama_bank').'</div>');
			redirect(base_url() . 'Admin/pemesanan/'.$no_pemesanan.'/'.$id_pemesanan);
		} else {
			$data = array(
				'no_pembayaran' => $this->M_galsline->kode_pembayaran($id_member),
				'id_pemesanan' =>  $id_pemesanan,
				'no_pemesanan' => $no_pemesanan,
				'tgl_bayar' => time(),
				'jumlah_tranfer' => $jumlah_tranfer,
				'id_admin' => $admin['id_admin'],
				'nama_admin' => $admin['nama'],
				'nama_bank' => $nama_bank
			);

			$data2 = array('status_pembayaran' => 1);

			$data3 = array('status_pembayaran' => $status_pembayaran );

			$where = array(
				'id_pemesanan' =>  $id_pemesanan,
				'no_pemesanan' => $no_pemesanan
			);

			if(isset($status_pembayaran)){
				$this->M_galsline->update_data('pemesanan', $data3, $where);
				$this->M_galsline->update_data('pembayaran', $data, $where);
				if($status_pembayaran == 0){
					$this->M_galsline->delete_data($where, 'pembayaran');
				}
				$this->session->flashdata('editPemesanan', 'ok');
				redirect(base_url() . 'Admin/pemesanan/'.$no_pemesanan.'/'.$id_pemesanan);
			}else{
				$this->M_galsline->insert_data($data, 'pembayaran');
				$this->M_galsline->update_data('pemesanan', $data2, $where);
				redirect(base_url() . 'Admin/pemesanan/'.$no_pemesanan.'/'.$id_pemesanan);
			}
		
		}
	}

	public function editPemesanan($noPemesanan, $idPemesanan){
		$role_id = $this->session->userdata('role_id');
		if( $role_id != 3){
			redirect('Admin');
		} else{
			$data['judul'] = 'Edit Pemasanan';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$data['detailPemesanan'] = $this->db->query("SELECT * FROM detail_pemesanan WHERE no_pemesanan = '$noPemesanan'  ")->result();
			$data['dataPemesan'] = $this->db->query("SELECT * FROM pemesanan WHERE no_pemesanan = '$noPemesanan' AND id_pemesanan = '$idPemesanan' ")->result();
			$data['pembayaran'] = $this->db->query("SELECT * FROM pembayaran WHERE no_pemesanan = '$noPemesanan' AND id_pemesanan = '$idPemesanan' ")->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_editPemesanan');
			$this->load->view('admin/footer');
		}

	}

	public function daftarPembayaran()
	{
		$data['judul'] = "Daftar Pembayaran";
		$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
		$data['pembayaran'] = $this->M_galsline->get_data('pembayaran')->result();

		$this->load->view('admin/header', $data);
		$this->load->view('admin/v_daftarPembayaran');
		$this->load->view('admin/footer');
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */