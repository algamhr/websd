<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listing()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function listing_admin()
    {
        $query = $this->db->query("select * from user where akses_level!=1 AND akses_level!=21");
        return $query->result();
    }

    public function listing_pendaftar()
    {
        $query = $this->db->query("select * from user where akses_level=2");
        return $query->result();
    }

    //show data detail
    public function detail($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->row();
    }

    //show data detail
    public function detail_guru($id)
    {
        $query = $this->db->get_where('user', array('id' => $id));
        return $query->row();
    }

    //tambah data
    public function add($data)
    {
        $this->db->insert('user', $data);
    }

    //edit data
    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
    }

    //delete data
    public function delete($data)
    {
        $this->db->where('username', $data['username']);
        $this->db->delete('user', $data);
    }

    public function delete_kelasguru($id_user)
    {
        $this->db->where_in('id_user', $id_user);
        $this->db->delete('kelasguru');
    }

    public function listing_kelasguru($id_user)
    {
        $query = $this->db->query("select * from kelasguru where id_user=$id_user");
        return $query->result();
    }
}

/* End of file Pengelola_model.php */
/* Location: ./application/models/Pengelola_model.php */
