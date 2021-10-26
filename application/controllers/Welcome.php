<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	public function index(){
		$this->load->view('welcome_message');
	}

	public function Login(){
		$data = $this->curl->simple_get($this->api_url.'api/v1/Login?Username='.$this->input->post("Username").'&Password='.urlencode($this->input->post("Password")));
		$decode = json_decode($data, true);
		// var_dump($this->api_url.'api/v1/Login?Username='.$this->input->post("Username").'&Password='.urlencode($this->input->post("Password")));
		if (!$data) {
			echo "500";
		}else if ($decode["data"] == null) {
			echo "0";
		}else{
			if ($decode["data"][0]["StatusPerusahaan"] == 0) {
			echo "401";
			}else{
				// var_dump($data);die();
				$this->session->set_userdata('Id', $decode["data"][0]["IdUsers"]);
				$this->session->set_userdata('Username', $decode["data"][0]["Username"]);
				$this->session->set_userdata('Role', $decode["data"][0]["Role"]);
				$this->session->set_userdata('IdPerusahaan', $decode["data"][0]["IdPerusahaan"]);
				if (isset($decode["data"][0]["IdCabang"])) {
					$this->session->set_userdata('IdCabang', $decode["data"][0]["IdCabang"]);
				}
				echo $data;
				}
		}
	}

	public function Logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function GetProvinsi()
	{
		$this->db->select('id_prov as IdProvinsi, nama as NamaProvinsi');
		$isi = $this->db->get('provinsi')->result_array();
		$json = json_encode($isi, true);
		var_dump($json);
	}

	public function GetKabupaten()
	{
		$this->db->select('id_kab as IdKabupaten, id_prov as IdProvinsi, nama as NamaKabupaten');
		$isi = $this->db->get('Kabupaten')->result_array();
		$json = json_encode($isi, true);
		var_dump($json);
	}

	public function GetKecamatan()
	{
		$this->db->select('id_kec as IdKecamatan, id_kab as IdKabupaten, nama as NamaKecamatan');
		$isi = $this->db->get('kecamatan')->result_array();
		$json = json_encode($isi, true);
		var_dump($json);
	}

	public function GetDesa()
	{
		$this->db->select('id_kel as IdDesa, id_kec as IdKecamatan, nama as NamaDesa');
		$isi = $this->db->get('kelurahan')->result_array();
		$json = json_encode($isi, true);
		foreach ($isi as $key => $value) {
			echo '{"IdDesa": "'.$value["IdDesa"].'", "IdKecamatan": "'.$value["IdKecamatan"].'", "NamaDesa": "'.$value["NamaDesa"].'"},<br/>';
		}
	}
}