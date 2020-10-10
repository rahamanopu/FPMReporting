<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

CLASS Dashboard extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('dashboard_data','dashboard');        
        $this->load->model('CommonModel','common');
    }
    public function index() {

//echo "<pre />"; print_r($this->session); exit();
        $data = array();
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = '2018-01-01';
        $data['dateto']         = '2018-07-21';

        $data['head'] = $this->load->view('template/head', $data, true);
        $data['header'] = $this->load->view('template/header', $data, true);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['content'] = $this->load->view('template/content', $data, true);
        $data['footer'] = $this->load->view('template/footer', $data, true);
        
        $this->load->view('dashboard', $data);
    } 
    
    public function buffernotification(){
        $data                   = array();
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = '2018-01-01';
        $data['dateto']         = '2018-07-21';
     
        $return = $this->dashboard->doLoadDBData($data['datefrom'], $data['dateto'], $data['userid']);
            $data['business']           = $return['business'];
            $data['redzone']            = $return['redzone'];
            $data['whitezone']          = $return['whitezone'];
            $data['blackzone']          = $return['blackzone'];
            $data['greenzone']          = $return['greenzone'];
            $data['summery']            = $return['summery'];
            $data['groupdetails']       = $return['groupdetails'];
        $this->load->view('dashboard/buffernotification', $data);
    }
    
    public function ordernotification(){
        $data                   = array();
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        
        $data['businesscode']         = '%';    
        $data['locationcode']         = '%';    
        $data['materialtypecode']     = '%';    
        $data['materialcode']         = '';  
        
        $return = $this->dashboard->doLoadOrderQtyDashBoard($data['businesscode'], $data['locationcode'], $data['materialtypecode'], $data['materialcode'], $data['userid']);
            $data['orderbusinesslist']  = $return['business'];
            $data['ordersummery']       = $return['summery'];
            $data['ordergroupdetails']  = $return['groupdetails'];
        $this->load->view('dashboard/ordernotification', $data);
    }
    
    public function lastupdatenotification(){
        $data                   = array();
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = '2018-01-01';
        $data['dateto']         = '2018-07-21';
        
        $data['lastupdate'] = $this->dashboard->doLoadLastUpdateNotification($data['datefrom'], $data['dateto'], $data['userid']);    
        $this->load->view('dashboard/lastupdatenotification', $data);
    }
    
    public function orderdetails(){
        $data = array();
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');

        $data['businesscode']           = $this->input->get("businesscode", TRUE);
        $data['locationcode']           = $this->input->get("locationcode", TRUE);
        $data['materialtypecode']       = $this->input->get("materialtypecode", TRUE);
        $data['materialcode']           = $this->input->get("materialcode", TRUE);

        $data['selectedbusinesscode']   = $this->input->get("selectedbusinesscode", TRUE);
        $data['selectedlocation']       = $this->input->get("selectedlocation", TRUE);
        $data['selectedmaterialtype']   = $this->input->get("selectedmaterialtype", TRUE);
        $data['selectedasondate']       = $this->input->get("asondate", TRUE);
        
        $data['excel']                  = $this->input->get("excel", TRUE);
//echo $data['excel']; exit();
        $return = $this->dashboard->doLoadOrderQtyDashBoard($data['businesscode'], $data['locationcode'], $data['materialtypecode'], $data['materialcode'], $data['userid']);
        //$return = unserialize(file_get_contents("test.text"));
            $data['orderbusinesslist']  = $return['business'];
            $data['ordersummery']       = $return['summery'];
            $data['ordergroupdetails']  = $return['groupdetails'];
//echo "<pre />"; print_r($data['ordergroupdetails']); exit();
            global $selectedbusinesscode;
            global $selectedlocation;
            global $selectedmaterialtype;
            global $selectedasondate;
            
            $selectedbusinesscode   = $data['selectedbusinesscode'];
            $selectedlocation       = $data['selectedlocation'];
            $selectedmaterialtype   = $data['selectedmaterialtype'];
            $selectedasondate       = $data['selectedasondate'];

            $data['filterdata'] = array_values(array_filter($data['ordergroupdetails'], function($val){
                global $selectedbusinesscode;
                global $selectedlocation;
                global $selectedmaterialtype;
                global $selectedasondate;
                if($val['BusinessCode'] == $selectedbusinesscode 
                        && $val['Location'] ==$selectedlocation
                        && $val['Material_Type'] == $selectedmaterialtype
                        && $val['Opening_AS_of_Day'] == $selectedasondate
                        ){
                    return true;
                }
            }));                                             

            if($selectedmaterialtype != 'FG'){
                for($i=0; $i<count($data['filterdata']); $i++){
                    unset($data['filterdata'][$i]['Carton_Size']);   
                }
            }
            
            if($data['excel'] == 'yes'){
                $filename = $data['filterdata'][0]['BusinessName'].'_'.$data['filterdata'][0]['Location'];
                $this->exportexcel($data['filterdata'], $filename);
                exit();
            }
            //echo "<pre />"; print_r($data['filterdata']); exit();

            $data['head'] = $this->load->view('template/head', $data, true);
            $data['header'] = $this->load->view('template/header', $data, true);
            $data['menu'] = $this->load->view('template/menu', $data, true);
            $data['content'] = $this->load->view('dashboard/orderdetails', $data, true);
            $data['footer'] = $this->load->view('template/footer', $data, true);

            $this->load->view('dashboard', $data);


    }

    public function groupdetails(){
        global $businesscode;
        global $location;
        global $alertgroup;
        global $materialtype;

        $data = '';
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = $this->uri->segment(3);
        $data['dateto']         = $this->uri->segment(4);
        $data['businesscode']   = $this->uri->segment(5);
        $data['location']       = $this->input->get('location', TRUE);
        $data['aleartgroup']    = $this->input->get('alertgroup', TRUE);
        $data['materialtype']    = $this->input->get('materialtype', TRUE);

        $return = $this->dashboard->doLoadDBData($data['datefrom'], $data['dateto'], $data['userid']);
            $data['business']           = $return['business'];
            $data['redzone']            = $return['redzone'];
            $data['whitezone']          = $return['whitezone'];
            $data['blackzone']          = $return['blackzone'];
            $data['greenzone']          = $return['greenzone'];
            $data['summery']            = $return['summery'];
            $data['groupdetails']       = $return['groupdetails'];
            //$data['materialdetails']    = $return['materialdetails'];
            

            function filtergroupdetails($val){
                global $businesscode;
                global $location;
                global $alertgroup;
                global $materialtype;
              
                if($val['BusinessCode'] == $businesscode 
                    && $val['Location'] ==  str_replace("%20", " ", $location) 
                    && $val['AlertGroup'] == $alertgroup
                    && $val['Material_Type'] == $materialtype){
                    return true; 
                }else{
                    return false;  
                }
            }
            
            $businesscode   = $data['businesscode'];
            $location       = $data['location'];
            $alertgroup     = $data['aleartgroup'];
            $materialtype   = $data['materialtype'];
            $data['filterdetailsdata'] = array_values(array_filter($data['groupdetails'], "filtergroupdetails"));
//echo "<pre />"; print_r($data['filterdetailsdata']); exit();
            $data['head'] = $this->load->view('template/head', $data, true);
            $data['header'] = $this->load->view('template/header', $data, true);
            $data['menu'] = $this->load->view('template/menu', $data, true);
            $data['content'] = $this->load->view('dashboard/detailsreport', $data, true);
            $data['footer'] = $this->load->view('template/footer', $data, true);

            $this->load->view('dashboard', $data);

    }

    public function groupdetailsexport(){
        global $businesscode;
        global $location;
        global $alertgroup;
        global $materialtype;
        
        $data = '';
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = $this->uri->segment(3);
        $data['dateto']         = $this->uri->segment(4);
        $data['businesscode']   = $this->uri->segment(5);
        $data['location']       = $this->input->get('location', TRUE);
        $data['aleartgroup']    = $this->input->get('alertgroup', TRUE);
        $data['materialtype']   = $this->input->get('materialtype', TRUE);

        $return = $this->dashboard->doLoadDBData($data['datefrom'], $data['dateto'], $data['userid']);
            $data['business']           = $return['business'];
            $data['redzone']            = $return['redzone'];
            $data['whitezone']          = $return['whitezone'];
            $data['blackzone']          = $return['blackzone'];
            $data['greenzone']          = $return['greenzone'];
            $data['summery']            = $return['summery'];
            $data['groupdetails']       = $return['groupdetails'];
            //$data['materialdetails']    = $return['materialdetails'];
            

            function filtergroupdetails($val){
                global $businesscode;
                global $location;
                global $alertgroup;
                global $materialtype;
                
                if($val['BusinessCode'] == $businesscode 
                    && $val['Location'] ==  str_replace("%20", " ", $location) 
                    && $val['AlertGroup'] == $alertgroup
                    && $val['Material_Type'] == $materialtype){
                    return true; 
                }else{
                    return false;  
                }
            }
            
            
            $businesscode   = $data['businesscode'];
            $location       = $data['location'];
            $alertgroup     = $data['aleartgroup'];
            $materialtype   = $data['materialtype'];
            $data['filterdetailsdata'] = array_values(array_filter($data['groupdetails'], "filtergroupdetails"));


            $filename = $location.'_'.$alertgroup;
            $this->exportexcel($data['filterdetailsdata'], $filename);
            //var_dump($data['filterdetailsdata']);

    }


    function exportexcel($result, $filename){

        $arrayheading[0] = array_keys($result[0]);
        $result = array_merge($arrayheading, $result);
        //var_dump($result); exit();

        
        header("Content-Disposition: attachment; filename=\"{$filename}.xls\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($result as $data)
        {
                fputcsv($out, $data,"\t");
        }
        fclose($out);
    }

    public function materialdetails(){
        global $businesscode;
        global $location;
        global $alertgroup;
        global $materialcode;

        $data = '';
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = $this->uri->segment(3);
        $data['dateto']         = $this->uri->segment(4);
        $data['businesscode']   = $this->uri->segment(5);
        $data['location']       = $this->input->get('location', TRUE);
        $data['aleartgroup']    = $this->input->get('alertgroup', TRUE);//
        $data['materialcode']   = $this->input->get('materialcode', TRUE);//alertgroup$this->uri->segment(6);

        $return = $this->dashboard->doLoadDBDataMaterialDetails($data['datefrom'], $data['dateto'], 
			$data['materialcode'], $data['userid'], $data['aleartgroup']);
            $data['materialdetails']    = $return['materialdetails'];
//echo "<pre />"; print_r($data['materialdetails']); exit();           

            function filtermaterialdetails($val){
                global $businesscode;
                global $location;
                global $alertgroup;
                global $materialcode;

                if($val['BusinessCode'] == $businesscode 
                    && $val['LocationName'] ==  $location
                    && $val['Penetration_Group'] == $alertgroup
                    && $val['MaterialCode'] == $materialcode
                ){
                    return true; 
                }else{
                    return false;  
                }
            }
            

            $businesscode   = $data['businesscode'];
            $location       = $data['location'];
            $alertgroup     = $data['aleartgroup'];
            $materialcode   = $data['materialcode'];

            $data['filtermaterialdetails'] = array_values(array_filter($data['materialdetails'], "filtermaterialdetails"));

            //echo "<pre />"; print_r($data['filtermaterialdetails']); 
            //exit();

            $data['head']       = $this->load->view('template/head', $data, true);
            $data['header']     = $this->load->view('template/header', $data, true);
            $data['menu']       = $this->load->view('template/menu', $data, true);
            $data['content']    = $this->load->view('dashboard/materialdetailsreport', $data, true);
            $data['footer']     = $this->load->view('template/footer', $data, true);

            $this->load->view('dashboard', $data);
    }


    public function materialdetailsexport(){
        global $businesscode;
        global $location;
        global $alertgroup;
        global $materialcode;

        $data = '';
        $data['userid']         = $this->session->userdata('userid');
        $data['emp_name']       = $this->session->userdata('emp_name');
        $data['designation']    = $this->session->userdata('designation');
        $data['usertype']       = $this->session->userdata('usertype');
        $data['datefrom']       = $this->uri->segment(3);
        $data['dateto']         = $this->uri->segment(4);
        $data['businesscode']   = $this->uri->segment(5);
        $data['location']       = $this->input->get('location', TRUE);
        $data['aleartgroup']    = $this->input->get('alertgroup', TRUE);//
        $data['materialcode']   = $this->input->get('materialcode', TRUE);//alertgroup$this->uri->segment(6);

        $return = $this->dashboard->doLoadDBDataMaterialDetails($data['datefrom'], $data['dateto'], $data['materialcode'], $data['userid']);
            $data['materialdetails']    = $return['materialdetails'];          
//echo "<pre />"; print_r($data['materialdetails']);
            function filtermaterialdetails($val){
                global $businesscode;
                global $location;
                global $alertgroup;
                global $materialcode;

                if($val['BusinessCode'] == $businesscode 
                    && $val['LocationName'] ==  $location
                    && $val['Penetration_Group'] == $alertgroup
                    && $val['MaterialCode'] == $materialcode
                ){
                    return true; 
                }else{
                    return false;  
                }
            }
            

            $businesscode   = $data['businesscode'];
            $location       = $data['location'];
            $alertgroup     = $data['aleartgroup'];
            $materialcode   = $data['materialcode'];

            $data['filtermaterialdetails'] = array_values(array_filter($data['materialdetails'], "filtermaterialdetails"));
            //var_dump($data['filtermaterialdetails']); exit();
            $filename = $location.'_'.$alertgroup.'_'.$materialcode;
            $this->exportexcel($data['filtermaterialdetails'], $filename);
    }
    
}
?>