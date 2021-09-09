<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');class Kurir extends CI_Controller {
var $api_url = 'http://localhost:5000/';
public function __construct()
{parent::__construct();$this->load->model('Kurir_m');
}public function index(){if (!$this->session->userdata("Username")) redirect(base_url());$this->load->view('kurir/start');}public function get_kurir_all(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Kurir_m->GetAll();echo $data;}public function get_kurir(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Kurir_m->GetByIdPerusahaan();echo $data;}public function get_kurir_cabang(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Kurir_m->GetByIdCabang();echo $data;}public function post_kurir(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Kurir_m->PostKurir($this->input->post());echo $data;}public function put_kurir(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Kurir_m->PutKurir($this->input->post());echo $data;}public function delete_kurir(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Kurir_m->DeleteKurir($this->input->post());echo $data;}
}
?>
