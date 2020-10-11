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
                $level =>trim($this->input->post('staffId')),
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
}
?>