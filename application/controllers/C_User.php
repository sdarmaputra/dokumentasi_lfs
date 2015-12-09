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
    }
    
	public function index()
	{
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
		echo json_encode($data);
	}
	public function insertDataDokumentasi()
	{
		$judul=$this->input->post('judul');
		$keterangan=$this->input->post('keterangan');
		$nrp=$this->input->post('nrp');
		$iduser=$this->session->iduser;
		$data = array(
	        'waktu' => date('Y-m-d H:i:s'),
	        'judul' => $judul,
	        'keterangan' => $keterangan,
	        'user_iduser' => $iduser,
	        'nrp' => $nrp
		);
		print_r($data);
		$this->M_User->insertDataDokumentasi($data);
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
		print_r($data);
		$this->M_User->insertDataMahasiswa($data);
	}
	public function getDataMahasiswa()
	{
		$data=$this->M_User->getDataMahasiswa($this->session->iduser);
		echo json_encode($data);
	}
	
	
}
