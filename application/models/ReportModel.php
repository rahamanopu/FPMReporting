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

    public function getDailyAttendanceReport($business,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadAttendanceReport  '$business','$startDate', '$endDate' "; 
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    public function getOrderAndCollectionReport($startDate,$endDate,$business,$report_status,$userid){                 
        $sql = "EXEC usp_doLoadOrderAndCollectionReport  '$startDate','$endDate','$business','$report_status','$userid' "; 
        if ($business == 'D') {
            $CI = & get_instance();
            $CI->db = $this->load->database('cbsdms', true);
        }else{
            $CI = & get_instance();
            $CI->db = $this->load->database('sdms', true);
        }
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    
    public function getDayWisePrimarySalesReport($startDate,$endDate,$business,$report_status,$userid){                 
        $sql = "EXEC usp_doLoadDayWisePrimary  '$startDate','$endDate','$business','$report_status','$userid' "; 
        // die($sql);
        $CI = & get_instance();
        $CI->db = $this->load->database('sdms',true);
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }

    public function getCustomerComplaint($startDate,$endDate,$report_status){                 
        $sql = "select CC.ComplaintID,CC.ProductCode,CC.BatchNo,
                    case when CC.Solved ='1' then 'Resolved' else 'Pending' end Solved_Status, CC.SolvedComments,
                    CC.CustomerName,CC.CustomerMobile,CC.CustomerType, convert(varchar, CC.EntryDate, 103) Date ,CC.ComplaintDetails,
                    CC.ComplaintImage as Image ,B.BusinessName as Business,
                    UM.UserName, UM.Designation, CC.ComplaintCategory
                from CustomerComplaint CC
                join Business B on B.Business=CC.Business 
                join [192.168.100.21].[SDMSMirror].dbo.UserManager UM on UM.UserId=CC.EntryBy
                where CC.EntryDate between '$startDate' and '$endDate 23:59:59'
                and (Solved='$report_status' or '$report_status' = '')"; 
        // die($sql);
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data['priorityData'] = $query->result_array();             
              
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
    public function getDistributorCompititorSecondarySales($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadDistributorSecoundarySalesCompititor  '$leve3','$level2','$level1','$startDate', '$endDate' ";        
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
            FROM [192.168.100.75].DCR.dbo.UserLocation U
            WHERE ServerTime BETWEEN '$date' AND '$date 23:59:59.000'
            and U.UserId='$level1'";
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data = $query->result_array();          
                                 
        }       
        return $data;
    }

    public function getRetailerStockReport($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadRetailerStock '$leve3','$level2','$level1','$startDate', '$endDate' "; 
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }

    public function getRetailerCompititorStock($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadRetailerCompititorStock   '$leve3','$level2','$level1','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);            
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }  


    public function getRetailers($leve3,$level2,$level1,$pageLimit, $pageNumber, $distcode = ''){                 
        $sql = " EXEC usp_doLoadRetailerlist  '$leve3','$level2','$level1','$pageLimit', '$pageNumber', '$distcode' ";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
            $data['pagingData'] = $query->next_result();          
                                 
        }       
        return $data;
    }
    public function getRetailerOrder($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadRetailerOrder  '$leve3','$level2','$level1','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
            // $data['pagingData'] = $query->next_result();          
                                 
        }       
        return $data;
    }
    
    public function getExpenseTopSheet($leve3,$level2,$level1,$period){                 
        $sql = " EXEC usp_doLoadExpenseTopSheet   '$leve3','$level2','$level1','$period'";
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
            // $data['pagingData'] = $query->next_result();          
                                 
        }       
        return $data;
    }
    
    public function getTourPlanMissed($leve3,$level2,$level1,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadTourPlanMissedReport   '$leve3','$level2','$level1','$startDate', '$endDate'";
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
            // $data['pagingData'] = $query->next_result();          
                                 
        }       
        return $data;
    }

    public function getUserTimelineLocation($level3, $level2, $level1,$dateFrom, $dateTo){                 
        $sql = " EXEC usp_doLoadUserTimelineReport   '$level3','$level2','$level1', '$dateFrom', '$dateTo'";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['distributor'] = $query->result_array();   
            $data['retailer'] = $query->next_result();
            $data['user_location'] = $query->next_result();
                                 
        }       
        return $data;
    }
      
}
