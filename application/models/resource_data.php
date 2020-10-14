<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class resource_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function doLoadResourceCallBusiness($level1, $period, $brandcall = null) {
        $sql = "exec usp_doLoadResourceCallBusiness '$level1', '$period', '$brandcall' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['detailsdata'] = $query->result_array();
            $data['summerydata'] = $query->next_result();
        }
        return $data;
    }

    public function doLoadResourceDistribution($sbid, $level3, $level2, $level1, $period, $brandcall, $reportylevel, $reporttype) {
        $sql = "exec usp_doLoadResourceDistribution '$sbid', '$level3', '$level2', '$level1', 
            '$period', '$brandcall', '$reportylevel', '$reporttype' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['detailsdata'] = $query->result_array();
            //$data['summerydata'] = $query->next_result();
        }
        return $data;
    }
    
    public function doLoadResourceDistributionDetails($sbid, $level3, $level2, $level1, $period, $brandcall, $reportylevel, 
            $reportylevelcode, $reporttype, $pagelimit, $pagenumber) {
        $sql = "exec usp_doLoadResourceDistributionDetails '$sbid', '$level3', '$level2', '$level1', 
                    '$period', '$brandcall', '$reportylevel', '$reportylevelcode', '$reporttype',"
                . " '$pagelimit', '$pagenumber' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['detailsdata']    = $query->result_array();
            $data['pagingdata']     = $query->next_result();
        }
        return $data;
    }
    
    public function usp_doLoadResourcePlanVsExecute($sbid, $level3, $level2, $level1, $datefrom, $dateto,
            $brandcode, $reporttype, $pagelimit, $pagenumber) {
        $sql = "exec usp_doLoadResourcePlanVsExecute '$sbid', '$level3', '$level2', '$level1', 
                    '$datefrom', '$dateto', '$brandcode', '$reporttype',"
                . " '$pagelimit', '$pagenumber' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['detailsdata']    = $query->result_array();
            $data['pagingdata']     = $query->next_result();
        }
        return $data;
    }
    
    public function doLoadLevel1BrandWiseSalesDetails($level1, $period, $brandcode, $datefrom, $dateto) {
        $CI = & get_instance();
        $CI->db = $this->load->database('sm', true);

        $sql = "exec usp_doLoadLevel1BrandWiseSalesDetails '$level1', '$datefrom','$dateto','$period','$brandcode' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $rows = $query->result_array();
        }
        return $rows;
    }

    public function getAllocationResource($userid, $period) {
        $year = substr($period, 0, 4);
        $sql = "SELECT
                        'Gift' AS Category, 
                        PB.BrandName, 
                        G.ProductCode,
                        P.ProductName, 
                        GL.GiftName, 
                        G.GiftCode, 
                        G.Quantity
                FROM Gift G
                        INNER JOIN Product P
                                ON G.ProductCode = P.SMSCODE
                        INNER JOIN GiftList GL
                                ON GL.ProductCode = G.ProductCode AND GL.GiftCode = G.GiftCode AND GL.Years = LEFT(G.GiftPeriod,4)
                        INNER JOIN ProdBrand PB
                                ON P.BrandCode = PB.BrandCode
                WHERE Level1		= '$userid' 
                        AND GiftPeriod	= '$period'
                        AND Quantity	> 0
                        AND GL.Years	= '$year'
                        AND IsInstitute = 'N'
                UNION ALL
                SELECT
                        'PPM' AS Category, 
                        PB.BrandName,
                        L.ProductCode,
                        P.ProductName, 
                        LL.LiteratureName , 
                        L.LiteratureCode, 
                        L.Quantity
                FROM Literature L
                        INNER JOIN Product P
                                ON L.ProductCode = P.SMSCODE
                        INNER JOIN LiteratureList LL
                                ON LL.ProductCode = L.ProductCode AND LL.LiteratureCode = L.LiteratureCode AND LL.Years = LEFT(L.LiteraturePeriod,4)
                        INNER JOIN ProdBrand PB
                                ON P.BrandCode = PB.BrandCode
                WHERE Level1				= '$userid' 
                        AND LiteraturePeriod	= '$period'
                        AND Quantity			> 0
                        AND LL.Years			= '$year'
                        AND IsInstitute			= 'N'
                ORDER BY 1, 2, 5 
		";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }
    }

    public function doLoadLevel1ProductWiseCustomerDetails($datefrom, $dateto, $productcode, $level1, $reporttype) {
        $CI = & get_instance();
        $CI->db = $this->load->database('sm', true);

        $sql = "exec usp_doLoadLevel1ProductWiseCustomerDetails '$datefrom', '$dateto', '$productcode', '$level1','$reporttype' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $rows = $query->result_array();
        }
        return $rows;
    }

    public function doLoadLevel1BrandWiseHistoricalSalesDetails($datefrom, $dateto, $productcode, $level1) {
        $CI = & get_instance();
        $CI->db = $this->load->database('sm', true);

        $sql = "exec usp_doLoadLevel1BrandWiseHistoricalSalesDetails '$datefrom', '$dateto', '$productcode', '$level1' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $rows = $query->result_array();
        }
        return $rows;
    }

    public function doLoadBrandWiseRxDetails($brandcode, $level1, $datefrom, $dateto) {

        $sql = "exec usp_doLoadBrandWiseRxDetails '$brandcode', '$level1','$datefrom', '$dateto' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['rxsummery'] = $query->result_array();
            $data['rxdetails'] = $query->next_result();
            $data['dcrdetails'] = $query->next_result();
            $data['promoteddoctor'] = $query->next_result();
        }
        return $data;
    }

    public function doLoadResourceCallBusinessDoctorDetails($datefrom, $dateto, $level1, $brandcode, $giftcode, $literaturecode) {

        $sql = "exec usp_doLoadResourceCallBusinessDoctorDetails '$datefrom', '$dateto', '$level1', "
                . "'$brandcode', '$giftcode','$literaturecode' ";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $data['doctordetails'] = $query->result_array();
            //$data['doctordcrdetails'] = $query->next_result();
            $data['prescriptiondata'] = $query->next_result();
        }
        return $data;
    }

    public function doLoadLevel1brandWiseDoctorCallDetails($datefrom, $dateto, $brandcode, $level1, $doctorid) {
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);

        $sql = "SELECT 
                        ROW_NUMBER() OVER (ORDER BY D.DCRDate) CallNumber,
                        LEFT(D.DCRDate,6) DCRDate,
                        DATENAME(Weekday,D.DCRDate) WeekDayName,
                        CASE WHEN WP.PlanDay IS NULL THEN 'Unplancall' ELSE 'Plancall' END Calltype,
                        CASE	WHEN L.LiteratureName LIKE '%Showcard%' THEN 'Detailing'
                                WHEN L.LiteratureName LIKE '%Show card%' THEN 'Detailing'
                                        WHEN L.LiteratureName LIKE '%Hotpot%' THEN 'Detailing'
                                        WHEN L.LiteratureName LIKE '%Hot pot%' THEN 'Detailing'
                                        WHEN Promote = 'R' THEN 'Reminder' 
                                ELSE 'Reminder' 
                        END VisitType,
                        D.GiftCode,
                        ISNULL(G.GiftName, '') Gift_Name, 
                        D.GiftQty Gift_Qty,
                        D.LiteratureCode,
                        ISNULL(L.LiteratureName,'') Literature,
                        D.LiteratureQty Literature_Qty,
                        PB.BrandName
                FROM DCR D
                        INNER JOIN Product p
                                ON D.ProductCode = P.SMSCODE
                        INNER JOIN ProdBrand PB
                            ON P.BrandCode = PB.BrandCode
                        INNER JOIN Doctor DO
                                ON D.DoctorID = Do.DoctorId
                        INNER JOIN Speciality S
                                ON S.SpecialityID = DO.SpecialityID
                        LEFT JOIN WPMonthlyPlanner WP
                                ON D.Level1 = WP.Level1 AND D.Level2 = WP.Level2 AND D.Level3 = WP.Level3 AND WP.PlanDay = DAY(D.DCRDate) AND DCRPeriod = WP.Period AND WP.PlanBy = 'Level1' AND D.DoctorID = WP.DoctorId
                        LEFT JOIN GiftList G
                                ON D.GiftCode = G.GiftCode And D.ProductCode = G.ProductCode AND CONVERT(VARCHAR(4),D.DCRDate,112) = G.Years
                        LEFT JOIN LiteratureList L
                                ON D.LiteratureCode = L.LiteratureCode And D.ProductCode = L.ProductCode AND CONVERT(VARCHAR(4),D.DCRDate,112) = L.Years
                WHERE D.DCRDate BETWEEN '$datefrom' AND '$dateto'
                        AND P.BrandCode = '$brandcode'
                        AND D.DoctorID = '$doctorid'
                        AND VisitBy = 'L1'
                        AND D.Level1 = '$level1'
                ORDER BY D.DCRDate";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $rows = $query->result_array();
        }
        return $rows;
    }

}

?>