<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
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
            $this->load->model('konfigurasi_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $konfig = $this->konfigurasi_model->listing();
        $this->form_validation->set_rules('author', 'Author', 'required', array('required' => 'Author Harus diisi'));
        $this->form_validation->set_rules('nama_web', 'Nama WEB', 'required|trim', array(
            'required' => 'Nama WEB harus diisi',
            'trim' => 'Nama WEB tidak boleh ada spasi'
        ));

        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'     => 'Konfigurasi',
                'isi'         => 'admin/konfigurasi/list',
                'konfig'    => $konfig
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $nama_web = strtoupper($_POST['nama_web']);
            $data = array(
                'id'    => $this->input->post('id'),
                'author' => $this->input->post('author'),
                'nama_web' => $nama_web
            );

            $this->konfigurasi_model->update($data);
            $this->session->set_flashdata('sukses', 'Data telah diperbarui');
            redirect(base_url('konfigurasi'));
        }
    }
}
