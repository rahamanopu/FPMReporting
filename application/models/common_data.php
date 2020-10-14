<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    
    public function getUserRegion($userlevel, $levelCode){
    
        if($userlevel == ''){
            $sql = "SELECT 
                    DISTINCT Level3, Level3Name 
                FROM ViewLevels 
                WHERE Active = 'Y' ORDER BY Level3";
        }else{
            $sql = "SELECT 
                    DISTINCT Level3, Level3Name 
                FROM ViewLevels 
                WHERE Level3 IN (SELECT DISTINCT Level3 FROM ViewLevels WHERE $userlevel = '$levelCode') "
                . "AND Active = 'Y'  ORDER BY Level3";          
        };

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
                FROM ViewLevels 
                WHERE Level2 IN (SELECT DISTINCT Level2 FROM ViewLevels WHERE Level3 = '$regioncode') 
                    AND Active = 'Y' ORDER BY Level2 ";
        }else{
            $sql = "SELECT 
                    DISTINCT Level2, Level2Name 
                FROM ViewLevels 
                WHERE Level2 IN (SELECT DISTINCT Level2 FROM ViewLevels WHERE Level3 = '$regioncode') 
                        AND ($userlevel = '$levelCode')
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
                    DISTINCT Level1StaffID, Level1Name 
                FROM ViewLevels 
                WHERE Level1 IN (SELECT DISTINCT Level1 FROM ViewLevels WHERE Level2 = '$areacode') 
                        AND Active = 'Y'  ORDER BY Level1StaffID ";
        }else{
            $sql = "SELECT 
                    DISTINCT Level1StaffID, Level1Name 
                FROM ViewLevels 
                WHERE Level1 IN (SELECT DISTINCT Level1 FROM ViewLevels WHERE Level2 = '$areacode') 
                        AND ($userlevel = '$salescode')
                        AND Active = 'Y'  ORDER BY Level1StaffID  ";
        }
            
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }        
    }
}

?>