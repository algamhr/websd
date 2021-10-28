<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Materi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('akses_level') == 2 || $this->session->userdata('akses_level') == 1) {
			$this->load->model('materi_model');
			$this->load->model('kelas_model');
			$this->load->model('pelajaran_model');
		} else {
			redirect('pagenotfound404', 'refresh');
		}
	}

	public function index()
	{
		if ($this->session->userdata('akses_level') == '21' || $this->session->userdata('akses_level') == '2') {
			$materi = $this->materi_model->listing_guru($this->session->userdata('id'));
		} else {
			$materi = $this->materi_model->listing_home3();
		}
		$data = array('title' => 'Materi', 'isi' => 'admin/materi/list', 'materi' => $materi);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function tambah()
	{
		$kelas = $this->kelas_model->listing();
		$pelajaran = $this->pelajaran_model->listing();
		$this->form_validation->set_rules('nama_materi', 'Judul Materi', 'required', array('required' => 'Judul Materi harus diisi'));

		if ($this->form_validation->run()) {
			$config['upload_path'] 		= './asset/upload/image/';  //lokasi folder upload
			$config['allowed_types'] 	= 'gif|jpg|png|svg|tiff|doc|docx|xls|xlsx|pdf|ppt|pptx|txt|doc|docx|zip|rar'; //format file yang di-upload
			$config['max_size']			= '10000'; // KB	
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$data = array(
					'title' 	=> 'Tambah Materi',
					'isi' 		=> 'admin/materi/tambah',
					'kelas'     => $kelas,
					'pelajaran'	=> $pelajaran,
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


				$slug_materi = url_title($this->input->post('nama_materi'), 'dash', TRUE);

				$data = array(
					'username'			=> $this->session->userdata('username'),
					'nama_materi' 		=> $this->input->post('nama_materi'),
					'link_materi'		=> $this->input->post('link_materi'),
					'slug_materi'  		=> $slug_materi,
					'keterangan_materi' => $this->input->post('keterangan_materi'),
					'waktu_selesai'		=> $this->input->post('waktu_selesai'),
					'waktu_mulai'		=> $this->input->post('waktu_mulai'),
					'nilai_soal'		=> $this->input->post('nilai_soal'),
					'gambar'		=> $upload_data['uploads']['file_name'],
					'id_kelas' 	=> $this->input->post('id_kelas'),
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'status_materi' => $this->input->post('status_materi'),
					'video_materi' => $this->input->post('video_materi'),
					'id_user'		=> $this->session->userdata('id')
				);

				$this->materi_model->add($data);
				$this->session->set_flashdata('sukses', 'Materi telah ditambah');
				redirect(base_url('materi'));
			}
		}

		$data = array(
			'title' => 'Tambah Materi',
			'kelas' => $kelas,
			'pelajaran'     => $pelajaran,
			'isi' => 'admin/materi/tambah'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function delete($id)
	{
		$materi = $this->materi_model->detail($id);

		//hapus gambar
		if ($materi->gambar != "") {
			unlink('./asset/upload/image/' . $materi->gambar);
		}
		//end hapus gambar

		$data = array('id_materi' => $materi->id_materi);

		if ($this->session->userdata('akses_level') == 21 || 2) {
			$this->materi_model->delete($data);
		} else {
			redirect('error404', 'refresh');
		}

		$this->session->set_flashdata('sukses', 'Materi berhasil dihapus');
		redirect('materi', 'refresh');
	}

	public function edit($id)
	{
		$kelas = $this->kelas_model->listing();
		$pelajaran = $this->pelajaran_model->listing();
		$materi = $this->materi_model->detail($id);
		$this->form_validation->set_rules('nama_materi', 'Judul Materi', 'required', array('required' => 'Judul Materi harus diisi'));

		if ($this->form_validation->run()) {

			//kalau ada gambar
			if (!empty($_FILES['gambar']['name'])) {

				$config['upload_path'] 		= './asset/upload/image/';  //lokasi folder upload
				$config['allowed_types'] 	= 'gif|jpg|png|svg|tiff|doc|docx|xls|xlsx|pdf|ppt|pptx|txt|doc|docx|zip|rar'; //format file yang di-upload
				$config['max_size']			= '10000'; // KB	
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 	=> 'Edit Materi',
						'isi' 		=> 'admin/materi/edit',
						'kelas'	=> $kelas,
						'pelajaran'	=> $pelajaran,
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

					//hapus gambar
					if ($materi->gambar != "") {
						unlink('./asset/upload/image/' . $materi->gambar);
					}
					//end hapus gambar

					$slug_materi = url_title($this->input->post('nama_materi'), 'dash', TRUE);
					$data = array(
						'id_materi' => $id,
						'username'			=> $this->session->userdata('username'),
						'nama_materi' 		=> $this->input->post('nama_materi'),
						'link_materi'		=> $this->input->post('link_materi'),
						'slug_materi'  		=> $slug_materi,
						'keterangan_materi' => $this->input->post('keterangan_materi'),
						'waktu_selesai'		=> $this->input->post('waktu_selesai'),
						'waktu_mulai'		=> $this->input->post('waktu_mulai'),
						'nilai_soal'		=> $this->input->post('nilai_soal'),
						'gambar'		=> $upload_data['uploads']['file_name'],
						'id_kelas' 	=> $this->input->post('id_kelas'),
						'id_pelajaran' => $this->input->post('id_pelajaran'),
						'status_materi' => $this->input->post('status_materi'),
						'video_materi' => $this->input->post('video_materi')
					);

					$this->materi_model->update($data);
					$this->session->set_flashdata('sukses', 'Materi berhasil diperbarui');
					redirect(base_url('materi'));
				}
			} else {
				//tanpa ganti gambar
				$slug_materi = url_title($this->input->post('nama_materi'), 'dash', TRUE);
				$data = array(
					'id_materi' => $id,
					'username'			=> $this->session->userdata('username'),
					'nama_materi' 		=> $this->input->post('nama_materi'),
					'link_materi'		=> $this->input->post('link_materi'),
					'slug_materi'  		=> $slug_materi,
					'keterangan_materi' => $this->input->post('keterangan_materi'),
					'waktu_selesai'		=> $this->input->post('waktu_selesai'),
					'waktu_mulai'		=> $this->input->post('waktu_mulai'),
					'nilai_soal'		=> $this->input->post('nilai_soal'),
					'id_kelas' 	=> $this->input->post('id_kelas'),
					'id_pelajaran' => $this->input->post('id_pelajaran'),
					'status_materi' => $this->input->post('status_materi'),
					'video_materi' => $this->input->post('video_materi')
				);

				$this->materi_model->update($data);
				$this->session->set_flashdata('sukses', 'Materi berhasil diperbarui');
				redirect(base_url('materi'));
			}
		}
		//end masuk database

		$data = array(
			'title' => 'Edit Materi',
			'kelas' => $kelas,
			'materi'	=> $materi,
			'pelajaran'     => $pelajaran,
			'isi' => 'admin/materi/edit'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function download($id_materi)
	{

		$materi = $this->materi_model->detail($id_materi);

		$data = array(
			'id_user'		=> $this->session->userdata('id'),
			'id_kelas'	=> $materi->id_kelas,
			'id_materi'			=> $id_materi,
			'jumlah'	=> 1
		);

		$insert = $this->materi_model->jumlah_download($data);

		//fungsi download user_guide
		//Contents of photo.jpg will be automatically read
		$file = $materi->gambar;
		force_download('./asset/upload/image/' . $file, NULL);
	}

	public function baca($slug_materi)
	{
		$materi = $this->materi_model->detail_slug($slug_materi);
		$data = array(
			'title' => $materi->nama_materi,
			'isi'	=> 'admin/materi/baca',
			'materi'	=> $materi
		);
		$this->load->view('admin/layout/wrapper', $data);
	}
}

/* End of file Materi.php */
/* Location: ./application/controllers/Materi.php */
