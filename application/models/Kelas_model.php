<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listing()
    {
        $query = $this->db->query("select * from kelas order by nama_kelas");
        return $query->result();
    }

    public function listing_kelas_guru($id_user)
    {
        $query = $this->db->query("select * from kelas");
        return $query->result();
    }

    //show data detail
    public function detail($id)
    {
        $query = $this->db->get_where('kelas', array('id' => $id));
        return $query->row();
    }

    //tambah data
    public function add($data)
    {
        $this->db->insert('kelas', $data);
    }

    //tambah data
    public function add_kelasguru($data)
    {
        $this->db->insert('kelasguru', $data);
    }

    //edit data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('kelas', $data);
    }

    //delete data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('kelas', $data);
    }

    public function delete_kelas($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('kelas');
    }

    public function delete_kelasguru($id_kelas)
    {
        $this->db->where_in('id_kelas', $id_kelas);
        $this->db->delete('kelasguru');
    }

    public function listing_kelasguru($id)
    {
        $query = $this->db->query("select * from kelasguru where detail_user_id=$id");
        return $query->result();
    }

    //
}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */
