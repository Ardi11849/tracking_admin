<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PengirimanCabang_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengirimanCabang/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengirimanCabang/get?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengirimanCabang/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&CreatedBy='.$this->session->userdata('Id'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostPengirimanCabang($data){
		$result = $this->curl->simple_post($this->api_url.'api/v1/pengirimanCabang/post', $data);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutPengirimanCabang($data){
		$user = $this->session->userdata("Id");
		$result = $this->curl->simple_put($this->api_url.'api/v1/pengirimanCabang/putAdmin', 
					array(
						'IdPengirimanCabang' => $data["IdPengirimanCabang"], 
						'NoResi' => $data["NoResi"], 
						'IdCabang' => $data["IdCabang"], 
						'IdKurir' => $data["IdKurir"], 
						'AlamatTransit' => $data["AlamatTransit"], 
						'Pengirim' => $data["Pengirim"], 
						'NoTelpPengirim' => $data["NoTelpPengirim"], 
						'Penerima' => $data["Penerima"], 
						'NoTelpPenerima' => $data["NoTelpPenerima"], 
						'AlamatPenerima' => $data["AlamatPenerima"], 
						'ModifiedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeletePengirimanCabang($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/pengirimanCabang/delete', 
					array(
						'IdPengirimanCabang' => $data["IdPengirimanCabang"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

