<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class usermanager_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }         
    
    
    public function doLoadUserData($userid){

        $sql = "SELECT *
                FROM UserManager WHERE UserId = '$userid'";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }           
    }
    
    public function doCreateUser($userid, $staffid, $username, $password, $designation,$userLevel, $levelCode,$userType, $active, $entryby, $entryip, $divicestate){
        $sql = "EXEC usp_doInsertUserManager  '$userid', '$staffid', '$username', '$password', '$designation','$userLevel','$levelCode','$userType','$active',
                    '$entryby', '$entryip', '$divicestate'";
                    // die($sql);
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doUpdateUserUUID($userID, $uuID)
    {
        $sql = "update [192.168.100.21].SDMSMirror.dbo.USERMANAGER set uuID = '$uuID' where UserId = '$userID'";

        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doInsertUserBusiness($userid, $business){
        $sql = "INSERT INTO UserBusiness VALUES ('$userid','$business', 1)";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doDeleteUserBusiness($userid){
        $sql = "DELETE FROM UserBusiness WHERE Userid = '$userid' ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doInsertLocation($userid, $locationcode, $businesscode){
        $sql = "INSERT INTO UserLocation VALUES ('$userid','$businesscode','$locationcode',1)";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doDeleteUserLocation($userid){
        $sql = "DELETE FROM UserLocation WHERE Userid = '$userid' ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doInsertUserMenu($userid, $menuid){
        $sql = "INSERT INTO UserMenu VALUES ('$userid','$menuid', 1)";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }

    public function doDeleteUserMenu($userid){
        $sql = "DELETE FROM UserMenu WHERE Userid = '$userid' ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return true;
        }else{
            return false;
        } 
    }
    
    
    public function doLoadUserList(){
        $sql = "SELECT 
                    UserId, StaffId, UserName, Password, Designation, 
                    CASE Active 
                            WHEN 'Y' THEN 'Active'
                            WHEN 'N' THEN 'InActive' END ActiveStatus 	 
                FROM UserManager
                WHERE UserId != '11936'	";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        } 
    }

    public function doLoadUserListOfBusinessU(){
        $sql = "SELECT UserId, UserName, Designation, uuID
                FROM [192.168.100.21].SDMSMirror.dbo.USERMANAGER WHERE DEFAULTBUSINESS = 'U'";
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        } 
    }
    
    public function doChangePassword($userid, $currentpassword, $newpassword, $confirmpassword){         
        $sql = "SELECT 
                    *
                FROM UserManager WHERE UserId = '$userid' and Password = '$currentpassword' ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        
        if ($query) {
            if(count($query->result_array()) > 0){
                $update = "UPDATE UserManager SET  "
                        . "Password = '$newpassword' "
                        . "WHERE UserId = '$userid' "
                        . "and Password = '$currentpassword'";
                
                $query = $this->db->query($update);
                if ($query) {
                    $data['msgtype'] = 'success';
                    $data['msg'] = 'Successfully update.';
                    return $data;
                }else{
                    $data['msgtype'] = 'error';
                    $data['msg'] = 'Something wrong. ';
                    return $data;
                }
            }else{
                $data['msgtype'] = 'error';
                $data['msg'] = 'Current password does not match. ';
                return $data;
            }
        }           
    }
    
    public function doChangePIN($cardno, $currentpassword, $newpassword, $confirmpassword){         
        $sql = "SELECT 
                    *
                FROM ValueCardInfo WHERE ValueCardNo = '$cardno' and PIN = '$currentpassword' ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        
        if ($query) {
            if(count($query->result_array()) > 0){
                $update = "UPDATE ValueCardInfo SET  PIN = '$newpassword' WHERE ValueCardNo = '$cardno' and PIN = '$currentpassword'";
                $query = $this->db->query($update);
                if ($query) {
                    $data['msgtype'] = 'success';
                    $data['msg'] = 'Successfully update.';
                    return $data;
                }else{
                    $data['msgtype'] = 'error';
                    $data['msg'] = 'Something wrong. ';
                    return $data;
                }
            }else{
                $data['msgtype'] = 'error';
                $data['msg'] = 'Current password does not match. ';
                return $data;
            }
        }           
    }


    public function getBusiness($userid){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT 
                    B.*, ISNULL(U.Business,'') Selected 
                FROM Business B
                    INNER JOIN (SELECT DISTINCT Business FROM DayWiseMaterialInfo) C
                        ON b.Business = C.Business
                    LEFT JOIN (SELECT * FROM UserBusiness WHERE UserId = '$userid') U
                        ON B.Business = U.Business
                WHERE Enable = 'Y'
                ORDER BY 2";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    
    public function getLocation($userid, $locationtype = ''){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT 
                    L.LocationCode, L.LocationName, ISNULL(U.LocationCode,'') Selected ,L.BusinessCode, B.BusinessName
                FROM Location L
                    INNER JOIN Business B
                        ON B.Business = L.BusinessCode
                    LEFT JOIN (SELECT * FROM UserLocation WHERE UserId = '$userid') U
                        ON L.LocationCode = U.LocationCode AND L.BusinessCode = U.BusinessCode
                WHERE isActive = 'Y' ";
        if(!empty($locationtype)){ $sql .= " AND LocationType = '$locationtype' "; }
        $sql .= " ORDER BY B.BusinessName, L.LocationName ";              //    exit();
		
		//echo $sql.'<br /><br />'; 
		
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    

    public function getMenu($userid){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT 
                    M.MenuId, M.MenuName ParentMenuName, M.SubMenuName MenuName
                    , ISNULL(U.UserId,'') Selected 
                FROM Menu M
                    LEFT JOIN (SELECT * FROM UserMenu WHERE UserId = '$userid') U
                        ON M.MenuId = U.MenuId
                WHERE M.Active = 'Y'
                ORDER BY 2 ";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    
    public function getMenuId($link){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT * FROM Menu WHERE link = '$link'";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }
    
    public function CheckMenupermission($userid, $menuid){         
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);
        
        $sql = "SELECT * FROM UserMenu WHERE UserId = '$userid' AND MenuId = '$menuid'";              //    exit();
        $result['success'] = false;
        $query = $this->db->query($sql);
        $data = array();
        if ($query) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function addUserBusiness($userid, $userBusiness){
        $sql = "delete from UserBusiness where UserID='$userid'";
        $query = $this->db->query($sql);
        
        foreach($userBusiness as $item) {
            $dataToinsert = [
                'UserID' => $userid,
                'Business' => $item,
                'Active' => '1',
            ];
            $this->db->insert('UserBusiness', $dataToinsert);
        }
        return true;

    }
    
}

?>