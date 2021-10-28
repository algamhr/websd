<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        if ($this->session->userdata('akses_level') == 21 || 2 || $this->session->userdata('akses_level') == 1) {
            $this->load->model('user_model');
            $this->load->model('nilai_pengguna_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function ubah_password($id)
    {
        $valid = $this->form_validation;
        $valid->set_rules('password', 'Password', 'required|max_length[20]|min_length[6]', array(
            'required' => 'Password harus diisi',
            'max_lenght' => 'Password maksimal 20 karakter',
            'min_length' => 'Password minimal 6 karakter'
        ));
        $valid->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]', array(
            'required' => 'Konfirmasi Password harus diisi',
            'matches' => 'Konfirmasi password tidak valid'
        ));

        if ($valid->run() === FALSE) {
            $profile = $this->user_model->detail($id);
            $data = array(
                'title' => $profile->name,
                'isi' => 'admin/profile/list',
                'profile' => $profile
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'id' => $id,
                'password' => sha1($this->input->post('password'))
            );

            $this->user_model->update($data);
            $this->session->set_flashdata('sukses', 'Password berhasil diperbarui');
            redirect(base_url('profile/detail/' . $id));
        }
    }

    public function detail($id)
    {
        $profile = $this->user_model->detail_user_kelas($id);
        $profile_edit = $this->user_model->detail($id);
        $nilai = $this->nilai_pengguna_model->nilai_pelajaran($profile->username, $profile->id_kelas);
        $pelajaran = $this->nilai_pengguna_model->akumulasi($profile->username);
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required', array('required' => 'Nama harus diisi'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim', array(
            'required' => 'Username harus diisi',
            'trim' => 'Username tidak boleh ada spasi'
        ));

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->detail('gambar')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('list', $error);
        }

        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'     => $profile_edit->name,
                'isi'         => 'admin/profile/list',
                'profile'    => $profile,
                'profile_edit' => $profile_edit,
                'nilai' => $nilai,
                'pelajaran' => $pelajaran
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $data = array(
                'id'    => $id,
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
            );

            $this->user_model->update($data);
            $this->session->set_flashdata('sukses', 'Profile telah diperbarui');
            redirect(base_url('profile/detail/' . $id));
        }
    }
}
