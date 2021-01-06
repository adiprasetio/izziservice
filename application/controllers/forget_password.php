<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget_password extends CI_Controller {

	function __construct(){
        parent::__construct();
        error_reporting(0); 
        $this->load->model('Model_app');
        
    }

    
function index()
    {

        $this->load->view('Forget_password');
    }


 public function rst()
 {
 	$id_user = $this->uri->segment('3');
 	$this->load->view('resetpassword');
 }

 public function save_resetpassword()
 {
  $username = trim($this->input->post('username'));
  $password = md5(trim($this->input->post('password')));
  $cekuserbyuser['passwordkunci'] = $this->input->post('password');

  $update = $this->Model_app->save_resetpassword($username, $password);

  $cekuserbyuser['cekuserbyuser'] = $this->Model_app->cekuserbyuser($username);


  $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => $this->config->item('email_host'),
            'smtp_user' => $this->config->item('email_username'),  // Email gmail
            'smtp_pass'   => $this->config->item('email_password'),  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);


        $mesg = $this->load->view('mail/reset_password_success', $cekuserbyuser,true);

          $this->email->from($this->config->item('email_username'), "ADMIN");
          $this->email->to($this->config->item('email_admin'));
          $this->email->subject($username.' Telah mengganti Passwordnya');
          $this->email->message($mesg);
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->email->set_header('Content-type', 'text/html');

          if($this->email->send()) {
              $this->load->view('mail/success_resetpassword_end');
          }
          else {
           redirect();
             
          }
 
 }

 public function reset_password()
 {
 	$email = $this->input->post('email');
 	$this->load->model('Model_app');

 	$cekuserbymail['cekuserbymail'] = $this->Model_app->cekuserbymail($email);

   		  $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => $this->config->item('email_host'),
            'smtp_user' => $this->config->item('email_username'),  // Email gmail
            'smtp_pass'   => $this->config->item('email_password'),  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

          //$this->load->library('email');
		 //$this->email->initialize($config);

        $mesg = $this->load->view('mail/reset_password', $cekuserbymail,true);

          $this->email->from($this->config->item('email_username'), 'ADMIN');
          $this->email->to($email);
          $this->email->subject('izzi Password Change Request');
          $this->email->message($mesg);
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->email->set_header('Content-type', 'text/html');

          if($this->email->send()) {
              $this->load->view('mail/success_resetpassword');
          }
          else {
          	$this->load->view('mail/failed_resetpassword');
             
          }
 }



    
}
