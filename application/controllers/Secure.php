<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Secure extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('login') != NULL){
			redirect('admin');
		}else{
			$this->load->view('login');
		}
	}

	public function login_check()
	{
		$this->load->model('M_user');

		$no_telp 	= $this->input->post('no_telp');
		$password 	= SHA1($this->input->post('password'));
		$data 		= $this->M_user->checkleveluser($no_telp, $password);
		$level 		= $this->M_user->find_user($data);

		foreach ($level as $lvl){
			$leveluser = $lvl['id_level'];
			$no_telp = $lvl['no_telp'];
			$nama = $lvl['nama_lengkap'];
			$username = $lvl['username'];
			$alamat = $lvl['alamat'];
			$kota = $lvl['kota'];
			$provinsi = $lvl['provinsi'];
			$email = $lvl['email'];
		}

		if($data){
			$validator['success'] = true;
			$validator['status'] = 'success';
			$validator['messages'] = "Selamat Datang di OKEGO";
			$validator['data'] = [array('no_telp' => $no_telp,'username' => $username,'nama_lengkap' => $nama,'email' => $email,'alamat' => $alamat,'provinsi' => $provinsi,'kota' => $kota)];

		}else{

			$validator['success'] = false;
			$validator['status'] = 'error';
			$validator['messages'] = "Username / Password anda salah";		

		}

		echo json_encode($validator);

	}

	public function login_check_driver()
	{
		$this->load->model('M_user');

		$no_telp 	= $this->input->post('no_telp');
		$password 	= SHA1($this->input->post('password'));
		$data 		= $this->M_user->checkleveluser_driver($no_telp, $password);
		$level 		= $this->M_user->find_user($data);

		foreach ($level as $lvl){
			$leveluser 	= $lvl['id_level'];
			$no_telp 	= $lvl['no_telp'];
			$nama 		= $lvl['nama_lengkap'];
			$username 	= $lvl['username'];
			$alamat 	= $lvl['alamat'];
			$kota 		= $lvl['kota'];
			$provinsi 	= $lvl['provinsi'];
			$email 		= $lvl['email'];
		}

		if($data){
			$validator['success'] = true;
			$validator['status'] = 'success';
			$validator['messages'] = "Selamat Datang di OKEGO";
			$validator['data'] = [array('no_telp' => $no_telp,'username' => $username,'nama_lengkap' => $nama,'email' => $email,'alamat' => $alamat,'provinsi' => $provinsi,'kota' => $kota)];

		}else{

			$validator['success'] = false;
			$validator['status'] = 'error';
			$validator['messages'] = "Username / Password anda salah";		

		}

		echo json_encode($validator);

	}


	public function pesanokgo()
	{
		$data = array(
			'nama_pengirim' 	=> $this->input->post('nama_lengkap'),
			'no_telp_pengirim' 	=> $this->input->post('no_telp'),
			'alamat_pengirim' 	=> $this->input->post('alamat'),
			'nama_penerima' 	=> $this->input->post('nama_penerima'),
			'no_telp_penerima'	=> $this->input->post('no_telp_penerima'),
			'alamat_penerima' 	=> $this->input->post('alamat_penerima'),
			'tanggal' 			=> date('Y-m-d H:i:s'),
			'tanggal_pengambilan' => $this->input->post('tanggal_pengambilan'),
			'jenis_barang'		=> $this->input->post('jenis_barang'),
			'berat' 			=> $this->input->post('berat')
		);

		$this->load->model('M_okgo');
		$this->M_okgo->pesanokgo($data);

		$validator['success'] = true;
		$validator['status'] = 'success';
		$validator['messages'] = "OKGO Sukses dipesan, tunggu info selanjutnya";
		$validator['data'] = [array(
			'nama_pengirim' 	=> $this->input->post('nama_lengkap'),
			'no_telp_pengirim' 	=> $this->input->post('no_telp'),
			'alamat_pengirim' 	=> $this->input->post('alamat'),
			'nama_penerima' 	=> $this->input->post('nama_penerima'),
			'no_telp_penerima'	=> $this->input->post('no_telp_penerima'),
			'alamat_penerima' 	=> $this->input->post('alamat_penerima'),
			'tanggal' 			=> date('Y-m-d H:i:s'),
			'tanggal_pengambilan' => $this->input->post('tanggal_pengambilan'),
			'jenis_barang'		=> $this->input->post('jenis_barang'),
			'berat' 			=> $this->input->post('berat')
		)];
		

		echo json_encode($validator);
	}

	public function get_listhistoryorder_driver(){
		$no_telp = $this->input->get('no_telp');
		$this->load->model('M_okgo');
		$list = $this->M_okgo->get_listhistoryorder_driver($no_telp);
		if ($list) {
			$result['status'] = 'success';
			$result['data'] = array();

			foreach ($list as $key) {
				$validator = array(
					'id_pesanan' 			=> $key['id_pesanan'],
					'id_driver' 			=> $key['id_driver'],
					'nama_lengkap' 			=> $key['nama_pengirim'],
					'no_telp' 				=> $no_telp,
					'alamat' 				=> $key['alamat_pengirim'],
					'nama_penerima' 		=> $key['nama_penerima'],
					'no_telp_penerima' 		=> $key['no_telp_penerima'],
					'alamat_penerima' 		=> $key['alamat_penerima'],
					'status' 			=> $key['status'],
					'tanggal' 				=> $key['tanggal'],
					'tanggal_pengambilan' 	=> $key['tanggal_pengambilan']);
				array_push($result['data'],$validator);
			}
			echo json_encode($result);
		}else{
			$result['status'] = 'error';
			$result['data'] = array();

			foreach ($list as $key) {
				$validator = array(
					'id_pesanan' 			=> $key['id_pesanan'],
					'id_driver' 			=> $key['id_driver'],
					'nama_lengkap' 			=> $key['nama_pengirim'],
					'no_telp' 				=> $no_telp,'alamat' => $key['alamat_pengirim'],
					'nama_penerima' 		=> $key['nama_penerima'],
					'no_telp_penerima' 		=> $key['no_telp_penerima'],
					'alamat_penerima' 		=> $key['alamat_penerima'],
					'status' 			=> $key['status'],
					'tanggal' 				=> $key['tanggal'],
					'tanggal_pengambilan' 	=> $key['tanggal_pengambilan']);
				array_push($result['data'],$validator);
			}
			echo json_encode($result);
		}
		
	}

	public function get_list(){
		$no_telp = $this->input->get('no_telp');
		$this->load->model('M_okgo');
		$list = $this->M_okgo->get_list($no_telp);
		if ($list) {
			$result['status'] = 'success';
			$result['data'] = array();

			foreach ($list as $key) {
				$validator = array(
					'id_pesanan' 			=> $key['id_pesanan'],
					'id_driver' 			=> $key['id_driver'],
					'nama_lengkap' 			=> $key['nama_pengirim'],
					'no_telp' 				=> $no_telp,
					'alamat' 				=> $key['alamat_pengirim'],
					'nama_penerima' 		=> $key['nama_penerima'],
					'no_telp_penerima' 		=> $key['no_telp_penerima'],
					'alamat_penerima' 		=> $key['alamat_penerima'],
					'tanggal' 				=> $key['tanggal'],
					'tanggal_pengambilan' 	=> $key['tanggal_pengambilan'],
					'jenis_barang' 				=> $key['jenis_barang'],
					'berat' 	=> $key['berat']);
				array_push($result['data'],$validator);
			}
			echo json_encode($result);
		}else{
			$result['status'] = 'error';
			$result['data'] = array();

			foreach ($list as $key) {
				$validator = array(
					'id_pesanan' 			=> $key['id_pesanan'],
					'id_driver' 			=> $key['id_driver'],
					'nama_lengkap' 			=> $key['nama_pengirim'],
					'no_telp' 				=> $no_telp,'alamat' => $key['alamat_pengirim'],
					'nama_penerima' 		=> $key['nama_penerima'],
					'no_telp_penerima' 		=> $key['no_telp_penerima'],
					'alamat_penerima' 		=> $key['alamat_penerima'],
					'tanggal' 				=> $key['tanggal'],
					'tanggal_pengambilan' 	=> $key['tanggal_pengambilan'],
					'jenis_barang' 				=> $key['jenis_barang'],
					'berat' 	=> $key['berat']);
				array_push($result['data'],$validator);
			}
			echo json_encode($result);
		}
		
	}

	public function update_save()
	{
		$this->load->model('M_user');
		$no_telp = $this->input->post('no_telp');

		$path = 'uploads/profile/';
		if(!file_exists($path)){
			mkdir($path);
		}

		$path = 'uploads/profile/'.$no_telp;
		if(!file_exists($path)){
			mkdir($path);
		}

		$tmp_name = $_FILES["photo_profile"]["tmp_name"];
		$image = basename($_FILES["photo_profile"]["name"]);
		move_uploaded_file($tmp_name , 'uploads/profile/'.$no_telp.'/'.$image);

		// $image = $this->input->post('photo_profile');
		// $gambar = base64_decode($image);
		// $image = $this->input->post('photo_profile');
		$paths = base_url().'uploads/profile/'.$no_telp.'/';

		//file_put_contents($paths,base64_decode($image));

		if($image != NULL || $image != ''){
			
			$linkgambar = $paths.$image;

			if ($this->input->post('password') == NULL) {
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'alamat' => $this->input->post('alamat'),
					'photo_profile' => $linkgambar,
					'kota' => $this->input->post('kota'),
					'provinsi' => $this->input->post('provinsi'),
					'no_telp' => $this->input->post('no_telp'),

				);
			}else{
				$data = array(
					'username' => $this->input->post('username'),
					'password' => SHA1($this->input->post('password')),
					'email' => $this->input->post('email'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'alamat' => $this->input->post('alamat'),
					'kota' => $this->input->post('kota'),
					'photo_profile' => $linkgambar,
					'provinsi' => $this->input->post('provinsi'),
					'no_telp' => $this->input->post('no_telp'),
				);
			}

			

			$update = $this->M_user->update_user($data, $no_telp);

			$validator['success'] = true;
			$validator['status'] = 'success';
			$validator['messages'] = "Data berhasil diupdate";
			$validator['data'] = [array(
				'username' => $data['username'],
				'password' => SHA1($this->input->post('password')),
				'email' => $data['email'],
				'nama_lengkap' => $data['nama_lengkap'],
				'alamat' => $data['alamat'],
				'kota' => $data['kota'],
				'photo_profile' => $data['photo_profile'],
				'provinsi' => $data['provinsi'],
				'no_telp' => $data['no_telp']
			)];
			echo json_encode($validator);
		}else{
			if ($this->input->post('password') == NULL) {
				$data = array(
					'username' => $this->input->post('username'),
					'email' => $this->input->post('email'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'alamat' => $this->input->post('alamat'),
					'kota' => $this->input->post('kota'),
					'provinsi' => $this->input->post('provinsi'),
					'photo_profile' => $linkgambar,
					'no_telp' => $this->input->post('no_telp')
				);
			}else{
				$data = array(
					'username' => $this->input->post('username'),
					'password' => SHA1($this->input->post('password')),
					'email' => $this->input->post('email'),
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'alamat' => $this->input->post('alamat'),
					'kota' => $this->input->post('kota'),
					'provinsi' => $this->input->post('provinsi'),
					'photo_profile' => $linkgambar,
					'no_telp' => $this->input->post('no_telp')
				);
			}

			$update = $this->M_user->update_user($data, $no_telp);

			$validator['success'] = true;
			$validator['status'] = 'success';
			$validator['messages'] = "Data berhasil diupdate, silahkan login";
			$validator['data'] = [array(
				'username' => $data['username'],
				'password' => SHA1($this->input->post('password')),
				'email' => $data['email'],
				'nama_lengkap' => $data['nama_lengkap'],
				'alamat' => $data['alamat'],
				'kota' => $data['kota'],
				'photo_profile' =>  $data['photo_profile'],
				'provinsi' => $data['provinsi'],
				'no_telp' => $data['no_telp']
			)];
			echo json_encode($validator);
		}
	}

	public function register_save()
	{
		$this->load->model('M_user');
		$no_telp = $this->input->post('no_telp');

		$data = array(
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'no_telp' => $no_telp,
			'password' => SHA1($this->input->post('password')),
			'id_level' => 3
		);

		$check_datauser = $this->M_user->check_datauser($no_telp);

		if ($check_datauser) {
			$register = $this->M_user->register_user($data);
			$validator['success'] = true;
			$validator['status'] = 'success';
			$validator['messages'] = "Data berhasil tersimpan, silahkan login";
			$validator['data'] = [array(
				'nama_lengkap' => $data['nama_lengkap'],
				'no_telp' => $data['no_telp'],
				'password' => $this->input->post('password')
			)];
		}else{

			$validator['success'] = false;
			$validator['status'] = 'error';
			$validator['messages'] = "Anda sudah terdaftar, silahkan login";
		}

		echo json_encode($validator);

	}

	public function get_profile()
	{
		$this->load->model('M_user');
		$no_telp = $this->input->get('no_telp');
		$data = $this->M_user->get_profile($no_telp);

		if ($data) {
			foreach ($data as $key => $dat) {
				$validator['success'] = true;
				$validator['status'] = 'success';
				$validator['data'] = [array(
					'nama_lengkap' => $dat['nama_lengkap'],
					'no_telp' => $dat['no_telp'],
					'username' => $dat['username'],
					'email' => $dat['email'],
					'kota' => $dat['kota'],
					'photo_profile' => $dat['photo_profile'],
					'provinsi' => $dat['provinsi'],
					'alamat' => $dat['alamat']
				)];

				echo json_encode($validator);
			}
		}else{
			foreach ($data as $key => $dat) {
				$validator['success'] = false;
				$validator['status'] = 'error';
				$validator['data'] = [];

				echo json_encode($validator);
			}
		}
	}

	public function ambilorderan()
	{
		$no_telp = $this->input->post('no_telp');
		$id_pesanan = $this->input->post('id_pesanan');

		$data = array(
			'id_driver' => $no_telp,
			'status' => 'PROSES'
		);

		$this->load->model('M_okgo');
		$data = $this->M_okgo->ambilorderan($data, $id_pesanan);

		$validator['success'] = true;
		$validator['status'] = 'success';
		$validator['messages'] = "Pesanan Telah Diambil";
		$validator['data'] = [array(
			'no_telp' => $no_telp,
			'id_pesanan' => $id_pesanan
		)];

		echo json_encode($validator);
	}

	public function get_list_orderan(){
		$this->load->model('M_okgo');
		$list = $this->M_okgo->get_list_orderan();
		if ($list) {
			$result['status'] = 'success';
			$result['data'] = array();

			foreach ($list as $key) {
				$validator = array(
					'id_pesanan' 			=> $key['id_pesanan'],
					'nama_lengkap' 			=> $key['nama_pengirim'],
					'no_telp' 				=> $key['no_telp_pengirim'],
					'alamat' 				=> $key['alamat_pengirim'],
					'nama_penerima' 		=> $key['nama_penerima'],
					'no_telp_penerima' 		=> $key['no_telp_penerima'],
					'alamat_penerima' 		=> $key['alamat_penerima'],
					'tanggal' 				=> $key['tanggal'],
					'tanggal_pengambilan' 	=> $key['tanggal_pengambilan']);
				array_push($result['data'],$validator);
			}
			echo json_encode($result);
		}else{
			$result['status'] = 'error';
			$result['data'] = array();

			foreach ($list as $key) {
				$validator = array(
					'id_pesanan' 			=> $key['id_pesanan'],
					'nama_lengkap' 			=> $key['nama_pengirim'],
					'no_telp' 				=> $key['no_telp_pengirim'],
					'alamat' 				=> $key['alamat_pengirim'],
					'nama_penerima' 		=> $key['nama_penerima'],
					'no_telp_penerima' 		=> $key['no_telp_penerima'],
					'alamat_penerima' 		=> $key['alamat_penerima'],
					'tanggal' 				=> $key['tanggal'],
					'tanggal_pengambilan' 	=> $key['tanggal_pengambilan']);
				array_push($result['data'],$validator);
			}
			echo json_encode($result);
		}
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		redirect('secure');
	}
}
