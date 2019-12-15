<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		$this->load->model('user_model');
	}

	public function index(){
		$data['title']		= 'Halaman Login';
		$this->load->view('auth/login', $data, FALSE);
	}

	public function loginUser(){
		$valid = $this->form_validation;
		$valid->set_rules('username', 'Username', 'required', 
			array(
				'required'	=> '%s harus di isi !'
			)
		);

		$valid->set_rules('password', 'Password', 'required', 
			array(
				'required'	=> '%s harus di isi !'
			)
		);

		if( $valid->run() === FALSE ){
			$data['title']		= 'Halaman Login';
			$this->load->view('auth/login', $data, FALSE);
		}
		else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$hashPassword = base64_encode($password);
			$login 	  = $this->auth_model->isLogin( $username, $hashPassword );
			if( $login ){
			 //   var_dump($login['dokter_puskesmas']);exit();
			    if( $login['dokter_puskesmas'] !== "100" ) {
			        $this->session->set_flashdata('error_login', 'Anda bukan Admin !');
    				redirect(base_url().'auth/login');
			    } else {
			        $tempArray = [];
    				$tempArray = array(
    					'id'		=> $login['id'],
    					'username'	=> $login['username']
    				);
    				$this->session->set_userdata( $tempArray );
    				redirect(base_url(). 'admin/info');
			    }
			}
			else
			{
				$this->session->set_flashdata('error_login', 'Username atau Password Salah !');
				redirect(base_url().'auth/login');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		session_destroy();
		redirect( base_url().'auth','refresh' );
	}

	public function register()
	{
		$data['title']		= 'Halaman Register';

		$this->load->view('auth/register', $data, FALSE);
	}

	public function actionRegisters()
	{
		$valid = $this->form_validation;

		$valid->set_rules('username', 'Username', 'required|is_unique[users.username]', 
			array(
				'required'	=> '%s harus di isi !',
				'is_uniqe'	=> '%s '.$this->input->post('username').' sudah ada, silahkan buat baru'
			)
		);

		$valid->set_rules('email', 'Email', 'required|is_unique[users.email]', 
			array(
				'required'	=> '%s harus di isi !',
				'is_uniqe'	=> '%s '.$this->input->post('email').' sudah ada, silahkan buat baru'
			)
		);

		$valid->set_rules('phone', 'Phone', 'required|is_unique[users.phone]', 
			array(
				'required'	=> '%s harus di isi !',
				'is_uniqe'	=> '%s '.$this->input->post('phone').' sudah ada, silahkan buat baru'
			)
		);

		$valid->set_rules('location', 'Location', 'required', 
			array(
				'required'	=> '%s harus di isi !'
			)
		);

		$valid->set_rules('password', 'Password', 'required', 
			array(
				'required'	=> '%s harus di isi !'
			)
		);

		$valid->set_rules('confirmPassword', 'Confirm Password', 'required|matches[password]', 
			array(
				'required'	=> '%s harus di isi !',
				'matches'	=> '%s dan Password tidak sama !'
			)
		);

		$valid->set_rules('dokterPuskesmas', 'dokterPuskesmas', 'required', 
			array(
				'required'	=> '%s harus di isi !'
			)
		);

		if ( $valid->run() === FALSE ) {
			
			$data['title']		= 'Halaman Register';

			$this->load->view('auth/register', $data, FALSE);
		}else{

			$hash = $this->hashSSHA($this->input->post('password'));
		    $passwordku = $hash["encrypted"]; // encrypted password
		    $salt = $hash["salt"];

			$dataUser = array(
				'username'			=> $this->input->post('username'),
				'email'				=> $this->input->post('email'),
				'phone'				=> $this->input->post('phone'),
				'location'			=> $this->input->post('location'),
				'password'			=> base64_encode( $this->input->post('password') ),
				'dokter_puskesmas'	=> $this->input->post('dokterPuskesmas')
			);

			$insertData	= $this->user_model->insert( $dataUser );
			if( $insertData === TRUE ){

				$this->session->set_flashdata('respon', 'Anda berhasil mendaftar');
				redirect('auth/register','refresh');
			}
		}
	}

	private function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */