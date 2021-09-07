<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class PengirimanKurir extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengirimanKurir_m');
        $this->load->model('Kurir_m');
        $this->load->model('Pengiriman_m');
    }

	public function index()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        if ($this->session->userdata('Role') == 1) {
            $kurir = $this->Kurir_m->GetAll();
            $pengiriman = $this->Pengiriman_m->GetAll();
        } else if ($this->session->userdata('Role') == 2) {
            $kurir = $this->Kurir_m->GetByIdPerusahaan();
            $pengiriman = $this->Pengiriman_m->GetByIdPerusahaan();
        }else{
            $kurir = $this->Kurir_m->GetByIdCabang();
            $pengiriman = $this->Pengiriman_m->GetByIdCabang();
        }
        $decode['kurir'] = json_decode($kurir, true);
        $decode['pengiriman'] = json_decode($pengiriman, true);
		$this->load->view('pengirimanKurir/start', $decode);
	}

    public function tambah()
    {
        if (!$this->session->userdata("Username")) redirect(base_url());
        if ($this->session->userdata('Role') == 1) {
            $pengiriman = $this->Pengiriman_m->GetAll();
            $data = $this->Kurir_m->GetAll();
        } else if ($this->session->userdata('Role') == 2) {
            $pengiriman = $this->Pengiriman_m->GetByIdPerusahaan();
            $data = $this->Kurir_m->GetByIdPerusahaan();
        }else{
            $pengiriman = $this->Pengiriman_m->GetByIdCabang();
            $data = $this->Kurir_m->GetByIdCabang();
        }
        $decode['kurir'] = json_decode($data, true);
        $decode['pengiriman'] = json_decode($pengiriman, true);
        // var_dump($decode['kurir']);
        // die();
        $this->load->view('pengirimanKurir/tambah', $decode);
    }

	public function get_penerima_all()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->PengirimanKurir_m->GetAll();
		echo $data;
	}

	public function get_penerima()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
		$data = $this->PengirimanKurir_m->GetByIdPerusahaan();
		echo $data;
	}

    public function get_penerima_cabang()
    {
        if (!$this->session->userdata("Username")) redirect(base_url());
        $data = $this->PengirimanKurir_m->GetByIdCabang();
        echo $data;
    }

    public function add()
    {
        if (!$this->session->userdata("Username")) redirect(base_url());
        $isi = $this->input->post("data");
        $result = $this->PengirimanKurir_m->PostPengirimanKurir($isi);
        echo $result;        
    }

	public function post_penerima($data)
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        // var_dump($data);
        foreach ($data as $data) {
            var_dump($data["nofaktur"]);
            var_dump($data["nmpenerima"]);
            var_dump($data["alpenerima"]);
            var_dump($data["hppenerima"]);
            var_dump($data["idkurir"]);
            $result = $this->curl->simple_post($this->api_url.'api/v1/penerima/post', array('NoResi' => $data["nofaktur"], 'IdKurir' => $data["idkurir"], 'Penerima' => $data["nmpenerima"], 'Alamat' => $data["alpenerima"], 'NoHpPenerima' => $data["hppenerima"]));
        // echo $data;
            // echo "<br>";
        }
        echo $result;
	}

	public function put_penerima()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        $data = $this->PengirimanKurir_m->PutPengirimanKurir($this->input->post());
        // print_r($data);
		echo $data;
	}

	public function delete_penerima()
	{
        if (!$this->session->userdata("Username")) redirect(base_url());
        $data = $this->PengirimanKurir_m->DeletePengirimanKurir($this->input->post());
		echo $data;
	}

    public function upload() {
        if (!$this->session->userdata("Username")) redirect(base_url());
        $data = array();
        $data['title'] = 'Import Excel Sheet | TechArise';
        $data['breadcrumbs'] = array('Home' => '#');
         // Load form validation library
         $this->load->library('form_validation');
         $this->form_validation->set_rules('file', 'Upload File', 'callback_checkFileValidation');
         // if($this->form_validation->run() == false) {
            
            // $this->load->view('spreadsheet/index', $data);
         // } else {
            // If file uploaded
         var_dump($_FILES['file']);
            if(!empty($_FILES['file']['name'])) { 
                // get file extension
                $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            
                // array Count
                $arrayCount = count($allDataInSheet);
                $flag = 0;
                $createArray = array('nofaktur', 'nmpenerima', 'alpenerima', 'hppenerima', 'idkurir');
                $makeArray = array('nofaktur' => 'nofaktur', 'nmpenerima' => 'nmpenerima', 'alpenerima' => 'alpenerima', 'hppenerima' => 'hppenerima', 'idkurir' => 'idkurir');
                $SheetDataKey = array();
                foreach ($allDataInSheet as $dataInSheet) {
                    foreach ($dataInSheet as $key => $value) {
                        if (in_array(trim($value), $createArray)) {
                            $value = preg_replace('/\s+/', '', $value);
                            $SheetDataKey[trim($value)] = $key;
                        } 
                    }
                }
                $dataDiff = array_diff_key($makeArray, $SheetDataKey);
                if (empty($dataDiff)) {
                    $flag = 1;
                }
                // match excel sheet column
                if ($flag == 1) {
                    for ($i = 2; $i <= $arrayCount; $i++) {
                        $addresses = array();
                        $nofaktur = $SheetDataKey['nofaktur'];
                        $nmpenerima = $SheetDataKey['nmpenerima'];
                        $alpenerima = $SheetDataKey['alpenerima'];
                        $hppenerima = $SheetDataKey['hppenerima'];
                        $idkurir = $SheetDataKey['idkurir'];
 
                        $nofaktur = filter_var(trim($allDataInSheet[$i][$nofaktur]), FILTER_SANITIZE_STRING);
                        $nmpenerima = filter_var(trim($allDataInSheet[$i][$nmpenerima]), FILTER_SANITIZE_STRING);
                        $alpenerima = filter_var(trim($allDataInSheet[$i][$alpenerima]), FILTER_SANITIZE_STRING);
                        $hppenerima = filter_var(trim($allDataInSheet[$i][$hppenerima]), FILTER_SANITIZE_STRING);
                        $idkurir = filter_var(trim($allDataInSheet[$i][$idkurir]), FILTER_SANITIZE_STRING);
                        $fetchData[] = array('nofaktur' => $nofaktur, 'nmpenerima' => $nmpenerima, 'alpenerima' => $alpenerima, 'hppenerima' => $hppenerima, 'idkurir' => $idkurir);
                    }   
                    $data['dataInfo'] = $fetchData;
                    $hasil = $this->post_penerima($data['dataInfo']);
                    // $this->site->setBatchImport($fetchData);
                    // $this->site->importData();
                } else {
                    echo "Please import correct file, did not match excel sheet column";
                }
                // $this->load->view('spreadsheet/display', $data);
            }              
        // }
    }
}
?>
