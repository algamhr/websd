<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_pengguna extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses_level') == 21 || 2 || $this->session->userdata('akses_level') == 1) {
			$this->load->model('user_model');
			$this->load->model('kelas_model');
			$this->load->model('nilai_pengguna_model');
		} else {
			redirect('login', 'refresh');
		}
	}

	public function index()
	{
		$nilai = $this->nilai_pengguna_model->listing();
		$data = array('title' => 'Nilai Pengguna', 'isi' => 'admin/nilai_pengguna/list', 'nilai' => $nilai);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function hapus()
	{
		$validasi = 1;
		$this->nilai_pengguna_model->hapus_data_nilai();

		if ($validasi) {
			$this->session->set_flashdata('sukses', 'Semua data nilai telah berhasil dihapus.');
			redirect(base_url('nilai_pengguna'));
		}
	}

	public function pengguna($id_kelas)
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

		$kelas = $this->kelas_model->detail($id_kelas);
		$user = $this->user_model->listing_user_kelas($id_kelas);
		$count_user = count($this->user_model->listing_user_kelas($id_kelas));
		if ($valid->run() === FALSE) {
			$status = "draft";
			$nilai_pengguna = $this->nilai_pengguna_model->cek_status($id_kelas);
			foreach ($nilai_pengguna as $nilai_pengguna) {
				if ($nilai_pengguna->status_nilai != "publish") {
					$status = "draft";
				} else {
					$status = "publish";
				}
			}
			$data = array(
				'title' => $kelas->nama_kelas,
				'isi' => 'admin/nilai_pengguna/list',
				'user' => $user,
				'id_kelas' => $id_kelas,
				'count_user' => $count_user,
				'jumlah_kelas' => $kelas->jumlah_kelas,
				'id_kelas' => $id_kelas,
				'status' => $status
			);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} else {
			$data = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => sha1($this->input->post('password')),
				'akses_level' => 1,
				'id_kelas' => $id_kelas
			);

			$this->user_model->add($data);
			$this->session->set_flashdata('sukses', 'Data berhasil ditambah');
			redirect(base_url('users_kelas/pengguna/' . $id_kelas));
		}
	}
}

/* End of file Nilai_pengguna.php */
/* Location: ./application/controllers/Nilai_pengguna.php */
