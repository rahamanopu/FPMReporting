<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS UserManager extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usermanager_data', 'usermanager');
        $this->load->model('CommonModel', 'common');
    }

    public function index() {
        $data = [];
        $data['titel'] = 'User manager';
        $data['subtitel'] = 'Add user manager';
        $data['action'] = 'usermanager/index';

        $data['segment3'] = $this->uri->segment(3);

        $data['menulist']       = $this->usermanager->getMenu($data['segment3']);
        $data['userdata']       = $this->usermanager->doLoadUserData($data['segment3']);
        $data['businessList'] = $this->common->getBusiness();
        $data['userTypeList'] = $this->common->getUserType();


        $data['userlist'] = $this->usermanager->doLoadUserList();
        $this->loadView('usermanager/index',$data);
    }

    /**
     * Save user manager
     */
    public function docreate() {
        $userid = $this->input->post('userid', TRUE);
        $staffid = $this->input->post('staffid', TRUE);
        $username = $this->input->post('username', TRUE);
        $password = encrypt_password($this->input->post('password', TRUE));
        $designation = $this->input->post('designation', TRUE);
        $active = $this->input->post('active', TRUE);
        $entryby = $this->session->userdata('userid');
        $entryip = $_SERVER['REMOTE_ADDR'];
        $divicestate = $this->useagent();
        $usermenu = $this->input->post('usermenu', TRUE);
        $userLevel = $this->input->post('userLevel', TRUE);
        $levelCode = $this->input->post('levelCode', TRUE);
        $userType = $this->input->post('userType', TRUE);
//        echo "<pre>",var_dump($defaultBusiness,$userLevel,$levelCode,$userType);die();

        $userCreate = $this->usermanager->doCreateUser($userid, $staffid, $username, $password, $designation,$userLevel, $levelCode,$userType, $active, $entryby, $entryip, $divicestate);

        if ($userCreate == true) {
            $this->usermanager->doDeleteUserMenu($userid);
            if (!empty($usermenu)) {
                for ($i = 0; $i < count($usermenu); $i++) {
                    $this->usermanager->doInsertUserMenu($userid, $usermenu[$i]);
                }
            }
            setFlashMsg("Successful Added");
        } else {
            setFlashMsg("Something Went Wrong");
        }
        redirect('/usermanager');
    }

    public function changepassword() {

        $data = '';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['head'] = $this->load->view('template/head', $data, true);
        $data['header'] = $this->load->view('template/header', $data, true);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['content'] = $this->load->view('usermanager/changepassword', $data, true);
        $data['footer'] = $this->load->view('template/footer', $data, true);

        $this->load->view('dashboard', $data);
    }

    public function changepin() {

        $data = '';
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['head'] = $this->load->view('template/head', $data, true);
        $data['header'] = $this->load->view('template/header', $data, true);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['content'] = $this->load->view('page/changepin', $data, true);
        $data['footer'] = $this->load->view('template/footer', $data, true);

        $this->load->view('dashboard', $data);
    }

    public function dochangepin() {
        $userid = $this->session->userdata('userid');
        $currentpassword = $this->input->post('currentpassword', TRUE);
        $newpassword = $this->input->post('newpassword', TRUE);
        $confirmpassword = $this->input->post('confirmpassword', TRUE);

        $return = $this->usermanager->doChangePIN($userid, $currentpassword, $newpassword, $confirmpassword);
        //var_dump($_POST); exit();
        $this->session->set_flashdata('insertmsg', $return['msg']);
        $this->session->set_flashdata('msgtype', $return['msgtype']);
        redirect('/usermanager/changepassword');
    }

    public function dochangepassword() {
        $userid = $this->session->userdata('userid');
        $currentpassword = $this->input->post('currentpassword', TRUE);
        $newpassword = $this->input->post('newpassword', TRUE);
        $confirmpassword = $this->input->post('confirmpassword', TRUE);

        $return = $this->usermanager->doChangePassword($userid, $currentpassword, $newpassword, $confirmpassword);
        //var_dump($return); exit();
        $this->session->set_flashdata('insertmsg', $return['msg']);
        $this->session->set_flashdata('msgtype', $return['msgtype']);
        redirect('/usermanager/changepassword');
    }

    public function userdata() {
        $userid = $this->input->get_post('userid', TRUE);
        $return = $this->usermanager->doLoadUserData($userid);
        echo json_encode(utf8ize($return));
    }

    public function useagent() {
        $this->load->library('user_agent');

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }

}

?>