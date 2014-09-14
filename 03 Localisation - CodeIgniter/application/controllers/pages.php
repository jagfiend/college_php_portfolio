<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	public function view($page = 'home'){

		if ( ! file_exists('application/views/content_'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}

		// function calls header, content and footer views...
		$this->load->view("header");
		$this->load->view("content_".$page);
		$this->load->view("footer");

	} // end of view function...
} // end of controller...