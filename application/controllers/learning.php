<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

CLASS Learning extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('ri');
        $this->load->model('Learning_data');
    }

    function documentCategory() {
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Document Category List';
        $data['action'] = 'learning/document-category';

        $data['document_category'] = $this->Learning_data->getAllDocumentCategory($data['userid']);

        $this->loadView('learning_matarial/document_category/list',$data);
    }

    public function documentCategoryCreate(){
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Document Category Create';
        $data['action'] = 'learning/document-category-create';

        $data['Business'] = $this->Learning_data->getAllBusiness($data['userid']);

        $this->loadView('learning_matarial/document_category/create',$data);
    }

    public function documentCategoryStore(){
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['Business'] = $this->input->get_post("Business", TRUE);
        $data['CategoryName'] = $this->input->get_post("CategoryName", TRUE);
        $data['CategoryIcon'] = $this->input->get_post("CategoryIcon", TRUE);
        $data['ActiveStatus'] = $this->input->get_post("ActiveStatus", TRUE);

        $name = $_FILES['file']['name'];

        $target_dir = "uploads/images/";

        if(!file_exists($target_dir)) {
            mkdir($target_dir,'0755');
        }
        
        $target_file = $target_dir.basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $imageName = time().uniqid().'.'.$imageFileType;

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif","pdf","doc");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imageName);
        }


        $data['document_category_store'] = $this->Learning_data->doStoreDocumentCategory($data['Business'],$data['CategoryName'],$imageName,$data['ActiveStatus']);

        redirect('learning/document-category');
    }

    public function documentCategoryEdit($id){

        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Document Category Edit';
        $data['action'] = 'learning/document-category-update';

        $data['Business'] = $this->Learning_data->getAllBusiness($data['userid']);
        $data['document_category'] = $this->Learning_data->getDocumentCategoryById($id);
        //echo "<pre />";print_r($data['document_category'][0]); exit();

        $this->loadView('learning_matarial/document_category/edit',$data);
    }

    public function documentCategoryUpdate($id){

        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['Business'] = $this->input->get_post("Business", TRUE);
        $data['CategoryName'] = $this->input->get_post("CategoryName", TRUE);
        $data['ActiveStatus'] = $this->input->get_post("ActiveStatus", TRUE);

        $name = $_FILES['file']['name'];
        if (!empty($name)){
            $target_dir = "uploads/images/";
            $target_file = $target_dir.basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $imageName = time().uniqid().'.'.$imageFileType;
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif","pdf","doc");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imageName);
            }
        }else{
            $data['document_category'] = $this->Learning_data->getDocumentCategoryById($id);
            $imageName = $data['document_category'][0]['CategoryIcon'];
        }

        //echo "<pre />";print_r($data); exit();

        $data['document_category_update'] = $this->Learning_data->doUpdateDocumentCategoryById($data['Business'],$data['CategoryName'],$imageName,$data['ActiveStatus'],$id);
        //echo "<pre />";print_r($data['document_category'][0]); exit();

        redirect('learning/document-category');
    }


    //for document
    function document() {
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Document List';
        $data['action'] = 'learning/document';

        $data['document'] = $this->Learning_data->getAllDocument($data['userid']);

        $this->loadView('learning_matarial/document/list',$data);
    }

    public function documentCreate(){
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Document Create';
        $data['action'] = 'learning/document-create';

        $data['Business'] = $this->Learning_data->getAllBusiness($data['userid']);
        $data['document_category'] = $this->Learning_data->getAllDocumentCategory($data['userid']);

        $this->loadView('learning_matarial/document/create',$data);
    }

    public function documentStore(){
        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['Business'] = $this->input->get_post("Business", TRUE);
        $data['DocumentCategoryID'] = $this->input->get_post("DocumentCategoryID", TRUE);
        $data['DocumentTitle'] = $this->input->get_post("DocumentTitle", TRUE);
        $data['DocumentFileName'] = $this->input->get_post("DocumentFileName", TRUE);
        $data['DocumentDescription'] = $this->input->get_post("DocumentDescription", TRUE);
        $data['ActiveStatus'] = $this->input->get_post("ActiveStatus", TRUE);

        $name = $_FILES['file']['name'];

        $target_dir = "uploads/images/";
        $target_file = $target_dir.basename($_FILES["file"]["name"]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $imageName = time().uniqid().'.'.$imageFileType;

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif","pdf","doc");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imageName);
        }
        // Insert record
        $data['document_store'] = $this->Learning_data->doStoreDocument($data['Business'],$data['DocumentCategoryID'],$data['DocumentTitle'],$imageName,$imageFileType,$data['DocumentDescription'],$data['ActiveStatus'],$data['userid']);

        redirect('learning/document');
    }

    public function documentEdit($id){

        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');
        $data['levelCode'] = $this->session->userdata('levelCode');
        $data['pagetitel'] = 'Document Edit';
        $data['action'] = 'learning/document-update';

        $data['Business'] = $this->Learning_data->getAllBusiness($data['userid']);
        $data['document_category'] = $this->Learning_data->getAllDocumentCategory($data['userid']);

        $data['document'] = $this->Learning_data->getDocumentById($id);
        //echo "<pre />";print_r($data['document']); exit();

        $this->loadView('learning_matarial/document/edit',$data);
    }

    public function documentUpdate($id){

        $data['userid'] = $this->session->userdata('userid');
        $data['emp_name'] = $this->session->userdata('emp_name');
        $data['designation'] = $this->session->userdata('designation');

        $data['Business'] = $this->input->get_post("Business", TRUE);
        $data['DocumentCategoryID'] = $this->input->get_post("DocumentCategoryID", TRUE);
        $data['DocumentTitle'] = $this->input->get_post("DocumentTitle", TRUE);
        $data['DocumentFileName'] = $this->input->get_post("DocumentFileName", TRUE);
        $data['DocumentDescription'] = $this->input->get_post("DocumentDescription", TRUE);
        $data['ActiveStatus'] = $this->input->get_post("ActiveStatus", TRUE);

        $name = $_FILES['file']['name'];

        if (!empty($name)){
            $target_dir = "uploads/images/";
            $target_file = $target_dir.basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $imageName = time().uniqid().'.'.$imageFileType;
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif","pdf","doc");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$imageName);
            }
        }else{
            $data['document'] = $this->Learning_data->getDocumentById($id);
            $imageName = $data['document'][0]['DocumentFileName'];
        }

        // Insert record
        $data['document_update'] = $this->Learning_data->doUpdateDocumentById($data['Business'],$data['DocumentCategoryID'],$data['DocumentTitle'],$imageName,$imageFileType,$data['DocumentDescription'],$data['ActiveStatus'],$data['userid'],$id);

        redirect('learning/document');
    }


}

?>