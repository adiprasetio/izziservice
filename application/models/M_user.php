<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class M_user extends CI_Model {
                        
public function checkleveluser($no_telp, $password){
 
      if($no_telp && $password) {
        $sql = "SELECT * FROM tbl_user WHERE no_telp = '$no_telp' AND password = '$password' AND (id_level = 3 OR id_level = 2)";
        $query = $this->db->query($sql);
        $result = $query->row_array();
		return ($query->num_rows() === 1 ? $result['id_user'] : false);
    }
    else {
        return false;
    }
                                
}

public function checkleveluser_driver($no_telp, $password){
 
      if($no_telp && $password) {
        $sql = "SELECT * FROM tbl_user WHERE no_telp = '$no_telp' AND password = '$password' AND id_level = 4";
        $query = $this->db->query($sql);
        $result = $query->row_array();
		return ($query->num_rows() === 1 ? $result['id_user'] : false);
    }
    else {
        return false;
    }
                                
}

public function get_profile($no_telp)
{
	$sql = "SELECT A.`id_user`,A.`id_level`,A.`kota`, A.`provinsi`,A.`username`, A.`email`, A.`nama_lengkap`, A.`alamat`, A.`no_telp`, A.`photo_profile`, B.`nama_level` 
		FROM `tbl_user` as A 
		LEFT JOIN `tbl_level` as B ON A.`id_level` = B.`id_level` 
		WHERE A.`no_telp` = '$no_telp'";
		$query = $this->db->query($sql);
		return $query->result_array();
}

public function find_user($id)
	{
		$sql = "SELECT A.`id_user`,A.`id_level`,A.`kota`, A.`provinsi`,A.`username`, A.`email`, A.`nama_lengkap`, A.`alamat`, A.`no_telp`, A.`photo_profile`, B.`nama_level` 
		FROM `tbl_user` as A 
		LEFT JOIN `tbl_level` as B ON A.`id_level` = B.`id_level` 
		WHERE `id_user` = '$id'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function check_datauser($no_telp)
	{
		$query = $this->db->query("SELECT * FROM tbl_user as A WHERE `no_telp` = $no_telp");
			if ($query->num_rows() < 1) {
			return $query;
		}else{
			return false;
		}
	}

	public function update_user($data,  $no_telp)
	{
		$this->db->where('no_telp', $no_telp);
		$q = $this->db->update('tbl_user', $data);
		return $q;
	}

	public function register_user($data)
	{
		$q = $this->db->insert('tbl_user', $data);;
		return $q;
	}


}