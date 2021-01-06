<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

function __construct(){
        parent::__construct();
        $this->load->model('Model_app');
        error_reporting(0); 

        if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Please log in first
       </div>");
        redirect('login');
        }
        
    }


 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('nik', $id);
 	$this->db->delete('karyawan');

 	$this->db->trans_complete();
	
 }

 public function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_ticket";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id_user = trim($this->session->userdata('id_user'));

        //notification 


         $sql_listticket = "SELECT COUNT(A.id_ticket) AS jml_list_ticket FROM ticket A WHERE A.status = 2 OR A.status = 3 OR A.status = 4 OR A.status = 5 OR A.status = 6";
        $row_listticket = $this->db->query($sql_listticket)->row();
        $data['notif_list_ticket'] = $row_listticket->jml_list_ticket;
$sql_approvalticket = "SELECT COUNT(A.id_ticket) AS jml_approval_ticket FROM ticket A WHERE A.status = 1";
        $row_approvalticket = $this->db->query($sql_approvalticket)->row();

        $data['notif_approval'] = $row_approvalticket->jml_approval_ticket;

        $sql_assignmentticket = "SELECT COUNT(id_ticket) AS jml_assignment_ticket FROM ticket WHERE status = 3 AND id_teknisi='$id_user'";
        $row_assignmentticket = $this->db->query($sql_assignmentticket)->row();

        $data['notif_assignment'] = $row_assignmentticket->jml_assignment_ticket;

        //end notification
        
        $id_user = trim($this->session->userdata('id_user'));

        $cari_data = "SELECT A.nik, A.nama, A.id_institusi,D.nama_institusi, C.nama_dept, B.nama_bagian_dept FROM karyawan A
        							   LEFT JOIN bagian_departemen B ON B.id_bagian_dept = A.id_bagian_dept
        							   LEFT JOIN departemen C ON C.id_dept = A.id_bagian_dept
                                       LEFT JOIN institusi D ON D.id_institusi = A.id_institusi
        							   WHERE A.nik = '$id_user'";

        $row = $this->db->query($cari_data)->row();

        $data['id_ticket'] = "";

        $data['id_user'] = $id_user;
        $data['nama'] = $row->nama;
        $data['departemen'] = $row->nama_dept;
        $data['bagian_departemen'] = $row->nama_bagian_dept;
        $data['id_institusi'] = $row->id_institusi;		
        $data['institusi'] = $row->nama_institusi;
		
		$data['dd_kategori'] = $this->Model_app->dropdown_kategori();
		$data['id_kategori'] = "";

		$data['dd_kondisi'] = $this->Model_app->dropdown_kondisi();
		$data['id_kondisi'] = "";

		$data['problem_summary'] = "";
		$data['problem_detail'] = "";

		$data['status'] = "";
		$data['progress'] = "";

		$data['url'] = "ticket/save";

		$data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 function save()
 {

  $ticket                     = $this->Model_app->getkodeticket();
  $id_user                    = strtoupper(trim($this->input->post('id_user')));
  $data_usersql               = "SELECT A.nik, A.nama, A.alamat, A.email, B.level, B.level FROM KARYAWAN A LEFT JOIN user B ON B.username = A.nik WHERE A.nik ='$id_user'";

        $data_user = $this->db->query($data_usersql)->row();
        $email = $data_user->email;
          $username = $data_user->nama;
        //general
       
   $getkodeticket = $this->Model_app->getkodeticket();
  $ticket = $getkodeticket;

  $config = array(
                  'upload_path' => './uploads/'.$id_user.'/',
                  'allowed_types' => '*',
                  'overwrite' => TRUE,
                  'max_size' => '1024',
                  'encrypt_name' => TRUE
                );

                 $this->load->library('upload', $config);
                 $this->upload->initialize($config);

if ($_FILES["fileuser"]["type"] != 'image/png' && $_FILES["fileuser"]["type"] != 'image/jpg' && $_FILES["fileuser"]["type"] != 'image/jpeg' && $_FILES["fileuser"]["type"] != 'application/pdf' && !empty($_FILES['fileuser']['name'])) {
  $error = $this->upload->display_errors();

          $validator['success'] = false;
          $validator['status'] = 'error';
          $validator['messages'] = 'The filetype you are attempting to upload is not allowed';

          echo json_encode($validator);
}else{

    $path = 'uploads';
        if(!file_exists($path)){
             mkdir($path);
        }

     $path = 'uploads/'.$id_user;
        if(!file_exists($path)){
             mkdir($path);
        }


 if ($_FILES["fileuser"]["size"] < 1048576) {

  $this->upload->do_upload('fileuser');
  $fileuser = $this->upload->data();
  $userfile = $fileuser['file_name'];
                
  $tanggal                    = $time = date("Y-m-d H:i:s");
  $id_sub_kategori            = strtoupper(trim($this->input->post('id_sub_kategori')));
  $problem_summary            = strtoupper(trim($this->input->post('problem_summary')));
  $problem_detail             = strtoupper(trim($this->input->post('problem_detail')));
  $id_teknisi                 = strtoupper(trim($this->input->post('id_teknisi')));
  
    $data['id_ticket']        = $ticket;
    $data['reported']         = $id_user;
    $data['tanggal_proses']   = NULL;
    $data['tanggal']          = $tanggal;
    $data['id_sub_kategori']  = $id_sub_kategori;
    $data['problem_summary']  = $problem_summary;
    $data['problem_detail']   = $problem_detail;
    $data['id_teknisi']       = $id_teknisi;
    if ($_FILES["fileuser"]["type"] == NULL || $_FILES["fileuser"]["type"] == '') {
     $data['userfile'] = '';
    }else{
      $data['userfile']         = $id_user.'/'.$userfile;
    }
    $data['status']           = 1;
    $data['progress']         = 0;
    $data['id_kondisi']       = $this->input->post('id_kondisi');

    $tracking['id_ticket']    = $ticket;
    $tracking['tanggal']      = $tanggal;
     if ($_FILES["fileuser"]["type"] == NULL || $_FILES["fileuser"]["type"] == '') {
      $tracking['attachment']   = '';
    }else{
      $tracking['attachment']   = $id_user.'/'.$userfile;
    }
   
    $tracking['status']       = "Created Ticket";
    $tracking['deskripsi']    = "";
    $tracking['id_user']      = $id_user;
                
    // end upload gambar 

 	$this->db->trans_start();
 	$this->db->insert('ticket', $data);
 	$this->db->insert('tracking', $tracking);
 	$this->db->trans_complete();

				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
			    </div>");

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

          $mesg = $this->load->view('mail/open_tiket', $data,true);

          $this->email->from($this->config->item('email_username'), "ADMIN");
          
          $this->email->to($email);
          $this->email->cc($this->config->item('email_admin'));
          
          $this->email->subject($username.' [Ticket ID: '.$ticket.'] '.$problem_summary);
          $this->email->message($mesg);
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->email->set_header('Content-type', 'text/html');
          $this->email->send();

           $validator['success'] = true;
          $validator['status'] = 'success';
          $validator['messages'] = "Success";

       echo json_encode($validator);

         
			}else{
        $validator['success'] = false;
          $validator['status'] = 'error';
          $validator['messages'] = 'The file youare attempting to upload is larger than the permitted size';

          echo json_encode($validator);
      }
    }

      
		
 }

 


    
}
