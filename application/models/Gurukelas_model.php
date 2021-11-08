<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gurukelas_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // GET ALL PRODUCT
    function get_kelas()
    {
        $query = $this->db->query("select * from kelas order by nama_kelas");
        return $query;
    }

    //GET PRODUCT BY PACKAGE ID
    function get_kelas_by_guru($id)
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->join('kelasguru', 'detail_kelas_id=kelas.id');
        $this->db->join('user', 'user.id=detail_user_id');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    //READ
    function get_guru()
    {
        $this->db->select('user.*,COUNT(kelas.id) AS item_kelas, kelas.id as id_kelas');
        $this->db->from('user');
        $this->db->join('kelasguru', 'user.id=detail_user_id');
        $this->db->join('kelas', 'detail_kelas_id=kelas.id');
        $this->db->group_by('user.id');
        $query = $this->db->get();
        return $query;
    }

    // CREATE
    function create_guru($name, $kelas, $username, $password)
    {
        $this->db->trans_start();
        $data  = array(
            'name' => $name,
            'username' => $username,
            'password' => $password
        );
        $this->db->insert('user', $data);
        //GET ID PACKAGE
        $guru_id = $this->db->insert_id();
        $result = array();
        foreach ($kelas as $key => $val) {
            $result[] = array(
                'detail_user_id'   => $guru_id,
                'detail_kelas_id'   => $_POST['kelas'][$key]
            );
        }
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('kelasguru', $result);
        $this->db->trans_complete();
    }


    // UPDATE
    function update_guru($id, $guru, $kelas)
    {
        $this->db->trans_start();
        $data  = array(
            'name' => $guru
        );
        $this->db->where('guru_id', $id);
        $this->db->update('guru', $data);

        $this->db->delete('gurukelas', array('detail_guru_id' => $id));

        $result = array();
        foreach ($kelas as $key => $val) {
            $result[] = array(
                'detail_guru_id'   => $id,
                'detail_kelas_id'   => $_POST['kelas_edit'][$key]
            );
        }
        //MULTIPLE INSERT TO DETAIL TABLE
        $this->db->insert_batch('kelasguru', $result);
        $this->db->trans_complete();
    }
}
