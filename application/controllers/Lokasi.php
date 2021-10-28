<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
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
        if ($this->session->userdata('akses_level') == 1) {
            $this->load->model('lokasi_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $id = 1;
        $lokasi = $this->lokasi_model->detail($id);
        $valid = $this->form_validation;
        $valid->set_rules('alamat', 'Alamat', 'required', array('required' => 'Alamat harus diisi'));

        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Lokasi',
                'isi' => 'admin/lokasi/list',
                'lokasi' => $lokasi
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'id' => $id,
                'alamat' => $this->input->post('alamat')
            );

            $this->lokasi_model->update($data);
            $this->session->set_flashdata('sukses', 'Data berhasil diperbarui');
            redirect(base_url('lokasi'));
        }
    }
}
