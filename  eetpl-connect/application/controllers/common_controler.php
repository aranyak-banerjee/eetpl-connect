<?php 
//namespace controller;
//use CI_Controller;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('date.timezone', 'Asia/Kolkata');


class Common_controler extends CI_Controller {
    public $userId;
    public $userName;
    public $unreadMessages;
    public function __construct() {
        parent::__construct();
        
        if(!$this->checkIfLoggedIn()){
            redirect('login/');
        }else{
            $this->userId = $this->session->userdata('user_details')->id;
            $this->userName = $this->session->userdata('user_details')->f_name;
            $this->load->model('Message_model');
            $this->unreadMessages = $this->Message_model->getUserMessageListTotalUnread($this->userId);
            $this->session->set_userData("unread_messages",$this->unreadMessages);
            
        }
    }
    
    public function render($title,$data){
        $this->title = $title;
        $data["last5Msgs"]=$this->Message_model->getUserMessageList($this->userId,[0,5]);
        $this->load->view("template/index",$data);
    }
    
    public function getFullPath(){
        return base_url()."index.php".DIRECTORY_SEPARATOR;
    }
    
    private function checkIfLoggedIn(){
        if($this->session->userdata('user_details')){
            return true;
        }else{
            return false;
        }
    }
    
    
    
}

