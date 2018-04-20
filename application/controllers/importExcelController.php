<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ImportExcelController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Import_model','import');
    }
    // upload xlsx|xls file
    public function index() {
        $data['page'] = 'import';
        $this->load->view('admin/products/index');
    }

        // import excel data
     public function save() {

        $this->load->library('excel');
        $this->load->library('upload');
        
        if ($this->input->post('importfile')) {

            $path = 'upload/';

            $config['upload_path'] = $path;

            $config['allowed_types'] = 'xlsx|xls';

            $config['remove_spaces'] = TRUE;

            $this->upload->initialize($config);

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('reg_no', 'owner_name', 'address', 'regn_date', 'maker','maker_model','mobile','import_date','last_date','next_date','modify_date','note','vehicle_type');
            $makeArray = array('reg_no' => 'reg_no', 'owner_name' => 'owner_name', 'address' => 'address', 'regn_date' => 'regn_date', 'maker' => 'maker','maker_model' => 'maker_model','mobile' => 'mobile','import_date' => 'import_date','last_date' => 'last_date','next_date' => 'next_date','modify_date' => 'modify_date','note' => 'note','vehicle_type' => 'vehicle_type',);

            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
         
            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $reg_no = $SheetDataKey['reg_no'];
                    $owner_name = $SheetDataKey['owner_name'];
                    $address = $SheetDataKey['address'];
                    $regn_date = $SheetDataKey['regn_date'];
                    $maker = $SheetDataKey['maker'];
                    $maker_model = $SheetDataKey['maker_model'];
                    $mobile = $SheetDataKey['mobile'];
                    $import_date = $SheetDataKey['import_date'];
                    $last_date = $SheetDataKey['last_date'];
                    $next_date = $SheetDataKey['next_date'];
                    $modify_date = $SheetDataKey['modify_date'];
                    $note = $SheetDataKey['note'];
                    $vehicle_type = $SheetDataKey['vehicle_type'];

                    $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                    $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                    $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                    $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                    $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                    $fetchData[] = array('reg_no' => $reg_no, 'owner_name' => $owner_name, 'address' => $address, 'regn_date' => $regn_date, 'maker' => $maker,'maker_model' => $maker_model,'mobile' => $mobile,'import_date' => $import_date,'last_date' => $last_date,'next_date' => $next_date,'modify_date' => $modify_date,'note' => $note,'vehicle_type' => $vehicle_type);
                }              
                $data['employeeInfo'] = $fetchData;
                $this->import->setBatchImport($fetchData);
                $this->import->importData();

            } else {
                echo "Please import correct file";
            }
        }

        $this->load->view('admin/products/index',$data);
        
    }

}
?>