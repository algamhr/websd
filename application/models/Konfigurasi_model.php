<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listing()
    {
        $query = $this->db->get('konfigurasi');
        return $query->row();
    }

    //show data detail
    public function detail($id)
    {
        $query = $this->db->get_where('konfigurasi', array('id' => $id));
        return $query->row();
    }

    //edit data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('konfigurasi', $data);
    }
}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */
