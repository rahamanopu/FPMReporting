<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function doUserLogin($userid, $password){
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
    	$sql = "SELECT 
                        U.*
                FROM UserManager U
                WHERE U.UserId = '$userid'";
        $result['success'] = false;
        $query = $this->db->query($sql);
		if ($query) {
		    $rows = $query->result_array();
                    if (count($rows) > 0) {
//                        die(decrypt_password($rows[0]['Password']));
                        if($rows[0]['Password'] == encrypt_password($password)){
                            $data = $rows[0];
                            $result['success'] = true;
                            $result = array_merge($result, $data);
                        }
                    }
		}		
	   return $result;				
    }

    public function loadmenu($userid){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT 
                    M.MenuId,
                    M.MenuName,
                    M.MenuActiveLink,
                    M.SubMenuName,
                    M.Link
                FROM Menu M
                    INNER JOIN UserMenu U
                        ON M.MenuId = U.MenuId
                WHERE M.Active = 'Y'    
                    AND U.UserId = '$userid'
                ORDER BY MenuOrder
                ";    
                     //echo $sql; exit(); // ORDER BY 2    exit();

        return ($query = $this->db->query($sql)) ? $query->result_array() : false;
    }
    
    

}
