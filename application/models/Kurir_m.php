<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kurir_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';
	
	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/Kurir/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/Kurir/get?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/Kurir/getCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostKurir($data){
		$user = $this->session->userdata("Id");
		$perusahaan = $this->session->userdata("IdPerusahaan");
		$cabang = $this->session->userdata("IdCabang");
		$result = $this->curl->simple_post($this->api_url.'api/v1/kurir/post', 
					array(
						'Nama' => $data["Nama"], 
						'IdPerusahaan' => $perusahaan, 
						'IdCabang' => $cabang, 
						'NoTelp' => $data["NoTelp"], 
						'CreatedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutKurir($data){
		$user = $this->session->userdata("Id");
		$result = $this->curl->simple_put($this->api_url.'api/v1/kurir/put', 
					array(
						'IdKurir' => $data["IdKurir"], 
						'Nama' => $data["Nama"], 
						'NoTelp' => $data["NoTelp"], 
						'IdPerusahaan' => $this->session->userdata('IdPerusahaan'), 
						'ModifiedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeleteKurir($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/kurir/delete', 
					array(
						'IdKurir' => $data["IdKurir"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

