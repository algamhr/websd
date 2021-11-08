<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function listing()
	{
		$this->db->select('soal.*, materi.*, kelas.nama_kelas, pelajaran.nama_pelajaran');
		$this->db->from('soal');
		//relasi database
		$this->db->join('materi', 'materi.id_materi = soal.id_materi', 'left');
		$this->db->join('kelas', 'kelas.id = soal.id_kelas', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = soal.id_pelajaran', 'left');
		//end relasi database
		$this->db->order_by('id_soal', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function add($data)
	{
		$this->db->insert('soal', $data);
	}

	public function update($data)
	{
		$this->db->where('id_soal', $data['id_soal']);
		$this->db->update('soal', $data);
	}

	public function delete($data)
	{
		$this->db->where('id_soal', $data['id_soal']);
		$this->db->delete('soal', $data);
	}

	public function detail($id_soal)
	{
		$query = $this->db->get_where('soal', array('id_soal' => $id_soal));
		return $query->row();
	}

	public function soal_test($id_materi)
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->where('id_materi', $id_materi);
		$this->db->order_by('id_soal', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function add_nilai($id_soal, $username, $jawaban, $id_materi, $status_nilai, $id_pelajaran, $id_kelas)
	{
		$data = array(
			'id_soal' => $id_soal,
			'username' => $username,
			'jawaban' => $jawaban,
			'id_materi' => $id_materi,
			'status_nilai' => $status_nilai,
			'id_pelajaran' => $id_pelajaran,
			'id_kelas' => $id_kelas
		);
		$this->db->insert('nilai', $data);
	}

	public function jawaban_benar($id_materi, $username)
	{
		$query = $this->db->query("select nilai.id_nilai from nilai,soal where (nilai.id_soal=soal.id_soal and nilai.id_materi=soal.id_materi and nilai.jawaban=soal.jawaban) and (nilai.id_materi='$id_materi' and nilai.username='$username')");
		return $query->result();
	}

	public function jumlah_soal($id_materi)
	{
		$query = $this->db->query("select id_soal from soal where id_materi='$id_materi'");
		return $query->result();
	}

	public function kunci_jawaban($id_materi)
	{
		$this->db->select('*');
		$this->db->from('soal');
		$this->db->where('id_materi', $id_materi);
		$this->db->order_by('id_soal', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function status_selesai()
	{
		$query = $this->db->get('nilai');
		return $query->result();
	}

	public function delete_soal_kelas($id)
	{
		$this->db->where_in('id_kelas', $id);
		$this->db->delete('soal');
	}

	// public function status_selesai($id_materi)
	// {
	// 	$query=$this->db->get_where('nilai', array('id_materi' => $id_materi));
	// 	return $query->row();
	// }

}

/* End of file Soal_model.php */
/* Location: ./application/models/Soal_model.php */
