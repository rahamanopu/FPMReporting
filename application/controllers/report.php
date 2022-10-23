<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('ri');
        $this->load->model('common_data');
        $this->load->model('ReportModel');
        $this->load->helper('url');
        $this->load->library("pagination");
    }

    function attendancereport() {
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Attendance Summary Report';
        $data['action'] = 'report/attendancereport';
        // $userlevel = $this->session->userdata('userLevel');
        $userlevel = '';
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

    public function dailyAttendanceReport() {
        $data['action'] = 'report/dailyAttendanceReport';
        $data['pageTitel'] = 'Daily Attendance Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        // $userlevel = $this->session->userdata('userLevel');
        $userlevel = '';

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['userBusinesses'] = $commonData->getUserBusiness($data['userid']);
        // echo '<pre>',print_r($data['userBusinesses']);die();
        // $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);   

            $data['business'] = $this->input->get_post("business", TRUE);           

            // $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            // $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDailyAttendanceReport($data['business'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Stock_".time());
            } else {
                $datas = $reportModel->getDailyAttendanceReport($data['business'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }
            // echo '<pre>',print_r($data['priorityData']);die();
            
                                  
        }

        // $this->loadView('report/common_report',$data);
        $this->loadView('report/daily_attendancereport',$data);
    }

    public function ahDoctorReport() {
        $data['action'] = 'report/ahDoctorReport';
        $data['pageTitel'] = 'AH Doctor Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        // $userlevel = $this->session->userdata('userLevel');
        $userlevel = '';

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['userBusinesses'] = $commonData->getUserBusiness($data['userid']);
        // echo '<pre>',print_r($data['userBusinesses']);die();
        // $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        // if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);   

            $data['business'] = $this->input->get_post("business", TRUE);           

            // $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            // $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getAhDoctorReport();
                exportexcel($datas['priorityData'],$filename = "ah_doctor_report".time());
            } else {
                $config = array();
                $config["base_url"] = base_url() . "report/ahDoctorReport";
                $config["total_rows"] = $reportModel->get_doctor_count();
                $config["per_page"] = 10;
                $config["uri_segment"] = 3;
                
                $this->pagination->initialize($config);

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                // echo "<pre/>";print_r($page);exit();
                $data["links"] = $this->pagination->create_links();
               
                $datas = $reportModel->getAhDoctorReport($config["per_page"], $page);

                $data['priorityData'] = $datas['priorityData'];
            }
            // echo '<pre>',print_r($data['priorityData']);die();
            
                                  
        // }

        // $this->loadView('report/common_report',$data);
        $this->loadView('report/ah_doctor_report',$data);
    }
    
    public function FarmReport() {
        $data['action'] = 'report/farmReport';
        $data['pageTitel'] = 'Farm Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        // $userlevel = $this->session->userdata('userLevel');
        $userlevel = '';

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['userBusinesses'] = $commonData->getUserBusiness($data['userid']);
        // echo '<pre>',print_r($data['userBusinesses']);die();
        // $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        // if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);   

            $data['business'] = $this->input->get_post("business", TRUE);           

            // $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            // $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getFarmReport();
                exportexcel($datas['priorityData'],$filename = "farm_report".time());
            } else {
                $config = array();
                $config["base_url"] = base_url() . "report/farmReport";
                $config["total_rows"] = $reportModel->get_farm_count();
                $config["per_page"] = 10;
                $config["uri_segment"] = 3;
                
                $this->pagination->initialize($config);

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                // echo "<pre/>";print_r($page);exit();
                $data["links"] = $this->pagination->create_links();
               
                $datas = $reportModel->getFarmReport($config["per_page"], $page);
                $data['priorityData'] = $datas['priorityData'];
            }
            // echo '<pre>',print_r($data['priorityData']);die();
            
                                  
        // }

        // $this->loadView('report/common_report',$data);
        $this->loadView('report/farm_report',$data);
    }

    public function orderAndCollection() {
        $data['action'] = 'report/orderAndCollection';
        $data['pageTitel'] = 'Order And Collection Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');  

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
        $data['reportStauses'] = $this->getReportStatus();
        $commonData = new Common_data();
        $data['userBusinesses'] = $commonData->getUserBusiness($data['userid']);
        if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            
            $data['business'] = $this->input->get_post("business", TRUE);           
            $data['report_status'] = $this->input->get_post("report_status", TRUE);  
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getOrderAndCollectionReport($data['startDate'],$data['endDate'],$data['business'],$data['report_status'],$data['userid']);
                exportexcel($datas['priorityData'],$filename = "OrderAndCollectionReprot_".time());
            } else {
                $datas = $reportModel->getOrderAndCollectionReport($data['startDate'],$data['endDate'],$data['business'],$data['report_status'],$data['userid']);
                $data['priorityData'] = $datas['priorityData'];
            }
                                  
        }
        $this->loadView('report/order_collection_report',$data);
    }

    public function dayWisePrimarySales() {
        $data['action'] = 'report/dayWisePrimarySales';
        $data['pageTitel'] = 'Day Wise Primary Sales Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
        $data['reportStauses'] = $this->getReportStatus();
       
        
        $commonData = new Common_data();
        $data['userBusinesses'] = $commonData->getUserBusiness($data['userid']);
        // echo '<pre>',print_r($data['userBusinesses']);die();
        if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            
            $data['business'] = $this->input->get_post("business", TRUE);           
            $data['report_status'] = $this->input->get_post("report_status", TRUE);             
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDayWisePrimarySalesReport($data['startDate'],$data['endDate'],$data['business'],$data['report_status'],$data['userid']);
                exportexcel($datas['priorityData'],$filename = "DayWisePrimarySalesReport_".time());
            } else {
                $datas = $reportModel->getDayWisePrimarySalesReport($data['startDate'],$data['endDate'],$data['business'],$data['report_status'],$data['userid']);
                $data['priorityData'] = $datas['priorityData'];
            }
            // echo '<pre>',print_r($data['priorityData']);die();            
                                  
        }
        $this->loadView('report/day_wise_primary_sales_report',$data);
    }


    public function customerComplaint() {
        $data['action'] = 'report/customerComplaint';
        $data['pageTitel'] = 'Customer Complaint Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');  

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
        $data['reportStauses'] = [''=>'Pending','1'=>'Resolved'];
        if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';    
            $data['report_status'] = $this->input->get_post("report_status", TRUE); 
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getCustomerComplaint($data['startDate'],$data['endDate'],$data['report_status']);
                exportexcel($datas['priorityData'],$filename = "ComplaintReprot_".time());
            } else {
                $datas = $reportModel->getCustomerComplaint($data['startDate'],$data['endDate'],$data['report_status']);
                $data['priorityData'] = $datas['priorityData'];
            }
                                  
        }
        // echo '<pre>',print_r($data['priorityData']);die();
        $this->loadView('report/customer_complaint',$data);
    }

    public function resolveComplaint() {
        $data['action'] = 'report/resolveComplaint';
        $data['pageTitel'] = 'Resolve Customer Complaint';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');  

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
        if (!empty($_POST) OR ! empty($_GET)) {             
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getCustomerComplaint($data['startDate'],$data['endDate'],'');
                exportexcel($datas['priorityData'],$filename = "ComplaintReprot_".time());
            } else {
                $datas = $reportModel->getCustomerComplaint($data['startDate'],$data['endDate'],'');
                $data['priorityData'] = $datas['priorityData'];
            }
                                  
        }
        $this->loadView('report/customer_complaint_resolve',$data);
    }

    public function resolveCustomerComplaint() {
        $userId= $this->session->userdata('userid');
        $complaintId = $this->input->get_post('complaintId',true);
        $complaintText = $this->input->get_post('complaintText',true);

        $sql = "update CustomerComplaint set Solved='1',SolvedComments='$complaintText', SolvedBy='$userId'
                where ComplaintId='$complaintId'";

        $result = $this->db->query($sql);  
        $response = [];
        if($result) {
            $response = [
                'success' => true,
                'message' => 'Successfully Resolved the Compalint',
            ];
            
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to Resolve the Complaint',
            ];
        }
        echo json_encode($response);
    }

    public function updateCustomerComplaintCategory() {
        try{
            $complaintCategory = $this->input->post('complaintCategory',true);
            $complaintIDs = $this->input->post('complaintID',true);
            $status = false;
            foreach($complaintIDs as $key=>$item) {
                $dataToAdd['ComplaintCategory'] = $complaintCategory[$key];
                $status = $this->db->update('CustomerComplaint',$dataToAdd,['ComplaintID'=>$item]);
            }
            if($status) {
                setFlashMsg('Updated Complaint Category','success');
            } else {
                setFlashMsg('Nothing to be updated','error');
            }

        }catch(Exception $ex) {
            setFlashMsg("Exception Happend","error");
        }
        return redirect('report/customerComplaint');        

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
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

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
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

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
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

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
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

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
        $data['pageTitel'] = 'Retailer Compititor Stock Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');
        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

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
        $userlevel = $this->session->userdata('userLevel');
        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
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
            $data['imageFolder'] = 'uploads/expense/'; 
            $data['expenseTypeHead'] = $this->input->get_post('expenseTypeHead');
            $data['expenseTypeSubHead'] = $this->input->get_post('expenseTypeSubHead');
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

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
        $data['pageTitel'] = 'Distributor Secoundary Sales';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDistributorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Secoundary_Sales_".time());
            } else {
                $datas = $reportModel->getDistributorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }
        }

        $this->loadView('report/common_report',$data);
    }


    function distributorCompititorSecondarySales() {
        
        $data['action'] = 'report/distributorCompititorSecondarySales';
        $data['pageTitel'] = 'Distributor Compititor Secoundary Sales';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getDistributorCompititorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Compititor_Secoundary_Sales_".time());
            } else {
                $datas = $reportModel->getDistributorCompititorSecondarySales($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];
            }
        }

        $this->loadView('report/common_report',$data);
    }


    function distributorSecondarySalesProjection() {
        
        $data['action'] = 'report/distributorSecondarySalesProjection';
        $data['pageTitel'] = 'Distributor Primary Sales projection';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {  
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getdistributorSecondaryProjection($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Distributor_Secondary_Sales_Projction_".time());
            } else {
                $datas = $reportModel->getdistributorSecondaryProjection($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
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
        // echo '<pre>',var_dump('Okkkkkk======',$datas);die();
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
                    'code'=> $locData['RetailerID'],
                    'name'=> $locData['RetailerName'],                    
                    'RetailerContactNumber' => $locData['RetailerContactNumber'],
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

        }
        elseif($category == 'retailer') {
            foreach($datas['retailer'] as $locData){
                $markersOnMap[] = [
                    'code'=> $locData['RetailerID'],
                    'name'=> $locData['RetailerName'],                    
                    'RetailerContactNumber' => $locData['RetailerContactNumber'],
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
                'greaterthanTenMin' => ((strtotime($locData['Last_Updated'])+(10*60)) < time()) ? 'yes' : 'no',
                'name'=> $locData['TSI_ID'].' - '.$locData['TSI_Name'], 
                'time' => date('Y-m-d H:i A',strtotime($locData['Last_Updated'])),
                'type' => 'user_location',
                'LatLng'=> [
                    [
                        'lat'=> floatval($locData['Latitude']),
                        'lng'=> floatval($locData['Longitude'])
                    ]
                ],                                                   
            ];                        
        } 

        //$distributorRetailerLocation = $reportModel->getDistributorRetailerLocation('','','','');
		$distributorRetailerLocation = array();
        // distributor
		if(!empty($distributorRetailerLocation)){
			foreach($distributorRetailerLocation['distributor'] as $locData){
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
		}
        // Retailer
		if(!empty($distributorRetailerLocation)){
			foreach($distributorRetailerLocation['retailer'] as $locData){
				$markersOnMap[] = [
					'code'=> $locData['RetailerID'],
					'name'=> $locData['RetailerName'],                    
					'RetailerContactNumber' => $locData['RetailerContactNumber'],
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

    function retailers() {
        $data['pagelimit'] = 20;
        $data['action'] = 'report/retailers';
        $data['pageTitel'] = 'Retailer List';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');       
        
		$data['showDistributorField'] = true;  
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);
        
        if(!empty($this->input->get("page", TRUE))){
            $data['page']       = $this->input->get("page", TRUE);
        }else{
            $data['page']       = 1;
        }

        if (!empty($_POST) OR ! empty($_GET)) {
            $data['startDate'] = '';
            $data['endDate'] = '';
            $data['period'] = '';
            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE); 
			$data['distributorcode'] = $this->input->get_post("distributorcode", TRUE); 			

            $data['areainfo'] 			= $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] 			= $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
			if(!empty($data['fmecode'])){
				$data['distributorlist'] 	= $this->common_data->getUserDistributor($data['fmecode']);
			}
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getRetailers($data['regioncode'], $data['areacode'], $data['fmecode'], $data['pagelimit'],'%',$data['distributorcode']);
					exportexcel($datas['priorityData'],$filename = "Retailer_List_".time());
            } else {
                $datas = $reportModel->getRetailers($data['regioncode'], $data['areacode'], $data['fmecode'], $data['pagelimit'],$data['page'],$data['distributorcode']);
					$data['priorityData'] = $datas['priorityData'];
					$data['pagingData'] = $datas['pagingData'];
            }
        }

        $this->loadView('report/common_report_with_paging',$data);
    }

    function retailerOrder() {
        // $data['pagelimit'] = 20;
        $data['action'] = 'report/retailerOrder';
        $data['pageTitel'] = 'Retailer Order';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);
    
        if (!empty($_POST) OR ! empty($_GET)) {
            $data['period'] = '';
            $data['startDate'] = $this->input->get_post("startDate", TRUE);
            $data['endDate'] = $this->input->get_post("endDate", TRUE);
            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getRetailerOrder($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Retailer_Order_".time());
            } else {
                $datas = $reportModel->getRetailerOrder($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];                
            }
        }

        $this->loadView('report/common_report',$data);
    }
    
    function expenseTopSheet() {
        $data['action'] = 'report/expenseTopSheet';
        $data['pageTitel'] = 'Expense Top Sheet';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');              
        $userlevel = $this->session->userdata('userLevel');

        $data['showPeriodField'] = true; 
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);
    
        if (!empty($_POST) OR ! empty($_GET)) {
            $data['startDate'] = '';
            $data['endDate'] = '';
            $data['period'] = $this->input->get_post("period", TRUE);
            $data['periodFormat'] = date('Ym',strtotime($this->input->get_post("period", TRUE)));
            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getExpenseTopSheet($data['regioncode'], $data['areacode'], $data['fmecode'], $data['periodFormat']);
                exportexcel($datas['priorityData'],$filename = "Expense_Top_Sheet_".time());
            } else {
                $datas = $reportModel->getExpenseTopSheet($data['regioncode'], $data['areacode'], $data['fmecode'], $data['periodFormat']);
                $data['priorityData'] = $datas['priorityData'];         
            }
        }

        $this->loadView('report/common_report',$data);
    }

    function tourPlanMissed() {
        $data['action'] = 'report/tourPlanMissed';
        $data['pageTitel'] = 'Tour Plan Missed Report';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');              
        $userlevel = $this->session->userdata('userLevel');

        $data['showDateToField'] = true; 
        $data['showDateFromField'] = true; 
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);
    
        if (!empty($_POST) OR ! empty($_GET)) {
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
            $data['period'] = '';
            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            
            $reportModel = new ReportModel();
            if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 'yes'){
                $datas = $reportModel->getTourPlanMissed($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                exportexcel($datas['priorityData'],$filename = "Tour_Plan_Missed_Report_".time());
            } else {
                $datas = $reportModel->getTourPlanMissed($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData'] = $datas['priorityData'];         
            }
        }

        $this->loadView('report/common_report',$data);
    }

    function userTimelineLocation() {
        $data['pageTitel'] = 'User Timeline Location';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');
       
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        $this->loadView('report/user_timeline_location',$data);
        // $this->loadView('report/user_timeline_location2',$data);
    }

    public function getUserTimelineLocation() {          
        $level1 = $this->input->post('level1');
        $level2 = $this->input->post('level2');
        $level3 = $this->input->post('level3');
        $dateFrom = $this->input->post('dateFrom');   
        $dateTo = $this->input->post('dateTo');   
        $markersOnMap = [];     
        $reportModel = new ReportModel();
        $datas = $reportModel->getUserTimelineLocation($level3, $level2, $level1,$dateFrom,$dateTo);
       
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
                    'code'=> $locData['RetailerID'],
                    'name'=> $locData['RetailerName'],                    
                    'retailerContactNumber' => $locData['RetailerContactNumber'],
                    'retailerTypeName' => $locData['RetailerTypeName'],
                    'type'=> 'retailer',
                    'LatLng'=> [
                        [
                            'lat'=> floatval($locData['Latitude']),
                            'lng'=> floatval($locData['Longitude'])
                        ]
                    ],                                                   
                ];                        
            }
            
            foreach($datas['user_location'] as $locData){
                $markersOnMap[] = [
                    'name'=> $locData['UserId'],
                    'time'=> $locData['ServerTime'],
                    'type'=> 'user_location',
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

    function downloadImage($img,$url = '')
    {       
        if($url =='') {
            $url = "https://s3.amazonaws.com/acifpmattendance/";
        }
        $this->load->helper('download');
        $data = @file_get_contents ($url.$img);
        force_download($img, $data);
    }

    

    

}

?>