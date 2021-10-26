<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Pengiriman_m extends CI_Model {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function GetAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/get?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').
			'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByCreatedBy(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getByCreatedBy?CreatedBy='.$this->session->userdata('Id'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetAllByWilayah($data){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getAllByWilayah?KodeKotaBesar='.$data["KodeKotaBesar"].
			"&KodeKota=".$data["KodeKota"].
			"&CreatedOn=".$data["CreatedOn"]);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdPerusahaanByWilayah($data){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getByWilayah?IdPerusahaan='.$this->session->userdata('IdPerusahaan').
			'&KodeKotaBesar='.$data["KodeKotaBesar"].
			"&KodeKota=".$data["KodeKota"].
			"&CreatedOn=".$data["CreatedOn"]);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetByIdCabangByWilayah($data){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getCabangByWilayah?IdPerusahaan='.$this->session->userdata('IdPerusahaan').
			'&IdCabang='.$this->session->userdata("IdCabang").
			'&KodeKotaBesar='.$data["KodeKotaBesar"].
			"&KodeKota=".$data["KodeKota"].
			"&CreatedOn=".$data["CreatedOn"]);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetFPAll(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getFPAll');
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetFPByIdPerusahaan(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getFP?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function GetFPByIdCabang(){
		$result = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getFPCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').
			'&IdCabang='.$this->session->userdata("IdCabang"));
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PostPengiriman($data){
		$user = $this->session->userdata("Id");
		$idperusahaan = $data["IdPerusahaan"];
		$idcabang = $data["IdCabang"];
		
		if ($idperusahaan === null || $idperusahaan === 'null'|| $idperusahaan === '' || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');
		if ($idcabang === null || $idcabang === 'null' || $idcabang === '' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');

		$result = $this->curl->simple_post($this->api_url.'api/v1/pengiriman/post', 
					array( 
						'NoResi' => $data["NoResi"], 
						'IdPerusahaan' => $idperusahaan, 
						'IdCabang' => $idcabang, 
						'Pengirim' => $data["Pengirim"], 
				 		'AlamatPengirim' => $data["AlamatPengirim"], 
						'NoTelpPengirim' => $data["NoTelpPengirim"], 
						'Penerima' => $data["Penerima"], 
						'NoTelpPenerima' => $data["NoTelpPenerima"], 
						'IdProvinsi' => $data["IdProvinsi"], 
						'IdKabupaten' => $data["IdKabupaten"], 
						'IdKecamatan' => $data["IdKecamatan"], 
						'IdDesa' => $data["IdDesa"], 
						'KodeKotaBesar' => $data["KodeKotaBesar"], 
						'KodeKota' => $data["KodeKota"], 
						'AlamatPenerima' => $data["AlamatPenerima"], 
						'Status' => $data["Status"], 
						'CreatedBy' => $user
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function PutPengiriman($data){
		$user = $this->session->userdata("Id");
		$idperusahaan = $data["IdPerusahaan"];
		$idcabang = $data["IdCabang"];
		if ($idperusahaan === null || $idperusahaan === "null" || $idperusahaan === "" || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');
		if ($idcabang === null || $idcabang === 'null' || $idcabang === '' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');
		$result = $this->curl->simple_put($this->api_url.'api/v1/pengiriman/put',
				 array(
					'NoResi2' => $data["NoResi2"], 
				 	'NoResi' => $data["NoResi"], 
				 	'IdPerusahaan' => $idperusahaan, 
				 	'IdCabang' => $idcabang, 
				 	'Pengirim' => $data["Pengirim"], 
				 	'AlamatPengirim' => $data["AlamatPengirim"], 
				 	'NoTelpPengirim' => $data["NoTelpPengirim"], 
				 	'Penerima' => $data["Penerima"], 
				 	'NoTelpPenerima' => $data["NoTelpPenerima"], 
					'IdProvinsi' => $data["IdProvinsi"], 
					'IdKabupaten' => $data["IdKabupaten"], 
					'IdKecamatan' => $data["IdKecamatan"], 
					'IdDesa' => $data["IdDesa"], 
					'KodeKotaBesar' => $data["KodeKotaBesar"], 
					'KodeKota' => $data["KodeKota"], 
				 	'AlamatPenerima' => $data["AlamatPenerima"], 
				 	'Status' => $data["Status"], 
				 	'ModifiedBy' => $user
				 )
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

	public function DeletePengiriman($data){
		$result = $this->curl->simple_delete($this->api_url.'api/v1/pengiriman/delete', 
					array(
						'NoResi' => $data["NoResi"]
					)
				);
		if (!$result) return json_encode(array('message' => $this->curl->error_string), true);
		return $result;
	}

}

