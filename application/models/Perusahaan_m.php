<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Perusahaan_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';
	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/perusahaan/getPerusahaan');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function Active($data){
		$result = $this->curl->simple_put($this->api_url.'api/v1/perusahaan/active', 
					array(
						'IdPerusahaan' => $data['IdPerusahaan'], 
						'ModifiedBy' => $this->session->userdata("Id")
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function InActive($data){
		$result = $this->curl->simple_put($this->api_url.'api/v1/perusahaan/inActive', 
					array(
						'IdPerusahaan' => $data["IdPerusahaan"], 
						'ModifiedBy' => $this->session->userdata("Id")
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostPerusahaan($data){
		$user = $this->session->userdata("Id");
		$perusahaan = $this->session->userdata("IdPerusahaan");
		$result = $this->curl->simple_post($this->api_url.'api/v1/perusahaan/createPerusahaan', 
					array(
						'NamaPerusahaan' => $data["Nama"], 
						'Status' => '1', 
						'CreatedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutPerusahaan($data){
		$user = $this->session->userdata("Id");
		$result = $this->curl->simple_put($this->api_url.'api/v1/perusahaan/putPerusahaan', 
					array(
						'NamaPerusahaan' => $data["Nama"], 
						'IdPerusahaan' => $data["IdPerusahaan"], 
						'ModifiedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeletePerusahaan($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/perusahaan/delete', 
					array(
						'IdPerusahaan' => $data["IdPerusahaan"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

