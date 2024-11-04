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

    public function getDailyAttendanceReport($business,$startDate, $endDate, $userLevel){                 
        $sql = " EXEC usp_doLoadAttendanceReport  '$business','$startDate', '$endDate', '$userLevel' "; 
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    
    public function getDailyActivityData($business,$level2,$startDate, $endDate){
                         
        $sql = " EXEC usp_getDailyActivity  '$business','$level2','$startDate', '$endDate' "; 

        $CI = & get_instance();
        $CI->db = $this->load->database('default',true);
        
        $query = $this->db->query($sql); 
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }
    
    public function get_doctor_count() {
        return $this->db->count_all('AhDoctor');
    }

    public function getAhDoctorReportAll()
    {
        $query = $this->db->query("SELECT  ah.DoctorID,CategoryID,DoctorLocation,DoctorLocationLat,DoctorLocationLon,DoctorName,Qualification,Institute,Designation,SpecialityID,Address,MobileNo,EmailAddress,FacebookID,NoOfPatient,WorkingDays,DepotCode,TTYCode,CustomerCode,CustomerName,DoctorClassID,
                                        Active,EntryBy,EntryDate,EditedBy,EditedDate,Remarks,
                                            convert(varchar, acr.DoctorBirthday, 23) as DoctorBirthday, 
                                            convert(varchar, acr.SpouseBirthday, 23) as SpouseBirthday ,
                                            convert(varchar, acr.MarriageAnniversrryDay, 23) as MarriageAnniversrryDay,
                                            MAX(case when acd.ChildSL = 1 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_1,
                                            MAX(case when acd.ChildSL = 2 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_2,
                                            MAX(case when acd.ChildSL = 3 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_3,
                                            MAX(case when acd.ChildSL = 4 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_4,
                                            MAX(case when acd.ChildSL = 5 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_5
                                    FROM AhDoctor as ah
                                    left join AHDoctorCRMData as acr on ah.DoctorID=acr.DoctorID
                                    left join AHDoctorChildInfo as acd on ah.DoctorID=acd.DoctorID
                                    GROUP BY ah.DoctorID,CategoryID,DoctorLocation,DoctorLocationLat,DoctorLocationLon,DoctorName,Qualification,Institute,Designation,SpecialityID,Address,MobileNo,EmailAddress,FacebookID,NoOfPatient,WorkingDays,DepotCode,TTYCode,CustomerCode,CustomerName,DoctorClassID,Active,EntryBy,EntryDate,EditedBy,EditedDate,Remarks,
                                            acr.DoctorBirthday, acr.SpouseBirthday,acr.MarriageAnniversrryDay
                                    ORDER BY ah.DoctorID desc");

        $data['priorityData'] = $query->result_array();       
        return $data;
    }

    public function getAhDoctorReport($limit, $start){ 
        
        $this->db->limit($limit, $start);
        $query = $this->db->query("SELECT  ah.DoctorID,CategoryID,DoctorLocation,DoctorLocationLat,DoctorLocationLon,DoctorName,Qualification,Institute,Designation,SpecialityID,Address,MobileNo,EmailAddress,FacebookID,NoOfPatient,WorkingDays,DepotCode,TTYCode,CustomerCode,CustomerName,DoctorClassID,
                                        Active,EntryBy,EntryDate,EditedBy,EditedDate,Remarks,
                                            convert(varchar, acr.DoctorBirthday, 23) as DoctorBirthday, 
                                            convert(varchar, acr.SpouseBirthday, 23) as SpouseBirthday ,
                                            convert(varchar, acr.MarriageAnniversrryDay, 23) as MarriageAnniversrryDay,
                                            MAX(case when acd.ChildSL = 1 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_1,
                                            MAX(case when acd.ChildSL = 2 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_2,
                                            MAX(case when acd.ChildSL = 3 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_3,
                                            MAX(case when acd.ChildSL = 4 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_4,
                                            MAX(case when acd.ChildSL = 5 THEN convert(varchar, ChildBirthday, 23) ELSE NULL END) Child_5
                                    FROM AhDoctor as ah
                                    left join AHDoctorCRMData as acr on ah.DoctorID=acr.DoctorID
                                    left join AHDoctorChildInfo as acd on ah.DoctorID=acd.DoctorID
                                    GROUP BY ah.DoctorID,CategoryID,DoctorLocation,DoctorLocationLat,DoctorLocationLon,DoctorName,Qualification,Institute,Designation,SpecialityID,Address,MobileNo,EmailAddress,FacebookID,NoOfPatient,WorkingDays,DepotCode,TTYCode,CustomerCode,CustomerName,DoctorClassID,Active,EntryBy,EntryDate,EditedBy,EditedDate,Remarks,
                                            acr.DoctorBirthday, acr.SpouseBirthday,acr.MarriageAnniversrryDay
                                    ORDER BY ah.DoctorID desc 
                                    OFFSET  $start ROWS 
                                    FETCH NEXT $limit ROWS ONLY ");

        $data['priorityData'] = $query->result_array();       
        return $data;
    }
    
    public function get_farm_count() {
        return $this->db->count_all('FirmMaster');
    }
    
    public function getFarmReportAll()
    {
        $query = $this->db->query("SELECT  * FROM     FirmMaster");

        $data['priorityData'] = $query->result_array();       
        return $data;
    }

    public function getFarmReport($limit, $start)
    {  
        $this->db->limit($limit, $start);
        $query = $this->db->query("SELECT  * FROM     FirmMaster ORDER BY FirmID desc 
                                    OFFSET  $start ROWS 
                                    FETCH NEXT $limit ROWS ONLY ");

        $data['priorityData'] = $query->result_array();       
        return $data;
    }
    public function getOrderAndCollectionReport($startDate,$endDate,$business,$report_status,$userid){                 
        $sql = "EXEC usp_doLoadOrderAndCollectionReport  '$startDate','$endDate','$business','$report_status','$userid' "; 
        if (in_array($business,$this->config->item('cb_core_business_codes'))) {
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
    
    public function dealerStockReport($period){                 
        $sql = " EXEC usp_getDealerProductStock '$period'";   
        
        $CI = & get_instance();
        $CI->db = $this->load->database('cbsdms',true);
             
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();
                                 
        }       
        return $data;
    }

    public function dealerCdpStockReport($period){                 
        $sql = " EXEC usp_getDealerCdpProductStock '$period'";

        $CI = & get_instance();
        $CI->db = $this->load->database('cbsdms',true);
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();
                                 
        }       
        return $data;
    }
      
}
