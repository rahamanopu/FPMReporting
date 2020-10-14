<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Attendance extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('ri');
        $this->load->model('common_data');
        $this->load->model('attendance_data');
        $designation = $this->session->userdata('designation');
        $this->userlevel = getUserLevel($designation);
    }

    function attendancereport() {
        $pagelimit = 0;

        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Attendance Summary Report';
        $userlevel = $this->session->userdata('userLevel');;
        $data['postperiod'] = date('F y');
        
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        if (!empty($_POST) OR ! empty($_GET)) {            
            $data['regioncode'] = $this->input->post("regioncode", TRUE);
            $data['areacode'] = $this->input->post("areacode", TRUE);
            $data['fmecode'] = $this->input->post("fmecode", TRUE);
            $data['period'] = $this->input->post("period", TRUE);
            $data['periodformat'] = date('Ym', strtotime($data['period']));

            $data['monthname'] = date('M', strtotime($data['period']));
            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            

            $datas = $this->attendance_data->getUserMonthlyAttendanceDetails(
                        $data['periodformat'], $data['fmecode']);
                $data['summary']        = $datas['summary'];
                $data['detailsdata']    = $datas['detailsdata'];                
        }

        $this->loadView('attendance/attendancereport',$data);
    }

    function divicestate() {
        $this->load->library('user_agent');
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        return $agent;
    }

}

?>