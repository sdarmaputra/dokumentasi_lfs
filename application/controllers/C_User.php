<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
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
		echo "dashboard";
	}
	public function getDataDokumentasi()
	{
		$data=$this->M_User->getDataDokumentasi($this->session->iduser);
		echo json_encode($data);
	}
	public function insertMahasiswa()
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
		$this->M_User->insertMahasiswa($data);
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
	
}
