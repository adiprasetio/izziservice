<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
        parent::__construct();
        error_reporting(0); 
        $this->load->model('Model_app');

        
        
    }

    
function index()
    {
    	
        $this->load->view('login');

    }


  function login_akses()
  {

  	$username = trim($this->input->post('username'));
  	$password = md5(trim($this->input->post('password')));
  	
	$akses = $this->db->query("select A.username, B.nama, A.level, B.id_jabatan, C.id_dept FROM user A 
		LEFT JOIN karyawan B ON B.nik = A.username
        LEFT JOIN bagian_departemen C ON C.id_bagian_dept = B.id_bagian_dept
	 WHERE (A.username = '$username' OR A.email = '$username') AND A.password = '$password'");

    if($akses->num_rows() == 1)
	{
	
	foreach($akses->result_array() as $data)
	{

	$session['id_user'] = $data['username'];
	$session['nama'] = $data['nama'];
	$session['level'] = $data['level'];
	$session['id_jabatan'] = $data['id_jabatan'];
	$session['id_dept'] = $data['id_dept'];
	
	$this->session->set_userdata($session);
    redirect('home');
	}
	
	}
	else
	{
	$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Wrong Username and Password.
			    </div>");
	redirect('login');
	}

	
  }


  public function logout() {


  $this->session->sess_destroy();
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");

  redirect('login');
    


}


    
}
