<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/cabang/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/cabang/getByIdPerusahaan?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaanInput($data){
		$result = $this->curl->simple_get($this->api_url.'api/v1/cabang/getByIdPerusahaan?IdPerusahaan='.$data['IdPerusahaan']);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/cabang/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").
			'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostCabang($data){
		$user = $this->session->userdata("Id");
		$IdPerusahaan = $data['IdPerusahaan'];

		if(!$data['IdPerusahaan'] || $data['IdPerusahaan'] == 0 || $data['IdPerusahaan'] == "undefined") $IdPerusahaan = $this->session->userdata('IdPerusahaan');

		$result = $this->curl->simple_post($this->api_url.'api/v1/cabang/post',
					array(
						'IdPerusahaan' => $IdPerusahaan, 
						'Nama' => $data["Nama"], 
						'KodeKotaBesar' => $data["KodeKotaBesar"], 
						'KodeKota' => $data["KodeKota"], 
						'Alamat' => $data["Alamat"], 
						'CreatedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutCabang($data){
		$user = $this->session->userdata("Id");

		$IdPerusahaan = $data['IdPerusahaan'];
		if(!$data['IdPerusahaan'] || $data['IdPerusahaan'] == 0 || $data['IdPerusahaan'] == "undefined") $IdPerusahaan = $this->session->userdata('IdPerusahaan');

		$result = $this->curl->simple_put($this->api_url.'api/v1/cabang/put', 
					array(
						'IdCabang' => $data["IdCabang"], 
						'IdPerusahaan' => $IdPerusahaan, 
						'KodeKotaBesar' => $data["KodeKotaBesar"], 
						'KodeKota' => $data["KodeKota"], 
						'Nama' => $data["Nama"], 
						'Alamat' => $data["Alamat"], 
						'ModifiedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeleteCabang($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/cabang/delete', 
					array(
						'IdCabang' => $data["IdCabang"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}
}