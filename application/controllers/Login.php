<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index()
	{
		$valid = $this->form_validation;
		$valid->set_rules('username', 'Username', 'required', array('required' => 'Username harus diisi'));
		$valid->set_rules('password', 'Password', 'required|max_length[20]|min_length[6]', array('required' => 'Password harus diisi', 'max_lenght' => 'Password maksimal 20 karakter', 'min_length' => 'Password minimal 6 karakter'));

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($valid->run()) {
			$this->simple_login->login($username, $password, base_url('dashboard'), base_url('login'));
		}

		$data = array('title' => 'Login',);
		$this->load->view('login_view', $data);
	}

	public function logout()
	{
		$this->simple_login->logout();
	}

	public function register()
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


		if ($valid->run() === FALSE) {
			$this->load->view('register_view');
		} else {
			$user = 2;
			$data = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'akses_level' => $user
			);

			$this->user_model->add($data);
			$this->session->set_flashdata('sukses', 'Registrasi berhasil, silahkan Login terlebih dahulu..');
			redirect(base_url('login'));
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
