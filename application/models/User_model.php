<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
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
        $query = $this->db->query("select * from user where akses_level=21");
        return $query->result();
    }

    public function listing_user()
    {
        $query = $this->db->query("select * from user where akses_level=1");
        return $query->result();
    }
    public function listing_guru()
    {
        $query = $this->db->query("select * from user where akses_level=2");
        return $query->result();
    }

    public function listing_user_kelas($id)
    {
        $query = $this->db->query("select user.*, avg(nilai_pengguna.nilai_akhir) as nilai_akhir from user left join nilai_pengguna on user.username=nilai_pengguna.username where user.akses_level!=21 && user.id_kelas='$id' group by user.username order by nilai_akhir desc");
        return $query->result();
    }

    //tambah data
    public function add($data)
    {
        $this->db->insert('user', $data);
    }

    //edit data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
    }

    //delete data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('user', $data);
    }

    public function detail_user_kelas($id)
    {
        $this->db->select('user.*, kelas.nama_kelas');
        $this->db->from('user');
        //relasi database
        $this->db->join('kelas', 'kelas.id = user.id_kelas', 'left');
        //end relasi database
        $this->db->where(array('user.id' => $id));
        $query = $this->db->get();
        return $query->row();
    }

    //show data detail
    public function detail($id)
    {
        $this->db->select('user.*, kelas.nama_kelas');
        $this->db->from('user');
        //relasi database
        $this->db->join('kelas', 'kelas.id = user.id_kelas', 'left');
        //end relasi database
        $this->db->where(array('user.id' => $id));
        $query = $this->db->get();
        return $query->row();
    }

    public function detail_guru($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        //relasi database
        //end relasi database
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_users_kelas($id)
    {
        $this->db->where_in('id_kelas', $id);
        $this->db->delete('user');
    }
}
 
/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */
