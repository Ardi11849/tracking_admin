<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';
	
	public function GetAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/cabang/getAll');
		return $hasil;
	}

	public function GetByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/cabang/getByIdPerusahaan?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		return $hasil;
	}

	public function GetByIdCabang()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/cabang/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
		return $hasil;
	}

	public function PostCabang($data)
	{
        $user = $this->session->userdata("Id");
        $IdPerusahaan = $data['IdPerusahaan'];
        if(!$data['IdPerusahaan'] || $data['IdPerusahaan'] == 0 || $data['IdPerusahaan'] == "undefined") $IdPerusahaan = $this->session->userdata('IdPerusahaan');
        $hasil = $this->curl->simple_post($this->api_url.'api/v1/cabang/post', array('IdPerusahaan' => $IdPerusahaan, 'Nama' => $data["Nama"], 'Alamat' => $data["Alamat"], 'CreatedBy' => $user));
        return $hasil;
	}

	public function PutCabang($data)
	{
        $user = $this->session->userdata("Id");
        if(!$data['IdPerusahaan'] || $data['IdPerusahaan'] == 0 || $data['IdPerusahaan'] == "undefined") $IdPerusahaan = $this->session->userdata('IdPerusahaan');
        $IdPerusahaan = $data['IdPerusahaan'];
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/cabang/put', array('IdCabang' => $data["IdCabang"], 'IdPerusahaan' => $IdPerusahaan, 'Nama' => $data["Nama"], 'Alamat' => $data["Alamat"], 'ModifiedBy' => $user));
		return $hasil;
	}

	public function DeleteCabang($data)
	{
		$hasil = $this->curl->simple_delete($this->api_url.'api/v1/cabang/delete', array('IdCabang' => $data["IdCabang"]));
		return $hasil;
	}

}

/* End of file Cabang.php */
/* Location: ./application/models/Cabang.php */