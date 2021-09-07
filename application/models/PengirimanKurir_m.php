<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PengirimanKurir_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/penerima/getAll');
		return $hasil;
	}

	public function GetByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/penerima/get?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		return $hasil;
	}

	public function GetByIdCabang()
	{
        $result = $this->curl->simple_get($this->api_url.'api/v1/penerima/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
        return $result;
	}

	public function PostPengirimanKurir($data)
	{
		$result = $this->curl->simple_post($this->api_url.'api/v1/penerima/post', $data);
        if (!$result) {
            echo 0;
        } else {
            echo $result;
        }
	}

	public function PutPengirimanKurir($data)
	{
        $user = $this->session->userdata("Id");
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/penerima/putAdmin', array('NoResi' => $data["NoResi"], 'IdKurir' => $data["IdKurir"], 'Alamat' => $data["Alamat"], 'Penerima' => $data["Penerima"], 'NoHpPenerima' => $data["NoHpPenerima"], 'ModifiedBy' => $user, 'IdPengirimanKurir' => $data["IdPengirimanKurir"]));
		return $hasil;
	}

	public function DeletePengirimanKurir($data)
	{
		$hasil = $this->curl->simple_delete($this->api_url.'api/v1/penerima/delete', array('IdPengirimanKurir' => $data["IdPengirimanKurir"]));
		return $hasil;
	}
}

/* End of file PengirimanKurir_m.php */
/* Location: ./application/models/PengirimanKurir_m.php */