<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	private $table = 'users';

	public function isLogin( $username, $password )
	{
		$query = $this->db->query("SELECT * FROM users WHERE email = '$username' AND password = '$password'");
		if( $query->num_rows() > 0 )
		{
			return $query->row_array();
		}
	}

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */