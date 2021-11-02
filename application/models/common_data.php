<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    public function getUserType(){
        $sql = "select * from UserType order by UserTypeName";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return [];
        }
    }
    
    public function getUserRegion($userlevel, $levelCode){
    
        if($userlevel == ''){
            $sql = "SELECT 
                    DISTINCT Level3, Level3Name 
                FROM [192.168.100.75].DCR.dbo.ViewLevels 
                WHERE Active = 'Y' ORDER BY Level3";
        }else{
            // $sql = "SELECT 
            //         DISTINCT Level3, Level3Name 
            //     FROM [192.168.100.75].DCR.dbo.ViewLevels 
            //     WHERE Level3 IN (SELECT DISTINCT Level3 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE $userlevel = '$levelCode') "
            //     . "AND Active = 'Y'  ORDER BY Level3";   
            $sql = "SELECT 
                    DISTINCT Level3, Level3Name 
                FROM [192.168.100.75].DCR.dbo.ViewLevels 
                WHERE Active = 'Y' ORDER BY Level3";       
        };

        // $CI=& get_instance();
        // $CI->load->database('dcr');
        
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            $rows = $query->result_array();
        }        
        return $rows;                
    }
    
    public function getUserArea($regioncode, $userlevel, $levelCode){
        if($userlevel == ''){
            $sql = "SELECT 
                    DISTINCT Level2, Level2Name 
                FROM [192.168.100.75].DCR.dbo.ViewLevels 
                WHERE Level2 IN (SELECT DISTINCT Level2 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE Level3 = '$regioncode') 
                    AND Active = 'Y' ORDER BY Level2 ";
        }else{
            // $sql = "SELECT 
            //         DISTINCT Level2, Level2Name 
            //     FROM [192.168.100.75].DCR.dbo.ViewLevels 
            //     WHERE Level2 IN (SELECT DISTINCT Level2 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE Level3 = '$regioncode') 
            //             AND ($userlevel = '$levelCode')
            //             AND Active = 'Y' ORDER BY Level2 ";

            $sql = "SELECT 
                    DISTINCT Level2, Level2Name 
                FROM [192.168.100.75].DCR.dbo.ViewLevels 
                WHERE Level2 IN (SELECT DISTINCT Level2 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE Level3 = '$regioncode') 
                    AND Active = 'Y' ORDER BY Level2 ";
        }
            //  echo $sql;
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }        
    }
    
    public function getUserTerritory($areacode, $userlevel, $salescode){
        if($userlevel == ''){
            $sql = "SELECT 
                    DISTINCT Level1, Level1Name 
                FROM [192.168.100.75].DCR.dbo.ViewLevels 
                WHERE Level1 IN (SELECT DISTINCT Level1 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE Level2 = '$areacode') 
                        AND Active = 'Y'  ORDER BY Level1";
        }else{
            // $sql = "SELECT 
            //         DISTINCT Level1, Level1Name 
            //     FROM [192.168.100.75].DCR.dbo.ViewLevels 
            //     WHERE Level1 IN (SELECT DISTINCT Level1 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE Level2 = '$areacode') 
            //             AND ($userlevel = '$salescode')
            //             AND Active = 'Y'  ORDER BY Level1";

            $sql = "SELECT 
                    DISTINCT Level1, Level1Name 
                FROM [192.168.100.75].DCR.dbo.ViewLevels 
                WHERE Level1 IN (SELECT DISTINCT Level1 FROM [192.168.100.75].DCR.dbo.ViewLevels WHERE Level2 = '$areacode') 
                        AND Active = 'Y'  ORDER BY Level1";
        }
            
        $result['success'] = false;

        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }        
    }
	
	public function getUserDistributor($territorycode){		
        $sql = "SELECT * FROM Distributor WHERE TSIID IN (SELECT StaffId FROM Level1 WHERE Level1 = '$territorycode')";            
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }        
    }

    public function getBusiness() {
        $sql = "select Business, BusinessName 
            from BusinessView order by BusinessName ";
        $query = $this->db->query($sql);       
        if($query) {
            return $query->result_array();
        }
        return [];
    }

    public function getUserBusiness($userId) {
        $sql = "select UB.UserId,UB.Business,BV.BusinessName from UserBusiness UB
        left join BusinessView BV on BV.Business= UB.Business   
        where UB.UserId='$userId'
        Order by BV.BusinessName";

        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return [];
    }
    public function getUserBusinessCode($userId) {
        $sql = "select UB.Business from UserBusiness UB         
            where UB.UserId='$userId'";

        $query = $this->db->query($sql);
        if($query) {
            return $query->result_array();
        }
        return [];
    }
	
	
}

?>