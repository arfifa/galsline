<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('Member');
		}
		$data['judul'] = 'Halaman Login';
		$this->load->view('member/v_login', $data);
	}


	public function loginActMember()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Halaman Login';
			$this->load->view('member/v_login', $data);
		} else {
			$this->_loginMember();
		}

	}

	public function loginActAdmin()
	{
		$this->form_validation->set_rules('email', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Halaman Login';
			$this->load->view('admin/v_login', $data);
		} else {
			$email = strpos($this->input->post('email', true), "@");
			if ($email != 0) {
				$data['judul'] = 'Halaman Login';
				$this->load->view('admin/v_login', $data);
			} else {
				$this->_loginAdmin();
			}
		}
	}

	private function _loginMember()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		$where = array('email' => $email);

		$cek = $this->M_galsline->edit_data($where, 'user')->row_array();

		if ($cek) {
			//jika user aktif
			if ($cek['is_active'] == 1) {
				if (password_verify($password, $cek['password'])) {
					$data = [
						'email' => $cek['email'],
						'role_id' => $cek['role_id'],
						'nama' => $cek['name']
					];
					if ($cek['role_id'] == 1) {
						$this->session->set_userdata($data);
						redirect(base_url() . 'Member');
					} else {
						$this->session->set_userdata($data);
						redirect(base_url() . 'Login/blocked');
					}
				} else {
					$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
					Password salah!</div>');
					redirect(base_url() . 'Login');
				}

			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning" role="alert">
				email ini belum melakukan aktivasi, cek email anda dan lakukan aktivasi.</div>');
				redirect(base_url() . 'Login');
			}

		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
		email tidak terdaftar!</div>');
			redirect(base_url() . 'Login');
		}

	}

	private function _loginAdmin()
	{
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);

		$where = array('email' => $email);

		$cek = $this->M_galsline->edit_data($where, 'user')->row_array();

		if ($cek) {
			//jika user aktif
			if ($cek['is_active'] == 1) {
				if (password_verify($password, $cek['password'])) {
					$data = [
						'email' => $cek['email'],
						'role_id' => $cek['role_id'],
						'nama' => $cek['name']
					];
					if ($cek['role_id'] != 1) {
						$this->session->set_userdata($data);
						redirect(base_url() . 'Admin');
					}
				} else {
					$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
					password salah!</div>');
					redirect(base_url() . 'Galsline/adminGalsline');
				}

			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-warning" role="alert">
				username ini belum diaktifasi!</div>');
				redirect(base_url() . 'Galsline/adminGalsline');
			}

		} else {
			$this->session->set_flashdata('alert', '<div class="alert alert-danger" role="alert">
		username tidak terdaftar!</div>');
			redirect(base_url() . 'Galsline/adminGalsline');
		}

	}

	public function blocked()
	{
		$this->load->view('blocked');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */