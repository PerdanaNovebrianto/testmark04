<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

	private $table_user = "users";
	private $table_tips = "tipskesehatan";
	private $table_info = "infokesehatan";

	public function login($email, $password){
		$query = $this->db->query("SELECT * FROM users WHERE (email='$email' OR phone='$email') AND password='$password'");
		return $query->row_array();	
	}

	public function get_user($email){
		$query = $this->db->get_where('users', array('email' => $email));
		return $query->row_array();
	}
	
	public function get_user_01($id){
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_user_02($nik){
		$query = $this->db->get_where('users', array('nik' => $nik));
		return $query->row_array();
	}

	public function verify_nik($nik){
		$query = $this->db->query("SELECT * FROM users WHERE nik='$nik'");
		return $query->num_rows();	
	}

	public function verify_email($email){
		$query = $this->db->query("SELECT * FROM users WHERE email='$email'");
		return $query->num_rows();	
	}

	public function verify_phone($phone){
		$query = $this->db->query("SELECT * FROM users WHERE phone='$phone'");
		return $query->num_rows();	
	}

	public function verify_username($username){
		$query = $this->db->query("SELECT * FROM users WHERE username='$username'");
		return $query->num_rows();	
	}

	public function register($data){
		$this->db->insert('users', $data);
		return $this->db->affected_rows();
	}
	
	public function update($id, $data){
		$this->db->where('id', $id);
		$this->db->update('users' , $data);
		return $this->db->affected_rows();
	}

	public function all_info(){
		$query = $this->db->get('infokesehatan');
		return $query->result();
	}

	public function get_info($id){
		$query = $this->db->get_where('infokesehatan', array('id' => $id));
		return $query->row_array();
	}

	public function all_tips(){
		$query = $this->db->get('tipskesehatan');
		return $query->result();
	}

	public function get_tips($id){
		$query = $this->db->get_where('tipskesehatan', array('id' => $id));
		return $query->row_array();
	}
}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */