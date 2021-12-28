<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses_level') == 21 || $this->session->userdata('akses_level') == 2) {
            $this->load->model('kelas_model');
            $this->load->model('user_model');
            $this->load->model('materi_model');
            $this->load->model('nilai_pengguna_model');
            $this->load->model('soal_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama_kelas', 'Nama Kelas', 'required', array('required' => 'Nama Kelas harus diisi'));

        if ($this->session->userdata('akses_level') == 21) {
            $kelas = $this->kelas_model->listing();
        } else if ($this->session->userdata('akses_level') == 2) {
            $kelas = $this->kelas_model->listing_kelas_guru($this->session->userdata('id'));
            $user = $this->user_model->detail_guru($this->session->userdata('id'));
        }

        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Kelas',
                'isi' => 'admin/kelas/list',
                'kelas' => $kelas,
                'user' => $user
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {

            // $slug_kelas = url_title($this->input->post('nama_kelas'), 'dash', TRUE);
            $nama_kelas = strtolower($this->input->post('nama_kelas'));
            $slug_kelas = str_replace(' ', '', $nama_kelas);
            $data = array(
                'nama_kelas' => $this->input->post('nama_kelas'),
                'slug_kelas' => $slug_kelas
            );
            $this->db->insert('kelas', $data);

            $this->session->set_flashdata('sukses', 'Data berhasil ditambah');
            redirect(base_url('kelas'));

            $id_userImplode = implode(",", $this->input->post('id_user'));
            $id_user = (explode(",", $id_userImplode));
            $count_iduser = count($id_user);
            for ($i = 0; $i < $count_iduser; $i++) {
                $slug_kelas = url_title($this->input->post('nama_kelas'), 'dash', TRUE);
                $data = array(
                    'nama_kelas' => $this->input->post('nama_kelas'),
                    'slug_kelas' => $slug_kelas,
                    'id_user' => $id_user[$i],
                    'tahun_ajaran' => $this->input->post('tahun_ajaran')
                );
                $this->db->insert('kelas', $data);
            }

            $insert_id = $this->db->insert_id();
            $jumlah_kelas = $_POST['jumlah_kelas'];
            $slug_kelas = url_title($this->input->post('nama_kelas'), 'dash', TRUE);
            for ($i = 0; $i < $jumlah_kelas; $i++) {
                $data = array(
                    'name' => "user" . $i,
                    'username' => $slug_kelas . "~" . $i,
                    'password' => sha1($slug_kelas . "~" . $i),
                    'akses_level' => 1,
                    'id_kelas' => $insert_id
                );
                $this->user_model->add($data);
            }
        }
    }

    public function update($id)
    {
        $kelas = $this->kelas_model->listing();
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required', array(
            'required' => 'Nama Kelas harus diisi'
        ));

        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'     => 'Kelas',
                'isi'         => 'admin/kelas/list',
                'kelas'    => $kelas
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            // $slug_kelas = url_title($this->input->post('nama_kelas'), 'dash', TRUE);
            $nama_kelas = strtolower($this->input->post('nama_kelas'));
            $slug_kelas = str_replace(' ', '', $nama_kelas);
            $data = array(
                'id'    => $id,
                'nama_kelas' => $this->input->post('nama_kelas'),
                'slug_kelas' => $slug_kelas
            );

            $this->kelas_model->update($data);
            $this->session->set_flashdata('sukses', 'Data telah diperbarui');
            redirect(base_url('kelas'));
        }
    }

    public function destroy($id)
    {
        $this->user_model->delete_users_kelas($id);
        $this->materi_model->delete_materi_kelas($id);
        $this->nilai_pengguna_model->delete_nilai_kelas($id);
        $this->nilai_pengguna_model->delete_nilai_pengguna_kelas($id);
        $this->soal_model->delete_soal_kelas($id);
        $this->kelas_model->delete_kelas($id);
        $this->kelas_model->delete_kelasguru($id);

        $this->session->set_flashdata('sukses', 'Kelas berhasil dihapus');
        redirect(base_url('kelas'));
    }
}
