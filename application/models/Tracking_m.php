<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/getPosition');
		return $hasil;
	}

	public function GetByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/getPositionByPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		return $hasil;
	}

	public function GetByIdCabang()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/getPositionByCabang?IdCabang='.$this->session->userdata("IdCabang"));
		return $hasil;
	}

}

/* End of file Tracking_m.php */
/* Location: ./application/models/Tracking_m.php */