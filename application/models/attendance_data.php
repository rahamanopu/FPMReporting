<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    
    public function getUserMonthlyAttendanceDetails($period, $levelcode){                 
        $success = true;
        $sql = " EXEC usp_doLoadAttendanceReport '$period','$levelcode' ";         
        $query = $this->db->query($sql);  
        //echo "<pre />"; print_r($query->result_array()); exit();              
        $e = $this->db->_error_message();                
        if ($e == '') {
            $data['summary'] = $query->result_array();
            $data['detailsdata'] = $query->next_result();    
                                 
        } else {
            $data['success'] = $e;
        }        
        return $data;
    }  
      
}
