<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAllPengeluaran(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengeluaran/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetPengeluaranByPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengeluaran/get?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByPengeluaranCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengeluaran/getCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').
			'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostPengeluaran($data){
		$user = $this->session->userdata("Id");
		$idperusahaan = $data["IdPerusahaan"];
		$idcabang = $data["IdCabang"];
		
		if ($idperusahaan === null || $idperusahaan === 'null'|| $idperusahaan === '' || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');
		if ($idcabang === null || $idcabang === 'null' || $idcabang === '' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');

		$result = $this->curl->simple_post($this->api_url.'api/v1/pengeluaran/post', 
					array( 
						'IdPerusahaan' => $idperusahaan, 
						'IdCabang' => $idcabang, 
				 		'AlasanPengeluaran' => $data["AlasanPengeluaran"], 
						'JumlahPengeluaran' => $data["JumlahPengeluaran"], 
				 		'TanggalPengeluaran' => $data["TanggalPengeluaran"], 
						'CreatedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutPengeluaran($data){
		$user = $this->session->userdata("Id");
		$idperusahaan = $data["IdPerusahaan"];
		$idcabang = $data["IdCabang"];
		if ($idperusahaan === null || $idperusahaan === "null" || $idperusahaan === "" || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');
		if ($idcabang === null || $idcabang === 'null' || $idcabang === '' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');
		$result = $this->curl->simple_put($this->api_url.'api/v1/pengeluaran/put',
				 array(
					'IdPengeluaran' => $data["IdPengeluaran"], 
				 	'IdPerusahaan' => $idperusahaan, 
				 	'IdCabang' => $idcabang, 
				 	'AlasanPengeluaran' => $data["AlasanPengeluaran"], 
				 	'JumlahPengeluaran' => $data["JumlahPengeluaran"], 
				 	'TanggalPengeluaran' => $data["TanggalPengeluaran"], 
				 	'ModifiedBy' => $user
				 )
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeletePengeluaran($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/pengeluaran/delete', 
					array(
						'IdPengeluaran' => $data["IdPengeluaran"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}
}

/* End of file Laporan_m.php */
/* Location: ./application/models/Laporan_m.php */