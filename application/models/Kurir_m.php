<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurir_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/Kurir/getAll');
		return $hasil;
	}

	public function GetByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/Kurir/get?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		return $hasil;
	}

	public function GetByIdCabang()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/Kurir/getCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').'&IdCabang='.$this->session->userdata("IdCabang"));
		return $hasil;
	}

	public function PostKurir($data)
	{
        $user = $this->session->userdata("Id");
        $perusahaan = $this->session->userdata("IdPerusahaan");
        $cabang = $this->session->userdata("IdCabang");
		$hasil = $this->curl->simple_post($this->api_url.'api/v1/kurir/post', array('Nama' => $data["Nama"], 'IdPerusahaan' => $perusahaan, 'IdCabang' => $cabang, 'NoTelp' => $data["NoTelp"], 'CreatedBy' => $user));
		return $hasil;
	}

	public function PutKurir($data)
	{
        $user = $this->session->userdata("Id");
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/kurir/put', array('IdKurir' => $data["IdKurir"], 'Nama' => $data["Nama"], 'NoTelp' => $data["NoTelp"], 'IdPerusahaan' => $this->session->userdata('IdPerusahaan'), 'ModifiedBy' => $user));
		return $hasil;
	}

	public function DeleteKurir($data)
	{
		$hasil = $this->curl->simple_delete($this->api_url.'api/v1/kurir/delete', array('IdKurir' => $data["IdKurir"]));
		return $hasil;
	}

}

/* End of file Kurir_m.php */
/* Location: ./application/models/Kurir_m.php */