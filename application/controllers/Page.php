<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		$this->load->model('Model_app');
		$data = array(
			'get_kategori' => $this->Model_app->get_kategori(), 
		);
		$this->load->view('index', $data);
	}

	public function kategori($value='')
	{
		# code...
	}
}
