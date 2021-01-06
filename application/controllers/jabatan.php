<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

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


 function jabatan_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/jabatan";

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
        
        $data['link'] = "jabatan/hapus";

        $datajabatan = $this->Model_app->datajabatan();
	    $data['datajabatan'] = $datajabatan;
        

        $this->load->view('template', $data);

 }

  function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_jabatan', $id);
 	$this->db->delete('jabatan');

 	$this->db->trans_complete();
	
 }

 function add()
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

 function save()
 {

 	$nama_jabatan = strtoupper(trim($this->input->post('nama_jabatan')));

 	$data['nama_jabatan'] = $nama_jabatan;

 	$this->db->trans_start();

 	$this->db->insert('jabatan', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
			    </div>");
				redirect('jabatan/jabatan_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data  tersimpan.
			    </div>");
				redirect('jabatan/jabatan_list');	
			}
		
 }


 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_jabatan";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id_user = trim($this->session->userdata('id_user'));

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

        $sql = "SELECT * FROM jabatan WHERE id_jabatan = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "jabatan/update";
			
		$data['id_jabatan'] = $id;		
		$data['nama_jabatan'] = $row->nama_jabatan;
 

        $this->load->view('template', $data);

 }

 function update()
 {

 	$id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));
 	$nama_jabatan = strtoupper(trim($this->input->post('nama_jabatan')));

 	$data['nama_jabatan'] = $nama_jabatan;

 	$this->db->trans_start();

 	$this->db->where('id_jabatan', $id_jabatan);
 	$this->db->update('jabatan', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
			    </div>");
				redirect('jabatan/jabatan_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
			    </div>");
				redirect('jabatan/jabatan_list');	
			}

 }



    
}
