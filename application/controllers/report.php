<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Report extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('ri');
        $this->load->model('common_data');
        $this->load->model('report_data');
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
            $data['startDate'] = $this->input->post('startDate');;
            $data['endDate'] = $this->input->post('endDate');;

            $data['regioncode'] = $this->input->post("regioncode", TRUE);
            $data['areacode'] = $this->input->post("areacode", TRUE);
            $data['fmecode'] = $this->input->post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            

            $datas = $this->report_data->getTourplanReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData']        = $datas['priorityData'];   
                                  
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
            $data['startDate'] = $this->input->post('startDate');;
            $data['endDate'] = $this->input->post('endDate');;

            $data['regioncode'] = $this->input->post("regioncode", TRUE);
            $data['areacode'] = $this->input->post("areacode", TRUE);
            $data['fmecode'] = $this->input->post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            

            $datas = $this->report_data->getDistributorStockReport($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData']        = $datas['priorityData'];   
                                  
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
            $data['startDate'] = $this->input->post('startDate');;
            $data['endDate'] = $this->input->post('endDate');;

            $data['regioncode'] = $this->input->post("regioncode", TRUE);
            $data['areacode'] = $this->input->post("areacode", TRUE);
            $data['fmecode'] = $this->input->post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            

            $datas = $this->report_data->getdistributorCompititorStock($data['regioncode'], $data['areacode'], $data['fmecode'], $data['startDate'],$data['endDate']);
                $data['priorityData']        = $datas['priorityData'];   
                                  
        }

        $this->loadView('report/common_report',$data);
    }
    
    function distributorExpense() {        
        $data['action'] = 'report/distributorExpense';
        $data['pageTitel'] = 'Distributor Expense';
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
            $data['expenseTypeHead'] = $this->input->post('expenseTypeHead');
            $data['expenseTypeSubHead'] = $this->input->post('expenseTypeSubHead');
            $data['startDate'] = $this->input->post('startDate');;
            $data['endDate'] = $this->input->post('endDate');;

            $data['regioncode'] = $this->input->post("regioncode", TRUE);
            $data['areacode'] = $this->input->post("areacode", TRUE);
            $data['fmecode'] = $this->input->post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            

            $datas = $this->report_data->getdistributorExpense($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
                $data['priorityData']        = $datas['priorityData'];   
                                  
        }

        $this->loadView('report/common_report',$data);
    }

}

?>