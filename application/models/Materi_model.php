<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function listing()
	{
		$this->db->select('materi.*, user.username, pelajaran.nama_pelajaran, kelas.nama_kelas');
		$this->db->from('materi');
		//relasi database
		$this->db->join('user', 'user.username = materi.username', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = materi.id_pelajaran', 'left');
		$this->db->join('kelas', 'kelas.id = materi.id_kelas', 'left');
		//end relasi database
		$this->db->order_by('id_materi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function listing_guru($id_user)
	{
		$query = $this->db->query("select materi.*, kelas.nama_kelas, 
								pelajaran.nama_pelajaran, 
								user.id as iduser, 
								user.username as user_username 
								from materi 
								left join user on user.id = materi.id_user 
								left join kelas on materi.id_kelas = kelas.id
								left join pelajaran on materi.id_pelajaran = pelajaran.id
								where materi.id_user=$id_user");
		return $query->result();
	}

	public function listing_home1()
	{
		$this->db->select('materi.*, user.username, pelajaran.nama_pelajaran, kelas.nama_kelas');
		$this->db->from('materi');
		//relasi database
		$this->db->join('user', 'user.username = materi.username', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = materi.id_pelajaran', 'left');
		$this->db->join('kelas', 'kelas.id = materi.id_kelas', 'left');
		//end relasi database
		$this->db->where(array('materi.status_materi' => "publish"));
		$this->db->order_by('id_materi', 'desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}

	public function listing_home3()
	{
		$this->db->select('materi.*, user.username as user_username, pelajaran.nama_pelajaran, kelas.nama_kelas');
		$this->db->from('materi');
		//relasi database
		$this->db->join('user', 'user.username = materi.username', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = materi.id_pelajaran', 'left');
		$this->db->join('kelas', 'kelas.id = materi.id_kelas', 'left');
		//end relasi database
		$this->db->where(array('materi.status_materi' => "publish"));
		$this->db->order_by('id_materi', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function add($data)
	{
		$this->db->insert('materi', $data);
	}

	public function update($data)
	{
		$this->db->where('id_materi', $data['id_materi']);
		$this->db->update('materi', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_materi', $data['id_materi']);
		$this->db->delete('materi', $data);
	}

	public function detail($id_materi)
	{
		$query = $this->db->get_where('materi', array('id_materi' => $id_materi));
		return $query->row();
	}

	// public function detail_slug($slug_materi)
	// {
	// 	$query = $this->db->query("select materi.*,user.name,kelas.nama_kelas,pelajaran.nama_pelajaran from materi,user,kelas,pelajaran where (materi.username=user.username) && (materi.slug_materi='$slug_materi') && (materi.id_kelas=kelas.id) && (materi.id_pelajaran=pelajaran.id)");
	// 	return $query->row();
	// }

	public function detail_slug($slug_materi)
	{
		$query = $this->db->query("select materi.*,user.name,kelas.nama_kelas,pelajaran.nama_pelajaran from materi left join user on materi.username=user.username left join kelas on materi.id_kelas=kelas.id left join pelajaran on materi.id_pelajaran=pelajaran.id where materi.slug_materi='$slug_materi' order by materi.id_materi");
		return $query->row();
	}

	public function jumlah_download($data)
	{
		$this->db->insert('unduhan', $data);
	}

	public function delete_materi_kelas($id)
	{
		$this->db->where_in('id_kelas', $id);
		$this->db->delete('materi');
	}
}

/* End of file Materi_model.php */
/* Location: ./application/models/Materi_model.php */
