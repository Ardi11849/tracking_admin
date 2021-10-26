<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetProvinsi()
	{
		$result = $this->curl->simple_get($this->api_url."api/v1/provinsi/getProvinsi");
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetKabupaten($data)
	{
		$result = $this->curl->simple_get($this->api_url."api/v1/kabupaten/getKabupaten?IdProvinsi=".$data);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetKecamatan($data)
	{
		$result = $this->curl->simple_get($this->api_url."api/v1/kecamatan/getKecamatan?IdKabupaten=".$data);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetDesa($data)
	{
		$result = $this->curl->simple_get($this->api_url."api/v1/desa/getDesa?IdKecamatan=".$data);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}
	

}

/* End of file Wilayah_m.php */
/* Location: ./application/models/Wilayah_m.php */