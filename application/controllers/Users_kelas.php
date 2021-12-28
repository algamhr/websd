<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_kelas extends CI_Controller
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
            $this->load->model('kelas_model');
            $this->load->model('nilai_pengguna_model');
        } else {
            redirect('login', 'refresh');
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
            $nilai_pengguna = $this->nilai_pengguna_model->cek_status($id_kelas);
            if ($nilai_pengguna == NULL) {
                $status = 0;
            }
            foreach ($nilai_pengguna as $nilai_pengguna) {
                if ($nilai_pengguna->status_nilai != "publish" || $nilai_pengguna->status_nilai == NULL) {
                    $status = "draft";
                } else {
                    $status = "publish";
                }
            }
            $data = array(
                'slug_kelas' => $kelas->slug_kelas,
                'title' => $kelas->nama_kelas,
                'isi' => 'admin/users_kelas/list',
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

    public function import()
    {
        $data['title'] = "Import File Excel";
        $this->load->view('users_kelas/import', $data);
    }

    public function excel()
    {
        $id_kelas = $this->input->post('id_kelas');
        //$total_user = 0;
        //TODO : mendapatkan total user yang punya id_kelas = $id_kelas

        $slug_kelas = $this->input->post('slug_kelas');
        //TODO : mendapatkan username slug_kelas LIKE '$slug_kelas%' ORDER BY username DESCENDING, LIMIT 1

        //$last_number = 0;
        //TODO : extract username, pisahkan slug_kelas dan angkanya, str_split by '-'

        //$next_id = ($total_user == 0) ? 1 : $last_number + 1;

        if (isset($_FILES["import_murid"]["name"])) {
            // upload
            $file_tmp = $_FILES['import_murid']['tmp_name'];
            $file_name = $_FILES['import_murid']['name'];
            $file_size = $_FILES['import_murid']['size'];
            $file_type = $_FILES['import_murid']['type'];
            // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

            $object = PHPExcel_IOFactory::load($file_tmp);
            $data = array();

            $worksheet = $object->getSheet(0);

            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {
                $nisn = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $jenis_kelamin = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $agama = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $username = str_replace(' ', '.', strtolower($nama));
                //$username = $slug_kelas . '-' . $next_id;
                $password = sha1($username);
                $akses_level = '1';

                array_push($data, array(
                    'username'      => $username,
                    'password'      => $password,
                    'nisn'          => $nisn,
                    'name'          => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'agama'         => $agama,
                    'akses_level'   => $akses_level,
                    'id_kelas'      => $id_kelas,
                    $slug_kelas => $slug_kelas,
                ));

                //$next_id = $next_id + 1;
                //Untuk buat username +1
            }

            // echo json_encode($data);

            $message = array();

            if ($data) {
                $insertAll = $this->db->insert_batch('user', $data);
                if (!$insertAll && $this->db->_error_number() == 1062) {
                    $message = array(
                        'state'   => 'failed',
                        'message' => '<div class="alert alert-danger">Import file gagal, coba lagi</div>',
                    );
                } else {
                    $message = array(
                        'state'   => 'success',
                        'message' => '<div class="alert alert-success">Import file excel berhasil disimpan di database</div>',
                    );
                }
            } else {
                $message = array(
                    'state'   => 'failed',
                    'message' => '<div class="alert alert-danger">Import file gagal, coba lagi</div>',
                );
            }
            echo json_encode($message);
        } else {
            $message = array(
                'state'   => 'failed',
                'message' => '<div class="alert alert-danger">Import file gagal, coba lagi</div>',
            );
            echo json_encode($message);
        }
    }

    public function update($id, $id_kelas)
    {
        $user = $this->user_model->listing_user_kelas($id_kelas);
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required', array('required' => 'Nama harus diisi'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim', array(
            'required' => 'Username harus diisi',
            'is_unique' => 'Username <strong>' . $this->input->post('username') . '</strong> sudah digunakan',
            'trim' => 'Username tidak boleh ada spasi'
        ));

        $kelas = $this->kelas_model->detail($id_kelas);
        $count_user = count($this->user_model->listing_user_kelas($id_kelas));
        if ($this->form_validation->run() === FALSE) {
            $nilai_pengguna = $this->nilai_pengguna_model->cek_status($id_kelas);
            foreach ($nilai_pengguna as $nilai_pengguna) {
                if ($nilai_pengguna->status_nilai == NULL || $nilai_pengguna->status_nilai == "" || $nilai_pengguna == 0) {
                    $status = "draft";
                } else {
                    $status = "publish";
                }
            }
            $data = array(
                'title'     => $kelas->nama_kelas,
                'isi'         => 'admin/users_kelas/list',
                'user'    => $user,
                'id_kelas' => $id_kelas,
                'count_user' => $count_user,
                'jumlah_kelas' => $kelas->jumlah_kelas,
                'id_kelas' => $id_kelas,
                'status' => $status
            );
            $this->load->view('admin/layout/wrapper', $data);
        } else {
            $data = array(
                'id'    => $id,
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
            );

            $this->user_model->update($data);
            $this->session->set_flashdata('sukses', 'Data telah diperbarui');
            redirect(base_url('users_kelas/pengguna/' . $id_kelas));
        }
    }

    public function destroy($id, $id_kelas)
    {
        $user = $this->user_model->detail($id);

        $this->nilai_pengguna_model->delete_nilai_pengguna($user->username);
        $this->nilai_pengguna_model->delete_nilai($user->username);

        $data = array('id' => $user->id);
        $this->user_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('users_kelas/pengguna/' . $id_kelas));
    }

    public function reset_password($id, $id_kelas)
    {
        $karakter = "ABCDEFGHIJKLMNOPQRSTUVWQYZ1234567890";
        $password = substr(str_shuffle($karakter), 0, 8);
        $data = array(
            'id' => $id,
            'password' => sha1($password),
        );

        $this->user_model->update($data);

        $this->session->set_flashdata('sukses', 'Simpan Password Berikut : ' . $password);
        redirect(base_url('users_kelas/pengguna/' . $id_kelas));
    }

    public function publish_nilai($id_kelas)
    {
        $data = array(
            'id_kelas' => $id_kelas,
            'status_nilai' => "publish",
        );

        $this->nilai_pengguna_model->update_pengumuman($data);

        $this->session->set_flashdata('sukses', 'Pengumuman berhasil di-publish');
        redirect(base_url('users_kelas/pengguna/' . $id_kelas));
    }

    public function draft_nilai($id_kelas)
    {
        $data = array(
            'id_kelas' => $id_kelas,
            'status_nilai' => 0,
        );

        $this->nilai_pengguna_model->update_pengumuman($data);

        $this->session->set_flashdata('sukses', 'Pengumuman berhasil di-draft');
        redirect(base_url('users_kelas/pengguna/' . $id_kelas));
    }
}
