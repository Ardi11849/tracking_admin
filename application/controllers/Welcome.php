<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
// var $api_url = 'http://localhost:5000/';
var $api_url = 'https://damp-shore-65068.herokuapp.com/';

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function Login()
	{
		$data = $this->curl->simple_get($this->api_url.'api/v1/Login?Username='.$this->input->post("Username").'&Password='.urlencode($this->input->post("Password")));
		$decode = json_decode($data, true);
		if (!$data) {
			echo "500";
		}else if ($decode["data"] == null) {
			echo "0";
		}else{
			if ($decode["data"][0]["StatusPerusahaan"] == 0) {
				echo "401";
			}else{
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

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
