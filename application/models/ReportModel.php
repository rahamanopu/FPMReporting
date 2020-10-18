<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ReportModel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    public function getUserMonthlyAttendanceDetails($period, $levelcode){                 
        $success = true;
        $sql = " EXEC usp_doLoadAttendanceReport '$period','$levelcode' ";         
        $query = $this->db->query($sql);               
        $e = $this->db->_error_message();                
        if ($e == '') {
            $data['summary'] = $query->result_array();
            $data['detailsdata'] = $query->next_result();    
                                 
        } else {
            $data['success'] = $e;
        }        
        return $data;
    } 
    
    public function getTourplanReport($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadTourPlanReport  '$leve3','$level2','$level1','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);  
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    
    public function getDistributorStockReport($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadDistributorStock '$leve3','$level2','$level1','$startDate', '$endDate' "; 
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    
    public function getDistributorCompititorStock($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadDistributorCompititorStock   '$leve3','$level2','$level1','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);            
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }  

    public function getdistributorExpense($leve3,$level2,$level1,$expenseTypeHead, $expenseTypeSubHead,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadExpenseReport  '$leve3','$level2','$level1','$expenseTypeHead', '$expenseTypeSubHead','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    
    public function getDistributorSecondarySales($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadDistributorSecoundarySales  '$leve3','$level2','$level1','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }

    public function getdistributorSecondaryProjection($level3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadDistributorSecoundarySalesProjection  '$level3','$level2','$level1','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    public function getDistributorRetailerLocation($level3, $level2, $level1,$category){                 
        $sql = " EXEC usp_doLoadDistributorAndRetailerLocation   '$level3','$level2','$level1'";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['distributor'] = $query->result_array();   
            $data['retailer'] = $query->next_result();
                                 
        }       
        return $data;
    }
    public function getUserCurrentLocation(){                 
        $sql = "EXEC usp_doLoadUserCurrentLoation";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data = $query->result_array();   
                                 
        }       
        return $data;
    }

    public function getUserLocation($level1,$date){                 
        $sql = "SELECT U.* 
            FROM UserLocation U
            INNER JOIN ViewLevels L
                ON U.UserId = L.Level1StaffID
            WHERE ServerTime BETWEEN '$date' AND '$date 23:59:59.000'
                AND (L.Level1 = '$level1')";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data = $query->result_array();          
                                 
        }       
        return $data;
    }
      
}