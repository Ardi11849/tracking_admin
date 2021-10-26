<?php 
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Cabang extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Perusahaan_m');
		$this->load->model('Cabang_m');
		$this->load->model('Kota_m');
	}

	public function index(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Perusahaan_m->GetAll();
		$kotabesar = $this->Kota_m->GetKotaBesar();
		$decode['kotabesar'] = json_decode($kotabesar, true); 
		$decode['data'] = json_decode($data, true);
		$this->load->view('cabang/start', $decode);
	}

	public function get_cabang_all(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Cabang_m->GetAll();
		echo $data;
	}

	public function get_cabang(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Cabang_m->GetByIdPerusahaan();
		echo $data;
	}

	public function get_cabang_input(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Cabang_m->GetByIdPerusahaanInput($this->input->post());
		echo $data;
	}

	public function post_cabang(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Cabang_m->PostCabang($this->input->post());
		echo $data;
	}

	public function put_cabang(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Cabang_m->PutCabang($this->input->post());
		echo $data;
	}

	public function delete_cabang(){
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Cabang_m->DeleteCabang($this->input->post());
		echo $data;
	}

}
?>