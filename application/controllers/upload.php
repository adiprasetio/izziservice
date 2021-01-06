<?php 

class Upload extends CI_Controller{

	function __construct(){
		parent::__construct();
		error_reporting(0); 
		  $this->load->helper(array('form', 'url'));
	}

	public function index(){
		$this->load->view('v_upload', array('error' => ' ' ));
	}

	public function aksi_upload(){
		$config['upload_path']          = './izzi/images';
		$config['allowed_types']        = 'pdf|jpg|png|jpeg';
		$config['max_size']             = 10;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('v_upload', $error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('v_upload_success', $data);
		}
	}

	public function index()
	{
		$data['upload'] = $this->db->get('upload');
		$this->load->view('upload',$data);
	}
}