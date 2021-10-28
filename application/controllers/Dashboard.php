<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
            $this->load->model('user_model');
            $this->load->model('pelajaran_model');
            $this->load->model('materi_model');
            $this->load->model('kelas_model');
        } elseif ($this->session->userdata('akses_level') == 1) {
            $this->load->model('materi_model');
            $this->load->model('user_model');
            $this->load->model('kelas_model');
            $this->load->model('pelajaran_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $user_count = count($this->user_model->listing_user());
        $kelas_count = count($this->kelas_model->listing());
        $pelajaran_count = count($this->pelajaran_model->listing());
        $materi_count = count($this->materi_model->listing());
        $materi = $this->materi_model->listing_home1();
        $data = array(
            'title' => 'Dashboard',
            'isi' => 'admin/dashboard/list',
            'user_count' => $user_count,
            'kelas_count' => $kelas_count,
            'pelajaran_count' => $pelajaran_count,
            'materi_count' => $materi_count,
            'materi' => $materi
        );
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}
