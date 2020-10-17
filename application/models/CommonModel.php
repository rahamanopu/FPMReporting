<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CommonModel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    public function getBusiness(){
        $sql = "SELECT 
                    B.Business AS Business, BusinessName 
                FROM Business B
                WHERE Active = 'Y'
                ORDER BY 2";
        $result['success'] = false;
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getDepartment(){
        $sql = "SELECT 
                    D.DepartmentID, DepartmentName 
                FROM Department D
                ORDER BY 2";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    public function getUserType(){
        $sql = "select * from UserType order by UserTypeName";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }
    
    public function getLocation($userid){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT 
                    L.LocationCode, LocationName, L.BusinessCode, B.BusinessName
                FROM Location L
                    INNER JOIN UserLocation U
                        ON L.LocationCode = U.LocationCode
                WHERE isActive = 'Y'
                    AND U.UserId = '$userid'
                ORDER BY 2 ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    

    public function getMenu(){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT 
                    MenuId, SubMenuName MenuName 
                FROM Menu
                WHERE Active = 'Y'
                ORDER BY 2 ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getMaterialType(){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT * FROM MaterialType";              //    exit();
        
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function getExpenseTypeHead(){         
        $sql = "select * from ExpenseTypeHead";    
        $query = $this->db->query($sql);
        $data = [];
        if ($query) {
            $data = $query->result_array();
        }
        return $data;
    }

    public function getExpenseTypeSubHead(){         
        $sql = "select * from ExpenseTypeSubHead";    
        $query = $this->db->query($sql);
        $data = [];
        if ($query) {
            $data = $query->result_array();
        }
        return $data;
    }

}

?>