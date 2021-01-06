<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myassignment extends CI_Controller {

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


 function myassignment_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/myassignment";

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
        
        
        $datamyassignment = $this->Model_app->datamyassignment($id_user);
	      $data['datamyassignment'] = $datamyassignment;
        
        $this->load->view('template', $data);
 }


 function terima($ticket)
 {


    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $tracking['id_ticket'] = $ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Diproses oleh teknisi";
    $tracking['deskripsi'] = "";
    $tracking['id_user'] = $id_user;

    $data['status'] = 4;
    $data['tanggal_proses'] = $tanggal;
  
    $this->db->trans_start();

    $this->db->where('id_ticket', $ticket);
    $this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

    $this->db->trans_complete();

     if ($this->db->trans_status() === FALSE)
            {
               
                redirect('myassignment/myassignment_list');   
            } else 
            {
                
                redirect('myassignment/myassignment_list');   
            }
 }

 function pending($ticket)
 {
    $data['status'] = 5;

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $tracking['id_ticket'] = $ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Pending oleh teknisi";
    $tracking['deskripsi'] = "";
    $tracking['id_user'] = $id_user;
  
    $this->db->trans_start();

    $this->db->where('id_ticket', $ticket);
    $this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

    $this->db->trans_complete();

     if ($this->db->trans_status() === FALSE)
            {
               
                redirect('myassignment/myassignment_list');   
            } else 
            {
                
                redirect('myassignment/myassignment_list');   
            }
 }


 function ticket_detail($id)
 {

        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/up_progress";

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

        $sql = "SELECT A.progress, A.status, A.reported, A.userfile, D.nama, C.id_kategori, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                FROM ticket A 
                LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
                LEFT JOIN karyawan D ON D.nik = A.reported 
                WHERE A.id_ticket = '$id'";

        $row = $this->db->query($sql)->row();

        $id_kategori = $row->id_kategori;

        $data['url'] = "Myassignment/up_progress"; 

        $data['dd_teknisi'] = $this->Model_app->dropdown_teknisi($id_kategori);
        $data['id_teknisi'] = "";
            
        $data['id_ticket'] = $id;  
        
        $data['id_reported'] = $row->reported;
        $data['userfile'] = $row->userfile;
        $data['progress'] = $row->progress;       
        $data['tanggal'] = $row->tanggal;
        $data['nama_sub_kategori'] = $row->nama_sub_kategori;
        $data['nama_kategori'] = $row->nama_kategori;
        $data['reported'] = $row->nama;
        
        $this->load->view('template', $data);

 }


 function up_progress()
 {

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");
    $ticket = strtoupper(trim($this->input->post('id_ticket')));
    $progress = strtoupper(trim($this->input->post('progress')));

     if($progress==100){
        $data['status'] = 6;
        $data['tanggal_solved'] = $tanggal;
    }else{
        $data['status'] = 4;
    }

     $path = 'uploads';
        if(!file_exists($path)){
             mkdir($path);
        }

     $path = 'uploads/'.$id_user;
        if(!file_exists($path)){
             mkdir($path);
        }

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

    $deskripsi_progress = strtoupper(trim($this->input->post('deskripsi_progress')));

    $tracking['id_ticket'] = $ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Up Progress To ".$progress." %";
    $tracking['deskripsi'] = $deskripsi_progress;
    $tracking['id_user'] = $id_user;

    if($_FILES['fileuser']['name'] == NULL || $_FILES['fileuser']['name'] == ''){
    $tracking['attachment'] = '';
  }else{
    $tracking['attachment'] = $id_user.'/'.$userfile;
  }

   $data['progress'] = $progress;
    
    $this->db->trans_start();

    $this->db->where('id_ticket', $ticket);
    $this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

    $this->db->trans_complete();

        $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
                </div>");

    if ($this->db->trans_status() === FALSE){}
        else{
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

          $mesg = $this->load->view('mail/open_tiket_update', $tracking,true);

          $this->email->from($this->config->item('email_username'), "ADMIN");
          $this->email->to($this->config->item('email_admin'));
          
          $this->email->subject('UPDATE  [Ticket ID: '.$ticket.'] '.$progress.'%');
          $this->email->message($mesg);
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->email->set_header('Content-type', 'text/html');

          if($this->email->send()) {

            $validator['success'] = true;
          $validator['status'] = 'success';
          $validator['messages'] = "Success";

       echo json_encode($validator);
             
          }else {

            $validator['success'] = true;
          $validator['status'] = 'success';
          $validator['messages'] = "Success";

       echo json_encode($validator);
       
          }

        }

  }else{
     $validator['success'] = false;
          $validator['status'] = 'error';
          $validator['messages'] = 'The file youare attempting to upload is larger than the permitted size';

          echo json_encode($validator);
  }
}
 }
    
}
