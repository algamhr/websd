<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelajaran_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listing()
    {
        $query = $this->db->get('pelajaran');
        return $query->result();
    }

    //show data detail
    public function detail($id)
    {
        $query = $this->db->get_where('pelajaran', array('id' => $id));
        return $query->row();
    }

    //tambah data
    public function add($data)
    {
        $this->db->insert('pelajaran', $data);
    }

    //edit data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('pelajaran', $data);
    }

    //delete data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('pelajaran', $data);
    }
}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */
