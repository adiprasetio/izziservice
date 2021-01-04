<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index(){
        $this->load->view('Admin');
    }

    public function data_driver($value='')
    {
    	# code...
    }

    public function data_pesanan($value='')
    {
    	# code...
    }

}