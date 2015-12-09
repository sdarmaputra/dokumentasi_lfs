<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Template {
	var $ci;
	function __construct() {
		$this->ci =& get_instance();
	}	

	function load($base=null, $body_content=null, $data=null) {
		// Append body_content content
		if (!is_null($body_content)) {			
			$body_content = $this->ci->load->view($base.'/'.$body_content, $data, TRUE);	
		} else $body_content = null;

		// Set up assets and footer
		$assets_content = $this->ci->load->view('base/v_assets_content', $data, TRUE);
		$footer_content = $this->ci->load->view('base/v_footer_content', $data, TRUE);
		$scripts_content = $this->ci->load->view('base/v_scripts_content', $data, TRUE);

		// Append elements to data content
		if (is_null($data)) {
			$data = array(
				'assets_content' => $assets_content,
				'body_content' => $body_content,
				'footer_content' => $footer_content,
				'scripts_content' => $scripts_content
			);
		} else if (is_array($data)) {
			$data['assets_content'] = $assets_content;
			$data['body_content'] = $body_content;
			$data['footer_content'] = $footer_content;
			$data['scripts_content'] = $scripts_content;
		}

		// Append elements to template
		$this->ci->load->view('base/template/v_'.$base.'_template', $data);
	}
}
?>