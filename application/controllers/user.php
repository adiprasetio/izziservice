<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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


 function user_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/user";

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

        $data['link'] = "user/hapus";

        $datauser = $this->Model_app->datauser();
	    $data['datauser'] = $datauser;
        
        $this->load->view('template', $data);

 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('id_user', $id);
 	$this->db->delete('user');

 	$this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_user";

        $data['dd_karyawan'] = $this->Model_app->dropdown_karyawan();
		$data['id_karyawan'] = "";

		$data['dd_level'] = $this->Model_app->dropdown_level();
		$data['id_level'] = "";

		$data['password'] = "";
		$data['id_user'] = "";

		$data['url'] = "user/save";

		$data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 function save()
 {

 	$getkodeuser = $this->Model_app->getkodeuser();
	
	$id_user = $getkodeuser;

 	$id_karyawan = strtoupper(trim($this->input->post('id_karyawan')));
 	$password = $this->input->post('password');
    $email = strtoupper(trim($this->input->post('email')));
 	$id_level = strtoupper(trim($this->input->post('id_level')));


 	$data['id_user'] = NULL;
 	$data['username'] = $id_karyawan;
    $data['email'] = $email;
 	$data['password'] = md5($password);
 	$data['level'] = $id_level;
 	

 	$this->db->trans_start();

 	$this->db->insert('user', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
			    </div>");
				redirect('user/user_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
			    </div>");
				redirect('user/user_list');	
			}
		
 }

 function edit($id)
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_user";

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

        $sql = "SELECT * FROM user WHERE id_user = '$id'";
		$row = $this->db->query($sql)->row();

		$data['url'] = "user/update";
			
		$data['dd_karyawan'] = $this->Model_app->dropdown_karyawan();
		$data['id_karyawan'] = $row->username;
		$data['dd_level'] = $this->Model_app->dropdown_level();
		$data['id_level'] = $row->level;

		$data['password'] = "";
		$data['id_user'] = $row->id_user;

		$data['flag'] = "edit";

        $this->load->view('template', $data);

 }

 function update()
 {

 	$id_user = strtoupper(trim($this->input->post('id_user')));
    $password = $this->input->post('password');
   

 	$id_level = strtoupper(trim($this->input->post('id_level')));
 	$data['level'] = $id_level;
    if ($password != NULL || $password != '') {
       $data['password'] = md5($password);
    }else{
        
    }
 

 	$this->db->trans_start();

 	$this->db->where('id_user', $id_user);
 	$this->db->update('user', $data);

 	$this->db->trans_complete();

 	if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
			    </div>");
				redirect('user/user_list');	
			} else 
			{
				$this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
			    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			    <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
			    </div>");
				redirect('user/user_list');	
			}

 }


    
}
