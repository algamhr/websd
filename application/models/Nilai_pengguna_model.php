<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_pengguna_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function listing()
	{
		$this->db->select('nilai_pengguna.*, materi.*, user.username, user.name');
		$this->db->from('nilai_pengguna');
		//relasi database
		$this->db->join('materi', 'materi.id_materi = nilai_pengguna.id_materi', 'left');
		$this->db->join('user', 'user.username = nilai_pengguna.username', 'left');
		//end relasi database
		$this->db->order_by('id_nilai_pengguna', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function add($data)
	{
		$this->db->insert('nilai_pengguna', $data);
	}

	public function detail($id_materi, $username)
	{
		$this->db->select('nilai_pengguna.*, materi.*, user.username, user.name, kelas.nama_kelas, pelajaran.nama_pelajaran');
		$this->db->from('nilai_pengguna');
		//relasi database
		$this->db->join('materi', 'materi.id_materi = nilai_pengguna.id_materi', 'left');
		$this->db->join('user', 'user.username = nilai_pengguna.username', 'left');
		$this->db->join('kelas', 'kelas.id = nilai_pengguna.id_kelas', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = nilai_pengguna.id_pelajaran', 'left');
		//end relasi database
		$this->db->where(array('nilai_pengguna.id_materi' => $id_materi, 'nilai_pengguna.username' => $username));
		$this->db->order_by('id_nilai_pengguna', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function hapus_data_nilai()
	{
		$this->db->empty_table('nilai');
		$this->db->empty_table('nilai_pengguna');
	}

	public function nilai_pelajaran($username, $id_kelas)
	{
		$this->db->select('nilai_pengguna.*, materi.*, user.username, user.name, pelajaran.nama_pelajaran, kelas.nama_kelas');
		$this->db->from('nilai_pengguna');
		//relasi database
		$this->db->join('materi', 'materi.id_materi = nilai_pengguna.id_materi', 'left');
		$this->db->join('user', 'user.username = nilai_pengguna.username', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = nilai_pengguna.id_pelajaran', 'left');
		$this->db->join('kelas', 'kelas.id = nilai_pengguna.id_kelas', 'left');
		//end relasi database
		$this->db->where(array('nilai_pengguna.id_kelas' => $id_kelas, 'nilai_pengguna.username' => $username));
		$this->db->order_by('id_nilai_pengguna', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function akumulasi($username)
	{
		$query = $this->db->query("select avg(nilai_pengguna.nilai_akhir) as nilai_pelajaran, pelajaran.nama_pelajaran from nilai_pengguna left join pelajaran on nilai_pengguna.id_pelajaran=pelajaran.id where nilai_pengguna.username='$username' group by nilai_pengguna.id_pelajaran");
		return $query->result();
	}

	public function cek_status($id_kelas)
	{
		$this->db->select('nilai_pengguna.*, materi.*, user.username, user.name, pelajaran.nama_pelajaran, kelas.nama_kelas');
		$this->db->from('nilai_pengguna');
		//relasi database
		$this->db->join('materi', 'materi.id_materi = nilai_pengguna.id_materi', 'left');
		$this->db->join('user', 'user.username = nilai_pengguna.username', 'left');
		$this->db->join('pelajaran', 'pelajaran.id = nilai_pengguna.id_pelajaran', 'left');
		$this->db->join('kelas', 'kelas.id = nilai_pengguna.id_kelas', 'left');
		//end relasi database
		$this->db->where(array('nilai_pengguna.id_kelas' => $id_kelas));
		$this->db->order_by('id_nilai_pengguna', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_pengumuman($data)
	{
		$this->db->where('id_kelas', $data['id_kelas']);
		$this->db->update('nilai_pengguna', $data);
	}

	public function delete_nilai($username)
	{
		$this->db->where_in('username', $username);
		$this->db->delete('nilai');
	}

	public function delete_nilai_pengguna($username)
	{
		$this->db->where_in('username', $username);
		$this->db->delete('nilai_pengguna');
	}

	public function delete_nilai_kelas($id)
	{
		$this->db->where_in('id_kelas', $id);
		$this->db->delete('nilai');
	}

	public function delete_nilai_pengguna_kelas($id)
	{
		$this->db->where_in('id_kelas', $id);
		$this->db->delete('nilai_pengguna');
	}
}

/* End of file Nilai_pengguna_model.php */
/* Location: ./application/models/Nilai_pengguna_model.php */
