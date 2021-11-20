<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Laporan_m');
		$this->load->model('Pengiriman_m');
	}

	public function index()
	{
		$this->load->view('laporan/start');
	}

	public function get_pengeluaran_all()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Laporan_m->GetAllPengeluaran();
		echo $data;
	}

	public function get_pengeluaran()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Laporan_m->GetPengeluaranByPerusahaan();
		echo $data;
	}

	public function get_pengeluaran_cabang()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Laporan_m->GetByPengeluaranCabang();
		echo $data;
	}

	public function post_pengeluaran(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Laporan_m->PostPengeluaran($this->input->post());
		echo $data;
	}

	public function put_pengeluaran(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Laporan_m->PutPengeluaran($this->input->post());
		echo $data;
	}

	public function delete_pengeluaran(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Laporan_m->DeletePengeluaran($this->input->post());
		echo $data;
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */