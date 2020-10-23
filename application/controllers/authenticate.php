<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authenticate extends CI_Controller {

    var $data = null;

    public function __construct() {
        parent::__construct();
        $this->load->database('default', true);
        $this->load->model('Users_data');
        $this->data['currentdate'] = date('l, F d, Y', strtotime('now'));
        $this->data['currenttime'] = date('h:i A', strtotime('now'));
    }

    public function index() {
        $data = array();
//echo "<pre />"; print_r($this->session); 
        $data['head'] = $this->load->view('login/head', $data, true);
        $data['footer'] = $this->load->view('login/footer', $data, true);
        $data['content'] = $this->load->view('login/content', $data, true);
        $this->load->view('login', $data);
    }

    public function login() {
        
        if(isset($_GET['login_from_app']) && $_GET['login_from_app'] == true) {            
            $userid =  base64_decode($_GET['empcode']);
            $password =  base64_decode($_GET['password']);            
            
            $passwordParts = explode('.',$password);
            if(isset($passwordParts[0]) && $passwordParts[0] =='fpmreporting1234') {
                $password = isset($passwordParts[1]) ? $passwordParts[1] : '';
            }
        } else {
            $userid     = $this->input->post('empcode', true);
            $password   = $this->input->post('password', true);
        }

        $row = $this->Users_data->doUserLogin($userid, $password);

        if ($row['success'] == true) {
            $usermenu = $this->Users_data->loadmenu($userid);
//            echo "<pre>",print_r($usermenu);die();
            $this->session->set_userdata('login',       true);
            $this->session->set_userdata('userid',      $userid);
            $this->session->set_userdata('emp_name',    $row['UserName']);
            $this->session->set_userdata('designition', $row['Designition']);
            $this->session->set_userdata('usertype',    $row['UserType']);
            $this->session->set_userdata('levelCode',    $row['LevelCode']);
            $this->session->set_userdata('userLevel',    $row['UserLevel']);
            //exit();
            //$this->session->set_userdata('menu', $usermenu);
            file_put_contents("assets/temp/usermenu_" . $userid . ".tmp", serialize($usermenu));
            redirect(site_url());
            return true;
        }
        $this->session->set_flashdata('msg', 'Invalid employee code or password.');
        redirect('/authenticate');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/authenticate');
    }

}
