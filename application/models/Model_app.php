<?php

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function get_kategori()
    {
        return $this->db->get('kategori')->result_array();
    }

    //  ================= AUTOMATIC CODE ==================
    public function getkodeticket()
    {
        $query = $this->db->query("select max(id_ticket) as max_code FROM ticket");
        $row = $query->row_array();
        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 9, 4);
        $max_nik = $max_fix + 1;
        $tanggal = $time = date("d");
        $bulan = $time = date("m");
        $tahun = $time = date("Y");

        $nik = "T".$tahun.$bulan.$tanggal.sprintf("%04s", $max_nik);
        return $nik;
    }

    public function getkodekaryawan()
    {
        $query = $this->db->query("SELECT MAX(A.nik) as max_code 
                                    FROM karyawan AS A
                                     LEFT JOIN user B ON B.username = A.nik
                                     WHERE B.level = 'USER'");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_nik = $max_fix + 1;

        $nik = "C".sprintf("%04s", $max_nik);
        return $nik;
    }

    public function getkodekaryawan_su()
    {
        $query = $this->db->query("SELECT MAX(A.nik) as max_code 
                                    FROM karyawan AS A
                                     LEFT JOIN user B ON B.username = A.nik
                                     WHERE B.level = 'ADMIN' OR B.level = 'TEKNISI' 
            ");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_nik = $max_fix + 1;

        $nik = "K".sprintf("%04s", $max_nik);
        return $nik;
    }

    public function getkodekaryawan_teknisi()
    {
        $query = $this->db->query("SELECT MAX(A.nik) as max_code 
                                    FROM karyawan AS A
                                     LEFT JOIN user B ON B.username = A.nik
                                     WHERE B.level = 'TEKNISI'
            ");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_nik = $max_fix + 1;

        $nik = "T".sprintf("%04s", $max_nik);
        return $nik;
    }

     public function getkodeteknisi()
    {
        $query = $this->db->query("select max(id_teknisi) as max_code FROM teknisi");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_id_teknisi = $max_fix + 1;

        $id_teknisi = "T".sprintf("%04s", $max_id_teknisi);
        return $id_teknisi;
    }

     public function getkodeuser()
    {
        $query = $this->db->query("select count(id_user) as max_code FROM user");

        $row = $query->row_array();

        $max_id = $row['max_code'];
        $max_fix = (int) substr($max_id, 1, 4);

        $max_id_user = $max_fix + 1;

        $id_user = "U".sprintf("%04s", $max_id_user);
        return $id_user;
    }
    
    public function datajabatan()
    {
    $query = $this->db->query('SELECT * FROM jabatan');
    return $query->result();
    }

    public function datakaryawan()
    {
    $query = $this->db->query("SELECT A.nama, A.nik, A.id_jabatan, A.alamat, A.jk, A.id_institusi, C.nama_institusi, B.nama_jabatan, D.nama_dept
                               FROM karyawan A LEFT JOIN jabatan B ON B.id_jabatan = A.id_jabatan
                                                LEFT JOIN institusi C ON C.id_institusi = A.id_institusi
                                               LEFT JOIN departemen D ON D.id_dept = A.id_bagian_dept 
                                               LEFT JOIN user E ON E.username = A.nik WHERE E.level = 'USER'");
    return $query->result();
    }

    public function data_log()
    {
        $query = $this->db->query("SELECT * FROM `log` ORDER BY tanggal DESC");
    return $query->result();
    }

    public function datakaryawan_su()
    {
      $query = $this->db->query("SELECT A.nama, A.nik, A.alamat, A.jk, B.nama_jabatan, D.nama_dept
                               FROM karyawan A LEFT JOIN jabatan B ON B.id_jabatan = A.id_jabatan
                                               LEFT JOIN departemen D ON D.id_dept = A.id_bagian_dept 
                                               LEFT JOIN user E ON E.username = A.nik
                                               WHERE E.level != 'USER' ORDER BY A.nik

                                               ");
    return $query->result();
    }

     public function datakaryawan_superuser()
    {
      $query = $this->db->query("SELECT * FROM USER AS A WHERE A.level = 'SUPERUSER'

                                               ");
    return $query->result();
    }

    public function datalist_ticket()
    {

        $query = $this->db->query("SELECT D.nama, F.nama_dept,A.id_kondisi, A.status, A.id_ticket, G.deskripsi, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                                   FROM ticket A 
                                   LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                                   LEFT JOIN kategori C ON C.id_kategori = B.id_kategori
                                   LEFT JOIN karyawan D ON D.nik = A.reported
                                   LEFT JOIN bagian_departemen E ON E.id_bagian_dept = D.id_bagian_dept
                                   LEFT JOIN departemen F ON F.id_dept = E.id_dept
                                   LEFT JOIN `history_feedback` G ON G.id_ticket = A.id_ticket
                                   WHERE A.status IN (2,3,4,5,6) ORDER BY A.`tanggal` DESC");
        return $query->result();

    }
    public function datalist_ticketcsv($id)
    {

        $query = $this->db->query("SELECT D.nama, F.nama_dept, A.status, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                                   FROM ticket A 
                                   LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                                   LEFT JOIN kategori C ON C.id_kategori = B.id_kategori
                                   LEFT JOIN karyawan D ON D.nik = A.reported
                                   LEFT JOIN bagian_departemen E ON E.id_bagian_dept = D.id_bagian_dept
                                   LEFT JOIN departemen F ON F.id_dept = E.id_dept
                                   WHERE A.status IN (2,3,4,5,6)");
        return $query->result_array();

    }

    public function data_trackingticket($id)
    {

        $query = $this->db->query("SELECT A.tanggal, A.status, A.deskripsi, A.attachment, B.nama
                                   FROM tracking A 
                                   LEFT JOIN karyawan B ON B.nik = A.id_user
                                   WHERE A.id_ticket ='$id' ORDER BY A.tanggal ASC");
        return $query->result();

    }


    public function datainformasi()
    {

        $query = $this->db->query("SELECT A.tanggal, A.subject, A.pesan, C.nama, A.id_informasi
                                   FROM informasi A 
                                   LEFT JOIN karyawan C ON C.nik =  A.id_user
                                   WHERE A.status = 1");
        return $query->result();

    }

    public function datamyticket($id)
    {
        $query = $this->db->query("SELECT A.progress, A.userfile,A.reported, A.tanggal_proses, A.tanggal_solved, A.id_teknisi, D.feedback, A.status, A.id_ticket, A.id_kondisi, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                                   FROM ticket A 
                                   LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                                   LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
                                   LEFT JOIN history_feedback D ON D.id_ticket = A.id_ticket
                                   WHERE A.reported = '$id' ORDER BY A.`tanggal` DESC ");
    return $query->result();
    }
public function datamyticketcsv($id)
    {
        $query = $this->db->query("SELECT A.progress, A.tanggal_proses, A.tanggal_solved, A.id_teknisi, D.feedback, A.status, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                                   FROM ticket A 
                                   LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                                   LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
                                   LEFT JOIN history_feedback D ON D.id_ticket = A.id_ticket
                                   WHERE A.reported = '$id' ");
    return $query->result_array();
    }

    public function datamyassignment($id)
    {
        $query = $this->db->query("SELECT A.progress, A.status, A.id_kondisi, A.id_ticket, A.reported, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                                   FROM ticket A 
                                   LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                                   LEFT JOIN kategori C ON C.id_kategori = B.id_kategori
                                   LEFT JOIN karyawan D ON D.nik = A.reported
                                   LEFT JOIN teknisi E ON E.id_teknisi = A.id_teknisi
                                   LEFT JOIN karyawan F ON F.nik = E.nik
                                   WHERE F.nik = '$id'
                                   AND A.status IN (3,4,5,6)
                                   ORDER BY A.`tanggal` DESC
                                   ");
        return $query->result();
    }

     public function dataapproval($id)
    {
    $query = $this->db->query("SELECT A.status, D.nama ,A.status, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori 
        FROM ticket A 
        LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori 
        LEFT JOIN kategori C ON C.id_kategori = B.id_kategori
        LEFT JOIN karyawan D ON D.nik = A.reported 
        LEFT JOIN bagian_departemen E ON E.id_bagian_dept = D.id_bagian_dept WHERE A.status = 1 OR  A.status= 0");
    return $query->result();
    }

     public function datadepartemen()
    {
    $query = $this->db->query('SELECT * FROM departemen');
    return $query->result();
    }

     public function databagiandepartemen()
    {
    $query = $this->db->query('SELECT * FROM bagian_departemen A LEFT JOIN departemen B ON B.id_dept = A.id_dept ');
    return $query->result();
    }

    public function datakondisi()
    {
    $query = $this->db->query('SELECT * FROM kondisi');
    return $query->result();
    }

    public function datateknisi()
    {
    $query = $this->db->query('SELECT A.point, A.id_teknisi, B.nama, B.jk, C.nama_kategori, A.status, A.point FROM teknisi A 
                                LEFT JOIN karyawan B ON B.nik = A.nik
                                LEFT JOIN kategori C ON C.id_kategori = A.id_kategori
                                
                                 ');
    return $query->result();
    }


    public function datareportteknisi($id)
    {
     $query = $this->db->query("SELECT A.progress, A.tanggal_proses, A.status, A.problem_summary, B.nama, D.nama_kategori, F.nama_dept  FROM ticket A 
                                LEFT JOIN karyawan B ON B.nik = A.reported
                                LEFT JOIN sub_kategori C ON C.id_sub_kategori = A.id_sub_kategori
                                LEFT JOIN kategori D ON D.id_kategori = C.id_kategori
                                LEFT JOIN bagian_departemen E ON E.id_bagian_dept = B.id_bagian_dept
                                LEFT JOIN departemen F ON F.id_dept = E.id_dept
                                WHERE id_teknisi = '$id'"                        
                                 );
    return $query->result();
    }


    public function datauser()
    {
         $query = $this->db->query("SELECT A.username, A.level, A.id_user, B.nik, B.nama, A.password, D.nama_dept 
            FROM user A LEFT JOIN karyawan B ON B.nik = A.username 
            LEFT JOIN departemen D ON D.id_dept = B.id_bagian_dept WHERE A.level = 'USER'
                                 ");

         return $query->result();

    }

    public function datakategori()
    {
    $query = $this->db->query('SELECT * FROM kategori');
    return $query->result();
    }

    public function dataassigment($id)
    {
    $query = $this->db->query('SELECT A.status, D.nama, C.id_kategori, A.id_ticket, A.tanggal, B.nama_sub_kategori, C.nama_kategori
                FROM ticket A 
                LEFT JOIN sub_kategori B ON B.id_sub_kategori = A.id_sub_kategori
                LEFT JOIN kategori C ON C.id_kategori = B.id_kategori 
                LEFT JOIN karyawan D ON D.nik = A.reported 
                WHERE A.id_teknisi = "$id"');
    return $query->result();
    }

    public function datasubkategori()
    {
    $query = $this->db->query('SELECT * FROM sub_kategori A LEFT JOIN kategori B ON B.id_kategori = A.id_kategori ');
    return $query->result();
    }


    public function dropdown_departemen()
    {
        $sql = "SELECT * FROM departemen ORDER BY nama_dept";
            $query = $this->db->query($sql);
            
            $value[''] = '-- SELECT --';
            foreach ($query->result() as $row){
                $value[$row->id_dept] = $row->nama_dept;
            }
            return $value;
    }

    public function dd_kodeinstitusi()
    {
       $sql = "SELECT * FROM `institusi` ORDER BY `institusi`.`kode_institusi` ASC";
       $query = $this->db->query($sql);
       return $query->result_array();
    }

     public function dd_kodeinstitusi_edit($segment)
    {
       $sql = "SELECT * FROM `karyawan` as A
        LEFT JOIN institusi B ON B.id_institusi = A.id_institusi
        WHERE nik = '".$segment."' ";
       $query = $this->db->query($sql);
       return $query->result_array();
    }

    public function dropdown_kategori()
    {
        $sql = "SELECT * FROM kategori ORDER BY nama_kategori";
        $query = $this->db->query($sql);
            
            $value[''] = '-- SELECT --';
            foreach ($query->result() as $row){
                $value[$row->id_kategori] = $row->nama_kategori;
            }
            return $value;
    }

    public function dropdown_karyawan()
    {
        $sql = "SELECT A.nama, A.nik FROM karyawan A 
                LEFT JOIN bagian_departemen B ON B.id_bagian_dept = A.id_bagian_dept
                LEFT JOIN departemen C ON C.id_dept = b.id_dept WHERE A.id_jabatan != 0
                ORDER BY A.nama";
        $query = $this->db->query($sql);
            
            $value[''] = '-- SELECT --';
            foreach ($query->result() as $row){
                $value[$row->nik] = $row->nama;
            }
            return $value;
    }

    public function dropdown_jabatan()
    {
        $sql = "SELECT * FROM jabatan ORDER BY nama_jabatan";
        $query = $this->db->query($sql);
            
        $value[''] = '-- SELECT --';
        foreach ($query->result() as $row){
            $value[$row->id_jabatan] = $row->nama_jabatan;
        }
        return $value;
    }

    public function dropdown_kondisi()
    {
        $sql = "SELECT * FROM kondisi ORDER BY nama_kondisi";
        $query = $this->db->query($sql);
            
        $value[''] = '-- SELECT --';
        foreach ($query->result() as $row){
            $value[$row->id_kondisi] = $row->nama_kondisi;
            // $value[$row->id_kondisi] = $row->nama_kondisi."  -  (TARGET PROCESS ".$row->waktu_respon." "."DAY)";
        }
        return $value;
    }

    public function dropdown_bagian_departemen($id_departemen)
    {
        $sql = "SELECT * FROM bagian_departemen where id_dept ='$id_departemen' ORDER BY nama_bagian_dept";
        $query = $this->db->query($sql);
            
        $value[''] = '-- SELECT --';
        foreach ($query->result() as $row){
            $value[$row->id_bagian_dept] = $row->nama_bagian_dept;
        }
        return $value;
    }

    public function dropdown_sub_kategori($id_kategori)
    {
        $sql = "SELECT * FROM sub_kategori where id_kategori ='$id_kategori' ORDER BY nama_sub_kategori";
        $query = $this->db->query($sql);
            
        $value[''] = '-- SELECT --';
        foreach ($query->result() as $row){
            $value[$row->id_sub_kategori] = $row->nama_sub_kategori;
        }
        return $value;
    }

    function dropdown_teknisi($id_kategori)
    {

        $sql = "SELECT A.id_teknisi, B.nama, B.jk, C.nama_kategori, A.status, A.point FROM teknisi A 
                                LEFT JOIN karyawan B ON B.nik = A.nik
                                LEFT JOIN kategori C ON C.id_kategori = A.id_kategori
                                WHERE A.id_kategori ='$id_kategori'";
        $query = $this->db->query($sql);
            
        $value[''] = '-- SELECT --';
        foreach ($query->result() as $row){
            $value[$row->id_teknisi] = $row->nama;
        }
        return $value;

    }


    public function dropdown_jk()
    {
        $value[''] = '--SELECT--';            
        $value['LAKI-LAKI'] = 'MAN';
        $value['PEREMPUAN'] = 'WOMEN';           
            
            return $value;
    }

    public function dropdown_level()
    {
        $value[''] = '--SELECT--';            
        $value['ADMIN'] = 'ADMIN';
        $value['TEKNISI'] = 'TECHNITION';
        $value['USER'] = 'USER';           
            
            return $value;
    }

     public function dropdown_level_su()
    {
        $value[''] = '--SELECT--';          
        $value['ADMIN'] = 'ADMIN';
        $value['TEKNISI'] = 'TECHNITION';

            
            return $value;
    }

    public function cekuserbymail($email)
    {
        $query = $this->db->query("SELECT * FROM `user` WHERE email = '".$email."' ");
        return $query->result_array();
    }

    public function cekuserbyuser($username)
    {
         $query = $this->db->query("SELECT * FROM `user` WHERE username = '".$username."' ");
        return $query->result_array();
    }

    public function save_resetpassword($username, $password)
    {
       $query = $this->db->query("UPDATE `user` SET `password` = '".$password."' WHERE `user`.`username` = '".$username."';");
        return $query;
    }



   

   

}