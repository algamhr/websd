<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        if ($this->session->userdata('akses_level') == 21) {
            $this->load->model('user_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $valid = $this->form_validation;
        $valid->set_rules('name', 'Nama Lengkap', 'required', array('required' => 'Nama harus diisi'));
        $valid->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', array(
            'required' => 'Username user harus diisi',
            'is_unique' => 'Username <strong>' . $this->input->post('username') . '</strong> sudah digunakan',
            'trim' => 'Username tidak boleh ada spasi'
        ));
        $valid->set_rules('password', 'Password', 'required|max_length[20]|min_length[6]', array(
            'required' => 'Password harus diisi',
            'max_lenght' => 'Password maksimal 20 karakter',
            'min_length' => 'Password minimal 6 karakter'
        ));
        $valid->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]', array(
            'required' => 'Konfirmasi Password harus diisi',
            'matches' => 'Konfirmasi password tidak valid'
        ));

        $user = $this->user_model->listing_admin();
        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Pengelola',
                'isi' => 'admin/user/list',
                'user' => $user
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password')),
                'akses_level' => 21,
            );

            $this->user_model->add($data);
            $this->session->set_flashdata('sukses', 'Data berhasil ditambah');
            redirect(base_url('user'));
        }
    }

    public function update($id)
    {
        $user = $this->user_model->listing_admin();
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required', array('required' => 'Nama harus diisi'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim', array(
            'required' => 'Username harus diisi',
            'trim' => 'Username tidak boleh ada spasi'
        ));

        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'     => 'Pengelola',
                'isi'         => 'admin/user/list',
                'user'    => $user
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $data = array(
                'id'    => $id,
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'akses_level' => 21,
            );

            $this->user_model->update($data);
            $this->session->set_flashdata('sukses', 'Data telah diperbarui');
            redirect(base_url('user'));
        }
    }

    public function destroy($id)
    {
        $user = $this->user_model->detail($id);
        $data = array('id' => $user->id);
        $this->user_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('user'));
    }

    public function update_password($id)
    {
        $user = $this->user_model->listing_admin();
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
            $data = array(
                'title'   => 'Pengelola',
                'isi'     => 'admin/user/list',
                'user'    => $user
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $data = array(
                'id'    => $id,
                'password' => sha1($this->input->post('password')),
            );

            $this->user_model->update($data);
            $this->session->set_flashdata('sukses', 'Silahkan login terlebih dahulu');
            redirect(base_url('login'));
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
        redirect(base_url('user'));
    }
}
