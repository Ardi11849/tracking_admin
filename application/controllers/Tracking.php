<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tracking_m');
	}

	public function index()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$this->load->view('tracking/start');
	}

	public function get_tracking()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		if ($this->session->userdata("Role") == 1) {
			$data = $this->Tracking_m->GetAll();
		} else if($this->session->userdata("Role") == 2){
			$data = $this->Tracking_m->GetByIdPerusahaan();
		}else{
			$data = $this->Tracking_m->GetByIdCabang();
		}	
		echo $data;
	}
}
?>
