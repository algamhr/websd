<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses_level') == 21) {
            $this->load->model('guru_model');
            $this->load->model('user_model');
            $this->load->model('kelas_model');
            $this->load->model('gurukelas_model');
        } else {
            redirect('pagenotfound404', 'refresh');
        }
    }

    public function index()
    {
        $valid = $this->form_validation;
        $valid->set_rules('name', 'name', 'required', array('required' => 'name harus diisi'));
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
            $data['guru'] = $this->user_model->listing_guru();
            $data['kelas'] = $this->kelas_model->listing();
            $data['isi'] = 'admin/guru/list';
            $data['title'] = 'Guru';
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $valuekelas = implode(",", $this->input->post('kelas'));
            $kelas = (explode(",", $valuekelas));
            $oldkelas = [
                'kelas1a', 'kelas2a', 'kelas3a', 'kelas4a', 'kelas5a', 'kelas6a',
                'kelas1b', 'kelas2b', 'kelas3b', 'kelas4b', 'kelas5b', 'kelas6b',
                'kelas1c', 'kelas2c', 'kelas3c', 'kelas4c', 'kelas5c', 'kelas6c'
            ];
            $countkelas = count($kelas);
            for ($i = 0; $i < 18; $i++) {
                if (isset($kelas[$i])) {
                    $kelas[$i] = $kelas[$i];
                } else {
                    $kelas[$i] = null;
                }
            }

            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'password' => sha1($this->input->post('password')),
                'akses_level' => 2,
            );
            $this->guru_model->add($data);

            $insert_id = $this->db->insert_id();
            for ($i = 0; $i < $countkelas; $i++) {
                for ($j = 0; $j < 18; $j++) {
                    if ($kelas[$i] == $oldkelas[$j]) {
                        $data_update = array(
                            'id'    => $insert_id,
                            "$oldkelas[$j]" => $kelas[$i]
                        );
                        $this->guru_model->edit($data_update);
                    }
                }
            }

            $this->session->set_flashdata('sukses', 'guru telah ditambah');
            redirect(base_url('guru'));
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'name', 'required', array('required' => 'name user harus diisi'));
        $this->form_validation->set_rules('username', 'username', 'required', array('required' => 'username user harus diisi'));


        if ($this->form_validation->run() === FALSE) {

            $user = $this->guru_model->detail_guru($id);
            $kelas = $this->kelas_model->listing();
            $data = array(
                'title' => 'Guru',
                'isi' => 'admin/guru/edit',
                'kelas' => $kelas,
                'user' => $user,
            );

            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $data = array(
                'id'    => $id,
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'kelas1a' => null,
                'kelas1b' => null,
                'kelas1c' => null,
                'kelas2a' => null,
                'kelas2b' => null,
                'kelas2c' => null,
                'kelas3a' => null,
                'kelas3b' => null,
                'kelas3c' => null,
                'kelas4a' => null,
                'kelas4b' => null,
                'kelas4c' => null,
                'kelas5a' => null,
                'kelas5b' => null,
                'kelas5c' => null,
                'kelas6a' => null,
                'kelas6b' => null,
                'kelas6c' => null
            );
            $this->guru_model->edit($data);

            $valuekelas = implode(",", $this->input->post('kelas'));
            $kelas = (explode(",", $valuekelas));
            $oldkelas = [
                'kelas1a', 'kelas2a', 'kelas3a', 'kelas4a', 'kelas5a', 'kelas6a',
                'kelas1b', 'kelas2b', 'kelas3b', 'kelas4b', 'kelas5b', 'kelas6b',
                'kelas1c', 'kelas2c', 'kelas3c', 'kelas4c', 'kelas5c', 'kelas6c'
            ];
            $countkelas = count($kelas);
            for ($i = 0; $i < 18; $i++) {
                if (isset($kelas[$i])) {
                    $kelas[$i] = $kelas[$i];
                } else {
                    $kelas[$i] = null;
                }
            }
            for ($i = 0; $i < $countkelas; $i++) {
                for ($j = 0; $j < 18; $j++) {
                    if ($kelas[$i] == $oldkelas[$j]) {
                        $data_update = array(
                            'id'    => $id,
                            "$oldkelas[$j]" => $kelas[$i]
                        );
                        $this->guru_model->edit($data_update);
                    }
                }
            }

            $this->session->set_flashdata('sukses', 'Data telah diedit');
            redirect(base_url('guru'));
        }
    }

    //CREATE
    function create()
    {
        // $guru = $this->input->post('guru', TRUE);
        $kelas = $this->input->post('kelas', TRUE);
        $name = $this->input->post('name', TRUE);
        $username = $this->input->post('username', TRUE);
        $password = sha1($this->input->post('password'));
        $this->gurukelas_model->create_guru($name, $kelas, $username, $password);
        redirect('guru');
    }

    function get_kelas_by_guru()
    {
        $guru_id = $this->input->post('guru_id');
        $data = $this->gurukelas_model->get_kelas_by_guru($guru_id)->result();
        foreach ($data as $result) {
            $value[] = (float) $result->kelas_id;
        }
        echo json_encode($value);
    }

    //UPDATE
    function update()
    {
        $id = $this->input->post('edit_id', TRUE);
        $guru = $this->input->post('guru_edit', TRUE);
        $kelas = $this->input->post('kelas_edit', TRUE);
        $this->gurukelas_model->update_guru($id, $guru, $kelas);
        redirect('guru');
    }

    public function hapus($id)
    {
        $user = $this->user_model->detail($id);
        $data = array('id' => $user->id);
        $this->user_model->delete($data);
        $this->session->set_flashdata('sukses', 'Data berhasil dihapus');
        redirect(base_url('guru'));
    }
}

/* End of file guru.php */
/* Location: ./application/controllers/guru.php */
