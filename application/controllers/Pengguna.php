<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('akses_level')==21){
			$this->load->model('pengguna_model');
		} else {
			redirect('pagenotfound404','refresh');
		}
	}

	public function index()
	{
		$site_config=$this->konfigurasi_model->listing();
		$user=$this->pengguna_model->listing_user();
		$valid= $this->form_validation;
		$valid->set_rules('nama', 'Nama', 'required', array('required' => 'Nama harus diisi'));
		$valid->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', array(
			'required' => 'Username user harus diisi',
			'is_unique' => 'Username <strong>'.$this->input->post('username').'</strong> sudah digunakan',
			'trim' => 'Username tidak boleh ada spasi'));
		$valid->set_rules('password', 'Password', 'required|max_length[12]|min_length[6]', array(
			'required' => 'Password harus diisi',
			'max_lenght' => 'Password maksimal 12 karakter',
			'min_length' => 'Password minimal 6 karakter'));

		if($valid->run() === FALSE) {
			$data = array(
			'title' => 'Pengguna '.$site_config->namaweb,
			'isi' => 'admin/pengguna/list',
			'user' => $user
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} else {
			$pengguna=1;
			$data = array(	
							'nama' => $this->input->post('nama'), 
							'username' => $this->input->post('username'), 
						 	'password' => sha1($this->input->post('password')), 
							'akses_level' => $pengguna,
							); 

			$this->pengguna_model->add($data);
			$this->session->set_flashdata('sukses','Pengguna telah ditambah');
			redirect(base_url('pengguna'));
		}
	}

	public function hapus($username)
	{
		$user=$this->pengguna_model->detail($username);
		$data = array('username' => $user->username );
		$this->pengguna_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		redirect(base_url('pengguna'));
	}


}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */