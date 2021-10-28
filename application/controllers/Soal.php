<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses_level') == 21 || 2 || $this->session->userdata('akses_level') == 1) {
			$this->load->model('soal_model');
			$this->load->model('materi_model');
			$this->load->model('pengguna_model');
			$this->load->model('nilai_pengguna_model');
			$this->load->model('kelas_model');
			$this->load->model('pelajaran_model');
			$this->load->model('user_model');
		}
	}

	public function index()
	{
		if ($this->session->userdata('akses_level') == 21 || 2) {
			$soal = $this->soal_model->listing();
			$data = array('title' => 'Soal - Jawaban', 'isi' => 'admin/soal/list', 'soal' => $soal);
			$this->load->view('admin/layout/wrapper', $data, FALSE);
		} else {
			redirect('pagenotfound404', 'refresh');
		}
	}

	public function tambah()
	{
		$kelas = $this->kelas_model->listing();
		$materi = $this->materi_model->listing();

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', array('required' => 'Pertanyaan soal harus diisi'));
		$this->form_validation->set_rules('jawaban', 'Jawaban Benar', 'required', array('required' => 'Jawaban soal harus diisi'));

		if ($this->form_validation->run()) {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './asset/upload/image/';  //lokasi folder upload
				$config['allowed_types'] 	= 'gif|jpg|png|svg|tiff|doc|docx|xls|xlsx|pdf|ppt|pptx|txt|doc|docx|zip|rar'; //format file yang di-upload
				$config['max_size']			= '10000'; // KB	
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 	=> 'Tambah Soal',
						'isi' 		=> 'admin/soal/tambah',
						'kelas'     => $kelas,
						'materi' => $materi,
						'error' 	=>  $this->upload->display_errors()
					);
					$this->load->view('admin/layout/wrapper', $data);

					// Masuk database 
				} else {
					$upload_data				= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']	= 'gd2';
					$config['source_image'] 	= './asset/upload/image/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './asset/upload/image/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= TRUE;
					$config['width'] 			= 360; // Pixel
					$config['height'] 			= 360; // Pixel
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$materi_detail = $this->materi_model->detail($_POST['id_materi']);
					$pelajaran = $this->pelajaran_model->detail($materi_detail->id_pelajaran);
					$data = array(
						'pertanyaan' 		=> $this->input->post('pertanyaan'),
						'id_materi'			=> $this->input->post('id_materi'),
						'id_pelajaran'		=> $pelajaran->id,
						'id_kelas'			=> $this->input->post('id_kelas'),
						'jawaban' 			=> $this->input->post('jawaban'),
						'pilihan1'			=> $this->input->post('pilihan1'),
						'pilihan2'			=> $this->input->post('pilihan2'),
						'pilihan3'			=> $this->input->post('pilihan3'),
						'gambar'		=> $upload_data['uploads']['file_name']
					);

					$this->soal_model->add($data);
					$this->session->set_flashdata('sukses', 'Soal telah ditambah');
					redirect(base_url('soal'));
				}
			} else {
				$materi_detail = $this->materi_model->detail($_POST['id_materi']);
				$pelajaran = $this->pelajaran_model->detail($materi_detail->id_pelajaran);
				$data = array(
					'pertanyaan' 		=> $this->input->post('pertanyaan'),
					'id_materi'			=> $this->input->post('id_materi'),
					'id_pelajaran'		=> $pelajaran->id,
					'id_kelas'			=> $this->input->post('id_kelas'),
					'jawaban' 			=> $this->input->post('jawaban'),
					'pilihan1'			=> $this->input->post('pilihan1'),
					'pilihan2'			=> $this->input->post('pilihan2'),
					'pilihan3'			=> $this->input->post('pilihan3'),
				);

				$this->soal_model->add($data);
				$this->session->set_flashdata('sukses', 'Soal telah ditambah');
				redirect(base_url('soal'));
			}
		}

		$data = array(
			'title' => 'Tambah Soal',
			'kelas' => $kelas,
			'materi' => $materi,
			'isi' => 'admin/soal/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function delete($id)
	{
		$soal = $this->soal_model->detail($id);

		//hapus gambar
		if ($soal->gambar != "") {
			unlink('./asset/upload/image/' . $soal->gambar);
			unlink('./asset/upload/image/thumbs/' . $soal->gambar);
		}
		//end hapus gambar

		$data = array('id_soal' => $soal->id_soal);

		if ($this->session->userdata('akses_level') == 21 || 2) {
			$this->soal_model->delete($data);
		} else {
			redirect('error404', 'refresh');
		}

		$this->session->set_flashdata('sukses', 'Materi berhasil dihapus');
		redirect('soal', 'refresh');
	}

	public function edit($id)
	{
		$kelas = $this->kelas_model->listing();
		$materi = $this->materi_model->listing();
		$soal = $this->soal_model->detail($id);

		$this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', array('required' => 'Pertanyaan soal harus diisi'));
		$this->form_validation->set_rules('jawaban', 'Jawaban Benar', 'required', array('required' => 'Jawaban soal harus diisi'));

		if ($this->form_validation->run()) {

			//kalau ada gambar
			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path'] 		= './asset/upload/image/';  //lokasi folder upload
				$config['allowed_types'] 	= 'gif|jpg|png|svg|tiff|doc|docx|xls|xlsx|pdf|ppt|pptx|txt|doc|docx|zip|rar'; //format file yang di-upload
				$config['max_size']			= '10000'; // KB	
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 	=> 'Edit Soal',
						'isi' 		=> 'admin/soal/edit',
						'kelas'	=> $kelas,
						'materi'	=> $materi,
						'soal' => $soal,
						'error' 	=>  $this->upload->display_errors()
					);
					$this->load->view('admin/layout/wrapper', $data);

					// Masuk database 
				} else {
					$upload_data				= array('uploads' => $this->upload->data());
					// Image Editor
					$config['image_library']	= 'gd2';
					$config['source_image'] 	= './asset/upload/image/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './asset/upload/image/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= TRUE;
					$config['width'] 			= 360; // Pixel
					$config['height'] 			= 360; // Pixel
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					//hapus gambar
					if ($soal->gambar != "") {
						unlink('./asset/upload/image/' . $soal->gambar);
						unlink('./asset/upload/image/thumbs/' . $soal->gambar);
					}
					//end hapus gambar

					$materi_detail = $this->materi_model->detail($_POST['id_materi']);
					$pelajaran = $this->pelajaran_model->detail($materi_detail->id_pelajaran);
					$data = array(
						'id_soal' => $id,
						'pertanyaan' 		=> $this->input->post('pertanyaan'),
						'id_materi'			=> $this->input->post('id_materi'),
						'id_pelajaran'		=> $pelajaran->id,
						'id_kelas'			=> $this->input->post('id_kelas'),
						'jawaban' 			=> $this->input->post('jawaban'),
						'pilihan1'			=> $this->input->post('pilihan1'),
						'pilihan2'			=> $this->input->post('pilihan2'),
						'pilihan3'			=> $this->input->post('pilihan3'),
						'gambar'		=> $upload_data['uploads']['file_name']
					);

					$this->soal_model->update($data);
					$this->session->set_flashdata('sukses', 'Soal berhasil diperbarui');
					redirect(base_url('soal'));
				}
			} else {
				//tanpa ganti gambar
				$materi_detail = $this->materi_model->detail($_POST['id_materi']);
				$pelajaran = $this->pelajaran_model->detail($materi_detail->id_pelajaran);
				$data = array(
					'id_soal' => $id,
					'pertanyaan' 		=> $this->input->post('pertanyaan'),
					'id_materi'			=> $this->input->post('id_materi'),
					'id_pelajaran'		=> $pelajaran->id,
					'id_kelas'			=> $this->input->post('id_kelas'),
					'jawaban' 			=> $this->input->post('jawaban'),
					'pilihan1'			=> $this->input->post('pilihan1'),
					'pilihan2'			=> $this->input->post('pilihan2'),
					'pilihan3'			=> $this->input->post('pilihan3')
				);

				$this->soal_model->update($data);
				$this->session->set_flashdata('sukses', 'Soal berhasil diperbarui');
				redirect(base_url('soal'));
			}
		}
		//end masuk database

		$data = array(
			'title' => 'Edit Soal',
			'kelas' => $kelas,
			'materi'	=> $materi,
			'soal'     => $soal,
			'isi' => 'admin/soal/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function countdown_soal($id_materi)
	{
		$materi = $this->materi_model->detail($id_materi);
		$status = $this->soal_model->status_selesai();
		$kelas = $this->kelas_model->detail($materi->id_kelas);
		$pelajaran = $this->pelajaran_model->detail($materi->id_pelajaran);

		foreach ($status as $status) {
			if ($status->status_nilai == 1 && $status->username == $this->session->userdata('username') && $status->id_materi == $id_materi && $status->id_kelas == $kelas->id && $status->id_pelajaran == $pelajaran->id) {
				$this->session->set_flashdata('sukses', 'Maaf, anda tidak dapat masuk ke halaman soal ini karena sudah selesai menjawab soal.');
				redirect('materi/baca/' . $materi->slug_materi, 'refresh');
			}
		}

		$data = array('title' => 'Countdown Soal', 'isi' => 'admin/soal/countdown_soal', 'materi' => $materi);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function jawab($id_materi)
	{
		$materi = $this->materi_model->detail($id_materi);
		$status = $this->soal_model->status_selesai();
		$kelas = $this->kelas_model->detail($materi->id_kelas);
		$pelajaran = $this->pelajaran_model->detail($materi->id_pelajaran);

		foreach ($status as $status) {
			if ($status->status_nilai == 1 && $status->username == $this->session->userdata('username') && $status->id_materi == $id_materi && $status->id_kelas == $kelas->id && $status->id_pelajaran == $pelajaran->id) {
				$this->session->set_flashdata('sukses', 'Maaf, anda tidak dapat masuk ke halaman soal ini karena sudah selesai menjawab soal.');
				redirect('materi/baca/' . $materi->slug_materi, 'refresh');
			}
		}

		$soal = $this->soal_model->soal_test($id_materi);
		$data = array('title' => $materi->nama_materi, 'materi' => $materi, 'soal' => $soal, 'isi' => 'admin/soal/jawab');
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function nilai()
	{
		$username = $this->session->userdata('username');
		$id_materi = $_POST['id_materi'];
		$materi = $this->materi_model->detail($id_materi);
		$i = 1;
		$pelajaran = $this->pelajaran_model->detail($materi->id_pelajaran);
		$kelas = $this->kelas_model->detail($materi->id_kelas);

		while (isset($_POST['jawaban' . $i])) {
			$id_soal = $_POST['id_soal' . $i];
			$jawaban = $_POST['jawaban' . $i];
			$status_nilai = 1;
			// var_dump($answer);
			$this->soal_model->add_nilai($id_soal, $username, $jawaban, $id_materi, $status_nilai, $pelajaran->id, $kelas->id);
			$i++;
		}

		$this->session->set_flashdata('sukses', 'Terima kasih telah menyelesaikan pertanyaan');
		redirect(base_url('soal/countdown_hasil/' . $id_materi));
	}

	public function countdown_hasil($id_materi)
	{
		$materi = $this->materi_model->detail($id_materi);
		$jumlah_soal = count($this->soal_model->jumlah_soal($id_materi));
		$jawaban_benar = count($this->soal_model->jawaban_benar($id_materi, $this->session->userdata('username')));
		$nilai_akhir = $jawaban_benar * $materi->nilai_soal;

		$user = $this->user_model->detail($this->session->userdata('id'));
		$kelas = $this->kelas_model->detail($user->id_kelas);
		$pelajaran = $this->pelajaran_model->detail($materi->id_pelajaran);
		$data = array(
			'username' 			=> $this->session->userdata('username'),
			'jumlah_soal'		=> $jumlah_soal,
			'jawaban_benar' 	=> $jawaban_benar,
			'nilai_akhir'		=> $nilai_akhir,
			'id_materi'			=> $id_materi,
			'id_pelajaran'		=> $pelajaran->id,
			'id_kelas'			=> $kelas->id
		);

		$this->nilai_pengguna_model->add($data);

		$data = array('title' => 'Nilai kamu akan segara ditampilkan, sabar ya...', 'isi' => 'admin/soal/countdown_hasil', 'materi' => $materi);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function hasil($id_materi)
	{
		$nilai = $this->nilai_pengguna_model->detail($id_materi, $this->session->userdata('username'));
		$soal = $this->soal_model->kunci_jawaban($id_materi);

		$data = array('title' => $this->session->userdata('username'), 'isi' => 'admin/soal/hasil', 'nilai' => $nilai, 'soal' => $soal);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function download($id_soal)
	{
		$soal = $this->soal_model->detail($id_soal);

		//fungsi download user_guide
		//Contents of photo.jpg will be automatically read
		$file = $soal->gambar;
		force_download('./asset/upload/image/' . $file, NULL);
	}
}

/* End of file Soal.php */
/* Location: ./application/controllers/Soal.php */
