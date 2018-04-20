<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Import_model extends CI_Model {

    private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('importexcel', $data);
    }
    // get employee list
    public function employeeList() {
        $this->db->select(array('e.id', 'e.reg_no', 'e.owner_name', 'e.address', 'e.regn_date', 'e.maker','e.maker_model','e.mobile','e.import_date','e.last_date','e.next_date','e.modify_date','e.note','e.vehicle_type',));
        $this->db->from('importexcel as e');
        $query = $this->db->get();
        return $query->result_array();
    }

}

?>