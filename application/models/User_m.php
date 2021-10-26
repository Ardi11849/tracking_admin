<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetUsersAdminAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersAllAdmin');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetUsersAdminByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersAdminGetByIdPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetUsersKurirAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersAllKurir');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetUsersKurirByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersKurirByPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetUsersKurirByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsersKurirByCabang?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetUsernameAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsernameAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetUsernameByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/user/getUsernameByIdPerusahaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostUsers($data){
		$user = $this->session->userdata("Id");
		$role = $data["Role"];
		$idperusahaan = $data["IdPerusahaan"];
		$idcabang = $data["IdCabang"];

		if ($role === null || $role === 'null') $role = '4';

		if ($idperusahaan === null || $idperusahaan === 'null' || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');

		if ($idcabang === null || $idcabang === 'null' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');

		$result = $this->curl->simple_post($this->api_url.'api/v1/user/createUser', 
					array(
						'Username' => $data["Username"], 
						'Password' => $data["Password"], 
						'Role' => $role, 
						'IdPerusahaan' => $idperusahaan, 
						'IdCabang' => $idcabang, 
						'IdKurir' => $data["IdKurir"], 
						'CreatedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutUsers($data){
		$user = $this->session->userdata("Id");
		$role = $data["Role"];
		$idperusahaan = $data["IdPerusahaan"];

		if ($role === null || $role === 'null') $role = '4';

		if ($idperusahaan === null ||$idperusahaan === 'null' || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');

		$result = $this->curl->simple_put($this->api_url.'api/v1/user/putUser', 
					array(
						'IdUser' => $data["IdUser"], 
						'Username' => $data["Username"], 
						'Password' => $data["Password"], 
						'Role' => $role, 
						'IdPerusahaan' => $idperusahaan, 
						'IdCabang' => $data["IdCabang"], 
						'ModifiedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeleteUsers($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/user/delete', 
					array(
						'IdUsers' => $data["IdUsers"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

