<?php

include_once 'common_controler.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Files extends Common_controler {
    
    public $fileTable ="";
    
    public function __construct() {
        parent::__construct();
        $this->load->model("files_model");
        
    }

    public function do_upload($refField, $refValue) {

        $this->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        $no_error = true;
        $errors = [];
        $successDataSets=[];
        for ($i = 0; $i < $cpt; $i++) {
            $fullName = $files['userfile']['name'][$i];
            $nameArray = explode(".", $fullName);
            $ext = end($nameArray);
            
            $data=[];
            $data = [
                "original_name" => $files['userfile']['name'][$i],
                "temp_name" => uniqid(),
                "type"=>$refField,
                "ref_id"=>$refValue,
                "created_by"=>  $this->userId,
                "created_on"=>  date("Y-m-d H:i:s")
            ];

            $_FILES['userfile']['name'] = $data["temp_name"].".".$ext;
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];



            $this->upload->initialize($this->set_upload_options());
            //   $upload_result = $this->upload->do_upload();
            if ($this->upload->do_upload() == false) {
                $errors [$fullName] = $this->upload->display_errors();
                $no_error = false;
            }else{
                $successDataSets[]=$data;
            }
        }
        if ($no_error == true) {
            return ["status"=>true,"successDataSets"=>$successDataSets];
        } else {
            return ["status"=>false,"successDataSets"=>$successDataSets,"error_msg"=>$errors];;
        }
    }

    private function set_upload_options() {
//  upload an image options
        $config = array();
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;


        return $config;
    }
    
    public function insertFileData($data){
        
        $this->files_model->insertData($data);   
    }

}

?>