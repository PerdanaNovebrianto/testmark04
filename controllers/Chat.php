<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index(){
		$data['title']		= 'Halaman Data Chat';
		$data['sub_title']	= "Data Chat";
		$data['konten'] 	= "chat/chat";
		$this->load->view('layout/wrapper', $data, FALSE); 
	}

    public function history(){
    	$data['email']		= $this->input->get('email');
    	$data['title']		= 'Halaman Data Chat';
		$data['sub_title']	= "Riwayat Chat";
		$data['konten'] 	= "chat/chat_history";
		$this->load->view('layout/wrapper', $data, FALSE);
    }
}

/* End of file Chat.php */
/* Location: ./application/controllers/Chat.php */