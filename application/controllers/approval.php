<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

function __construct(){
        parent::__construct();
        error_reporting(0); 
        $this->load->model('Model_app');

       if(!$this->session->userdata('id_user'))
       {
        redirect();
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Please log in first
       </div>");
        redirect('login');
        }
        
        
    }





 function approval_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/approval";

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
        
        $data['link'] = "approval_kabag/hapus";

       

        $dataapproval = $this->Model_app->dataapproval($id_dept);
	    $data['dataapproval'] = $dataapproval;
        

        $this->load->view('template', $data);

 }

  function approval_no($ticket)
 {
 	
    $data['status'] = 0;

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $tracking['id_ticket'] = $ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Ticket tidak disetujui";
    $tracking['deskripsi'] = "";
    $tracking['id_user'] = $id_user;

  
    $this->db->trans_start();

 	$this->db->where('id_ticket', $ticket);
 	$this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

 	$this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
               
                redirect('approval/approval_list');   
            } else 
            {
                
                redirect('approval/approval_list');   
            }

	
 }

 function approval_reaction($ticket)
 {

     $data['status'] = 1;

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $tracking['id_ticket'] = $ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Ticket dikembalikan ke posisi belum di setujui";
    $tracking['deskripsi'] = "";
    $tracking['id_user'] = $id_user;

  
    $this->db->trans_start();

    $this->db->where('id_ticket', $ticket);
    $this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
               
                redirect('approval/approval_list');   
            } else 
            {
                
                redirect('approval/approval_list');   
            }

 }

  function approval_yes($ticket)
 {
   
    $data['status'] = 2;

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $tracking['id_ticket'] = $ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Ticket disetujui";
    $tracking['deskripsi'] = "";
    $tracking['id_user'] = $id_user;
  
    $this->db->trans_start();

    $this->db->where('id_ticket', $ticket);
    $this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

    $this->db->trans_complete();

     if ($this->db->trans_status() === FALSE)
            {
               
                redirect('approval/approval_list');   
            } else 
            {
                
                redirect('approval/approval_list');   
            }
    
 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_jabatan', $id);
 	$this->db->delete('jabatan');

 	$this->db->trans_complete();
	
 }

 function approval()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_jabatan";

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

	    $data['url'] = "jabatan/save";
			
		$data['id_jabatan'] = "";		
		$data['nama_jabatan'] = "";
        

        $this->load->view('template', $data);

 }

 



    
}
