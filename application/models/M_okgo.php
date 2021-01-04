<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_okgo extends CI_Model {

	public function pesanokgo($data)
	{
		$db = $this->db->insert('tbl_pesanan', $data);
	}

	public function ambilorderan($data, $id_pesanan)
	{
		$this->db->where('id_pesanan', $id_pesanan);
		$this->db->update('tbl_pesanan', $data);
	}

	public function get_list($no_telp)
	{
		$sql = "SELECT * FROM `tbl_pesanan`	WHERE `no_telp_pengirim` = '".$no_telp."' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_listhistoryorder_driver($no_telp)
	{
		$sql = "SELECT * FROM `tbl_pesanan`	WHERE `id_driver` = '".$no_telp."' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_list_orderan()
	{
		$sql = "SELECT * FROM `tbl_pesanan`	WHERE `status` = 'CARI DRIVER' OR `id_driver` = NULL";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}