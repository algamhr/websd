<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function listing()
	{
		$query=$this->db->get('user');
		return $query->result();
	}

	public function listing_user()
	{
		$query=$this->db->query("select * from user where akses_level=1");
		return $query->result();
	}

		//show data detail
	public function detail($username)
	{
		$query=$this->db->get_where('user',array('username'=>$username));
		return $query->row();
	}

	//tambah data
	public function add($data)
	{
		$this->db->insert('user', $data);
	}

	//edit data
	public function update($data)
	{
		$this->db->where('username', $data['username']);
		$this->db->update('user', $data);
	}

	//delete data
	public function delete($data)
	{
		$this->db->where('username', $data['username']);
		$this->db->delete('user', $data);
	}

}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */