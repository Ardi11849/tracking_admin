<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetUsersAdminAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersAllAdmin');
		return $hasil;
	}

	public function GetUsersAdminByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersAdminGetByIdPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		return $hasil;
	}

	public function GetUsersKurirAll()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersAllKurir');
		return $hasil;
	}

	public function GetUsersKurirByIdPerusahaan()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersKurirByPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		return $hasil;
	}

	public function GetUsersKurirByIdCabang()
	{
		$hasil = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersKurirByCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
		return $hasil;
	}

	public function PostUsers($data)
	{
        $user = $this->session->userdata("Id");
        $role = $data["Role"];
        $idperusahaan = $data["IdPerusahaan"];
        $idcabang = $data["IdCabang"];
        if ($role === null || $role === 'null') $role = '4';
        if ($idperusahaan === null || $idperusahaan === 'null' || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');
        if ($idcabang === null || $idcabang === 'null' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');
		$hasil = $this->curl->simple_post($this->api_url.'api/v1/user/createUser', array('Username' => $data["Username"], 'Password' => $data["Password"], 'Role' => $role, 'IdPerusahaan' => $idperusahaan, 'IdCabang' => $idcabang, 'IdKurir' => $data["IdKurir"], 'CreatedBy' => $user));
		return $hasil;
	}

	public function PutUsers($data)
	{
        $user = $this->session->userdata("Id");
        $role = $data["Role"];
        $idperusahaan = $data["IdPerusahaan"];
        // var_dump($data[]);
        if ($role === null) $role = '4';
        if ($idperusahaan === null || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');
		$hasil = $this->curl->simple_put($this->api_url.'api/v1/user/putUser', array('IdUser' => $data["IdUser"], 'Username' => $data["Username"], 'Password' => $data["Password"], 'Role' => $role, 'IdPerusahaan' => $idperusahaan, 'IdCabang' => $data["IdCabang"], 'ModifiedBy' => $user));
		return $hasil;
	}

	public function DeleteUsers($data)
	{
		$hasil = $this->curl->simple_delete($this->api_url.'api/v1/user/delete', array('IdUsers' => $data["IdUsers"]));
		return $hasil;
	}
	

}

/* End of file User_m.php */
/* Location: ./application/models/User_m.php */