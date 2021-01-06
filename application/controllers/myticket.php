<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myticket extends CI_Controller {

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


 function myticket_list()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/myticket";

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

        $datamyticket = $this->Model_app->datamyticket($id_user);
	    $data['datamyticket'] = $datamyticket;
        
        $this->load->view('template', $data);
 }


 function myticket_detail($id)
 {
    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/progress_teknisi";
		
		$sql_listticket = "SELECT COUNT(A.id_ticket) AS jml_list_ticket FROM ticket A WHERE A.status = 2 OR A.status = 3 OR A.status = 4 OR A.status = 5 OR A.status = 6";
        $row_listticket = $this->db->query($sql_listticket)->row();
        $data['notif_list_ticket'] = $row_listticket->jml_list_ticket;
$sql_approvalticket = "SELECT COUNT(A.id_ticket) AS jml_approval_ticket FROM ticket A WHERE A.status = 1";
        $row_approvalticket = $this->db->query($sql_approvalticket)->row();

        $data['notif_approval'] = $row_approvalticket->jml_approval_ticket;

        $sql_assignmentticket = "SELECT COUNT(id_ticket) AS jml_assignment_ticket FROM ticket WHERE status = 3 AND id_teknisi='$id_user'";
        $row_assignmentticket = $this->db->query($sql_assignmentticket)->row();

        $data['notif_assignment'] = $row_assignmentticket->jml_assignment_ticket;

         $sql = "SELECT A.status, A.progress,A.tanggal, A.userfile,A.tanggal_solved,A.reported, A.tanggal_proses, A.tanggal_solved, F.nama AS nama_teknisi, D.nama, C.id_kategori, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                FROM ticket A 
                LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
                LEFT JOIN karyawan D ON D.nik = A.reported 
                LEFT JOIN teknisi E ON E.id_teknisi = A.id_teknisi
                LEFT JOIN karyawan F ON F.nik = E.nik 
                WHERE A.id_ticket = '$id'";

        $row = $this->db->query($sql)->row();

        $id_kategori = $row->id_kategori;

        $data['dd_teknisi'] = $this->Model_app->dropdown_teknisi($id_kategori);
        $data['id_teknisi'] = "";
            
        $data['id_ticket'] = $id;  
        $data['nama_teknisi'] = $row->nama_teknisi;       
        $data['tanggal'] = $row->tanggal;
        $data['nama_sub_kategori'] = $row->nama_sub_kategori;
        $data['nama_kategori'] = $row->nama_kategori;
        $data['reported'] = $row->nama;
        $data['id_reported'] = $row->reported;
        $data['userfile'] = $row->userfile;
        $data['status'] = $row->status;
        $data['progress'] = $row->progress;
        $data['tanggal_proses'] = $row->tanggal_proses;

        $data['tanggal'] = $row->tanggal;
        $data['tanggal_solved'] = $row->tanggal_solved;

        //TRACKING TICKET
        $data_trackingticket = $this->Model_app->data_trackingticket($id);
        $data['data_trackingticket'] = $data_trackingticket;

        
        $this->load->view('template', $data);
 }


 function feedback_yes($id_ticket, $id_teknisi)
 {

    $id_user = trim($this->session->userdata('id_user'));
    $feedback = trim($this->input->post('feedback'));
    $deskripsi = $this->input->post('deskripsi');
    $tanggal = $time = date("Y-m-d  H:i:s");

    $data['feedback'] = $feedback;
    $data['reported'] = $id_user;
    $data['deskripsi'] = $deskripsi;
    $data['id_ticket'] = $id_ticket;


    $sql_teknisi = "SELECT * FROM teknisi WHERE id_teknisi = '$id_teknisi'";
    $row = $this->db->query($sql_teknisi)->row();

    $data2['point'] = $row->point + 1;
  
    $this->db->trans_start();

    $this->db->insert('history_feedback', $data);

    $this->db->where('id_teknisi', $id_teknisi);
    $this->db->update('teknisi', $data2);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
               
                redirect('myticket/myticket_list');   
            } else 
            {
                
                redirect('myticket/myticket_list');   
            }



 }

 function feedback_no($id_ticket, $id_teknisi)
 {

    

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $data['feedback'] = 0;
    $data['reported'] = $id_user;
    $data['id_ticket'] = $id_ticket;

    $sql_teknisi = "SELECT * FROM teknisi WHERE id_teknisi = '$id_teknisi'";
    $row = $this->db->query($sql_teknisi)->row();

    $data2['point'] = $row->point - 1;
  
    $this->db->trans_start();

    $this->db->insert('history_feedback', $data);

    $this->db->where('id_teknisi', $id_teknisi);
    $this->db->update('teknisi', $data2);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
            {
               
                redirect('myticket/myticket_list');   
            } else 
            {
                
                redirect('myticket/myticket_list');   
            }
 }
    
public function pdfmyticket()
    {

         require_once('./asset/html2pdf-4.03/ci_html2pdf.class.php');
          $this->load->library('CI_HTML2PDF');
    
    $id = trim($this->session->userdata('id_user'));

        $datamyticket = $this->Model_app->datamyticket($id);
        $data['datamyticket'] = $datamyticket;
    
    
    ob_start();
        $content = $this->load->view('body/pdfmyticket',$data);
        $content = ob_get_clean();      
       
        try
        {
            $html2pdf = new CI_HTML2PDF('L', 'A4', 'en');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Report_ppic.pdf');
        }
        catch(CI_HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
    
    }
    public function csvmyticket()
    {

        $id = trim($this->session->userdata('id_user'));
         $datamyticket = $this->Model_app->datamyticket($id);
        $data['datamyticket'] = $datamyticket;

        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="export myticket.xls";');

        $content = $this->load->view('body/pdfmyticket',$data);

    }
    function array_to_csv_download($array, $filename = "export.csv", $delimiter=";")
    {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w');
        fputcsv($f, ['Progress','Status','Feedback','','','','Id Ticket','Tanggal Ticket','Nama Sub Kategori','Nama Kategori'], $delimiter); 
        // loop over the input array
        foreach ($array as $line) { 
            // generate csv lines from the inner arrays
            fputcsv($f, $line, $delimiter); 
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        // tell the browser it's going to be a csv file
        header('Content-Type: application/csv');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        // make php send the generated csv lines to the browser
        fpassthru($f);
    }

}
