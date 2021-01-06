<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_ticket extends CI_Controller {

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


    function ticket_list()
    {

      $data['header'] = "header/header";
      $data['navbar'] = "navbar/navbar";
      $data['sidebar'] = "sidebar/sidebar";
      $data['body'] = "body/list_ticket";

      $id_dept = trim($this->session->userdata('id_dept'));
      $id_user = trim($this->session->userdata('id_user'));

        //notification 

      $sql_listticket = "SELECT COUNT(A.id_ticket) AS jml_list_ticket 
      FROM ticket A WHERE A.status = 2 OR A.status = 3 OR A.status = 4 OR A.status = 5 OR A.status = 6";
      $row_listticket = $this->db->query($sql_listticket)->row();

      $data['notif_list_ticket'] = $row_listticket->jml_list_ticket;
      $sql_approvalticket = "SELECT COUNT(A.id_ticket) AS jml_approval_ticket FROM ticket A WHERE A.status = 1";
      $row_approvalticket = $this->db->query($sql_approvalticket)->row();

      $data['notif_approval'] = $row_approvalticket->jml_approval_ticket;

      $sql_assignmentticket = "SELECT COUNT(id_ticket) AS jml_assignment_ticket FROM ticket WHERE status = 3 AND id_teknisi='$id_user'";
      $row_assignmentticket = $this->db->query($sql_assignmentticket)->row();

      $data['notif_assignment'] = $row_assignmentticket->jml_assignment_ticket;

        //end notification

      $datalist_ticket = $this->Model_app->datalist_ticket();
      $data['datalist_ticket'] = $datalist_ticket;

      $this->load->view('template', $data);
  }


  function pilih_teknisi($id)
  {
    $data['header'] = "header/header";
    $data['navbar'] = "navbar/navbar";
    $data['sidebar'] = "sidebar/sidebar";
    $data['body'] = "body/pilih_teknisi";

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

    $sql = "SELECT A.status, D.nama,A.problem_detail,A.problem_summary, C.id_kategori, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
    FROM ticket A 
    LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
    LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
    LEFT JOIN karyawan D ON D.nik = A.reported 
    WHERE A.id_ticket = '$id'";

    $row = $this->db->query($sql)->row();

    $id_kategori = $row->id_kategori;

    $data['url'] = "list_ticket/assignment"; 

    $data['dd_teknisi'] = $this->Model_app->dropdown_teknisi($id_kategori);
    $data['id_teknisi'] = "";

    $data['id_ticket'] = $id;       
    $data['deskripsi'] = $row->problem_detail;  
    $data['subject'] = $row->problem_summary;
    $data['tanggal'] = $row->tanggal;
    $data['nama_sub_kategori'] = $row->nama_sub_kategori;
    $data['nama_kategori'] = $row->nama_kategori;
    $data['reported'] = $row->nama;

    $this->load->view('template', $data);

}


function assignment()
{

    $id_ticket = strtoupper(trim($this->input->post('id_ticket')));
    $id_teknisi = strtoupper(trim($this->input->post('id_teknisi')));

    $id_user = trim($this->session->userdata('id_user'));
    $tanggal = $time = date("Y-m-d  H:i:s");

    $data['id_teknisi'] = $id_teknisi;
    $data['status'] = 3;
    

    $tracking['id_ticket'] = $id_ticket;
    $tracking['tanggal'] = $tanggal;
    $tracking['status'] = "Pemilihan Teknisi";
    $tracking['deskripsi'] = "TICKET DIBERIKAN KEPADA TEKNISI";
    $tracking['id_user'] = $id_user;

    $this->db->trans_start();

    $this->db->where('id_ticket', $id_ticket);
    $this->db->update('ticket', $data);

    $this->db->insert('tracking', $tracking);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
        $this->session->set_flashdata("msg", "<div class='alert bg-danger' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data failed to save.
            </div>");
        redirect('list_ticket/ticket_list'); 
    } else 
    {
        $this->session->set_flashdata("msg", "<div class='alert bg-success' role='alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data saved.
            </div>");
        redirect('list_ticket/ticket_list'); 
    }

}

function view_progress_teknisi($id)
{

    $data['header'] = "header/header";
    $data['navbar'] = "navbar/navbar";
    $data['sidebar'] = "sidebar/sidebar";
    $data['body'] = "body/progress_teknisi";

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

    $sql = "SELECT A.status, A.progress,A.problem_detail,A.problem_summary, A.tanggal, A.reported,  A.tanggal_proses,A.userfile, A.tanggal_solved, F.nama AS nama_teknisi, D.nama, C.id_kategori, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
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
    $data['deskripsi'] = $row->problem_detail;  
    $data['subject'] = $row->problem_summary;
    $data['nama_teknisi'] = $row->nama_teknisi;       
    $data['tanggal'] = $row->tanggal;
    $data['nama_sub_kategori'] = $row->nama_sub_kategori;
    $data['userfile'] = $row->userfile;
    $data['nama_kategori'] = $row->nama_kategori;
    $data['id_reported'] = $row->reported;
    $data['reported'] = $row->nama;
    $data['progress'] = $row->progress;
    $data['status'] = $row->status;

    $data['tanggal_proses'] = $row->tanggal_proses;
    $data['tanggal'] = $row->tanggal;
    $data['tanggal_solved'] = $row->tanggal_solved;

        //TRACKING TICKET
    $data_trackingticket = $this->Model_app->data_trackingticket($id);
    $data['data_trackingticket'] = $data_trackingticket;


    $this->load->view('template', $data);

}

public function pdflistticket()
{
    //error_reporting(0);
    echo(base_url().'asset/html2pdf-4.03/ci_html2pdf.class.php');

    require_once(base_url().'asset/html2pdf-4.03/ci_html2pdf.class.php');

    $this->load->model('Model_app');
    
    $datalist_ticket = $this->Model_app->datalist_ticket();
    $data['datalist_ticket'] = $datalist_ticket;
    
    
    ob_start();
    $content = $this->load->view('body/pdflistticket',$data);
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
public function csvlist_ticket()
{

    $id = trim($this->session->userdata('id_user'));
    $datalist_ticket = $this->Model_app->datalist_ticket();
    $data['datalist_ticket'] = $datalist_ticket;
    header('Content-Type: application/xls');
        // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="export list.xls";');
    $content = $this->load->view('body/pdflistticket',$data);

    // $this->array_to_csv_download($datalist_ticket,'export.csv',';');

}  

function array_to_csv_download($array, $filename = "export.csv", $delimiter=";")
{
        // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w');
    fputcsv($f, ['',''], $delimiter); 
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
