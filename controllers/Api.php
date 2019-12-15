<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Api_model', 'Api');
	}

	public function check_email(){
		$email = $this->input->post("email");
		if(empty($email)){
			$response['success'] = 0;
			$response['message'] = "Email tidak boleh kosong";
		}
		else{
			$verify = $this->Api->verify_email($email);
			if($verify > 0){
				$user = $this->Api->get_user($email);
				$response['success'] = 1;
				$response['message'] = "Email sudah terdaftar";
				$response['id'] = $user['id'];
				$response['nik'] = $user['nik'];
				$response['username'] = $user['username'];
				$response['email'] = $user['email'];
				$response['notelp'] = $user['phone'];
				$response['alamat'] = $user['location'];
				$response['dokter_puskesmas'] = $user['dokter_puskesmas'];
				echo json_encode($response);
			}
			else{
				$response['success'] = 0;
				$response['message'] = "Email belum terdaftar";
				echo json_encode($response);
			}
		}
	}

	public function login(){
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$hash = base64_encode($password);
		if ((empty($email)) || (empty($password))) { 
			$response['success'] = 0;
			$response['message'] = "Email atau password tidak boleh kosong";
			echo json_encode($response);
		}
		else{
		    $login = $this->Api->login($email, $hash);
		    if(!empty($login)){
				$response['success'] = 1;
				$response['message'] = "Selamat datang". $login['username'];
				$response['id'] = $login['id'];
				$response['nik'] = $login['nik'];
				$response['username'] = $login['username'];
				$response['email'] = $login['email'];
				$response['notelp'] = $login['phone'];
				$response['alamat'] = $login['location'];
				$response['dokter_puskesmas'] = $login['dokter_puskesmas'];
				echo json_encode($response);
		    }
		    else{
				$response['success'] = 0;
				$response['message'] = "Email, telepon atau password salah";
				echo json_encode($response);
		    }
		}
	}
	
	public function forgot_password(){
		$nik = $this->input->post("nik");
		if(empty($nik)) {
			$response['success'] = 0;
			$response['message'] = "NIK tidak boleh kosong";
			echo json_encode($response);
		}
		else{
			$verify = $this->Api->verify_nik($nik);
			if($verify > 0){
				$user = $this->Api->get_user_02($nik);
				$response['success'] = 1;
				$response['message'] = "NIK sudah terdaftar";
				$response['id'] = $user['id'];
				$response['nik'] = $user['nik'];
				$response['username'] = $user['username'];
				$response['email'] = $user['email'];
				$response['notelp'] = $user['phone'];
				$response['alamat'] = $user['location'];
				$response['dokter_puskesmas'] = $user['dokter_puskesmas'];
				echo json_encode($response);
			}
			else{
				$response['success'] = 0;
				$response['message'] = "NIK belum terdaftar";
				echo json_encode($response);
			}
		}
	}

	public function register(){
		$username = $this->input->post("username");
		$nik = $this->input->post("nik");
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$location = $this->input->post("location");
    	$password = $this->input->post("password");
		$confirm_password = $this->input->post("confirm_password");
 		$hash = base64_encode($password);

		if (empty($username)) {
			$response['success'] = 0;
			$response['message'] = "Kolom username tidak boleh kosong";
			echo json_encode($response);
		} 
		else if (empty($nik)) {
			$response['success'] = 0;
			$response['message'] = "Kolom nik tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($password)) {
			$response['success'] = 0;
			$response['message'] = "Kolom password tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($email)) {
			$response['success'] = 0;
			$response['message'] = "Kolom email tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($phone)) {
			$response['success'] = 0;
			$response['message'] = "Kolom phone tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($location)) {
			$response['success'] = 0;
			$response['message'] = "Kolom location tidak boleh kosong";
			echo json_encode($response);
		} 
		else if (empty($confirm_password) || $password != $confirm_password) {
			$response['success'] = 0;
			$response['message'] = "Konfirmasi password tidak sama";
			echo json_encode($response);
		} 
		else {
			$verify = $this->Api->verify_email($email);
			if($verify > 0){
				$response['success'] = 0;
				$response['message'] = "Email sudah terdaftar";
				echo json_encode($response);
			}
			else{
				$verify = $this->Api->verify_phone($phone);
				if($verify > 0){
					$response['success'] = 0;
					$response['message'] = "Phone sudah terdaftar";
					echo json_encode($response);
				}
				else{
					$verify = $this->Api->verify_username($username);
					if($verify > 0){
						$response['success'] = 0;
						$response['message'] = "Username sudah terdaftar";
						echo json_encode($response);
					}
					else{
						$verify = $this->Api->verify_nik($nik);
						if($verify > 0){
							$response['success'] = 0;
							$response['message'] = "NIK sudah terdaftar";
							echo json_encode($response);
						}
						else{
							$data = [
						    	'nik' => $nik,
							   	'username' => $username,
							   	'email' => $email,
							   	'phone' => $phone,
							  	'location' => $location,
							   	'password' => $hash
					    	];
					    	if($this->Api->register($data) > 0){
						    	$response['success'] = 1;
								$response['message'] = "Registrasi berhasil, silahkan login";
								echo json_encode($response);
					   		}
					   		else{
							    $response['success'] = 0;
								$response['message'] = "Pendaftaran gagal";
								echo json_encode($response);
							}
						}
					}
				}
			}
		}
	}
	
	public function register_oauth(){
		$username = $this->input->post("username");
		$nik = $this->input->post("nik");
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$location = $this->input->post("location");

		if (empty($username)) {
			$response['success'] = 0;
			$response['message'] = "Kolom username tidak boleh kosong";
			echo json_encode($response);
		} 
		else if (empty($nik)) {
			$response['success'] = 0;
			$response['message'] = "Kolom nik tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($email)) {
			$response['success'] = 0;
			$response['message'] = "Kolom email tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($phone)) {
			$response['success'] = 0;
			$response['message'] = "Kolom phone tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($location)) {
			$response['success'] = 0;
			$response['message'] = "Kolom location tidak boleh kosong";
			echo json_encode($response);
		} 
		else {
			$verify = $this->Api->verify_email($email);
			if($verify > 0){
				$response['success'] = 0;
				$response['message'] = "Email sudah terdaftar";
				echo json_encode($response);
			}
			else{
				$verify = $this->Api->verify_phone($phone);
				if($verify > 0){
					$response['success'] = 0;
					$response['message'] = "Phone sudah terdaftar";
					echo json_encode($response);
				}
				else{
					$verify = $this->Api->verify_username($username);
					if($verify > 0){
						$response['success'] = 0;
						$response['message'] = "Username sudah terdaftar";
						echo json_encode($response);
					}
					else{
						$verify = $this->Api->verify_nik($nik);
						if($verify > 0){
							$response['success'] = 0;
							$response['message'] = "NIK sudah terdaftar";
							echo json_encode($response);
						}
						else{
							$data = [
						    	'nik' => $nik,
							   	'username' => $username,
							   	'email' => $email,
							   	'phone' => $phone,
							  	'location' => $location
					    	];
					    	if($this->Api->register($data) > 0){
						   		$response['success'] = 1;
								$response['message'] = "Registrasi berhasil, silahkan login";
								echo json_encode($response);
				    		}
				    		else{
							    $response['success'] = 0;
								$response['message'] = "Pendaftaran gagal";
								echo json_encode($response);
					   		}
						}
					}
				}
			}
		}
	}
	
	public function update_user(){
		$id = $this->input->post("id");
		$username = $this->input->post("username");
		$nik = $this->input->post("nik");
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$location = $this->input->post("location");
    	$password = $this->input->post("password");
		$confirm_password = $this->input->post("confirm_password");
 		$hash = base64_encode($password);
		
		$user = $this->Api->get_user_01($id);
		$old_nik = $user['nik'];
		$old_username = $user['username'];
		$old_email = $user['email'];
		$old_phone = $user['phone'];
		
		$error = 'false';

		if (empty($username)) {
			$error = 'true';
			$response['success'] = 0;
			$response['message'] = "Kolom username tidak boleh kosong";
			echo json_encode($response);
		} 
		else if (empty($nik)) {
			$response['success'] = 0;
			$response['message'] = "Kolom nik tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($password)) {
			$error = 'true';
			$response['success'] = 0;
			$response['message'] = "Kolom password tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($email)) {
			$error = 'true';
			$response['success'] = 0;
			$response['message'] = "Kolom email tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($phone)) {
			$error = 'true';
			$response['success'] = 0;
			$response['message'] = "Kolom phone tidak boleh kosong";
			echo json_encode($response);
		}
		else if (empty($location)) {
			$error = 'true';
			$response['success'] = 0;
			$response['message'] = "Kolom location tidak boleh kosong";
			echo json_encode($response);
		} 
		else if (empty($confirm_password) || $password != $confirm_password) {
			$error = 'true';
			$response['success'] = 0;
			$response['message'] = "Konfirmasi password tidak sama";
			echo json_encode($response);
		}
		else if ($nik != $old_nik){
			$verify = $this->Api->verify_nik($nik);
			if($verify > 0){
				$error = 'true';
				$response['success'] = 0;
				$response['message'] = "NIK sudah terdaftar";
				echo json_encode($response);
			}
		}
		else if($username != $old_username){
			$verify = $this->Api->verify_username($username);
			if($verify > 0){
				$error = 'true';
				$response['success'] = 0;
				$response['message'] = "Username sudah terdaftar";
				echo json_encode($response);
			}
		}
		else if($email != $old_email){
			$verify = $this->Api->verify_email($email);
			if($verify > 0){
				$error = 'true';
				$response['success'] = 0;
				$response['message'] = "Email sudah terdaftar";
				echo json_encode($response);
			}
		}
		else if($phone != $old_phone){
			$verify = $this->Api->verify_phone($phone);
			if($verify > 0){
				$error = 'true';
				$response['success'] = 0;
				$response['message'] = "Phone sudah terdaftar";
				echo json_encode($response);
			}
		}
		if($error === 'false') {
			$data = [
				'nik' => $nik,
				'username' => $username,
				'email' => $email,
				'phone' => $phone,
				'location' => $location,
				'password' => $hash
			];
			if($this->Api->update($id, $data) > 0){
				$response['success'] = 1;
				$response['message'] = "Update berhasil";
				echo json_encode($response);
			}
			else{
				$response['success'] = 0;
				$response['message'] = "Tidak ada data yang di update";
				echo json_encode($response);
			}
		}
	}
	
	public function info(){
		$info = $this->Api->all_info();
		foreach ($info as $key) {
			$response['berita'][] = array(
				'id' => $key->id,
				'judul' => $key->judul,
				'tanggal' => $key->tanggal,
				'pengarang' => $key->pengarang,
				'gambar' => 'http://103.108.187.249/testmark05/assets/dist/img/content/'.$key->gambar,
				'isi' => $key->isi
			);
		}
		echo json_encode($response);
	}

	public function detail_info($id){
		$info = $this->Api->get_info($id);
		$response['id'] = $info['id'];
		$response['judul'] = $info['judul'];
		$response['tanggal'] = $info['tanggal'];
		$response['pengarang'] = $info['pengarang'];
		$response['gambar'] = 'http://103.108.187.249/testmark05/assets/dist/img/content/'.$info['gambar'];
		$response['isi'] = $info['isi'];
		echo json_encode($response);
	}

	public function tips(){
		$tips = $this->Api->all_tips();
		foreach ($tips as $key) {
			$response['tipskesehatan'][] = array(
				'id' => $key->id,
				'judul' => $key->judul,
				'tanggal' => $key->tanggal,
				'pengarang' => $key->pengarang,
				'gambar' => 'http://103.108.187.249/testmark05/assets/dist/img/content/'.$key->gambar,
				'isi' => $key->isi
			);
		}
		echo json_encode($response);
	}

	public function detail_tips($id){
		$tips = $this->Api->get_tips($id);
		$response['id'] = $tips['id'];
		$response['judul'] = $tips['judul'];
		$response['tanggal'] = $tips['tanggal'];
		$response['pengarang'] = $tips['pengarang'];
		$response['gambar'] = 'http://103.108.187.249/testmark05/assets/dist/img/content/'.$tips['gambar'];
		$response['isi'] = $tips['isi'];
		echo json_encode($response);
	}

	/**
    * Encrypting password
    * @param password
    * returns salt and encrypted password
    */
    private function hashSSHA($password) {
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */