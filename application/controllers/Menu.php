<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct(){
	parent:: __construct();
	//cek login
		is_logged_in();
	}

	public function index($id = 0)
	{
		htmlspecialchars($menu = $this->input->post('menu') );
		$this->form_validation->set_rules('menu', 'Menu', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = 'Menu Manajemen';
			$data['user'] = $this->db->get_where('admin',['username' => $this->session->userdata('email')])->row_array();
			$data['menu'] = $this->M_galsline->get_data('user_menu')->result();

			$id = array ( 'id' => $id );
			$data['datamenu'] = $this->M_galsline->edit_data($id, 'user_menu')->result();
			if($id != 0){
				$this->session->set_flashdata('edit_menu', 'tampil');
			}
			
			$this->load->view('admin/header', $data);
			$this->load->view('menu/index');
			$this->load->view('admin/footer');
			
		} else {
			$this->M_galsline->insert_data(['menu' => $menu], 'user_menu');
			$this->session->set_flashdata('add_menu', 'ok');
			redirect(base_url().'Menu');
		}
		
	}

	public function editMenuAct($oldmenu)
	{
		htmlspecialchars($menu = $this->input->post('menu') );
		htmlspecialchars($id = $this->input->post('id') );

		$this->form_validation->set_rules('menu', 'Menu', 'trim|required');

		if( $this->form_validation->run() == TRUE){
		$where = array('id' => $id);
		$data = array(
			'menu' => $menu
		);

		$this->M_galsline->update_data('user_menu', $data, $where);
		$this->session->set_flashdata('berhasil_edit', '<div class="alert alert-success" role="alert">Menu '.$oldmenu.' berhasil diganti dengan '.$menu. '!</div>');
		redirect(base_url().'Menu');
		}else{
		redirect(base_url().'Menu');
		}
	}

	public function hapusMenu($id)
	{
		$where = array('id' => $id );
		$this->M_galsline->delete_data($where, 'user_menu');
		$this->session->set_flashdata('hapusMenu', 'ok');
		redirect(base_url().'Menu');
	}


	public function subMenu($id_subMenu = 0)
	{
		htmlspecialchars($title = $this->input->post('title') );
		htmlspecialchars($menu = $this->input->post('menu') );
		htmlspecialchars($url = $this->input->post('url') );
		htmlspecialchars($icon = $this->input->post('icon') );
		htmlspecialchars($is_active = $this->input->post('is_active') );

		$data = array(
			'title' => $title,
			'menu_id' => $menu,
			'url' => $url,
			'icon' => $icon,
			'is_active' => $is_active
		);

		$this->form_validation->set_rules('title', 'Nama Submenu', 'trim|required');
		$this->form_validation->set_rules('menu', 'Menu', 'trim|required');
		$this->form_validation->set_rules('url', 'Menu', 'trim|required');
		$this->form_validation->set_rules('icon', 'Icon', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = 'Submenu Manajemen';
			$data['user'] = $this->db->get_where('admin',['username' => $this->session->userdata('email')])->row_array();
			$data['submenu'] = $this->db->query("SELECT * FROM user_menu U, user_sub_menu S WHERE U.id = S.menu_id ORDER BY U.id ASC")->result();
			$data['menu'] = $this->M_galsline->get_data('user_menu')->result();

			$data['dataSubMenu'] = $this->db->query("SELECT * FROM user_menu U, user_sub_menu S WHERE U.id = S.menu_id AND S.id = '$id_subMenu' ")->result();
			if($id_subMenu != 0){
				$this->session->set_flashdata('edit_subMenu', 'tampil');
			}
			
			$this->load->view('admin/header', $data);
			$this->load->view('menu/v_subMenu');
			$this->load->view('admin/footer');
			
		} else {
			$this->M_galsline->insert_data($data, 'user_sub_menu');
			$this->session->set_flashdata('add_subMenu', 'ok');
			redirect(base_url().'Menu/subMenu');
		}
		
	}

	public function edit_subMenuAct($oldSubMenu)
	{
		htmlspecialchars($id = $this->input->post('id') );
		htmlspecialchars($title = $this->input->post('title') );
		htmlspecialchars($menu = $this->input->post('menu') );
		htmlspecialchars($url = $this->input->post('url') );
		htmlspecialchars($icon = $this->input->post('icon') );
		htmlspecialchars($is_active = $this->input->post('is_active') );

		$this->form_validation->set_rules('menu', 'Menu', 'trim|required');

		if( $this->form_validation->run() == TRUE){
		$where = array('id' => $id);
		$data = array(
			'title' => $title,
			'menu_id' => $menu,
			'url' => $url,
			'icon' => $icon,
			'is_active' => $is_active
		);

		$this->M_galsline->update_data('user_sub_menu', $data, $where);
		$this->session->set_flashdata('berhasil_editSubmenu', 'ok');
		redirect(base_url().'Menu/subMenu');
		}else{
		redirect(base_url().'Menu/subMenu');
		}
	}

	public function hapus_subMenu($id_subMenu)
	{
		$where = array('id' => $id_subMenu );
		$this->M_galsline->delete_data($where, 'user_sub_menu');
		$this->session->set_flashdata('hapus_subMenu', 'ok');
		redirect(base_url().'Menu/subMenu');
	}
}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */