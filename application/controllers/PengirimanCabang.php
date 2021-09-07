<?php 
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class PengirimanCabang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengirimanCabang_m');
        $this->load->model('Cabang_m');
        $this->load->model('Kurir_m');
        $this->load->model('Pengiriman_m');
    }

	public function index()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        if ($this->session->userdata('Role') == 1) {
            $data = $this->Cabang_m->GetAll();
            $kurir = $this->Kurir_m->GetAll();
            $pengiriman = $this->Pengiriman_m->GetAll();
        }else if($this->session->userdata('Role') == 2){
            $pengiriman = $this->Pengiriman_m->GetByIdPerusahaan();
            $data = $this->Cabang_m->GetByIdPerusahaan();
            $kurir = $this->Kurir_m->GetByIdPerusahaan();
        }else{
            $pengiriman = $this->Pengiriman_m->GetByIdCabang();
            $data = $this->Cabang_m->GetByIdCabang();
            $kurir = $this->Kurir_m->GetByIdCabang();
        }
        $decode['cabang'] = json_decode($data, true);
        $decode['kurir'] = json_decode($kurir, true);
        $decode['pengiriman'] = json_decode($pengiriman, true);
		$this->load->view("pengirimanCabang/start", $decode);
	}

	public function get_pengiriman_all()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        if ($this->session->userdata("Role") != '1') redirect(base_url());
		$data = $this->PengirimanCabang_m->GetAll();
		echo $data;
	}

    public function get_pengiriman()
    {
        if (!$this->session->userdata("Username")) redirect(base_url());
        $data = $this->PengirimanCabang_m->GetByIdPerusahaan();
        echo $data;
    }

	public function tambah()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        if ($this->session->userdata('Role') == 1) {
            $data = $this->Cabang_m->GetAll();
            $kurir = $this->Kurir_m->GetAll();
            $pengiriman = $this->Pengiriman_m->GetAll();
        }else if($this->session->userdata('Role') == 2){
            $pengiriman = $this->Pengiriman_m->GetByIdPerusahaan();
            $data = $this->Cabang_m->GetByIdPerusahaan();
            $kurir = $this->Kurir_m->GetByIdPerusahaan();
        }else{
            $pengiriman = $this->Pengiriman_m->GetByIdCabang();
            $data = $this->Cabang_m->GetByIdPerusahaan();
            $kurir = $this->Kurir_m->GetByIdCabang();
        }
        $decode['cabang'] = json_decode($data, true);
        $decode['kurir'] = json_decode($kurir, true);
        $decode['pengiriman'] = json_decode($pengiriman, true);
		$this->load->view("pengirimanCabang/tambah", $decode);
	}

    public function add()
    {
        if (!$this->session->userdata("Username")) redirect(base_url());
        $isi = $this->input->post("data");
        $result = $this->PengirimanCabang_m->PostPengirimanCabang($isi);
        echo $result;
    }

    public function put_pengiriman()
    {
        if (!$this->session->userdata("Username")) redirect(base_url());
        $result = $this->PengirimanCabang_m->PutPengirimanCabang($this->input->post());
        echo $result;
    }

    public function delete()
    {
        if(!$this->session->userdata("Username")) redirect(base_url());
        $result = $this->PengirimanCabang_m->DeletePengirimanCabang($this->input->post());
        echo $result;
    }

}