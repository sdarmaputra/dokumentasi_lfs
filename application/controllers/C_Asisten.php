<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Asisten extends CI_Controller {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('M_User');
        if (!empty($this->session->userdata('iduser'))) { 
        	$role = explode('_', $this->session->userdata('kelas'));
        	if (!$role[1] || $role[1] != 'asisten') {
        		redirect(site_url('user'));	
        	}
        }
        else if (empty($this->session->userdata('iduser'))) {
        	redirect(site_url('auth'));
        }
    }
    
	public function index()
	{
		$data['page_title'] = 'Dasbor';
		$page = $this->input->get('page');
		$this->session->set_flashdata('section', $page);
		if(!empty($this->session->userdata('iduser')))
		{
			$data['need_table'] = TRUE;
			$data['daftar_kelas'] = $this->M_User->getDaftarKelas();
			$this->template->load('dashboard', 'v_asisten_dashboard', $data);
		} else redirect(site_url('auth'));
	}
	public function getDataDokumentasi($iduser)
	{
		$data=$this->M_User->getDataDokumentasi($iduser);
		$output = [];
		$output['data'] = $data;
		echo json_encode($output);
	}
	
	public function getDataMahasiswa($iduser)
	{
		$data=$this->M_User->getDataMahasiswa($iduser);
		echo json_encode($data);
	}
	public function getDaftarKelompok($kelas) {
		$data=$this->M_User->getUserByKelas($kelas);
		echo json_encode($data);	
	}
	public function loadUserData() {
		$user = $this->input->post('kelompok');
		$kelas = $this->input->post('kelas');		
		$data_user = $this->M_User->getById($user);
		$this->session->set_userdata('loaded_user_data', $user);
		$this->session->set_userdata('loaded_user_data_name', $data_user['username']);
		$this->session->set_userdata('loaded_user_data_kelas', $kelas);
		redirect(site_url('asisten'));
	}
	
}
