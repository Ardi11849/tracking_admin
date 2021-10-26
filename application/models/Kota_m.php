<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota_m extends CI_Model {

	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetKotaBesar()
	{
		$result = $this->curl->simple_get($this->api_url.'api/v1/kota/getKotaBesar');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetKota()
	{
		$result = $this->curl->simple_get($this->api_url.'api/v1/kota/getKota');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetKotaByKodeKotaBesar($data)
	{
		$result = $this->curl->simple_get($this->api_url.'api/v1/kota/getKotaByKKB?KodeKotaBesar='.$data['KodeKotaBesar']);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostKotaBesar($data)
	{
		$result = $this->curl->simple_post($this->api_url.'api/v1/kota/postKotaBesar', 
			array(
				  "KodeKotaBesar" => $data["KodeKotaBesar"],
				  "NamaKotaBesar" => $data["NamaKotaBesar"],
				  "CreatedBy" => $this->session->userdata("Id")
				)
		);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostKota($data)
	{
		$result = $this->curl->simple_post($this->api_url.'api/v1/kota/postKota', 
			array(
				  "KodeKota" => $data["KodeKota"],
				  "KodeKotaBesar" => $data["KodeKotaBesar3"],
				  "NamaKota" => $data["NamaKota"],
				  "CreatedBy" => $this->session->userdata("Id")
				)
		);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutKotaBesar($data)
	{
		$result = $this->curl->simple_put($this->api_url.'api/v1/kota/putKotaBesar', 
			array(
				  "KodeKotaBesar" => $data["KodeKotaBesar"],
				  "NamaKotaBesar" => $data["NamaKotaBesar"],
				  "ModifiedBy" => $this->session->userdata("Id"),
				  "KodeKotaBesar2" => $data["KodeKotaBesar2"]
				)
		);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutKota($data)
	{
		$result = $this->curl->simple_put($this->api_url.'api/v1/kota/putKota', 
			array(
				  "KodeKota" => $data["KodeKota"],
				  "KodeKotaBesar" => $data["KodeKotaBesar3"],
				  "NamaKota" => $data["NamaKota"],
				  "ModifiedBy" => $this->session->userdata("Id"),
				  "KodeKota2" => $data["KodeKota2"]
				)
		);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeleteKotaBesar($data)
	{
		$result = $this->curl->simple_delete($this->api_url.'api/v1/kota/deleteKotaBesar', 
			array(
				  "KodeKotaBesar" => $data["KodeKotaBesar"],
				)
		);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeleteKota($data)
	{
		$result = $this->curl->simple_delete($this->api_url.'api/v1/kota/deleteKota', 
			array(
				  "KodeKota" => $data["KodeKota"],
				)
		);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

/* End of file Kota_m.php */
/* Location: ./application/models/Kota_m.php */