<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KonfirmasiCabang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KonfirmasiCabang_m');
    }

	public function index()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        if ($this->session->userdata('Role') == 1) {
            $konfirmasi = $this->KonfirmasiCabang_m->GetAll();
        }else if($this->session->userdata('Role') == 2){
            $konfirmasi = $this->KonfirmasiCabang_m->GetByIdPerusahaan();
        }else{
            $konfirmasi = $this->KonfirmasiCabang_m->GetByIdCabang();
        }
        $decode['konfirmasi'] = json_decode($konfirmasi, true);
		$this->load->view('konfirmasiCabang/start', $decode);
	}

	public function konfirmasi()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        $konfirmasi = $this->KonfirmasiCabang_m->Konfirmasi($this->input->post());
        echo $konfirmasi;
	}

}

/* End of file KonfirmasiCabang.php */
/* Location: ./application/controllers/KonfirmasiCabang.php */
