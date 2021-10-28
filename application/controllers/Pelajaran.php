<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelajaran extends CI_Controller
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
            $this->load->model('pelajaran_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $valid = $this->form_validation;
        $valid->set_rules('nama_pelajaran', 'Nama Pelajaran', 'required|is_unique[pelajaran.nama_pelajaran]', array(
            'required' => 'Nama Pelajaran harus diisi',
            'is_unique' => 'Nama Pelajaran <strong>' . $this->input->post('nama_pelajaran') . '</strong> sudah digunakan'
        ));

        $pelajaran = $this->pelajaran_model->listing();
        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Pelajaran',
                'isi' => 'admin/pelajaran/list',
                'pelajaran' => $pelajaran
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'nama_pelajaran' => $this->input->post('nama_pelajaran')
            );
            $this->pelajaran_model->add($data);

            $this->session->set_flashdata('sukses', 'Pelajaran berhasil ditambah');
            redirect(base_url('pelajaran'));
        }
    }

    public function update($id)
    {
        $pelajaran = $this->pelajaran_model->listing();
        $this->form_validation->set_rules('nama_pelajaran', 'Nama Pelajaran', 'required', array('required' => 'Nama Pelajaran harus diisi'));

        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'     => 'Kelas',
                'isi'         => 'admin/pelajaran/list',
                'pelajaran'    => $pelajaran
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $data = array(
                'id'    => $id,
                'nama_pelajaran' => $this->input->post('nama_pelajaran')
            );

            $this->pelajaran_model->update($data);
            $this->session->set_flashdata('sukses', 'Pelajaran telah diperbarui');
            redirect(base_url('pelajaran'));
        }
    }

    public function destroy($id)
    {
        $pelajaran = $this->pelajaran_model->detail($id);
        $data = array('id' => $pelajaran->id);
        $this->pelajaran_model->delete($data);

        $this->session->set_flashdata('sukses', 'Pelajaran berhasil dihapus');
        redirect(base_url('pelajaran'));
    }
}
