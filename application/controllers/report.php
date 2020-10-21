<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('ri');
        $this->load->model('common_data');
        $this->load->model('ReportModel');
    }

    function attendancereport() {
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Attendance Summary Report';
        $data['action'] = 'report/attendancereport';
        $userlevel = $this->session->userdata('userLevel');;
        $data['postperiod'] = date('F y');
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {            
            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);
            $data['period'] = $this->input->get_post("period", TRUE);
            $data['periodformat'] = date('Ym', strtotime($data['period']));

            $data['monthname'] = date('M', strtotime($data['period']));
            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);

            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getUserMonthlyAttendanceDetails($data['periodformat'], $data['fmecode']);
                exportexcel($datas['summary'],$filename = "Attendance_Summary_".time());
            } else {
                $datas = $reportModel->getUserMonthlyAttendanceDetails($data['periodformat'], $data['fmecode']);
                $data['summary']        = $datas['summary'];
                $data['detailsdata']    = $datas['detailsdata']; 
            }

                                         
        }

        $this->loadView('report/attendancereport',$data);
    }

    public function userLocation() {
        $level = $this->input->get('level');
        $date = $this->input->get('date');
        $reportModel = new ReportModel();
        $locationData = $reportModel->getUserLocation($level,$date);
        $markersOnMap = [];
        

        foreach($locationData as $locData){
            $markersOnMap[] = [
                'content'=> date('Y-m-d H:i A',strtotime($locData['ServerTime'])),
                'LatLng'=> [
                    [
                        'lat'=> floatval($locData['Latitude']),
                        'lng'=> floatval($locData['Longitude'])
                    ]
                ],                                                   
            ];                        
        }
        echo json_encode($markersOnMap);
    }


    function tourplan() {
        
        $data['action'] = 'report/tourplan';
        $data['pageTitel'] = 'Tour Plan Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            

            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getTourplanReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);                
                exportexcel($datas['priorityData'],$filename = "Tour_Plan_".time());
            }else {
                $datas = $reportModel->getTourplanReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'], $data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }
                                  
        }

        $this->loadView('report/common_report',$data);
    }

    function distributorStock() {
        
        $data['action'] = 'report/distributorStock';
        $data['pageTitel'] = 'Distributor Stock Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDistributorStockReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Stock_".time());
            } else {
                $datas = $reportModel->getDistributorStockReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];   
            }
            
                                  
        }

        $this->loadView('report/common_report',$data);
    }

    function retailerStock() {
        
        $data['action'] = 'report/retailerStock';
        $data['pageTitel'] = 'Retailer Stock Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getRetailerStockReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Retailer_Stock_".time());
            } else {
                $datas = $reportModel->getRetailerStockReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];   
            }
            
                                  
        }

        $this->loadView('report/common_report',$data);
    }

    function distributorCompititorStock () {
        
        $data['action'] = 'report/distributorCompititorStock';
        $data['pageTitel'] = 'Distributor Compititor Stock Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDistributorCompititorStock($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Tour_Plan_".time());
            } else {
                $datas = $reportModel->getDistributorCompititorStock($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData']        = $datas['priorityData'];
            }
        }

        $this->loadView('report/common_report',$data);
    }

    function retailerCompititorStock () {
        
        $data['action'] = 'report/retailerCompititorStock';
        $data['pageTitel'] = 'Detailer Compititor Stock Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getRetailerCompititorStock($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Retailer_Compititor_Stock_".time());
            } else {
                $datas = $reportModel->getRetailerCompititorStock($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData']        = $datas['priorityData'];
            }
        }

        $this->loadView('report/common_report',$data);
    }
    
    function distributorExpense() {        
        $data['action'] = 'report/distributorExpense';
        $data['pageTitel'] = 'TSI Expense';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        $this->load->model('CommonModel');
        $commonModel = new CommonModel();

        $data['expenseTypeHeadField']= true;
        $data['expenseTypeSubHeadField']= true;
        $data['expenseTypeHeads']= $commonModel->getExpenseTypeHead();
        $data['expenseTypeSubHeads']= $commonModel->getExpenseTypeSubHead();   
        $data['expenseTypeHead'] = '';
        $data['expenseTypeSubHead'] = '';
          

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['expenseTypeHead'] = $this->input->get_post('expenseTypeHead');
            $data['expenseTypeSubHead'] = $this->input->get_post('expenseTypeSubHead');
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getdistributorExpense($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Expense_".time());
            } else {
                $datas = $reportModel->getdistributorExpense($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }                                  
        }

        $this->loadView('report/common_report',$data);
    }


    function distributorSecondarySales() {
        
        $data['action'] = 'report/distributorSecondarySales';
        $data['pageTitel'] = 'Distibutor Primary Sales EPGL';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');;
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDistributorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Secondary_Sales_".time());
            } else {
                $datas = $reportModel->getDistributorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }
        }

        $this->loadView('report/common_report',$data);
    }

    function distributorSecondarySalesProjection() {
        
        $data['action'] = 'report/distributorSecondarySalesProjection';
        $data['pageTitel'] = 'Distibutor Secoundary Sales Projection ';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');;

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getdistributorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Secondary_Sales_Projction_".time());
            } else {
                $datas = $reportModel->getdistributorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }
        }

        $this->loadView('report/common_report',$data);
    }

    function distributorAndRetailerLocation() {
        $data['pageTitel'] = 'Distributor and Retailer Location';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        $this->loadView('report/distributor_retailer_location',$data);
    }

    public function getDistributorAndRetailerLocation() {  
        $level1 = $this->input->post('level1');
        $level2 = $this->input->post('level2');
        $level3 = $this->input->post('level3');
        $category = $this->input->post('category');   
        $markersOnMap = [];     
        $reportModel = new ReportModel();
        $datas = $reportModel->getDistributorRetailerLocation($level3, $level2, $level1,$category);
        if($category == 'all') {
            foreach($datas['distributor'] as $locData){
                $markersOnMap[] = [
                    'code'=> $locData['DistributorCode'],
                    'name'=> $locData['DistributorName'],
                    'location'=> $locData['DistributorPoint'],
                    'type'=> 'distributor',
                    'LatLng'=> [
                        [
                            'lat'=> floatval($locData['Latitude']),
                            'lng'=> floatval($locData['Longitude'])
                        ]
                    ],                                                   
                ];                        
            } 
            
            foreach($datas['retailer'] as $locData){
                $markersOnMap[] = [
                    'name'=> 'Retailer',
                    'type'=> 'retailer',
                    'LatLng'=> [
                        [
                            'lat'=> floatval($locData['Latitude']),
                            'lng'=> floatval($locData['Longitude'])
                        ]
                    ],                                                   
                ];                        
            } 

        } elseif($category == 'distributor') {
            foreach($datas['distributor'] as $locData){
                $markersOnMap[] = [
                    'name'=> $locData['DistributorCode'].' - '.$locData['DistributorName'],
                    'type'=> 'distributor',
                    'LatLng'=> [
                        [
                            'lat'=> floatval($locData['Latitude']),
                            'lng'=> floatval($locData['Longitude'])
                        ]
                    ],                                                   
                ];                        
            } 

        }
        elseif($category == 'retailer') {
            foreach($datas['retailer'] as $locData){
                $markersOnMap[] = [
                    'name'=> 'Retailer',
                    'type'=> 'retailer',
                    'LatLng'=> [
                        [
                            'lat'=> floatval($locData['Latitude']),
                            'lng'=> floatval($locData['Longitude'])
                        ]
                    ],                                                   
                ];                        
            } 
            
        }
        
        echo json_encode($markersOnMap);

    }

    function userCurrentLocation() {
        $data['pageTitel'] = 'User Current Location';       

        $this->loadView('report/user_current_location',$data);
    }

    public function getuserCurrentLocation() { 
        
        $markersOnMap = [];     
        $reportModel = new ReportModel();
        $locations = $reportModel->getUserCurrentLocation();
        foreach($locations as $locData){
            $markersOnMap[] = [
                'name'=> $locData['TSI_ID'].' - '.$locData['TSI_Name'],                
                'LatLng'=> [
                    [
                        'lat'=> floatval($locData['Latitude']),
                        'lng'=> floatval($locData['Longitude'])
                    ]
                ],                                                   
            ];                        
        } 
        
        echo json_encode($markersOnMap);

    }


    

}

?>