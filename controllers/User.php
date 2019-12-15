<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index(){
		$data['title']		= 'Halaman Data User';
		$data['sub_title']	= "Data User";
		$data['user']		= $this->user_model->fetchAll();
		$data['konten'] 	= "user/user";
		$this->load->view('layout/wrapper', $data, FALSE); 
	}

	public function add(){
		$data['title']		= 'Halaman Data User';
		$data['sub_title']	= "Add User";
		$data['puskesmas']  = $this->user_model->getDropDownPuskesmas();
		$data['konten'] 	= "user/add_user";
		$this->load->view('layout/wrapper', $data, FALSE); 
	}

	public function actionAdd(){
		if ($this->input->post('btnSimpan') !== NULL){
			$valid = $this->form_validation;
			$valid->set_rules('nik', 'NIK', 'required|is_unique[users.nik]', 
				array(
					'required'	=> '%s harus di isi !',
					'is_unique'	=> '%s '.$this->input->post('nik').' sudah ada, silahkan buat baru'
				)
			);
			$valid->set_rules('username', 'Username', 'required|is_unique[users.username]', 
				array(
					'required'	=> '%s harus di isi !',
					'is_unique'	=> '%s '.$this->input->post('username').' sudah ada, silahkan buat baru'
				)
			);
			$valid->set_rules('email', 'Email', 'required|is_unique[users.email]', 
				array(
					'required'	=> '%s harus di isi !',
					'is_unique'	=> '%s '.$this->input->post('email').' sudah ada, silahkan buat baru'
				)
			);
			$valid->set_rules('phone', 'Phone', 'required|is_unique[users.phone]', 
				array(
					'required'	=> '%s harus di isi !',
					'is_unique'	=> '%s '.$this->input->post('phone').' sudah ada, silahkan buat baru'
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
			$valid->set_rules('dokterPuskesmas', 'dokterPuskesmas', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			if($valid->run() === FALSE) {
				$data['title']		= 'Halaman Data User';
				$data['sub_title']	= "Add User";
				$data['konten'] 	= "user/add_user";
				$this->load->view('layout/wrapper', $data, FALSE);
			}
			else{
				$hash = $this->hashSSHA($this->input->post('password'));
			    $passwordku = $hash["encrypted"]; // encrypted password
				$dataUser = array(
				    'nik'			    => $this->input->post('nik'),
					'username'			=> $this->input->post('username'),
					'email'				=> $this->input->post('email'),
					'phone'				=> $this->input->post('phone'),
					'location'			=> $this->input->post('location'),
					'password'			=> base64_encode($this->input->post('password')),
					'dokter_puskesmas'	=> $this->input->post('dokterPuskesmas')
				);
				$this->user_model->insert($dataUser);
				$this->session->set_flashdata('respon', 'Data berhasil di Inputkan');
				redirect('admin/user','refresh');
			}
		}
		else{
			show_404();
		}
	}

    public function fetchSingle($id){
    	$dataUser = $this->user_model->fetchSingleUser($id);
    	$data['title']		= 'Halaman Data User';
		$data['sub_title']	= "Update User";
		$data['user']		= $dataUser;
		$data['konten'] 	= "user/update_user";
		$this->load->view('layout/wrapper', $data, FALSE);
    }

    public function actionUpdate(){
    	if ($this->input->post('btnSimpan') !== NULL){
    		$id = $this->input->post('id');
    		$valid = $this->form_validation;
    		if($this->input->post('nik') !== $this->input->post('old_nik')){
    			$valid->set_rules('nik', 'NIK', 'required|is_unique[users.nik]', 
					array(
						'required'	=> '%s harus di isi !',
						'is_unique'	=> '%s '.$this->input->post('nik').' sudah ada, silahkan buat baru'
					)
				);
    		}
			if($this->input->post('username') !== $this->input->post('old_username')){
				$valid->set_rules('username', 'Username', 'required|is_unique[users.username]', 
					array(
						'required'	=> '%s harus di isi !',
						'is_unique'	=> '%s '.$this->input->post('username').' sudah ada, silahkan buat baru'
					)
				);
			}
			if($this->input->post('email') !== $this->input->post('old_email')){
				$valid->set_rules('email', 'Email', 'required|is_unique[users.email]', 
					array(
						'required'	=> '%s harus di isi !',
						'is_unique'	=> '%s '.$this->input->post('email').' sudah ada, silahkan buat baru'
					)
				);
			}
			if($this->input->post('phone') !== $this->input->post('old_phone')){
				$valid->set_rules('phone', 'Phone', 'required|is_unique[users.phone]', 
					array(
						'required'	=> '%s harus di isi !',
						'is_unique'	=> '%s '.$this->input->post('phone').' sudah ada, silahkan buat baru'
					)
				);
			}
			$valid->set_rules('location', 'Location', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			$valid->set_rules('dokterPuskesmas', 'dokterPuskesmas', 'required', 
				array(
					'required'	=> '%s harus di isi !'
				)
			);
			if($valid->run() === FALSE) {
		    	$dataUser = $this->user_model->fetchSingleUser($id);
		    	$data['title']		= 'Halaman Data User';
				$data['sub_title']	= "Update User";
				$data['user']		= $dataUser;
				$data['konten'] 	= "user/update_user";
				$this->load->view('layout/wrapper', $data, FALSE);
			}
			else{
		    	$password = $this->input->post('password');
		    	if($password !== ""){
					$dataUser = array(
						'nik'			    => $this->input->post('nik'),
						'username'			=> $this->input->post('username'),
						'email'				=> $this->input->post('email'),
						'phone'				=> $this->input->post('phone'),
						'location'			=> $this->input->post('location'),
						'password'			=> base64_encode($this->input->post('password')),
						'dokter_puskesmas'	=> $this->input->post('dokterPuskesmas')
					);
					$this->user_model->update($id, $dataUser);
					$this->session->set_flashdata('respon', 'Data berhasil di Update');
					redirect('admin/user','refresh');
		    	}
		    	else{
					$dataUser = array(
					    'nik'			    => $this->input->post('nik'),
						'username'			=> $this->input->post('username'),
						'email'				=> $this->input->post('email'),
						'phone'				=> $this->input->post('phone'),
						'location'			=> $this->input->post('location'),
						'dokter_puskesmas'	=> $this->input->post('dokterPuskesmas')
					);
					$this->user_model->update($id, $dataUser);
					$this->session->set_flashdata('respon', 'Data berhasil di Update');
					redirect('admin/user','refresh');
		    	}
			}
		}
		else{
			show_404();
		}
    }

    public function deleteUser($id){
    	if ($this->input->post('btnSimpan') !== NULL){
    		$this->user_model->delete($id);
    		$this->session->set_flashdata('respon', 'Data berhasil di Hapus');
			redirect('admin/user','refresh');
		}
		else{
			show_404();
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

/* End of file User.php */
/* Location: ./application/controllers/User.php */