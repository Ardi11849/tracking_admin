<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengirimanCabang_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengirimanCabang/getAll');
		return $hasil;
	}

	public function GetByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengirimanCabang/get?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		return $hasil;
	}

	public function PostPengirimanCabang($data)
	{
        $result = $this->curl->simple_post($this->api_url.'api/v1/pengirimanCabang/post', $data);
        return $result;
	}

	public function PutPengirimanCabang($data)
	{
        $user = $this->session->userdata("Id");
        $result = $this->curl->simple_put($this->api_url.'api/v1/pengirimanCabang/putAdmin', array('IdPengirimanCabang' => $data["IdPengirimanCabang"], 'NoResi' => $data["NoResi"], 'IdCabang' => $data["IdCabang"], 'IdKurir' => $data["IdKurir"], 'AlamatTransit' => $data["AlamatTransit"], 'Pengirim' => $data["Pengirim"], 'NoTelpPengirim' => $data["NoTelpPengirim"], 'Penerima' => $data["Penerima"], 'NoTelpPenerima' => $data["NoTelpPenerima"], 'AlamatPenerima' => $data["AlamatPenerima"], 'ModifiedBy' => $user));
        return $result;
	}

	public function DeletePengirimanCabang($data)
	{
        $result = $this->curl->simple_delete($this->api_url.'api/v1/pengirimanCabang/delete', array('IdPengirimanCabang' => $data["IdPengirimanCabang"]));
        return $result;
	}

}

/* End of file PengirimanCabang.php */
/* Location: ./application/models/PengirimanCabang.php */