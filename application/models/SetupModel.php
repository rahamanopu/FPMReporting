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
}

?>