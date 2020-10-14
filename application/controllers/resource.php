<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Resource extends MY_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->helper('common');  
        $this->load->model('resource_data');
        $this->load->model('common_data');
    }
    
    
    // public function loadregion(){
    //     $subbusiness = 'Y';
    //     $data['levelCode'] = $this->session->userdata('levelCode');
    //     $data['designation'] = $this->session->userdata('designation');
    //     $userlevel = getUserLevel($data['designation']);        
    //     $regioninfo = $this->common_data->getUserRegion($subbusiness, $userlevel, $data['levelCode']);        
    //     echo json_encode($regioninfo);
    // }
    
    public function loadarea(){
        $regioninfo = $this->input->get_post('regioncode',true);
        $data['levelCode'] = $this->session->userdata('levelCode');
        $userlevel = $this->session->userdata('userLevel');    
        $areainfo = $this->common_data->getUserArea($regioninfo, $userlevel, $data['levelCode']);        
        echo json_encode($areainfo);
    }
    
    public function loadterritory(){
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['designation'] = $this->session->userdata('designation');
        $userlevel = $this->session->userdata('userLevel');
        $areacode = $this->input->get_post('areacode',true);
        $territoryinfo = $this->common_data->getUserTerritory($areacode, $userlevel, $data['levelCode']);        
        echo json_encode($territoryinfo);
    }
}
