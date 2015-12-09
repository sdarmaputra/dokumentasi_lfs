<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Auth extends CI_Controller {
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
			redirect(site_url('user'));
		}
		else {
			$data['page_title'] = 'Log In';
			$this->template->load('login', 'v_login', $data); 
		}
	}

	public function login()
	{
		if(!empty($this->session->userdata('iduser')))
		{
			redirect(site_url('user'));
		}
		else
		{
			
			$username = $this->input->post('username');
			$password =$this->input->post('password');
			$data = $this->M_User->auth($username,sha1($password));
			if(sizeof($data)>0)
			{
				$newdata = array(
			        'iduser'  => $data[0]->iduser,
			        'username'     => $data[0]->username,
			        'kelas' => $data[0]->kelas
				);
				$this->session->set_userdata($newdata);
				redirect(site_url('user'));
			}
			else redirect(site_url('auth'));
		}
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('auth'));
	}
}
