<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class superuser extends CI_Controller {

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


    public function index()
    {
    	$data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/dashboard_superuser";
        $data['link'] = "user/hapus";

        $sql_ticket = "SELECT COUNT(id_ticket) AS jml_ticket FROM ticket";
    $row_ticket = $this->db->query($sql_ticket)->row();

    $sql_ticket_user = "SELECT COUNT(id_ticket) AS jml_ticket FROM ticket WHERE reported = '".$id_user."' ";
    $row_ticket_user = $this->db->query($sql_ticket_user)->row();

    $sql_user = "SELECT COUNT(id_user) AS jml_user FROM user WHERE level = 'USER'";
    $row_user = $this->db->query($sql_user)->row();

    $sql_karyawan = "SELECT COUNT(id_user) AS jml_karyawan FROM user WHERE level = 'ADMIN'";
    $row_karyawan = $this->db->query($sql_karyawan)->row();

    $sql_teknisi = "SELECT COUNT(id_user) AS jml_teknisi FROM user WHERE level = 'TEKNISI'";
    $row_teknisi = $this->db->query($sql_teknisi)->row();

 $data['jml_ticket'] = $row_ticket->jml_ticket;
    $data['jml_user'] = $row_user->jml_user;
    $data['jml_karyawan'] = $row_karyawan->jml_karyawan;
    $data['jml_teknisi'] = $row_teknisi->jml_teknisi;
         $datauser = $this->Model_app->datakaryawan_superuser();
      $data['datauser'] = $datauser;
        $this->load->view('template', $data);
    }

    public function list_superuser()
    {
     $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "superuser/list_superuser";
        $data['link'] = "user/hapus";

        $sql_ticket = "SELECT COUNT(id_ticket) AS jml_ticket FROM ticket";
    $row_ticket = $this->db->query($sql_ticket)->row();

    $sql_ticket_user = "SELECT COUNT(id_ticket) AS jml_ticket FROM ticket WHERE reported = '".$id_user."' ";
    $row_ticket_user = $this->db->query($sql_ticket_user)->row();

    $sql_user = "SELECT COUNT(id_user) AS jml_user FROM user WHERE level = 'USER'";
    $row_user = $this->db->query($sql_user)->row();

    $sql_karyawan = "SELECT COUNT(id_user) AS jml_karyawan FROM user WHERE level = 'ADMIN'";
    $row_karyawan = $this->db->query($sql_karyawan)->row();

    $sql_teknisi = "SELECT COUNT(id_user) AS jml_teknisi FROM user WHERE level = 'TEKNISI'";
    $row_teknisi = $this->db->query($sql_teknisi)->row();


         $datauser = $this->Model_app->datakaryawan_superuser();
      $data['datauser'] = $datauser;
        $this->load->view('template', $data);
    }

  function user_add()
 {

      $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "superuser/form_user";

        $data['dd_karyawan'] = $this->Model_app->dropdown_karyawan();
    $data['id_karyawan'] = "";

    $data['dd_level'] = $this->Model_app->dropdown_level();
    $data['id_level'] = "";

    $data['password'] = "";
    $data['id_user'] = "";

    $data['url'] = "superuser/user_save";

    $data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 public function history_log()
 {
   $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "superuser/list_log";
        $data['link'] = "superuser/hapus_log";


         $datalog = $this->Model_app->data_log();
      $data['datalog'] = $datalog;
        $this->load->view('template', $data);
 }

 function user_edit($id)
 {

      $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "superuser/form_user";

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

    $data['url'] = "superuser/user_update";
      
    $data['dd_karyawan'] = $this->Model_app->dropdown_karyawan();
    $data['id_karyawan'] = $row->username;
    $data['email'] = $row->email;

    $data['dd_level'] = $this->Model_app->dropdown_level();
    $data['id_level'] = $row->level;

    $data['password'] = "";
    $data['id_user'] = $row->id_user;

    $data['flag'] = "edit";

        $this->load->view('template', $data);

 }

 function user_update()
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
        redirect('superuser/list_superuser'); 
      } else 
      {
        $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
          </div>");
        redirect('superuser/list_superuser'); 
      }

 }

 function user_save()
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
        redirect('superuser/list_superuser'); 
      } else 
      {
        $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
          </div>");
        redirect('superuser/list_superuser'); 
      }
    
 }


    public function add($value='')
    {
      $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "superuser/add_staff";
         $data['dd_kodeinstitusi'] = $this->Model_app->dd_kodeinstitusi();

    $data['dd_jk'] = $this->Model_app->dropdown_jk();
    $data['id_jk'] = "";

    $data['dd_level'] = $this->Model_app->dropdown_level_su();
        $data['id_level'] = "";

        $data['dd_jabatan'] = $this->Model_app->dropdown_jabatan();
    $data['id_jabatan'] = "";

    $data['dd_departemen'] = $this->Model_app->dropdown_departemen();
    $data['id_departemen'] = "";

        $this->load->view('template', $data);
    }

    public function save()
    {
      $getkodekaryawan = $this->Model_app->getkodekaryawan_su();
  
  $nik = $getkodekaryawan;

    $nama = strtoupper(trim($this->input->post('nama')));
    $jk = strtoupper(trim($this->input->post('id_jk')));
    $email = $this->input->post('email');
    $password = MD5($this->input->post('password'));
    $alamat = strtoupper(trim($this->input->post('alamat')));
    $id_bagian_dept = strtoupper(trim($this->input->post('id_departemen')));
    $id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));

     if ($id_bagian_dept == '' || $id_bagian_dept == NULL) {
      $id_bagian_dept = 0;
    }

    $data['nik'] = $nik;
    $data['nama'] = $nama;
    $data['email'] = $email;
    $data['jk'] = $jk;
    $data['alamat'] = $alamat;
    $data['id_bagian_dept'] = $id_bagian_dept;
    $data['id_jabatan'] = $id_jabatan;
    $data['id_institusi'] = '0';

    $datas['username'] = $nik;
    $datas['email'] = $email;
    $datas['password'] = $password;
    $datas['level'] = $this->input->post('id_level');

  $this->db->trans_start();

  $this->db->insert('user', $datas);
  $this->db->insert('karyawan', $data);

  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE)
      {
        $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
          </div>");
        redirect('superuser/list_user'); 
      } else 
      {
        $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
          </div>");
        redirect('superuser/list_user'); 
      }
    }


    public function list_user()
    {
      $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "superuser/list_user";
         $data['link'] = "karyawan/hapus";
        $datakaryawan = $this->Model_app->datakaryawan_su();
      $data['datakaryawan'] = $datakaryawan;

        $this->load->view('template', $data);
    }

    public function edit()
    {
    $id = $this->uri->segment(3);

      $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_karyawan_SU";

        $sql = "SELECT * FROM karyawan as A LEFT JOIN jabatan as B ON B.id_jabatan = A.id_jabatan
        LEFT JOIN user as C ON C.username = A.nik 
        LEFT JOIN departemen as D ON D.id_dept = A.id_bagian_dept WHERE A.nik = '".$id."'";
    $row = $this->db->query($sql)->row();

    $id_dept = trim($this->session->userdata('id_dept'));
        $id_user = trim($this->session->userdata('id_user'));
        $segment = $this->uri->segment(3);

    $data['url'] = "superuser/update";
    $data['nik'] = $id;   
    $data['nama'] = $row->nama;
    $data['alamat'] = $row->alamat;
        $data['email'] = $row->email;

    $data['dd_jk'] = $this->Model_app->dropdown_jk();
    $data['id_jk'] = $row->jk;

    $data['dd_jabatan'] = $this->Model_app->dropdown_jabatan();
    $data['id_jabatan'] = $row->id_jabatan;

    $data['dd_level'] = $this->Model_app->dropdown_level_su();
        $data['id_level'] = $row->level;

    // $data['dd_bagian_departemen'] = $this->Model_app->dropdown_bagian_departemen($row->id_dept);
    // $data['id_bagian_departemen'] = $row->id_bagian_dept;

    $data['dd_departemen'] = $this->Model_app->dropdown_departemen();
    $data['id_departemen'] = $row->id_bagian_dept;

    $data['flag'] = "edit";

        $this->load->view('template', $data);
    }

   public function update()
 {

  $nik = strtoupper(trim($this->input->post('nik')));
    $email = $this->input->post('email');
  $nama = strtoupper(trim($this->input->post('nama')));
  $jk = strtoupper(trim($this->input->post('id_jk')));
  $alamat = strtoupper(trim($this->input->post('alamat')));
  $id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));
  $id_bagian_dept = strtoupper(trim($this->input->post('id_departemen')));
  
  $data['nama'] = $nama;
  $data['jk'] = $jk;
  $data['alamat'] = $alamat;
    $data['email'] = $email;
  // $data['id_institusi'] = $id_institusi;
  $data['id_bagian_dept'] = $id_bagian_dept;
  $data['id_jabatan'] = $id_jabatan;

  $this->db->trans_start();

  $this->db->where('nik', $nik);
  $this->db->update('karyawan', $data);

  $this->db->trans_complete();

  if ($this->db->trans_status() === FALSE)
      {
        $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
          </div>");
        redirect('karyawan/karyawan_list'); 
      } else 
      {
        $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
          </div>");
        redirect('superuser/list_user'); 
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


}