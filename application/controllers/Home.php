<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

 	public function __construct()
 	{
 		parent::__construct();
 		//Do your magic here
 		if($this->session->userdata('akses_level')==21 || $this->session->userdata('akses_level')==1){
 			$this->load->model('materi_model');
 		} else {
 			redirect('pagenotfound404','refresh');
 		}
 	}

	public function index()
	{
		$materi1 = $this->materi_model->listing_home1();
		$materi3 = $this->materi_model->listing_home3();
		$data = array('title' => 'Home', 'isi' => 'admin/home/list', 'materi1' => $materi1, 'materi3' => $materi3 );
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */