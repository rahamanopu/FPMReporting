<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SetupModel extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    public function getLevelInfo($level,$levelId = ''){
        $level = ucfirst($level);
        $sql = "select * from $level";
        if($levelId !='') {
            $sql .=" where $level='$levelId'";
            $query = $this->db->query($sql);
            if($query) {
                return !empty($result = $query->result_array()) ? $result[0] : [];
            }
        }
        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return false;
    }

    public function getSupervisor($level)
    {
        $sql = "select $level,$level"."Name from $level";
        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return false;
    }

    public function getDistributorList()
    {
        $sql = "select * from Distributor ";
        $searchString = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
//        searching
        if($searchString !='') {
            $sql .=" where ";
            $sql .=" Zone like '%".$searchString."%'";
            $sql .= " or District like '%".$searchString."%'";
            $sql .= " or DistributorPoint like '%".$searchString."%'";
            $sql .= " or DistributorCode like '%".$searchString."%'";
            $sql .= " or DistributorName like '%".$searchString."%'";
            $sql .= " or ProprietorName like '%".$searchString."%'";
            $sql .= " or Address like '%".$searchString."%'";
            $sql .= " or ContactNO like '%".$searchString."%'";
            $sql .= " or TSIID like '%".$searchString."%'";
            $sql .= " or TSIName like '%".$searchString."%'";
            $sql .= " or ICID like '%".$searchString."%'";
            $sql .= " or ICName like '%".$searchString."%'";
        }
        // ordering
        if(isset($_POST['order'])) {
            $orderByColumn = $_POST['order']['0']['column'] + 1;
            $orderByDirection = $_POST['order']['0']['dir'];
            $sql .=" order by $orderByColumn $orderByDirection";

        } else{
            // any one order is must, otherwise Pagination will not work
            $sql .= " order by 1 DESC";
        }

        return $this->fetchData($sql);
    }

    public function getDistributorByCode($distributorCode) {
        $sql = "select * from Distributor where DistributorCode='$distributorCode'";
        $query =  $this->db->query($sql);
        if($query && !empty($result = $query->result_array())) {
            return $result[0];
        }
        return [];
    }


    public function getProductByCode($productCode) {
        $sql = "select P.*  
                    from Product P
                    join Business B on B.Business = p.Business
                    join ProdBrand PB on P.BrandCode = PB.BrandCode
                    where ProductCode='$productCode'";
        $query =  $this->db->query($sql);
        if($query && !empty($result = $query->result_array())) {
            return $result[0];
        }
        return [];
    }
    public function getProductBrand(){
        $sql = "select * from ProdBrand";
        $query =  $this->db->query($sql);
        if($query){
            return $query->result_array();
        }
        return [];
    }
    
    public function getBusiness(){
        $sql = "select * from Business";
        $query =  $this->db->query($sql);
        if($query){
            return $query->result_array();
        }
        return [];
    }

    public function getProductList()
    {
        $sql = "select P.ProductCode, P.SMSCODE, P.ProductName,	P.Capacity,	P.BrandCode, P.PakageRetailerUnitPrice, P.PakageRetailerVAT, P.PakageMRP,PB.BrandName  
                    from Product P
                    join Business B on B.Business = p.Business
                    join ProdBrand PB on P.BrandCode = PB.BrandCode";
        $searchString = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
//        searching
        if($searchString !='') {
            $sql .=" where ";
            $sql .=" ProductCode like '%".$searchString."%'";
            $sql .= " or SMSCODE like '%".$searchString."%'";
            $sql .= " or ProductName like '%".$searchString."%'";
            $sql .= " or Capacity like '%".$searchString."%'";
            $sql .= " or BrandCode like '%".$searchString."%'";
            $sql .= " or BrandName like '%".$searchString."%'";
        }
        // ordering
        if(isset($_POST['order'])) {
            $orderByColumn = $_POST['order']['0']['column'] + 1;
            $orderByDirection = $_POST['order']['0']['dir'];
            $sql .=" order by $orderByColumn $orderByDirection";

        } else{
            // any one order is must, otherwise Pagination will not work
            $sql .= " order by 1 DESC";
        }

       return $this->fetchData($sql);
    }

    private function fetchData($sql) {
        if(isset($_POST["length"]) && $_POST["length"] != -1) {
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $sqlResult = $sql." offset $offset ROWS FETCH NEXT $limit ROWS ONLY";
        } else {
            $sqlResult = $sql;
        }

        $queryCount = $this->db->query($sql);
        $data = [
            'count' => 0,
            'rows' => [],
        ];
        if($queryCount) {
            $data['count'] = $queryCount->num_rows();
            $query = $this->db->query($sqlResult);
            $data['rows'] = $query->result_array();
        }
        return $data;
    }

    public function getPlantData($plantId = null)
    {
        $sql = "select P.*,D.DistributorPoint,DistributorName from Plant P
                left join Distributor D on P.DistributorCode = D.DistributorCode";

        // only for single row
        if($plantId !=null) {
            $sql .=" where PlantID='$plantId'";
            $query = $this->db->query($sql);
            if($query) {
                return !empty($result = $query->result_array()) ? $result[0] : [];
            }
            return false;
        }

        $searchString = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
//        searching
        if($searchString !='') {
            $sql .=" where ";
            $sql .=" P.PlantShortName like '%".$searchString."%'";
            $sql .= " or P.PlantName like '%".$searchString."%'";
            $sql .= " or P.PlantAddress like '%".$searchString."%'";
            $sql .= " or P.PlantAdmin like '%".$searchString."%'";
            $sql .= " or P.DistributorCode like '%".$searchString."%'";
            $sql .= " or P.PlantType like '%".$searchString."%'";
            $sql .= " or P.PlantCodeSAP like '%".$searchString."%'";
            $sql .= " or D.DistributorName like '%".$searchString."%'";
            $sql .= " or D.DistributorPoint like '%".$searchString."%'";
        }
        // ordering
        if(isset($_POST['order'])) {
            $orderByColumn = $_POST['order']['0']['column'] + 1;
            $orderByDirection = $_POST['order']['0']['dir'];
            $sql .=" order by $orderByColumn $orderByDirection";

        } else{
            // any one order is must, otherwise Pagination will not work
            $sql .= " order by 1 DESC";
        }
        // return data for datatable
        return $this->fetchData($sql);
    }

    public function getDepartmentData($departmentId = null)
    {
        $sql = "select * from Department D";

        // only for single row
        if($departmentId !=null) {
            $sql .=" where D.DepartmentID='$departmentId'";
            $query = $this->db->query($sql);
            if($query) {
                return !empty($result = $query->result_array()) ? $result[0] : [];
            }
            return false;
        }

        $searchString = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
//        searching
        if($searchString !='') {
            $sql .=" where ";
            $sql .=" D.DepartmentName like '%".$searchString."%'";
        }
        // ordering
        if(isset($_POST['order'])) {
            $orderByColumn = $_POST['order']['0']['column'] + 1;
            $orderByDirection = $_POST['order']['0']['dir'];
            $sql .=" order by $orderByColumn $orderByDirection";

        } else{
            // any one order is must, otherwise Pagination will not work
            $sql .= " order by 1 DESC";
        }
        // return data for datatable
        return $this->fetchData($sql);
    }

    public function getExpenseList($leve3,$level2,$level1,$expenseTypeHead, $expenseTypeSubHead,$startDate, $endDate){                 
        $sql = " EXEC usp_doLoadExpense  '$leve3','$level2','$level1','$expenseTypeHead', '$expenseTypeSubHead','$startDate', '$endDate' ";        
        $query = $this->db->query($sql);           
        $e = $this->db->_error_message();   
        $data = [];             
        if ($e == '') {
            $data['priorityData'] = $query->result_array();          
                                 
        }       
        return $data;
    }

    public function getDistributor($userid)
    {
        $sql ="select D.*, DL.Latitude, DL.Longitude from Distributor D
                left join DistributorLocation DL on DL.DistributorCode = D.DistributorCode
                where D.TSIID = '$userid'";

                // $sql ="select D.* from Distributor D WHERE TSIID = '$userid'";
        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return [];
    }

    public function getExpenseTransport()
    {
        $sql ="select * from ExpseneTransport";
        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return [];
    }
    /*
	public function getExpenseTransport()
    {
        $sql ="select * from ExpseneTransport";
        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return [];
    }*/
	
	public function doDeleteTourPlan($planid)
    {
        $sql ="exec usp_doDeleteTourPlan $planid ";
        $query = $this->db->query($sql);
        if($query) {
            return true;
        }else{
			return false;
		}
    }

    public function getRetailer($retailerId) {
        $sql = "select * from Retailer where RetailerID='$retailerId'";
        $query = $this->db->query($sql);
        if($query && !empty($result = $query->result_array())) {
            return $result[0];
        }
        return [];
    }
	
	public function getRetailerType(){		
        $sql = "   SELECT * FROM RetailerType ";            
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }
        return [];        
    }

    public function getThanaData($thanaId = null)
    {
        $sql = "select U.DistrictCode,U.UpazilaCode, U.UpazilaName, D.DistrictName from Upazila U left join District D
                on D.DistrictCode=U.DistrictCode";

        // only for single row
        if($thanaId !=null) {
            $sql .=" where UpazilaCode='$thanaId'";
            $query = $this->db->query($sql);
            if($query) {
                return !empty($result = $query->result_array()) ? $result[0] : [];
            }
            return false;
        }

        $searchString = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';
//        searching
        if($searchString !='') {
            $sql .=" where ";
            $sql .=" U.UpazilaName like '%".$searchString."%'";            
            $sql .=" Or D.DistrictName like '%".$searchString."%'";            
        }
        // ordering
        if(isset($_POST['order'])) {
            $orderByColumn = $_POST['order']['0']['column'] + 1;
            $orderByDirection = $_POST['order']['0']['dir'];
            $sql .=" order by $orderByColumn $orderByDirection";

        } else{
            // any one order is must, otherwise Pagination will not work
            $sql .= " order by DistrictCode";
        }
        // return data for datatable
        return $this->fetchData($sql);
    }

    public function getDistrictList() {
        $sql = "select * from District";
        $query =  $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return [];
    }

}

?>