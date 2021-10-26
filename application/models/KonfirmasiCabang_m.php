<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class KonfirmasiCabang_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/konfirmasiCabang/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/konfirmasiCabang/get?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/konfirmasiCabang/getCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function Konfirmasi($data){
		$result = $this->curl->simple_put($this->api_url.'api/v1/konfirmasiCabang/put', array('Status' => '1', 'IdKurir' => $data['IdKurir'], 'ModifiedBy' => $this->session->userdata("Id")));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function Cancel($data){
		$result = $this->curl->simple_put($this->api_url.'api/v1/konfirmasiCabang/delete', 
				array(
					'IdKurir' => $data['IdKurir']
				)
			);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}