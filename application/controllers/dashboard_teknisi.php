<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_teknisi extends CI_Controller {

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


 function teknisi_view()
 {

 	    $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/dashboard_teknisi";

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
        
        $data['link'] = "teknisi/hapus";

        $datateknisi = $this->Model_app->datateknisi();
	    $data['datateknisi'] = $datateknisi;
        
        $this->load->view('template', $data);

 }

 function report_teknisi($id)
 {

        $data['header'] = "header/header";
        $data['navbar'] = "navbar/navbar";
        $data['sidebar'] = "sidebar/sidebar";
        $data['body'] = "body/report_teknisi";

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

        $data['link'] = "teknisi/hapus";

         $data['id_teknisi'] = $id;

        $datareportteknisi = $this->Model_app->datareportteknisi($id);
        $data['datareportteknisi'] = $datareportteknisi;
        
        $this->load->view('template', $data);

 }

 public function xlsreportteknisi($id)
 {
    $id = trim($this->session->userdata('id_user'));
     $datareportteknisi = $this->Model_app->datareportteknisi($id);
     $data['datareportteknisi'] = $datareportteknisi;
     header('Content-Type: application/xls');
        // tell the browser we want to save it instead of displaying it
        header('Content-Disposition: attachment; filename="export list.xls";');
     $content = $this->load->view('body/pdfreportteknisi',$data);

    // $this->array_to_csv_download($datalist_ticket,'export.csv',';');
 }

 public function pdfreportteknisi($id)
    {
     require_once('./asset/html2pdf-4.03/ci_html2pdf.class.php');
   
     $datareportteknisi = $this->Model_app->datareportteknisi($id);
     $data['datareportteknisi'] = $datareportteknisi;
    
    
    ob_start();
        $content = $this->load->view('body/pdfreportteknisi',$data);
        $content = ob_get_clean();      
        $this->load->library('CI_HTML2PDF');
        try
        {
            $html2pdf = new html2pdf('L', 'A4', 'en');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->Output('Report_ppic.pdf');
        }
        catch(html2pdf_exception $e) {
            echo $e;
            exit;
        }
    
    }

 


    
}
