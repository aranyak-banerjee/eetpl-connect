<?php
include_once 'common_controler.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends Common_controler{
    
    public function getMessageData(){
        if ($data = $this->input->post()){
            $msgId = $data["msgId"];
            $this->load->model('Message_model');
            $data = $this->Message_model->getMessage($msgId);
            echo json_encode($data);
        }
    }
    
    public function markMessageAsRead(){
        if ($data = $this->input->post()){
            $this->load->model('Message_model');
            $userId = $this->userId;
            $msgId = $data["msgId"];
            
            $this->Message_model->markMsgAsRead($msgId,$userId);
            echo $this->Message_model->getUserMessageListTotalUnread($userId);
        }
    }
}

