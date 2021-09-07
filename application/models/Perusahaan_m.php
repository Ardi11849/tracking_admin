<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll()
	{
        $hasil = $this->curl->simple_get($this->api_url.'api/v1/perusahaan/getPerusahaan');
        return $hasil;
	}

	public function Active($data)
	{
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/perusahaan/active', array('IdPerusahaan' => $data['IdPerusahaan'], 'ModifiedBy' => $this->session->userdata("Id")));
		return $hasil;
	}

	public function InActive($data)
	{
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/perusahaan/inActive', array('IdPerusahaan' => $data["IdPerusahaan"], 'ModifiedBy' => $this->session->userdata("Id")));
		return $hasil;
	}

	public function PostPerusahaan($data)
	{
        $user = $this->session->userdata("Id");
        $perusahaan = $this->session->userdata("IdPerusahaan");
		$hasil = $this->curl->simple_post($this->api_url.'api/v1/perusahaan/createPerusahaan', array('NamaPerusahaan' => $data["Nama"], 'Status' => '1', 'CreatedBy' => $user));
		return $hasil;
	}

	public function PutPerusahaan($data)
	{
        $user = $this->session->userdata("Id");
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/perusahaan/putPerusahaan', array('NamaPerusahaan' => $data["Nama"], 'IdPerusahaan' => $data["IdPerusahaan"], 'ModifiedBy' => $user));
		return $hasil;
	}

	public function DeletePerusahaan($data)
	{
		$hasil = $this->curl->simple_delete($this->api_url.'api/v1/perusahaan/delete', array('IdPerusahaan' => $data["IdPerusahaan"]));
		return $hasil;
	}

}

/* End of file Perusahaan_m.php */
/* Location: ./application/models/Perusahaan_m.php */