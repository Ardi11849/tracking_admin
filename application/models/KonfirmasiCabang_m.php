<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KonfirmasiCabang_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll()
	{
        $hasil = $this->curl->simple_get($this->api_url.'api/v1/konfirmasiCabang/getAll');
        return $hasil;
	}

	public function GetByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/konfirmasiCabang/get?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		return $hasil;
	}

	public function GetByIdCabang()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/konfirmasiCabang/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
		return $hasil;
	}

	public function Konfirmasi($data)
	{
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/konfirmasiCabang/put', array('Status' => '1', 'IdKurir' => $data['IdKurir'], 'ModifiedBy' => $this->session->userdata("Id")));
		return $hasil;
	}

}

/* End of file KonfirmasiCabang_m.php */
/* Location: ./application/models/KonfirmasiCabang_m.php */