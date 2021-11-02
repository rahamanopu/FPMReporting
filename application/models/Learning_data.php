<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Learning_data extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function getAllBusiness($userid){
        $CI = & get_instance();
        $CI->db = $this->load->database('default', true);

        $sql = "SELECT * FROM Business as B 
                    inner join UserBusiness as U on U.Business = B.Business
                    where U.userid = '$userid' AND B.Active = 'Y' ";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    public function getAllDocumentCategory($userid){

        $sql = "SELECT * FROM [192.168.100.75].DCR.dbo.DocumentCategory as D
                    inner join UserBusiness as U on U.Business = D.Business
                    where U.userid = '$userid'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function doStoreDocumentCategory($Business,$CategoryName,$imageName,$ActiveStatus){

        $sql = "INSERT INTO [192.168.100.75].DCR.dbo.DocumentCategory (Business, CategoryName,CategoryIcon, ActiveStatus) 
                                  VALUES ('$Business', '$CategoryName','$imageName', '$ActiveStatus') ";
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getDocumentCategoryById($id){

        $sql = "SELECT * FROM [192.168.100.75].DCR.dbo.DocumentCategory WHERE DocumentCategoryID ='$id'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function doUpdateDocumentCategoryById($Business,$CategoryName,$imageName,$ActiveStatus,$id){

        $sql = "UPDATE [192.168.100.75].DCR.dbo.DocumentCategory SET Business='$Business', CategoryName='$CategoryName',CategoryIcon='$imageName', ActiveStatus='$ActiveStatus' where DocumentCategoryID='$id' ";

        $query = $this->db->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }


    //for document

    public function getAllDocument($userid){

        $sql = "SELECT D.DocumentID, D.DocumentCategoryID, D.Business, D.DocumentTitle, D.DocumentDescription, D.DocumentFileName, D.ActiveStatus, DC.CategoryName,DC.CategoryIcon,
	            COUNT(DL.DocumentID) as TotalView, COUNT(DISTINCT DL.UserID) TotalUser
                FROM [192.168.100.75].DCR.dbo.Document as D
                inner join [192.168.100.75].DCR.dbo.DocumentCategory as DC on D.DocumentCategoryID = DC.DocumentCategoryID
                inner join UserBusiness as U on D.Business = U.Business
                left join [192.168.100.75].DCR.dbo.DocumentHitLog as DL on DL.DocumentID = D.DocumentID
                where U.userid = '$userid' 
                GROUP BY D.DocumentID, D.DocumentCategoryID, D.Business, D.DocumentTitle, D.DocumentDescription, D.DocumentFileName, D.ActiveStatus, DC.CategoryName,DC.CategoryIcon
                ORDER BY D.DocumentID";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function doStoreDocument($Business,$DocumentCategoryID,$DocumentTitle,$DocumentFileName,$imageFileType,$DocumentDescription,$ActiveStatus,$user_id){

        $sql = "INSERT INTO [192.168.100.75].DCR.dbo.Document (Business, DocumentCategoryID,DocumentTitle,DocumentDescription,DocumentFileName,DocumentFileType, ActiveStatus,EntryBy,EntryDate) 
                 VALUES ('$Business', '$DocumentCategoryID','$DocumentTitle','$DocumentDescription','$DocumentFileName','$imageFileType', '$ActiveStatus','$user_id','".date('Y-m-d')."') ";
        $query = $this->db->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getDocumentById($id){

        $sql = "SELECT * FROM [192.168.100.75].DCR.dbo.Document WHERE DocumentID ='$id'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function doUpdateDocumentById($Business,$DocumentCategoryID,$DocumentTitle,$DocumentFileName,$imageFileType,$DocumentDescription,$ActiveStatus,$user_id,$id){

        $sql = "UPDATE [192.168.100.75].DCR.dbo.Document SET Business='$Business', DocumentCategoryID='$DocumentCategoryID',DocumentTitle='$DocumentTitle',DocumentDescription='$DocumentDescription',DocumentFileName='$DocumentFileName',DocumentFileType='$imageFileType', ActiveStatus='$ActiveStatus',EditedBy='$user_id' where DocumentID='$id' ";

        $query = $this->db->query($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
