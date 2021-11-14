<?php
defined('BASEPATH') OR exit('No direct script access allowed');class Manifest_m extends CI_Model {var $api_url = 'https://damp-shore-65068.herokuapp.com/';public function GetPengiriman(){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getPengiriman?CreatedBy='.$this->session->userdata("Id"));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function GetPenerimaan(){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getPenerimaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function GetCabangPenerimaan(){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getCabangPenerimaan?IdPerusahaan='.$this->session->userdata("IdPerusahaan").'&IdCabang='.$this->session->userdata("IdCabang"));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function GetRiwayatAll(){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getRiwayatAll');if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function GetRiwayat(){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getRiwayat?IdPerusahaan='.$this->session->userdata("IdPerusahaan"));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function GetRiwayatCabang(){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getRiwayatCabang?IdCabang='.$this->session->userdata("IdCabang").'&CreatedBy='.$this->session->userdata("Id"));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function GetByNoManfiest($data){$result = $this->curl->simple_get($this->api_url.'api/v1/manifest/getByNoManifest?NoManifest='.$data["NoManifest"]);if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function Post($data){$result = $this->curl->simple_post($this->api_url.'api/v1/manifest/post', $data);if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function KonfirmasiByNoResi($data){$result = $this->curl->simple_put($this->api_url.'api/v1/manifest/konfirmasiByNoResi', $data);if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function Konfirmasi($data){$result = $this->curl->simple_put($this->api_url.'api/v1/manifest/konfirmasi', array('Status' => '1', 'NoManifest' => $data['NoManifest'], 'ModifiedBy' => $this->session->userdata("Id")));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}public function Cancel($data){$result = $this->curl->simple_delete($this->api_url.'api/v1/manifest/cancel', array('NoManifest' => $data['NoManifest']));if (!$result) return json_encode(array('message' => $this->curl->error_string), true);return $result;}}/* End of file Manifest_m.php */
/* Location: ./application/models/Manifest_m.php */