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

            foreach ($allDataInSheet as $key => $value) {

                $data=array(
                    'reg_no'=>$value['A'],
                    'owner_name'=>$value['B'],
                    'address'=>$value['C'],
                    'regn_date'=>$value['D'],
                    'maker'=>$value['E'],
                    'maker_model'=>$value['F'],
                    'mobile'=>$value['G']
                );

                $res=$this->db->insert('importexcel',$data);

                }

        }

        $sheetdata['importdata']=$this->db->get('importexcel')->result_array();


        $this->load->view('admin/products/index',$sheetdata);
        
    }
    public function edit(){

                $data=array(
                    'import_date'=>$value['H'],
                    'last_date'=>$value['I'],
                    'next_date'=>$value['J'],
                    'modify_date'=>$value['K'],
                    'note'=>$value['L'],
                    'vehicle_type'=>$value['M']
                );

        
               $sheetdata['editsheetdata'] = $this->Import_model->editExcel($id,$data);

                $this->load->view('admin/products/index',$sheetdata);
        
                // $this->show_student_id();


    }

}
?>