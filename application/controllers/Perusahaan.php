<?php header('Access-Control-Allow-Origin: *');defined('BASEPATH') OR exit('No direct script access allowed');class Perusahaan extends CI_Controller {public function __construct(){parent::__construct();$this->load->model('Perusahaan_m');}public function index(){if (!$this->session->userdata("Username")) redirect(base_url());$this->load->view('perusahaan/start');}public function get_perusahaan(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Perusahaan_m->GetAll();echo $data;}public function active_perusahaan(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Perusahaan_m->Active($this->input->post());echo $data;}public function inActive_perusahaan(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Perusahaan_m->InActive($this->input->post());echo $data;}public function post_perusahaan(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Perusahaan_m->PostPerusahaan($this->input->post());echo $data;}public function put_perusahaan(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Perusahaan_m->PutPerusahaan($this->input->post());echo $data;}public function delete_perusahaan(){if (!$this->session->userdata("Username")) redirect(base_url());$data = $this->Perusahaan_m->DeletePerusahaan($this->input->post());echo $data;}}?>