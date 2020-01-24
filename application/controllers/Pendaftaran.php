<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{

	public function pendaftaranRetail()
	{
		htmlspecialchars($nama = $this->input->post('nama', true));
		htmlspecialchars($noKtp = $this->input->post('noKtp', true));
		htmlspecialchars($alamat = $this->input->post('alamat', true));
		htmlspecialchars($namaRetail = $this->input->post('namaRetail', true));
		htmlspecialchars($alamatRetail = $this->input->post('alamatRetail', true));
		htmlspecialchars($noTlpn = $this->input->post('noTlpn', true));
		htmlspecialchars($email = $this->input->post('email', true));
		htmlspecialchars($password = $this->input->post('password', true));
		htmlspecialchars($password2 = $this->input->post('password2', true));

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('noKtp', 'Nomor KTP', 'required|min_length[16]|numeric|trim|is_unique[member.no_ktp]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);
		$this->form_validation->set_rules('namaRetail', 'Nama Retail', 'required|trim');
		$this->form_validation->set_rules('alamatRetail', 'Alamat Retail', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);
		$this->form_validation->set_rules('noTlpn', 'Nomor Telepon', 'required|numeric|trim|min_length[5]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[member.email]', [
			'is_unique' => 'This email already registered.'
		]);
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]|matches[password2]', [
			'min_length' => 'password to short.',
			'matches' => 'password dont matches.'
		]);
		$this->form_validation->set_rules('password2', 'password2', 'required|trim|matches[password]');

		if ($this->form_validation->run() == true) {
			$data = array(
				'id_member' => '',
				'nama' => $nama,
				'no_ktp' => $noKtp,
				'alamat' => $alamat,
				'nama_retail' => $namaRetail,
				'alamat_retail' => $alamatRetail,
				'no_telp' => $noTlpn,
				'email' => $email,
				'image' => 'default.png',
				'date_created' => time()
			);

			$data1 = array(
				'id' => '',
				'name' => $nama,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role_id' => 1,
				'is_active' => 1,
				'date_created' => time()
			);

			$this->M_galsline->insert_data($data, 'member');
			$this->M_galsline->insert_data($data1, 'user');
			$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
			Pendaftaran Anda berhasil dilakukan. silahkan Konfirmasi pendaftaran Anda melalui email yang kami Kirim dan
			Login dibawah ini!
			</div>');
			redirect(base_url() . 'Login');

		} else {
			$data['judul'] = "-> GALSLINE <-";
			$this->session->set_flashdata('gagal', 'ok');
			$this->load->view('part/header', $data);
			$this->load->view('v_home');
			$this->load->view('part/footer');
		}
	}
	public function daftarAdmin()
	{
		$data['judul'] = 'Daftar Admin';
		$this->load->view('admin/v_daftarAdmin', $data);
	}

	public function daftarAdminAct()
	{
		htmlspecialchars($nama = $this->input->post('nama', true));
		htmlspecialchars($no_ktp = $this->input->post('no_ktp', true));
		htmlspecialchars($alamat = $this->input->post('alamat', true));
		htmlspecialchars($no_telp = $this->input->post('no_telp', true));
		htmlspecialchars($role_id = $this->input->post('role_id', true));
		htmlspecialchars($username = $this->input->post('username', true));
		htmlspecialchars($password = $this->input->post('password', true));
		htmlspecialchars($password1 = $this->input->post('password1', true));

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|min_length[15]|numeric|trim|is_unique[admin.no_ktp]', [
			'is_unique' => 'This KTP number already registered.'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[15]', [
			'min_length' => 'Enter the correct address.'
		]);
		$this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|numeric|trim|min_length[8]');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admin.username]', [
			'is_unique' => 'This username already registered.'
		]);
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]|matches[password1]', [
			'min_length' => 'password to short.',
			'matches' => 'password dont matches.'
		]);
		$this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|trim');

		if ($this->form_validation->run() == true) {
			$data = array(
				'id_admin' => '',
				'nama' => $nama,
				'no_ktp' => $no_ktp,
				'alamat' => $alamat,
				'no_telp' => $no_telp,
				'username' => $username,
				'image' => 'default.png',
				'date_created' => time()
			);

			$data1 = array(
				'id' => '',
				'name' => $nama,
				'email' => $username,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'role_id' => $role_id,
				'is_active' => 1,
				'date_created' => time()
			);

			$this->M_galsline->insert_data($data, 'admin');
			$this->M_galsline->insert_data($data1, 'user');
			$this->session->set_flashdata('alert', '<div class="alert alert-success" role="alert">
			Admin baru telah ditambahkan!
			</div>');
			redirect(base_url() . 'Admin/pendaftaranAdmin');

		} else {
			$data['judul'] = 'Daftar Admin';
			$data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('email')])->row_array();
			$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
			registarasi gagal! pastikan semua form terisi dengan benar.
			</div>');
			$data['role'] = $this->M_galsline->get_data('user_role')->result();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_pendaftaranAdmin');
			$this->load->view('admin/footer');
		}
	}

}

/* End of file Pendaftaran.php */
/* Location: ./application/controllers/Pendaftaran.php */