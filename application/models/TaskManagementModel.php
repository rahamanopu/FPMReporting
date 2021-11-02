<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class TaskManagementModel extends CI_Model
{
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    public function getUserList()
    {
        $sql = "select * from UserManager where UserType in('U')";
        return ($query = $this->db->query($sql)) ? $query->result_array() : [];
    }

    public function getUserTask($userId)
    {
        $sql ="SELECT T.TaskId ,T.TaskDetails, T.TaskTypeId, TT.TaskType, 
                    CASE WHEN L.Active IS NULL THEN 0 
                    WHEN L.Active='Y' THEN 1 ELSE 0 END AS AssignStatus	  FROM 
                        (SELECT * FROM TaskDetails WHERE Active='Y') T
                INNER JOIN TaskType TT ON T.TaskTypeId = TT.TaskTypeId
                LEFT JOIN (SELECT * FROM TaskAssign WHERE UserId='$userId') L ON T.TaskId=L.TaskId
                ORDER BY T.TaskTypeId, T.TaskId";
        return ($query = $this->db->query($sql)) ? $query->result_array() : [];
    }

    public function updateUserTask($userId, $taskList, $status, $AssignedDateFrom, $updateBy)
    {
        $count = 0;
        foreach ($taskList as $taskId) {
            $sql = "EXEC SP_TaskAssignUpdate '$userId','$taskId','$status','$AssignedDateFrom', '$updateBy'";
            if($this->db->query($sql)) {
                $count++;
            }
        }
        return $count;
    }

    public function getMaxTaskDetailsId()
    {
        $sql = "select top 1 TaskId from TaskDetails order by TaskId desc";
        $query = $this->db->query($sql);
        if($query) {
            return (!empty($result = $query->result_array())) ? $result[0]['TaskId'] : 0;
        }
    }

    public function getTaskDetails($taskId = '')
    {
        $sql = "select * from TaskDetails";
        if($taskId) {
            $sql .=" where TaskId = '$taskId'";
        }
        return ($query = $this->db->query($sql)) ? $query->result_array() : [];

    }
}