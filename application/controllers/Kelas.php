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
        if ($this->session->userdata('akses_level') == 21 || 2) {
            $this->load->model('kelas_model');
            $this->load->model('user_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $valid = $this->form_validation;
        $valid->set_rules('jumlah_kelas', 'Jumlah Pelajar', 'required', array('required' => 'Jumlah Pelajar harus diisi'));
        $valid->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[kelas.nama_kelas]', array(
            'required' => 'Nama Kelas harus diisi',
            'is_unique' => 'Nama Kelas <strong>' . $this->input->post('nama_kelas') . '</strong> sudah digunakan'
        ));

        if ($this->session->userdata('akses_level') == 21) {
            $kelas = $this->kelas_model->listing();
        } else if ($this->session->userdata('akses_level') == 2) {
            $kelas = $this->kelas_model->listing_guru($this->session->userdata('id'));
        }

        $user = $this->kelas_model->listing_user();

        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Kelas',
                'isi' => 'admin/kelas/list',
                'kelas' => $kelas,
                'user' => $user
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'nama_kelas' => $this->input->post('nama_kelas'),
                'jumlah_kelas' => $this->input->post('jumlah_kelas'),
                'id_user' => ($this->input->post('id_user'))
            );
            $this->db->insert('kelas', $data);
            $insert_id = $this->db->insert_id();

            $nama_kelas = $_POST['nama_kelas'];
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

            $this->session->set_flashdata('sukses', 'Data berhasil ditambah');
            redirect(base_url('kelas'));
        }
    }

    public function update($id)
    {
        $kelas = $this->kelas_model->listing();
        $this->form_validation->set_rules('jumlah_kelas', 'Jumlah Pelajar', 'required', array('required' => 'Jumlah Pelajar harus diisi'));
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
            $data = array(
                'id'    => $id,
                'nama_kelas' => $this->input->post('nama_kelas'),
                'jumlah_kelas' => $this->input->post('jumlah_kelas')
            );

            $this->kelas_model->update($data);
            $this->session->set_flashdata('sukses', 'Data telah diperbarui');
            redirect(base_url('kelas'));
        }
    }

    public function destroy($id)
    {
        $this->user_model->delete_users_kelas($id);

        $kelas = $this->kelas_model->detail($id);
        $data_kelas = array('id' => $kelas->id);
        $this->kelas_model->delete($data_kelas);

        $this->session->set_flashdata('sukses', 'Kelas berhasil dihapus');
        redirect(base_url('kelas'));
    }
}
