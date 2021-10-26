<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tracking_m extends CI_Model {
	
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/getPosition');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/getPositionByPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/getPositionByCabang?IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

