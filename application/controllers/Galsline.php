<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galsline extends CI_Controller {

public function index(){
		$data['judul'] = "-> GALSLINE <-" ;							
		$this->load->view('part/header', $data);
		$this->load->view('v_home');
		$this->load->view('part/footer');
	}

public function adminGalsline()
	{
		if ($this->session->userdata('email')) {
            redirect('Admin');
        }
		$data['judul'] = 'Halaman Login';
		$this->load->view('admin/v_login', $data);
	}
	
}

/* End of file Galsline.php */
/* Location: ./application/controllers/Galsline.php */