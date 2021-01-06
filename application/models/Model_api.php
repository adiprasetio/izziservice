<?php

class Model_api extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function check_login($username, $password)
	{
		$query = $this->db->query("SELECT * FROM user WHERE (username = '$username' OR email = '$username') AND password = '$password' AND level = 'USER'");
		
		return $query->result_array();

	}

	public function get_kategori($subkategori)
	{
		if ($subkategori == '' || $subkategori == NULL) {
			$query = $this->db->query("SELECT * FROM `kategori` ORDER BY `kategori`.`nama_kategori` ASC");
			return $query->result_array();
		}else{
			$query = $this->db->query("SELECT * FROM `sub_kategori` WHERE id_kategori = $subkategori  ORDER BY `sub_kategori`.`nama_sub_kategori` ASC");
			return $query->result_array();
		}
	}

}