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
        $query = $this->db->get('kelas');
        return $query->result();
    }

    public function listing_guru($id_user)
    {
        $query = $this->db->query("select kelas.*, user.id as iduser, user.username as user_username from kelas left join user on user.id = kelas.id_user where id_user=$id_user");
        return $query->result();
    }

    public function listing_user()
    {
        $query = $this->db->query("select * from user where akses_level=2");
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
}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */
