<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Setup extends MY_Controller {
    private $ajaxDataLimit= 'ajaxDataLimit';
    private $limit = 25;
    private $ajaxDataLoadUrl = 'ajaxDataLoadUrl';
    function __construct() {
        parent::__construct();
        $this->load->model('CommonModel', 'common');
        $this->load->model('setupModel');
		$this->load->model('ReportModel');
    }

    /**
     * show view Level page
     * @param string $level
     */
    public function viewLevel($level = '') {
        $data = [];
        if($level == '') {
            $data['level'] = $level = 'level4';
        } else {
            $data['level'] = strtolower($level);
        }
        $setupModel = new SetupModel();
        $data['level_info_list'] = $setupModel->getLevelInfo($level);
        $this->loadView('setup/level_view',$data);
    }

    /**
     * show Level add and edit Page
     * @param $level
     * @param string $levelId
     */
    public function addLevel($level,$levelId = '') {
        $data = [];
        $data['level'] = $level = strtolower($level);
        $data['businesses'] = $this->common->getBusiness();
        $data['departments'] = $this->common->getDepartment();
        $data['supervisor_level'] = '';
        $setupModel = new SetupModel();
        $data['supervisorLevel'] ='';
        if('level4' != $level) {
        $data['supervisorLevel'] = $this->getSupervisorLevel($level);

            $data['supervisors'] = $setupModel->getSupervisor($data['supervisorLevel']);
        }
        $data['isEdit'] = 0;
        $data['levelInfo'] = [];
        $data['pageTitle'] = ucfirst($level)." Add";
        if($levelId !='') {
            $data['isEdit'] = 1;
            $data['levelInfo'] = $setupModel->getLevelInfo($level,$levelId);
            $data['pageTitle'] = ucfirst($level)." Update";
        }
        $this->loadView('setup/level_add',$data);
    }

    /**
     * Store and update Level data
     * @return mixed
     */
    public function storeLevel() {
        $level = $this->input->post('level');
        $supervisorLevel = $this->input->post('supervisorLevel');
        $isEdit = $this->input->post('isEdit');
        $levelId = $this->input->post('levelId');
        if(isset($_POST)) {
            $data = [
                $level =>trim($this->input->post('levelCode')),
                $level.'Name' => trim($this->input->post('fullName')),
                'Base' => trim($this->input->post('base')),
                'Designation' => trim($this->input->post('designation')),
                'StaffId' => trim($this->input->post('staffId')),
                'Business' => trim($this->input->post('business')),
                'Active' => trim($this->input->post('active')),
                'DepartmentID' => trim($this->input->post('department')),
                'MobileNo' => trim($this->input->post('mobileNo')),
                'EmailAddress' => trim($this->input->post('emailAddress')),
            ];
            if($level != 'level4') {
                $data[$supervisorLevel] = trim($this->input->post('supervisor'));
            }
            if($isEdit) {
                $data['EditedBy'] = $this->session->userdata('userid');
                $data['EditedDate'] = date('Y-m-d H:i:s');
                $data['EditedIpAddress'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
                $data['EditedDiviceState'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

                $status = $this->db->update($level,$data,[$level=>$levelId]);
                if($status) {
                    setFlashMsg("Successfully Updated");
                }
            } else {
                $data['EntryBy'] = $this->session->userdata('userid');
                $data['EntryDate'] = date('Y-m-d H:i:s');
                $data['EntryIpAddress'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
                $data['EntryDiviceState'] = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

                $status = $this->db->insert($level,$data);
                if($status) {
                    setFlashMsg("Successfully Added");
                }
            }
        }
        return redirect('setup/view-level/'.$level);
    }


    /**
     * get Supervisor Level
     * eg: if $level is 'Level1' then supervisor Level is 'Level2'
     * @param $level
     * @return string
     */
    private function getSupervisorLevel($level)
    {
        $supervisorLevel = '';
        switch ($level) {
            case 'level1' :
                $supervisorLevel = 'Level2';
                break;
            case 'level2' :
                $supervisorLevel = 'Level3';
                break;
            case 'level3' :
                $supervisorLevel = 'Level4';
                break;
        }
        return $supervisorLevel;
    }

    public function distributor() {
        $data = [];
        $data[$this->ajaxDataLimit] = $this->limit;
        $data[$this->ajaxDataLoadUrl] = base_url().'setup/distributor-data';
        $this->loadView('setup/distributor',$data);
    }

    public function distributorData() {
        $setupModel = new SetupModel();
        $result = $setupModel->getDistributorList();
        $data = [];
        foreach ($result['rows'] as $row) {
            $subArray = [];
            foreach ($row as $key) {
                $subArray[] = $key;
            }
//            $subArray[] = $row['Zone'];
//            $subArray[] = $row['Territory'];
//            $subArray[] = $row['District'];
//            $subArray[] = $row['DistributorPoint'];
//            $subArray[] = $row['DistributorCode'];
//            $subArray[] = $row['DistributorName'];
//            $subArray[] = $row['DistributorType'];
//            $subArray[] = $row['ProprietorName'];
//            $subArray[] = $row['Address'];
//            $subArray[] = $row['ContactNO'];
//            $subArray[] = $row['TSIID'];
//            $subArray[] = $row['TSIName'];
//            $subArray[] = $row['ICID'];
//            $subArray[] = $row['ICName'];

            $data[] = $subArray;
        }
        echo json_encode($this->prepareDataTableOutput($data,$result['count']));
    }

    public function product() {
        $data = [];
        $data[$this->ajaxDataLimit] = $this->limit;
        $data['ajaxDataLoadUrl'] = base_url().'setup/product-data';
        $this->loadView('setup/product',$data);
    }
    public function productData() {
        $setupModel = new SetupModel();
        $result = $setupModel->getProductList();
        $data = [];
        foreach ($result['rows'] as $row) {
            $subArray = [];
            // dynamically add column
            foreach ($row as $key) {
                $subArray[] = $key;
            }            
            $subArray[] = "<a href='".base_url()."setup/product-add/".$row['ProductCode']."' class='btn btn-sm btn-info'><i class='fa fa-edit'> Edit</a>";

        

            $data[] = $subArray;
        }
        echo json_encode($this->prepareDataTableOutput($data,$result['count']));
    }

    /**
     * show entry form
     */
    public function plant($plantId ='') {
        $data = [];
        $setupModel = new SetupModel();
        $data['distributors'] = $setupModel->getDistributorList();
        $data['pageTitle'] = "Plant Entry";
        if($plantId!='') {
            $data['plant'] = $setupModel->getPlantData($plantId);
            $data['pageTitle'] = "Plant Edit";
        }

        $data[$this->ajaxDataLimit] = $this->limit;
        $data[$this->ajaxDataLoadUrl] = base_url().'setup/plant-data';
//        echo "<pre>",print_r($data['distributors']);die();
        $this->loadView('setup/plant',$data);
    }
    public function plantData() {
        $setupModel = new SetupModel();
        $result = $setupModel->getPlantData();
        $data = [];
        foreach ($result['rows'] as $row) {
            $subArray = [];
            $subArray[] = $row['PlantShortName'];
            $subArray[] = $row['PlantName'];
            $subArray[] = $row['PlantAddress'];
            $subArray[] = $row['PlantAdmin'];
            $subArray[] = $row['DistributorCode'];
            $subArray[] = $row['PlantType'];
            $subArray[] = $row['PlantCodeSAP'];
            $subArray[] = $row['DistributorPoint'];
            $subArray[] = $row['DistributorName'];
            $subArray[] = "<a href='".base_url()."setup/plant/".$row['PlantID']."' class='btn btn-sm btn-info'><i class='fa fa-edit'> Edit</a>";

            $data[] = $subArray;
        }
        echo json_encode($this->prepareDataTableOutput($data,$result['count']));
    }

    // To add Product

    public function addProduct($productCode='') {   
        $setupModel = new SetupModel();     
        if (!empty($_POST)) {
            $productCode =  trim($this->input->post('ExistingProductCode'));
            $newProductCode = trim($this->input->post('ProductCode'));

            if($productCode =='' && !empty($setupModel->getProductByCode($newProductCode))) {
                setFlashMsg("Product Already Exist with this Product Code: ".$newProductCode,'error');
                return redirect('setup/product-add');
                
            }
            $dataToAdd['ProductCode'] = $newProductCode;
            $dataToAdd['ProductCodeSystem'] = trim($this->input->post('ProductCodeSystem'));
            $dataToAdd['SMSCODE'] = trim($this->input->post('SMSCODE'));
            $dataToAdd['ProductName'] = trim($this->input->post('ProductName'));
            $dataToAdd['Capacity'] = trim($this->input->post('Capacity'));
            $dataToAdd['BrandCode'] = trim($this->input->post('BrandCode'));
            $dataToAdd['EmptyDealerUnitPrice'] = trim($this->input->post('EmptyDealerUnitPrice'));
            $dataToAdd['EmptyDealerVAT'] = trim($this->input->post('EmptyDealerVAT'));
            $dataToAdd['EmptyRetailerUnitPrice'] = trim($this->input->post('EmptyRetailerUnitPrice'));
            $dataToAdd['EmptyRetailerVAT'] = trim($this->input->post('EmptyRetailerVAT'));
            $dataToAdd['EmptyMRP'] = trim($this->input->post('EmptyMRP'));
            $dataToAdd['PakageDealerUnitPrice'] = trim($this->input->post('PakageDealerUnitPrice'));
            $dataToAdd['PakageDealerVAT'] = trim($this->input->post('PakageDealerVAT'));
            $dataToAdd['PakageRetailerUnitPrice'] = trim($this->input->post('PakageRetailerUnitPrice'));
            $dataToAdd['PakageRetailerVAT'] = trim($this->input->post('PakageRetailerVAT'));
            $dataToAdd['PakageMRP'] = trim($this->input->post('PakageMRP'));
            $dataToAdd['RefillDealerUnitPrice'] = trim($this->input->post('RefillDealerUnitPrice'));
            $dataToAdd['RefillDealerVAT'] = trim($this->input->post('RefillDealerVAT'));
            $dataToAdd['RefillRetailerUnitPrice'] = trim($this->input->post('RefillRetailerUnitPrice'));
            $dataToAdd['RefillRetailerVAT'] = trim($this->input->post('RefillRetailerVAT'));
            $dataToAdd['RefillMRP'] = trim($this->input->post('RefillMRP'));
            $dataToAdd['Business'] = trim($this->input->post('Business'));
            $dataToAdd['Active'] = trim($this->input->post('Active'));

            if ($productCode !='') {
                $dataToAdd['EditedBy']= $this->session->userdata('userid');
                $dataToAdd['EditedDate']= date('Y-m-d H:i:s');
                $dataToAdd['EditedIpAddress']= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
                $dataToAdd['EditedDeviceState']= isset($_SERVER['HTTP_USER_AGENT']) ?  $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

                $status = $this->db->update('Product', $dataToAdd, ['ProductCode'=> $productCode]);
                if ($status) {
                    setFlashMsg("Updated Successfully");
                    return redirect('setup/product');
                }
                setFlashMsg("Failed to Updated","error");
                return redirect('setup/product-add/'.$productCode);
            } else {
                $dataToAdd['EntryBy']= $this->session->userdata('userid');
                $dataToAdd['EntryDate']= date('Y-m-d H:i:s');
                $dataToAdd['EntryIpAddress']= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
                $dataToAdd['EntryDeviceState']= isset($_SERVER['HTTP_USER_AGENT']) ?  $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

                $status = $this->db->insert('Product', $dataToAdd);
                if ($status) {
                    setFlashMsg("Added Successfully");
                }
            }
            return redirect('setup/product-add');
            
        }
        $data = [];
        $data['businesses'] = $setupModel->getBusiness();
        $data['brands'] = $setupModel->getProductBrand();
        // echo '<pre>',print_r($data['brands']);die();
        $data['pageTitle'] = "Product Entry";
        if($productCode!='') {
            $data['product'] = $setupModel->getProductByCode($productCode);
            $data['pageTitle'] = "Product Edit";
        }

        $this->loadView('setup/product_add',$data);
    }


    public function addPlant() {
//        echo "<pre>",print_r($_POST);die();
        $plantId = trim($this->input->post('plantId'));
        $data = [
        'PlantShortName' => trim($this->input->post('plantShortName')),
        'PlantName' => trim($this->input->post('plantName')),
        'PlantAdmin' => trim($this->input->post('plantAdmin')),
        'DistributorCode' => trim($this->input->post('distributorCode')),
        'PlantType' => trim($this->input->post('plantType')),
        'PlantCodeSAP' => trim($this->input->post('plantCodeSAP')),
        'Active' => trim($this->input->post('active')),
        'PlantAddress' => trim($this->input->post('plantAddress')),
        ];
        if($plantId !='') {
            $data['EditedBy']= $this->session->userdata('userid');
            $data['EditedDate']= date('Y-m-d H:i:s');
            $data['EditedIpAddress']= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
            $data['EditedDeviceState']= isset($_SERVER['HTTP_USER_AGENT']) ?  $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

            $status = $this->db->update('Plant',$data,['PlantID'=> $plantId]);
            if($status) {
                setFlashMsg("Updated Successfully");
            }
        } else {
            $data['EntryBy']= $this->session->userdata('userid');
            $data['EntryDate']= date('Y-m-d H:i:s');
            $data['EntryIpAddress']= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
            $data['EntryDeviceState']= isset($_SERVER['HTTP_USER_AGENT']) ?  $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

            $status = $this->db->insert('Plant',$data);
            if($status) {
                setFlashMsg("Added Successfully");
            }
        }
        return redirect('setup/plant');
    }

    /**
     * show entry form
     */
    public function department($departmentId ='') {
        $data = [];
        $setupModel = new SetupModel();
        $data['pageTitle'] = "Department Entry";
        if($departmentId!='') {
            $data['department'] = $setupModel->getDepartmentData($departmentId);
            $data['pageTitle'] = "Department Edit";
        }

        $data[$this->ajaxDataLimit] = $this->limit;
        $data[$this->ajaxDataLoadUrl] = base_url().'setup/department-data';
//        echo "<pre>",print_r($data['distributors']);die();
        $this->loadView('setup/department',$data);
    }
    public function departmentData() {
        $setupModel = new SetupModel();
        $result = $setupModel->getDepartmentData();
        $data = [];
        foreach ($result['rows'] as $key => $row) {
            $subArray = [];
            $subArray[] = $key+1;
            $subArray[] = $row['DepartmentName'];
            $subArray[] = "<a href='".base_url()."setup/department/".$row['DepartmentID']."' class='btn btn-sm btn-info'><i class='fa fa-edit'> Edit</a>";

            $data[] = $subArray;
        }
        echo json_encode($this->prepareDataTableOutput($data,$result['count']));
    }

    public function addDepartment() {
//        echo "<pre>",print_r($_POST);die();
        $departmentId = trim($this->input->post('departmentId'));
        $data = [
            'DepartmentName' => trim($this->input->post('departmentName')),
        ];
        if($departmentId !='') {
            $status = $this->db->update('Department',$data,['DepartmentID'=> $departmentId]);
            if($status) {
                setFlashMsg("Updated Successfully");
            }
        } else {
            $status = $this->db->insert('Department',$data);
            if($status) {
                setFlashMsg("Added Successfully");
            }
        }
        return redirect('setup/department');
    }


    function appUpload() {
        $data = array();
        $data['userid'] = $this->session->userdata('userid');
        if($data['userid'] == 'admin'){
            $this->loadView('appupload', $data);
        }
    } 
    
    public function submitUpload()
    {
        $data = array();
        $data['userid'] = $this->session->userdata('userid');
        if($data['userid'] == 'admin'){
            
            $new_name = 'TSI.apk';
            if($_FILES['userfile']['type'] == 'application/vnd.android.package-archive' || $_FILES['userfile']['type'] == 'application/octet-stream' ){
                $config['upload_path']          = 'uploads/apk/';
                $config['allowed_types']        = '*';
                $config['file_name']            = $new_name;
                $config['overwrite']            = true;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error); exit();
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    setFlashMsg("APK Upload Successful");
                    $this->session->set_userdata(['apk_file_path'=> base_url().'uploads/apk/'.$new_name]);
                    return redirect('app-upload','refresh');
                    
                }
            }else{
                echo "invalid file.";
            }
        }
    }

    public function expenseList() {
        $data['action'] = 'setup/expenseList';
        $data['pageTitel'] = 'Expense List';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');
        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        $this->load->model('common_data');
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
            
            $setupModel = new SetupModel();
            
            // $datas = $reportModel->getdistributorExpense($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
            $datas = $setupModel->getExpenseList($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
            $data['expenses'] = $datas['priorityData'];                                          
        }
//         echo '<pre>',print_r($data['expenses']);die();

        $this->loadView('setup/expense_list',$data);
        
    }
	
	
	public function tourplanlist() {
        $data['action'] = 'setup/tourplanlist';
        $data['pageTitel'] = 'Tour Plan Delete';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');
        $data['showDateToField'] = true;       
        $data['showDateFromField'] = true;
       
        $this->load->model('common_data');
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        $this->load->model('CommonModel');
        $commonModel = new CommonModel();

        $data['expenseTypeHeadField']= false;
        $data['expenseTypeSubHeadField']= false;
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
            
            // $datas = $reportModel->getdistributorExpense($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
            $datas = $reportModel->getTourplanReport($data['regioncode'],$data['areacode'],$data['fmecode'],$data['startDate'], $data['endDate']);
				$data['expenses'] = $datas['priorityData'];                                          
        }
         //echo '<pre>',print_r($data['expenses']);die();

        $this->loadView('setup/tourplanlist',$data);
        
    }
	
	public function deletetourplan(){
		$tourplanid = $this->input->post('tourplanid', true);
		$setupModel = new SetupModel();
		$return = $setupModel->doDeleteTourPlan($tourplanid);
		echo json_encode($return);
	}
	
	public function retailerlist() {
        $data['action'] = 'setup/retailerlist';
        $data['pageTitel'] = 'Retailer edit';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');       
        $userlevel = $this->session->userdata('userLevel');
        $data['showDateToField'] = false;       
        $data['showDateFromField'] = false;
       
        $this->load->model('common_data');
        $commonData = new Common_data();
        $data['regions'] = $commonData->getUserRegion($userlevel, $data['levelCode']);

        $this->load->model('CommonModel');
        $commonModel = new CommonModel();

		$data['showDistributorField']= true;
        $data['expenseTypeHeadField']= false;
        $data['expenseTypeSubHeadField']= false;
        $data['expenseTypeHeads']= $commonModel->getExpenseTypeHead();
        $data['expenseTypeSubHeads']= $commonModel->getExpenseTypeSubHead();   
        $data['expenseTypeHead'] = '';
        $data['expenseTypeSubHead'] = '';
        $data['pagelimit']  	= 1000;
		if(!empty($this->input->get_post('page'))){
			$data['page'] = $this->input->get_post('page');
		}else{
			$data['page'] = 1;
		}

        if (!empty($_POST) OR ! empty($_GET)) { 
            $data['imageFolder'] = 'uploads/expense/'; 
            $data['expenseTypeHead'] = $this->input->get_post('expenseTypeHead');
            $data['expenseTypeSubHead'] = $this->input->get_post('expenseTypeSubHead');
            $data['startDate'] = $this->input->get_post('startDate');
            $data['endDate'] = $this->input->get_post('endDate');
			$data['distributorcode'] = $this->input->get_post('distributorcode');
            $data['period'] = '';

            $data['regioncode'] = $this->input->get_post("regioncode", TRUE);
            $data['areacode'] = $this->input->get_post("areacode", TRUE);
            $data['fmecode'] = $this->input->get_post("fmecode", TRUE);           

            $data['areainfo'] = $this->common_data->getUserArea($data['regioncode'], $userlevel, $data['levelCode']);
            $data['fmelist'] = $this->common_data->getUserTerritory($data['areacode'], $userlevel, $data['levelCode']);
            if(!empty($data['fmecode'])){
				$data['distributorlist'] 	= $this->common_data->getUserDistributor($data['fmecode']);
			}
            $reportModel = new ReportModel();
            
            // $datas = $reportModel->getdistributorExpense($data['regioncode'], $data['areacode'], $data['fmecode'], $data['expenseTypeHead'],$data['expenseTypeSubHead'],$data['startDate'],$data['endDate']);
            $datas = $reportModel->getRetailers($data['regioncode'], $data['areacode'], $data['fmecode'], 
				$data['pagelimit'], $data['page'], $data['distributorcode']);
				$data['expenses'] 	= $datas['priorityData'];    
				$data['pagingData'] = $datas['pagingData'];    
        }
         //echo '<pre>',print_r($data['expenses']);die();

        $this->loadView('setup/retailerlist',$data);
        
    }
	
	public function retailerEdit($retailerId) {
        $data['action'] = 'setup/retailerUpdate';
        $data['pageTitel'] = 'Retailer Edit';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');

        
        $setupModel = new setupModel();
        $data['retailer'] = $setupModel->getRetailer($retailerId);    
        $data['distributors'] = $this->setupModel->getDistributor($data['retailer']['EntryBy']);   
		$data['retailertype'] = $this->setupModel->getRetailerType();		
        //echo '<pre>'; print_r($data['retailer']);die();
        $this->loadView('setup/retailer_edit',$data);
    }

    public function retailerUpdate() {
        $retailerID =  $this->input->post('RetailerID');
        $dataToUpdate['RetailerName'] = $this->input->post('RetailerName');
        $dataToUpdate['RetailerContactNumber'] = $this->input->post('RetailerContactNumber');
        $dataToUpdate['DistributorCode'] = $this->input->post('DistributorCode');
        $dataToUpdate['Remarks'] = $this->input->post('Remarks');
		
		$dataToUpdate['RetailerTypeID'] = $this->input->post('RetailerType');
		$dataToUpdate['RetailerContactNumber'] = $this->input->post('RetailerContactNumber');
		$dataToUpdate['RetailerAddress'] = $this->input->post('RetailerAddress');
		$dataToUpdate['RetailerContactPerson'] = $this->input->post('RetailerContactPerson');
		$dataToUpdate['ProprietorName'] = $this->input->post('ProprietorName');
		
        $status = $this->db->update('Retailer',$dataToUpdate,['RetailerID' => $retailerID]);
        if($status){
            setFlashMsg('Updated Successfully');
        } else {
            setFlashMsg('Something Went Wrong','error');
        }
        return  redirect('setup/retailerEdit/'.$retailerID);

    }
	
    public function expneseEdit($expenseId, $expenseDetailsId) {
        $data['action'] = 'setup/expenseUpdate';
        $data['pageTitel'] = 'Expense Edit';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');

        $sql = "select * from ExpenseMaster EM
                left join ExpenseDetails ED on ED.ExpenseID = EM.ExpenseId        
                where EM.ExpenseId='$expenseId' and ED.ExpenseDetailsID='$expenseDetailsId'";
        $query = $this->db->query($sql);
        if($query && !empty($result=$query->result_array())) {
            $data['expense'] =  $result[0];
        }
        
        $data['distributors'] = $this->setupModel->getDistributor($data['expense']['EmpCode']);
        $data['expenseTransports'] = $this->setupModel->getExpenseTransport();
        // echo '<pre>',print_r($data['expenseTransports']);die();
        $this->loadView('setup/expense_edit',$data);
    }

    public function expenseUpdate() {
        $expenseId = $this->input->post('ExpenseId');
        $expenseDetailsId = $this->input->post('ExpenseDetailsID');
        $expenseDate = $this->input->post('ExpenseDate');
        
        // Expense Master
        $dataMaster['EmpName'] = $this->input->post('EmpName');
        $dataMaster['UserLevel'] = $this->input->post('UserLevel');
        $dataMaster['LevelCode'] = $this->input->post('LevelCode');
        $dataMaster['Period'] = date('Ym', strtotime($expenseDate));
        $dataMaster['EditDate'] = date('Y-m-d H:i:s');
        $dataMaster['EditBy'] = $this->session->userdata('userid');        

        //************ */ Expense Details *************//
        $dataDetails['ExpenseDate'] = $expenseDate;
        if(isset($_POST['Amount'])) {
            $dataDetails['Amount'] = $this->input->post('Amount');
        }
        if(isset($_POST['Remarks'])) {
            $dataDetails['Remarks'] = $this->input->post('Remarks');
        }

        // DA
        if(isset($_POST['DAExpType'])) {
            $dataDetails['DAExpType'] = $this->input->post('DAExpType');
        }
        if(isset($_POST['LocationFrom'])) {
            $dataDetails['LocationFrom'] = $this->input->post('LocationFrom');
        }
        if(isset($_POST['DistributorCode'])) {
            $dataDetails['DistributorCode'] = $this->input->post('DistributorCode');
        }

        if(isset($_POST['Place'])) {
            $dataDetails['Place'] = $this->input->post('Place');
        }
        if(isset($_POST['TypeOfWork'])) {
            $dataDetails['TypeOfWork'] = $this->input->post('TypeOfWork');
        }
        if(isset($_POST['StartDate'])) {
            $dataDetails['StartDate'] = $this->input->post('StartDate');
        }
        if(isset($_POST['EndDate'])) {
            $dataDetails['EndDate'] = $this->input->post('EndDate');
        }
        

        if(isset($_POST['SeniorNameVisitedWith'])) {
            $dataDetails['SeniorNameVisitedWith'] = $this->input->post('SeniorNameVisitedWith');
        }
        // TA
        if(isset($_POST['LocationFrom'])) {
            $dataDetails['LocationFrom'] = $this->input->post('LocationFrom');
        }
        if(isset($_POST['LocationTo'])) {
            $dataDetails['LocationTo'] = $this->input->post('LocationTo');
        }
        if(isset($_POST['ExpseneTransportID'])) {
            $dataDetails['ExpseneTransportID'] = $this->input->post('ExpseneTransportID');
        }
        if(isset($_POST['PurposeOfTransport'])) {
            $dataDetails['PurposeOfTransport'] = $this->input->post('PurposeOfTransport');
        }
        if(isset($_POST['ContactPersonName'])) {
            $dataDetails['ContactPersonName'] = $this->input->post('ContactPersonName');
        }
        if(isset($_POST['ContactPersonMobile'])) {
            $dataDetails['ContactPersonMobile'] = $this->input->post('ContactPersonMobile');
        }

        // Accumodation Cost
        if(isset($_POST['HotelName'])) {
            $dataDetails['HotelName'] = $this->input->post('HotelName');
        }
        if(isset($_POST['HotelPlace'])) {
            $dataDetails['HotelPlace'] = $this->input->post('HotelPlace');
        }
        if($this->input->post('NightStatyFrom')) {
            $dataDetails['NightStatyFrom'] = $this->input->post('NightStatyFrom');
        }
        if(isset($_POST['NightStayTo'])) {
            $dataDetails['NightStayTo'] = $this->input->post('NightStayTo');
        }
        if(isset($_POST['Purpose'])) {
            $dataDetails['Purpose'] = $this->input->post('Purpose');
        }
        
        //  when Expense type in ['PhotoCopy','Courier Bill','Print','Other']
        if(isset($_POST['Purpose'])) {
            $dataDetails['Purpose'] = $this->input->post('Purpose');
        }

        $dataDetails['EditBy'] = $this->session->userdata('userid');;
        $dataDetails['EditDate'] = date('Y-m-d H:i:s');




        // Updating Expense Details        
        $this->db->update('ExpenseDetails',$dataDetails, ['ExpenseId'=> $expenseId,'ExpenseDetailsID'=> $expenseDetailsId]);
        // echo '<pre>',var_dump($this->db->last_query());die();

        // Updating Expense  Master
        $sql = "select ED.Amount from ExpenseMaster EM
                left join ExpenseDetails ED on ED.ExpenseID = EM.ExpenseId        
                where EM.ExpenseId='$expenseId'";
        $query = $this->db->query($sql);
        if($query && !empty($result=$query->result_array())) {
            $dataMaster['TotalAmount'] = array_sum( array_column($result,'Amount') ) ;
        }

        $status = $this->db->update('ExpenseMaster',$dataMaster,['ExpenseId'=> $expenseId]);
        if($result) {
            setFlashMsg('Updated Successfully');
        } else {
            setFlashMsg('Something Went Wrong','error');
        }
        return  redirect('setup/expneseEdit/'.$expenseId.'/'.$expenseDetailsId);
        
        
    }

    public function thana($thanaId ='') {
        $data = [];
        $setupModel = new SetupModel();
        $data['districts'] = $setupModel->getDistrictList();
        $data['pageTitle'] = "Thana Entry";
        if($thanaId!='') {
            $data['thana'] = $setupModel->getThanaData($thanaId);
            $data['pageTitle'] = "Thana Edit";
        }

        $data[$this->ajaxDataLimit] = $this->limit;
        $data[$this->ajaxDataLoadUrl] = base_url().'setup/thana-data';
//        echo "<pre>",print_r($data['distributors']);die();
        $this->loadView('setup/thana',$data);
    }
    public function thanaData() {
        $setupModel = new SetupModel();
        $result = $setupModel->getThanaData();
        $data = [];
        foreach ($result['rows'] as $row) {
            $subArray = [];
            
            $subArray[] = $row['UpazilaName'];
            $subArray[] = $row['DistrictName'];
            
            $subArray[] = "<a href='".base_url()."setup/thana/".$row['UpazilaCode']."' class='btn btn-sm btn-info'><i class='fa fa-edit'> Edit</a>";

            $data[] = $subArray;
        }
        echo json_encode($this->prepareDataTableOutput($data,$result['count']));
    }

    public function addThana() {
        //        echo "<pre>",print_r($_POST);die();
        
        $upazilaCode = trim($this->input->post('UpazilaCode'));
        $districtCode = trim($this->input->post('DistrictCode'));
        $data = [
            'UpazilaName' => trim($this->input->post('UpazilaName')),
            'DistrictCode' => $districtCode,        
        ];
    
        if($upazilaCode !='') {
            // $data['EditedBy']= $this->session->userdata('userid');
            // $data['EditedDate']= date('Y-m-d H:i:s');
            // $data['EditedIpAddress']= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
            // $data['EditedDeviceState']= isset($_SERVER['HTTP_USER_AGENT']) ?  $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

            $status = $this->db->update('Upazila',$data,['UpazilaCode'=> $upazilaCode]);
            if($status) {
                setFlashMsg("Updated Successfully");
            }
        } else {
            // $data['EntryBy']= $this->session->userdata('userid');
            // $data['EntryDate']= date('Y-m-d H:i:s');
            // $data['EntryIpAddress']= isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
            // $data['EntryDeviceState']= isset($_SERVER['HTTP_USER_AGENT']) ?  $_SERVER['HTTP_USER_AGENT'] : 'Unknown';

            $sql = "SELECT M.UpazilaCode FROM (
                SELECT L.UpazilaCode, ROW_NUMBER() OVER (ORDER BY L.UpazilaCode) AS SL FROM (
                SELECT '$districtCode'+FORMAT(ROW_NUMBER() OVER (ORDER BY UpazilaCode),'00') AS UpazilaCode
                FROM Upazila WHERE DistrictCode = '$districtCode') L
                LEFT JOIN (SELECT UpazilaCode FROM Upazila WHERE DistrictCode = '$districtCode') R
                    ON L.UpazilaCode= R.UpazilaCode
                    WHERE R.UpazilaCode IS NULL) M
                WHERE M.SL=1";
                    
            $query = $this->db->query($sql);
            
            if($query && !empty($result = $query->result_array())) {                
                $data['UpazilaCode'] = $result[0]['UpazilaCode'];
            }   

            $status = $this->db->insert('Upazila',$data);
            if($status) {
                setFlashMsg("Added Successfully");
            }
        }
        return redirect('setup/thana');
    }

}
?>