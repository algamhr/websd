<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Countdown extends CI_Controller
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
        if ($this->session->userdata('akses_level') == 1) {
            $this->load->model('countdown_model');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function index()
    {
        $id = 1;
        $countdown = $this->countdown_model->detail($id);
        $valid = $this->form_validation;
        $valid->set_rules('date', 'Date', 'required', array('required' => 'Tanggal harus diisi'));
        $valid->set_rules('time', 'Time', 'required', array('required' => 'Waktu harus diisi'));

        if ($valid->run() === FALSE) {
            $data = array(
                'title' => 'Countdown',
                'isi' => 'admin/countdown/list',
                'countdown' => $countdown
            );
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $date = $_POST['date'];
            $time = $_POST['time'];
            $waktu =  date('Y-m-d H:i:s', strtotime("$date $time"));
            $data = array(
                'id' => $id,
                'waktu' => $waktu
            );

            $this->countdown_model->update($data);
            redirect(base_url('countdown'));
        }
    }

    public function show()
    {
        $id = 1;
        $countdown = $this->countdown_model->detail($id);
        $data = array(
            'title' => 'Countdown',
            'countdown' => $countdown
        );
        $this->load->view('countdown_view', $data, FALSE);
    }
}
