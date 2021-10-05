<?php defined('BASEPATH') OR exit('No direct script access allowed');class Pengiriman_m extends CI_Model {var $api_url = 'https://damp-shore-65068.herokuapp.com/';public function GetAll(){$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getAll');return $hasil;}public function GetByIdPerusahaan(){$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/get?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));return $hasil;}public function GetByIdCabang(){$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').'&IdCabang='.$this->session->userdata("IdCabang"));return $hasil;}public function GetFPAll(){$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getFPAll');return $hasil;}public function GetFPByIdPerusahaan(){$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getFP?IdPerusahaan='.$this->session->userdata('IdPerusahaan'));return $hasil;}public function GetFPByIdCabang(){$hasil = $this->curl->simple_get($this->api_url.'api/v1/pengiriman/getFPCabang?IdPerusahaan='.$this->session->userdata('IdPerusahaan').'&IdCabang='.$this->session->userdata("IdCabang"));return $hasil;}public function PostPengiriman($data){$user = $this->session->userdata("Id");$idperusahaan = $data["IdPerusahaan"];$idcabang = $data["IdCabang"];if ($idperusahaan === null || $idperusahaan === 'null'|| $idperusahaan === '' || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');if ($idcabang === null || $idcabang === 'null' || $idcabang === '' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');$hasil = $this->curl->simple_post($this->api_url.'api/v1/pengiriman/post', array('NoResi' => $data["NoResi"], 'IdPerusahaan' => $idperusahaan, 'IdCabang' => $idcabang, 'Pengirim' => $data["Pengirim"], 'NoTelpPengirim' => $data["NoTelpPengirim"], 'Penerima' => $data["Penerima"], 'NoTelpPenerima' => $data["NoTelpPenerima"], 'IdProvinsi' => $data["IdProvinsi"], 'IdKabupaten' => $data["IdKabupaten"], 'IdKecamatan' => $data["IdKecamatan"], 'IdDesa' => $data["IdDesa"], 'AlamatPenerima' => $data["AlamatPenerima"], 'Status' => $data["Status"], 'CreatedBy' => $user));return $hasil;}public function PutPengiriman($data){$user = $this->session->userdata("Id");$idperusahaan = $data["IdPerusahaan"];$idcabang = $data["IdCabang"];if ($idperusahaan === null || $idperusahaan === "null" || $idperusahaan === "" || $idperusahaan == 'undefined') $idperusahaan = $this->session->userdata('IdPerusahaan');if ($idcabang === null || $idcabang === 'null' || $idcabang === '' || $idcabang == 'undefined') $idcabang = $this->session->userdata('IdCabang');$hasil = $this->curl->simple_put($this->api_url.'api/v1/pengiriman/put', array('NoResi' => $data["NoResi"], 'IdPerusahaan' => $idperusahaan, 'IdCabang' => $idcabang, 'Pengirim' => $data["Pengirim"], 'NoTelpPengirim' => $data["NoTelpPengirim"], 'Penerima' => $data["Penerima"], 'NoTelpPenerima' => $data["NoTelpPenerima"], 'AlamatPenerima' => $data["AlamatPenerima"], 'Status' => $data["Status"], 'ModifiedBy' => $user));return $hasil;}public function DeletePengiriman($data){$hasil = $this->curl->simple_delete($this->api_url.'api/v1/pengiriman/delete', array('NoResi' => $data["NoResi"]));return $hasil;}}