<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
        if ($this->session->userdata('akses_level') == 21 || 2 || $this->session->userdata('akses_level') == 1) {
            $this->load->model('user_model');
            $this->load->model('nilai_pengguna_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function ubah_password($id)
    {
        $valid = $this->form_validation;
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
            $profile = $this->user_model->detail($id);
            $data = array(
                'title' => $profile->name,
                'isi' => 'admin/profile/list',
                'profile' => $profile
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'id' => $id,
                'password' => sha1($this->input->post('password'))
            );

            $this->user_model->update($data);
            $this->session->set_flashdata('sukses', 'Password berhasil diperbarui');
            redirect(base_url('profile/detail/' . $id));
        }
    }

    public function detail($id)
    {
        $profile = $this->user_model->detail_user_kelas($id);
        $user = $this->user_model->detail($id);
        $profile_edit = $this->user_model->detail($id);
        $nilai = $this->nilai_pengguna_model->nilai_pelajaran($profile->username, $profile->id_kelas);
        $pelajaran = $this->nilai_pengguna_model->akumulasi($profile->username);
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required', array('required' => 'Nama harus diisi'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim', array(
            'required' => 'Username harus diisi',
            'trim' => 'Username tidak boleh ada spasi'
        ));

        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'     => $profile_edit->name,
                'isi'         => 'admin/profile/list',
                'profile'    => $profile,
                'profile_edit' => $profile_edit,
                'nilai' => $nilai,
                'pelajaran' => $pelajaran
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {

            //kalau ada gambar
            if (!empty($_FILES['gambar']['name'])) {

                $config['upload_path']         = './asset/upload/image/';  //lokasi folder upload
                $config['allowed_types']     = 'gif|jpg|png|svg|tiff|doc|docx|xls|xlsx|pdf|ppt|pptx|txt|doc|docx|zip|rar'; //format file yang di-upload
                $config['max_size']            = '10000'; // KB	
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    $data = array(
                        'title'     => $profile_edit->name,
                        'isi'         => 'admin/profile/list',
                        'profile'    => $profile,
                        'profile_edit' => $profile_edit,
                        'nilai' => $nilai,
                        'pelajaran' => $pelajaran,
                        'error'     =>  $this->upload->display_errors()
                    );
                    $this->load->view('admin/layout/wrapper', $data);

                    // Masuk database 
                } else {
                    $upload_data                = array('uploads' => $this->upload->data());
                    // Image Editor
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './asset/upload/image/' . $upload_data['uploads']['file_name'];
                    $config['new_image']         = './asset/upload/image/thumbs/';
                    $config['create_thumb']     = TRUE;
                    $config['quality']             = "100%";
                    $config['maintain_ratio']     = TRUE;
                    $config['width']             = 360; // Pixel
                    $config['height']             = 360; // Pixel
                    $config['x_axis']             = 0;
                    $config['y_axis']             = 0;
                    $config['thumb_marker']     = '';
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    //hapus gambar
                    if ($user->gambar != "") {
                        unlink('./asset/upload/image/' . $user->gambar);
                    }
                    //end hapus gambar
                    $data = array(
                        'id'    => $id,
                        'name' => $this->input->post('name'),
                        'username' => $this->input->post('username'),
                        'nisn' => $this->input->post('nisn'),
                        'gambar'        => $upload_data['uploads']['file_name'],
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'agama' => $this->input->post('agama'),
                    );

                    $this->user_model->update($data);
                    $this->session->set_flashdata('sukses', 'Profile telah diperbarui');
                    redirect(base_url('profile/detail/' . $id));
                }
            } else {
                //tanpa ganti gambar
                $data = array(
                    'id'    => $id,
                    'name' => $this->input->post('name'),
                    'username' => $this->input->post('username'),
                    'nisn' => $this->input->post('nisn'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'agama' => $this->input->post('agama'),
                );

                $this->user_model->update($data);
                $this->session->set_flashdata('sukses', 'Profile telah diperbarui');
                redirect(base_url('profile/detail/' . $id));
            }
        }
    }
}
