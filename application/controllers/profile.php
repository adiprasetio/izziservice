<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller {

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

    
function view()
    {
        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/profile";

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

       $id = $this->session->userdata('id_user');


        $sql = 
        "SELECT A.nik, A.nama, A.alamat, A.jk, B.level, B.level, C.nama_jabatan, D.nama_bagian_dept, E.nama_dept, C.nama_jabatan 
        FROM KARYAWAN A 
        LEFT JOIN user B ON B.username = A.nik 
        LEFT JOIN jabatan C ON C.id_jabatan = A.id_jabatan 
        LEFT JOIN bagian_departemen D ON D.id_bagian_dept = A.id_bagian_dept 
        LEFT JOIN departemen E ON E.id_dept = D.id_dept WHERE A.nik ='$id'";

        $row = $this->db->query($sql)->row();

        //general
        $data['nik'] = $row->nik;
        $data['nama'] = $row->nama;
        $data['alamat'] = $row->alamat;
        $data['jk'] = $row->jk;

        //info jabatan
        $data['jabatan'] = $row->nama_jabatan;
        $data['dept'] = $row->nama_dept;
        $data['bagian'] = $row->nama_bagian_dept;
        $data['level'] = $row->level;



	
        $this->load->view('template', $data);
    }

    
}
