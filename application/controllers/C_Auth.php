<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Auth extends CI_Controller {

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
		if(!empty($this->session->userdata('iduser')))
		{
			echo "redirect ke c_user/";
		}
		else $this->load->view('login');
		

	}
	public function login()
	{
		if(!empty($this->session->userdata('iduser')))
		{
			echo "redirect ke c_user/";
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
				echo "redirect ke c_user/";
			}
			else echo "redirect ke c_auth/";
		}
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		echo "redirect ke c_auth/";	
	}
}
