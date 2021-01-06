<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	function __construct(){
		parent::__construct();
		error_reporting(0);         
	}

	public function login()
	{
		$username = trim($this->input->post('username'));
		$password = md5(trim($this->input->post('password')));

		$this->load->model('Model_api');

		$data = $this->Model_api->check_login($username, $password);

		foreach ($data as $dt){
			$id_user = $dt['id_user'];
			$username = $dt['username'];
			$email = $dt['email'];
			$password = $dt['password'];
		}

		if($data){

			$user_data = array(
				'id' => $id_user,
				'username' => $username,
				'email' => $email,
				'password' => $password,
			);

			$validator['success'] = true;
			$validator['status'] = 'success';
			$validator['messages'] = "Berhasil Login";
			$validator['data'] = [$user_data];

		}else{

			$validator['success'] = false;
			$validator['status'] = 'error';
			$validator['messages'] = "Username / Password anda salah";

		}

		echo json_encode($validator);

	}

	public function kategori($subkategori = '')
	{

		$this->load->model('Model_api');
		$data = $this->Model_api->get_kategori($subkategori);
		if($data){

			foreach ($data as $dt){
				

				if ($subkategori == '' || $subkategori == NULL) {
					$id_kategori = $dt['id_kategori'];
					$nama_kategori = $dt['nama_kategori'];

					$validator[] = array(
						'id_kategori' => $id_kategori,
						'nama_kategori' => $nama_kategori,
					);
				}else{
					$id_sub_kategori = $dt['id_sub_kategori'];
					$nama_sub_kategori = $dt['nama_sub_kategori'];
					
					$validator[] = array(
						
						'id_kategori' => $id_sub_kategori,
						'nama_kategori' => $nama_sub_kategori,
					);
				}

				

			}



		}else{
			$validator['success'] = false;
			$validator['data'] = [];

		}
		echo json_encode($validator);
	}
}