<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->model('Cabang_m');
	$this->load->model('Perusahaan_m');
	$this->load->model('Pengiriman_m');
}
	

	public function index()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		if ($this->session->userdata('Role') == 1) {
	        $pengiriman = $this->Pengiriman_m->GetAll();
	        $cabang = $this->Cabang_m->GetAll();
		    $perusahaan = $this->Perusahaan_m->GetAll();
	        $decode['perusahaan'] = json_decode($perusahaan, true);
		} else if ($this->session->userdata('Role') == 2) {
	        $pengiriman = $this->Pengiriman_m->GetByIdPerusahaan();
	        $cabang = $this->Cabang_m->GetByIdPerusahaan();
		}else{
	        $pengiriman = $this->Pengiriman_m->GetByIdCabang();
	        $cabang = $this->Cabang_m->GetByIdCabang();
		}
        $decode['pengiriman'] = json_decode($pengiriman, true);
        $decode['cabang'] = json_decode($cabang, true);
		$this->load->view('pengiriman/start', $decode);
	}

	public function get_all()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Pengiriman_m->GetAll();
		echo $data;
	}

	public function get()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Pengiriman_m->GetByIdPerusahaan();
		echo $data;
	}

	public function get_cabang()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Pengiriman_m->GetByIdCabang();
		echo $data;
	}

	public function post()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Pengiriman_m->PostPengiriman($this->input->post());
		echo $data;
	}

	public function put()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Pengiriman_m->PutPengiriman($this->input->post());
		echo $data;
	}

	public function delete()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Pengiriman_m->DeletePengiriman($this->input->post());
		echo $data;
	}
}
?>
