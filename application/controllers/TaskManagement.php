<?php


class TaskManagement extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('common_data','common');
        $this->load->model('TaskManagementModel');
        $this->load->model('ConfigurationModel');
    }

    public function assignTask() {
        $taskModel = new TaskManagementModel();
        $data['user_list'] = $taskModel->getUserList();
        $data['action'] = 'TaskManagement/addTask';
        $this->loadView('task_manager/assign_task',$data);
    }

    /**
     * get User Task as json output
     */
    public function getUserTask() {
        $userId = $this->input->get('user_id');
        $taskModel = new TaskManagementModel();
        $data['user_list'] = $taskModel->getUserTask($userId);
        echo json_encode($data['user_list']);
    }

    /**
     * Update User Task
     * @return mixed
     */
    public function addTask() {
        $task_list = $this->input->post('task_list');
        $already_assigned_task_list = explode(',',$this->input->post('already_assigned_task_list'));
        if(empty($task_list)) {
            $task_list = [];
        }
        $deactivated_task_list = array_diff($already_assigned_task_list,$task_list);
        $activated_task_list = array_diff($task_list,$already_assigned_task_list);
//        echo "<pre>",print_r($activated_task_list);die();
        $user_id = $this->input->post('user_list');
        $updateBy = $this->session->userdata('userid');
        $assignedDateFrom = $this->input->post('AssignedDateFrom');
        $no_task_updated = [];
        $taskModel = new TaskManagementModel();
        if(!empty($activated_task_list)) {
            $status = 1;
            $no_task_updated[] = $taskModel->updateUserTask($user_id,$activated_task_list,$status,$assignedDateFrom, $updateBy);
        }
        if(!empty($deactivated_task_list)) {
            $status = 0;
            $no_task_updated[] = $taskModel->updateUserTask($user_id,$deactivated_task_list,$status,$assignedDateFrom, $updateBy);
        }

        $total_task_updated = array_sum($no_task_updated);
        setFlashMsg($total_task_updated. " Task Updated");
        return redirect('TaskManagement/assignTask');
    }

    public function taskDetailsManager() {
        $taskModel = new TaskManagementModel();
        $data['action'] = 'TaskManagement/addTaskDetails';
        $configurationModel = new ConfigurationModel();
        $data['task_types'] = $configurationModel->getConfigurationType('TaskType');
        $data['measured_types'] = $configurationModel->getConfigurationType('MeasuredTypeInfo');
        $data['operation_types'] = $configurationModel->getConfigurationType('OperationType');
        $data['considerations'] = getWorkDayType();
        $data['days'] = getDaysOfMonth();
        // get Task details list

        $data['task_details_list'] = $taskModel->getTaskDetails();
        if(isset($_GET['taskId'])) {
            $taskId = $this->input->get('taskId');
            $data['task_details'] = $taskModel->getTaskDetails($taskId);
            $data['task_details'] = (!empty($data['task_details'])) ? $data['task_details'][0] : [];
        }
        $this->loadView('task_manager/task_details',$data);
    }

    public function addTaskDetails() {
        $data = [
            'TaskTypeId'=> $this->input->post('TaskTypeId'),
            'TaskDetails'=> $this->input->post('TaskDetails'),
            'MeasuredType'=> $this->input->post('MeasuredType'),
            'Consideration'=> $this->input->post('Consideration'),
            'OperationType'=> $this->input->post('OperationType'),
            'OperationDeadLine'=> $this->input->post('OperationDeadLine'),
            'StandardNo'=> $this->input->post('OperationDeadLine'),
            'DeadLineASperReq'=> $this->input->post('OperationDeadLine'),
            'TaskWeight'=> $this->input->post('OperationDeadLine'),
            'Active'=> $this->input->post('Active'),
            'CreatedDate'=> date('Y-m-d'),
            'CreatedBy'=> $this->session->userdata('userid'),
        ];
        if($_POST['TaskId']) {
            // Update data
            $taskId = $this->input->post('TaskId');
            $result = $this->db->update('TaskDetails',$data, array('TaskId' => $taskId));
            if($result) {
                setFlashMsg('Task Updated Successfully');
            } else {
                setFlashMsg('Something Went Wrong','error');
            }

        } else {
            // Inset data
            $taskModel = new TaskManagementModel();
            $maxId = $taskModel->getMaxTaskDetailsId();
            $data['TaskId'] =($maxId+1);

            $result = $this->db->insert('TaskDetails',$data);
            if($result) {
                setFlashMsg('Task Added Successfully');
            } else {
                setFlashMsg('Something Went Wrong','error');
            }
        }
        redirect('TaskManagement/taskDetailsManager');

    }


}