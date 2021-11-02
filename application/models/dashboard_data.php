<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         

    public function doLoadDBData($datefrom, $dateto, $useid){
    	$CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "exec SP_AlertDashBoardNew '$datefrom' ,'$dateto','$useid'";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $e = $this->db->_error_message();
            if(!empty($e)){ echo $e; exit(); }

        $data = array();
        if ($query) {
        	$data['business'] = $query->result_array();            
        	$data['redzone'] = $query->next_result();            
        	$data['whitezone'] = $query->next_result();            
        	$data['blackzone'] = $query->next_result();            
        	$data['greenzone'] = $query->next_result();            
            $data['summery'] = $query->next_result();            
            $data['groupdetails'] = $query->next_result();
            $query->free_result();
            //$data['materialdetails'] = $query->next_result();
            //var_dump($data); exit();
            return $data;
        }else{
            return false;
        }
    }

    public function doLoadDBDataMaterialDetails($datefrom, $dateto, $materialcode, $useid, $alertgroup = ''){
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "exec SP_AlertDashBoardMaterialDetails '$datefrom' ,'$dateto','$materialcode','$useid', '$alertgroup'";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $e = $this->db->_error_message();
            if(!empty($e)){ echo $e; exit(); }

        $data = array();
        if ($query) {
            $data['materialdetails'] = $query->result_array();            
            
            $query->free_result();
            //$data['materialdetails'] = $query->next_result();
            //var_dump($data); exit();
            return $data;
        }else{
            return false;
        }
    }
    
    public function doLoadLastUpdateNotification($datefrom, $dateto, $useid){
    	$CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $date = date("Y-m-d");
        $sql = "exec SP_LastUpdateNotification '$date','$useid'";              //    exit();
        
        $result['success'] = false;
        $query = $this->db->query($sql);
        $e = $this->db->_error_message();
            if(!empty($e)){ echo $e; exit(); }

        $data = array();
        if ($query) {
            return $query->result_array(); 
        }else{
            return false;
        }
    }
    
    public function doLoadOrderQtyDashBoard($businesscode, $locationcode, $materialtypecode, $materialcode, $userid){
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "exec SP_OrderQtyDashBoardNew '$businesscode', '$locationcode', '$materialtypecode', '$materialcode', '$userid'"; 
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['business'] = $query->result_array();            
            $data['summery'] = $query->next_result();            
            $data['groupdetails'] = $query->next_result();
            return $data;
        }else{
            return false;
        }
    }
    
}

?>