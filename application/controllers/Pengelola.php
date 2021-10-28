<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengelola extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses_level') == 21) {
			$this->load->model('pengelola_model');
		} else {
			redirect('pagenotfound404', 'refresh');
		}
	}

	public function index()
	{
		$site_config = $this->konfigurasi_model->listing();
		$user = $this->pengelola_model->listing_admin();
		$valid = $this->form_validation;
		$valid->set_rules('nama', 'Nama', 'required', array('required' => 'Nama harus diisi'));
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
				'title' => 'Pengelola' . $site_config->namaweb,
				'isi' => 'admin/pengelola/list',
				'user' => $user
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} else {
			$pengelola = 21;
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'akses_level' => $pengelola,
			);

			$this->pengelola_model->add($data);
			$this->session->set_flashdata('sukses', 'Pengelola telah ditambah');
			redirect(base_url('pengelola'));
		}
	}

	public function hapus($username)
	{
		$user = $this->pengelola_model->detail($username);
		if ($user->username == "admin") {
			redirect('pagenotfound404', 'refresh');
		} else {
			$data = array('username' => $user->username);
			$this->pengelola_model->delete($data);
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
			redirect(base_url('pengelola'));
		}
	}

	public function edit($username)
	{
		$user = $this->pengelola_model->listing_admin($username);
		$this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama user harus diisi'));
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
				'title' 	=> 'Pengelola SDN 014',
				'isi' 		=> 'admin/pengelola/list',
				'user'	=> $user
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$pengelola = 21;
			$data = array(
				'username'	=> $username,
				'nama' => $this->input->post('nama'),
				'password' => sha1($this->input->post('password')),
				'akses_level' => $pengelola
			);

			$this->pengelola_model->update($data);
			$this->session->set_flashdata('sukses', 'Data telah diedit');
			redirect(base_url('pengelola'));
		}
	}
}

/* End of file Pengelola.php */
/* Location: ./application/controllers/Pengelola.php */
