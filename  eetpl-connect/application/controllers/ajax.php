<?php
include_once 'common_controler.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends Common_controler{
    
    public function getMessageData(){
        if ($data = $this->input->post()){
            
            $msgId = $data["msgId"];          
            
            $this->load->model('Message_model');
            $data['message'] = $this->Message_model->getMessage($msgId);
            
            $this->load->model('Files_model');
            $data['message']["files"] = $this->Files_model->getFiles("message_file",$msgId);
            
            $this->load->model('Comment_model');
            $data['comments'] = $this->Comment_model->getComments("message_comment",$msgId);
            
            $CmmntFiles=[];
            if($data['comments'] ){
                foreach($data['comments'] as $k=> $comment){
                    $CmmntFiles = $this->Files_model->getFiles("comment_file",$comment->id);
                    $data['comments'][$k]->files=$CmmntFiles;
                }
            }
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

