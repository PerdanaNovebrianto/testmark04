<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	private $table = "users";
	private $table_puskesmas = "puskesmas";
	
    private $selectData = [
		"users.*",
		"puskesmas.nama"
	];

	public function fetchAll()
	{
		$this->db->select( $this->selectData );
		$this->db->join('puskesmas', 'puskesmas.id_puskesmas = users.dokter_puskesmas', 'left');
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

	public function fetchSingleUser( $id )
	{
		$this->db->where('id', $id);
		$query = $this->db->get( $this->table );
		return $query->result();
	}

	public function update( $id, $dataUser )
	{
		$this->db->where('id', $id);
		$this->db->update( $this->table , $dataUser);
	}
	
	public function getDropDownPuskesmas() {
	    return $this->db->get( $this->table_puskesmas )->result();
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */