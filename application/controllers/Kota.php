<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kota_m');
	}

	public function index()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->GetKotaBesar();
		$decode['data'] = json_decode($data, true);
		$this->load->view('kota/start', $decode);
	}

	public function get_kota_besar()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->GetKotaBesar();
		echo $data;
	}

	public function get_kota()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->GetKota();
		echo $data;
	}

	public function get_kota_bykkb()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->GetKotaByKodeKotaBesar($this->input->post());
		echo $data;
	}

	public function post_kota_besar()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->PostKotaBesar($this->input->post());
		echo $data;
	}

	public function post_kota()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->PostKota($this->input->post());
		echo $data;
	}

	public function put_kota_besar()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->PutKotaBesar($this->input->post());
		echo $data;
	}

	public function put_kota()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->PutKota($this->input->post());
		echo $data;
	}

	public function delete_kota_besar()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->DeleteKotaBesar($this->input->post());
		echo $data;
	}

	public function delete_kota()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->Kota_m->DeleteKota($this->input->post());
		echo $data;
	}

}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */