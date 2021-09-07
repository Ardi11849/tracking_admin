<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_m');
		$this->load->model('Perusahaan_m');
		$this->load->model('Cabang_m');
		$this->load->model('Kurir_m');
	}
	

	public function index()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		if ($this->session->userdata('Role') == 1) {
	        $kurir = $this->Kurir_m->GetAll();
	        $cabang = $this->Cabang_m->GetAll();
		} else if ($this->session->userdata('Role') == 2) {
	        $kurir = $this->Kurir_m->GetByIdPerusahaan();
	        $cabang = $this->Cabang_m->GetByIdPerusahaan();
		}else{
	        $kurir = $this->Kurir_m->GetByIdCabang();
	        $cabang = $this->Cabang_m->GetByIdPerusahaan();
		}
	    $perusahaan = $this->Perusahaan_m->GetAll();
        $decode['kurir'] = json_decode($kurir, true);
        $decode['cabang'] = json_decode($cabang, true);
        $decode['perusahaan'] = json_decode($perusahaan, true);
		$this->load->view('user/start', $decode);
	}

	public function get_user_all_admin()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->GetUsersAdminAll();
		echo $data;
	}

	public function get_user_admin()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->GetUsersAdminByIdPerusahaan();
		echo $data;
	}

	public function get_user_all_kurir()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->GetUsersKurirAll();
		echo $data;
	}

	public function get_user_kurir()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->GetUsersKurirByIdPerusahaan();
		echo $data;
	}

	public function get_user_kurir_cabang()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->GetUsersKurirByIdCabang();
		echo $data;
	}

	public function post_user()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->PostUsers($this->input->post());
		echo $data;
	}

	public function put_user()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->PutUsers($this->input->post());
		echo $data;
	}

	public function delete_user()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->User_m->DeleteUSers($this->input->post());
		echo $data;
	}
}
?>
