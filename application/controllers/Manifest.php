<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manifest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Perusahaan_m');
		$this->load->model('Cabang_m');
		$this->load->model('Manifest_m');
		$this->load->model('Wilayah_m');
		$this->load->model('Kota_m');
	}

	public function index()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		if ($this->session->userdata("Role") == 1) {
			$pengiriman = $this->Manifest_m->GetPengiriman();
			$penerimaan = $this->Manifest_m->GetPenerimaan();
		} else if ($this->session->userdata("Role") == 2) {
			$pengiriman = $this->Manifest_m->GetPengiriman();
			$penerimaan = $this->Manifest_m->GetPenerimaan();
		} else {
			$pengiriman = $this->Manifest_m->GetPengiriman();
			$penerimaan = $this->Manifest_m->GetCabangPenerimaan();
		}
		$decode['pengiriman'] = json_decode($pengiriman, true);
		$decode['penerimaan'] = json_decode($penerimaan, true);
		$this->load->view('manifest/start', $decode);
	}

	public function get_manifest_by_nomanifest()
	{
		$data = $this->Manifest_m->GetByNoManfiest($this->input->post());
		echo $data;
	}

	public function tambah()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		if ($this->session->userdata("Role") == 1) {
			$cabang = $this->Cabang_m->GetAll();
		} else {
			$cabang = $this->Cabang_m->GetByIdPerusahaan($this->session->userdata('IdPerusahaan'));
		}
		$perusahaan = $this->Perusahaan_m->GetAll();
		$kotabesar = $this->Kota_m->GetKotaBesar();
		$provinsi = $this->Wilayah_m->GetProvinsi();
		$decode['perusahaan'] = json_decode($perusahaan, true);
		$decode['cabang'] = json_decode($cabang, true);
		$decode['provinsi'] = json_decode($provinsi, true);
		$decode['kotabesar'] = json_decode($kotabesar, true);
		$this->load->view('manifest/tambah', $decode);
	}

	public function add()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$hasil = $this->Manifest_m->Post($this->input->post("data"));
		echo $hasil;
	}

	public function konfirmasi_by_noresi()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$hasil = $this->Manifest_m->KonfirmasiByNoResi($this->input->post());
		echo $hasil;
	}

	public function konfirmasi()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$hasil = $this->Manifest_m->Konfirmasi($this->input->post());
		echo $hasil;
	}

	public function cancel()
	{
		if (!$this->session->userdata("Username")) redirect(base_url());
		$hasil = $this->Manifest_m->Cancel($this->input->post());
		echo $hasil;
	}

}

/* End of file Manifest.php */
/* Location: ./application/controllers/Manifest.php */