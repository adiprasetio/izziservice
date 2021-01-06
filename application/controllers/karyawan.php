<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

function __construct(){
        parent::__construct();
        error_reporting(0); 
        $this->load->model('Model_app');
		
		

        if(!$this->session->userdata('id_user'))
       {
        $this->session->set_flashdata("msg", "<div class='alert alert-info'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <strong><span class='glyphicon glyphicon-remove-sign'></span></strong> Please log in first
       </div>");
        redirect('login');
        }
        
    }


 function karyawan_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/karyawan";


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

        $data['link'] = "karyawan/hapus";

        $datakaryawan = $this->Model_app->datakaryawan();
	    $data['datakaryawan'] = $datakaryawan;
        
        $this->load->view('template', $data);

 }

 function hapus()
 {
 	$id = $_POST['id'];

 	$this->db->trans_start();

 	$this->db->where('nik', $id);
 	$this->db->delete('karyawan');


 	$this->db->trans_complete();

    $this->db->trans_start();

    $this->db->where('username', $id);
    $this->db->delete('user');
    

    $this->db->trans_complete();
	
 }

 function add()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_karyawan";

        $id_dept = trim($this->session->userdata('id_dept'));
        $id_user = trim($this->session->userdata('id_user'));

        //notification 

        $sql_listticket = "SELECT COUNT(A.id_ticket) AS jml_list_ticket FROM ticket A WHERE A.status = 2 OR A.status = 3 OR A.status = 4 OR A.status = 5 OR A.status = 6";
        $row_listticket = $this->db->query($sql_listticket)->row();

        $data['notif_list_ticket'] = $row_listticket->jml_list_ticket;

        $data['dd_level'] = $this->Model_app->dropdown_level();
        $data['id_level'] = "";
$sql_approvalticket = "SELECT COUNT(A.id_ticket) AS jml_approval_ticket FROM ticket A WHERE A.status = 1";
        $row_approvalticket = $this->db->query($sql_approvalticket)->row();

        $data['notif_approval'] = $row_approvalticket->jml_approval_ticket;

        $sql_assignmentticket = "SELECT COUNT(id_ticket) AS jml_assignment_ticket FROM ticket WHERE status = 3 AND id_teknisi='$id_user'";
        $row_assignmentticket = $this->db->query($sql_assignmentticket)->row();

        $data['notif_assignment'] = $row_assignmentticket->jml_assignment_ticket;

        //end notification

        $data['nik'] = "";		
		$data['nama'] = "";
		$data['alamat'] = "";
		
        $data['dd_kodeinstitusi'] = $this->Model_app->dd_kodeinstitusi();

		$data['dd_jk'] = $this->Model_app->dropdown_jk();
		$data['id_jk'] = "";

        $data['dd_jabatan'] = $this->Model_app->dropdown_jabatan();
		$data['id_jabatan'] = "";

		$data['dd_departemen'] = $this->Model_app->dropdown_departemen();
		$data['id_departemen'] = "";


		$data['url'] = "client/save";

		$data['flag'] = "add";
    
        $this->load->view('template', $data);

 }

 function save()
 {

    $datas['level'] = $this->input->post('id_level');
    if ($datas['level'] == 'USER') {
        $getkodekaryawan = $this->Model_app->getkodekaryawan();
    }else if ($datas['level'] == 'TEKNISI') {
        $getkodekaryawan = $this->Model_app->getkodekaryawan_teknisi();
    }else{
        $getkodekaryawan = $this->Model_app->getkodekaryawan_su();
    }
 	
	
	$nik = $getkodekaryawan;

 	$nama = strtoupper(trim($this->input->post('nama')));
 	$jk = strtoupper(trim($this->input->post('id_jk')));
    $email = $this->input->post('email');
 	$alamat = strtoupper(trim($this->input->post('alamat')));
 	$id_bagian_dept = strtoupper(trim($this->input->post('id_departemen')));
 	$id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));
    $id_institusi =  strtoupper(trim($this->input->post('id_institusi')));

 	$data['nik'] = $nik;
    $data['nama'] = $nama;
 	$data['email'] = $email;
 	$data['jk'] = $jk;
 	$data['alamat'] = $alamat;
 	$data['id_bagian_dept'] = $id_bagian_dept;
    $data['id_institusi'] = $id_institusi;
 	$data['id_jabatan'] = $id_jabatan;

    $datas['username'] = $nik;
    $datas['email'] = $email;
    $datas['password'] = MD5($this->input->post('password'));
    $datas['level'] = $this->input->post('id_level');

    $datat['id_teknisi'] = $nik;
    $datat['nik'] = $nik;

 	$this->db->trans_start();

 	$this->db->insert('karyawan', $data);
    $this->db->insert('user', $datas);

    if ($datas['level'] == 'TEKNISI') {
         $this->db->insert('teknisi', $datat);
    }

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
				redirect('karyawan/karyawan_list');	
			}
		
 }

 function edit()
 {
        $id = $this->uri->segment(3);

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/form_karyawan";

        $sql = "SELECT * FROM karyawan as A 
        LEFT JOIN jabatan as B ON B.id_jabatan = A.id_jabatan
        LEFT JOIN departemen as D ON D.id_dept = A.id_bagian_dept 
        LEFT JOIN USER as C ON C.username = A.nik WHERE A.nik = '".$id."'";
		$row = $this->db->query($sql)->row();

		$id_dept = trim($this->session->userdata('id_dept'));
        $id_user = trim($this->session->userdata('id_user'));
        $segment = $this->uri->segment(3);
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

		$data['url'] = "karyawan/update";
        $data['dd_kodeinstitusi'] = $this->Model_app->dd_kodeinstitusi();
        $data['dd_kodeinstitusi_edit'] = $this->Model_app->dd_kodeinstitusi_edit($segment);

		$data['nik'] = $id;		
		$data['nama'] = $row->nama;
		$data['alamat'] = $row->alamat;
        $data['email'] = $row->email;

        $data['dd_level'] = $this->Model_app->dropdown_level();
        $data['id_level'] = $row->level;

		$data['dd_jk'] = $this->Model_app->dropdown_jk();
		$data['id_jk'] = $row->jk;

		$data['dd_jabatan'] = $this->Model_app->dropdown_jabatan();
		$data['id_jabatan'] = $row->id_jabatan;

		// $data['dd_bagian_departemen'] = $this->Model_app->dropdown_bagian_departemen($row->id_dept);
		// $data['id_bagian_departemen'] = $row->id_bagian_dept;

		$data['dd_departemen'] = $this->Model_app->dropdown_departemen();
		$data['id_departemen'] = $row->id_dept;

		$data['flag'] = "edit";

        $this->load->view('template', $data);

 }

 function update()
 {

 	$nik = strtoupper(trim($this->input->post('nik')));
    $email = $this->input->post('email');
 	$nama = strtoupper(trim($this->input->post('nama')));
 	$jk = strtoupper(trim($this->input->post('id_jk')));
     $alamat = strtoupper(trim($this->input->post('alamat')));
     $id_bagian_dept = $this->input->post('id_departemen');
     console.log($id_bagian_dept);
 	$id_jabatan = strtoupper(trim($this->input->post('id_jabatan')));
    $id_institusi = strtoupper(trim($this->input->post('id_institusi')));
    $password = $this->input->post('password');

    if ($password != NULL || $password != '') {
        $datas['password'] = MD5($this->input->post('password'));

        $this->db->set('password', $datas['password']);
        $this->db->where('username', $nik);
        $this->db->update('user'); 
    }

 	$data['nama'] = $nama;
 	$data['jk'] = $jk;
     $data['alamat'] = $alamat;
     $data['id_bagian_dept'] = $id_bagian_dept;
    $data['email'] = $email;
 	$data['id_institusi'] = $id_institusi;
    // $data['id_bagian_dept'] = $id_bagian_dept;
 	$data['id_jabatan'] = $id_jabatan;

    $data['id_institusi'] = $id_institusi;

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

				redirect('karyawan/karyawan_list');	
			}

 }

 public function export_excel()
 {
     $id = trim($this->session->userdata('id_user'));
     $datakaryawan = $this->Model_app->datakaryawan();
        $data['datakaryawan'] = $datakaryawan;
     header('Content-Type: application/xls');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="export client.xls";');
     $content = $this->load->view('body/pdfclient',$data);

 }

  public function export_pdf()
 {
      require_once('./asset/html2pdf-4.03/ci_html2pdf.class.php');
       $this->load->library('CI_HTML2PDF');

        $this->load->model('Model_app');
    
    $datakaryawan = $this->Model_app->datakaryawan();
        $data['datakaryawan'] = $datakaryawan;
    
    
    ob_start();
        $content = $this->load->view('body/pdfclient',$data);
        $content = ob_get_clean();      
       
        try
        {
            $html2pdf = new ci_html2pdf('L', 'A4', 'en');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Report_ppic.pdf');
        }
        catch(ci_html2pdf_exception $e) {
            echo $e;
            exit;
        }
 }


    
}
