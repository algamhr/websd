<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses_level') == 21) {
            $this->load->model('guru_model');
            $this->load->model('user_model');
        } else {
            redirect('pagenotfound404', 'refresh');
        }
    }

    public function index()
    {
        $site_config = $this->konfigurasi_model->listing();
        $user = $this->guru_model->listing_admin();
        $valid = $this->form_validation;
        $valid->set_rules('name', 'name', 'required', array('required' => 'name harus diisi'));
        $valid->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', array(
            'required' => 'Username user harus diisi',
            'is_unique' => 'Username <strong>' . $this->input->post('username') . '</strong> sudah digunakan',
            'trim' => 'Username tidak boleh ada spasi'
        ));
        $valid->set_rules('password', 'Password', 'required|max_length[12]|min_length[6]', array(
            'required' => 'Password harus diisi',
            'max_lenght' => 'Password maksimal 12 karakter',
            'min_length' => 'Password minimal 6 karakter'
        ));

        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Guru',
                'isi' => 'admin/guru/list',
                'user' => $user
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $guru = 2;
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password')),
                'akses_level' => $guru,
            );

            $this->guru_model->add($data);
            $this->session->set_flashdata('sukses', 'guru telah ditambah');
            redirect(base_url('guru'));
        }
    }

    public function hapus($username)
    {
        $user = $this->guru_model->detail($username);
        if ($user->username == "admin21") {
            redirect('pagenotfound404', 'refresh');
        } else {
            $data = array('username' => $user->username);
            $this->guru_model->delete($data);
            $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
            redirect(base_url('guru'));
        }
    }

    public function edit($id)
    {
        $user = $this->guru_model->listing_admin($id);
        $this->form_validation->set_rules('name', 'name', 'required', array('required' => 'name user harus diisi'));
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[12]|min_length[6]', array(
            'required' => 'Password harus diisi',
            'max_length' => 'Password maksimal 12 karakter',
            'min_length' => 'Password minimal 6 karakter'
        ));
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]', array(
            'required' => 'Confirm Password harus diisi',
            'matches' => 'Password tidak sesuai'
        ));

        if ($this->form_validation->run() === FALSE) {

            $data = array(
                'title'     => 'guru SDN 014',
                'isi'         => 'admin/guru/list',
                'user'    => $user
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $guru = 2;
            $data = array(
                'id'    => $id,
                'name' => $this->input->post('name'),
                'password' => sha1($this->input->post('password')),
                'akses_level' => $guru
            );

            $this->guru_model->edit($data);
            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('guru'));
        }
    }

    public function reset_password($id)
    {
        $karakter = "ABCDEFGHIJKLMNOPQRSTUVWQYZ1234567890";
        $password = substr(str_shuffle($karakter), 0, 8);
        $data = array(
            'id' => $id,
            'password' => sha1($password),
        );

        $this->user_model->update($data);

        $this->session->set_flashdata('sukses', 'Simpan Password Berikut : ' . $password);
        redirect(base_url('guru'));
    }
}

/* End of file guru.php */
/* Location: ./application/controllers/guru.php */
