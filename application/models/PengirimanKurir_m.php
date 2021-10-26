<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PengirimanKurir_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';
	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/penerima/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/penerima/get?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/penerima/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostPengirimanKurir($data){
		$result = $this->curl->simple_post($this->api_url.'api/v1/penerima/post', $data);
		if (!$result) {
			echo 0;
		}else {
			echo $result;
		}
	}

	public function PutPengirimanKurir($data){
		$user = $this->session->userdata("Id");
		$result = $this->curl->simple_put($this->api_url.'api/v1/penerima/putAdmin', 
					array(
						'NoResi' => $data["NoResi"], 
						'IdKurir' => $data["IdKurir"], 
						'ModifiedBy' => $user, 
						'IdPengirimanKurir' => $data["IdPengirimanKurir"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeletePengirimanKurir($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/penerima/delete', array('IdPengirimanKurir' => $data["IdPengirimanKurir"]));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

