<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_Model {

	private $table = "infokesehatan";

	public function fetchAll()
	{
		$query = $this->db->get( $this->table );
		return $query->result();
	}

	public function insert( $dataForm )
	{
		$this->db->insert( $this->table , $dataForm);
		return true;
	}

	public function delete( $id )
	{
		$this->db->where('id', $id);
		$this->db->delete( $this->table );
		return true;
	}

	public function fetchId( $id )
	{
		$this->db->where('id', $id);
		$query = $this->db->get( $this->table );
		return $query->result();
	}

	public function update( $id, $dataInfo )
	{
		$this->db->where('id', $id);
		$this->db->update( $this->table , $dataInfo);
	}
}

/* End of file Info_model.php */
/* Location: ./application/models/Info_model.php */