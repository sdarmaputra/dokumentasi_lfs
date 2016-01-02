<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_User extends CI_Controller {
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('M_User');
        if (!empty($this->session->userdata('iduser'))) { 
        	$role = explode('_', $this->session->userdata('kelas'));
        	if ($role[0]  == 'special') {
        		redirect(site_url($role[1]));	
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
			$data['daftar_dokumentasi'] = $this->M_User->getDataDokumentasi($this->session->userdata('iduser'));
			$this->template->load('dashboard', 'v_dashboard', $data);
		} else redirect(site_url('auth'));
	}
	public function getDataDokumentasi()
	{
		$data=$this->M_User->getDataDokumentasi($this->session->iduser);
		$output = [];
		$output['data'] = $data;
		echo json_encode($output);
	}
	public function insertDataDokumentasi()
	{
		$judul=$this->input->post('judul');
		$keterangan=$this->input->post('keterangan');
		$nrp=$this->input->post('nrp');
		$iduser=$this->session->iduser;
		$nrp_count = sizeof($nrp);
		for ($i = 0; $i < $nrp_count; $i++) {
			$data = array(
		        'waktu' => date('Y-m-d H:i:s'),
		        'judul' => $judul,
		        'keterangan' => $keterangan,
		        'user_iduser' => $iduser,
		        'nrp' => $nrp[$i]
			);
			$this->M_User->insertDataDokumentasi($data);	
		}
		redirect(site_url('user?page=dokumentasi'));
	}
	public function deleteDataDokumentasi($id)
	{
		$this->M_User->deleteDataDokumentasi($id);
		redirect(site_url('user?page=dokumentasi'));
	}
	public function insertDataMahasiswa()
	{
		$nrp=$this->input->post('nrp');
		$nama=$this->input->post('nama');
		$iduser=$this->session->iduser;
		$data = array(
	        'nama' => $nama,
	        'user_iduser' => $iduser,
	        'nrp' => $nrp
		);
		$this->M_User->insertDataMahasiswa($data);
		redirect(site_url('user?page=anggota_tim'));
	}
	public function getDataMahasiswa()
	{
		$data=$this->M_User->getDataMahasiswa($this->session->iduser);
		echo json_encode($data);
	}
	public function deleteDataMahasiswa($id)
	{
		$this->M_User->deleteDataMahasiswa($id);
		redirect(site_url('user?page=anggota_tim'));
	}
	public function getPartisipasi($iduser) {
		$data = $this->M_User->getPartisipasi($iduser);
		echo json_encode($data);
	}
}
