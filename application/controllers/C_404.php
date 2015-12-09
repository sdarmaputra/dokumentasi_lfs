<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_404 extends CI_Controller {
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
		$this->load->view('base/v_404');
	}
}
