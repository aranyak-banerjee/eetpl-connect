<?php

include_once 'files.php';
//include_once 'comment_.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends Files {

    public function __construct() {
        parent::__construct();
        $this->load->model("comment_model");
    }

    private function dummy() {
        $title = "It All Starts Here";
        $data = ["page" => "content", "data" => "HELLO", "breadcrumbData" => [["label" => "home", "url" => "welcome"], "hello"]];
        $this->render($title, $data);
    }

    public function index() {
        $this->list_message();
    }

    public function list_message() {
        
        if ($data = $this->input->post()) {
            $comment = $data["data"]['comment'];
            $msgId = $data["message_id_for_comment"];
            if($cId = $this->comment_model->insertComment($comment, "message_comment", $msgId)){
                if (isset($_FILES)) {
                    $res = $this->do_upload("connent_file",$cId);
                    if($res["status"]){
                        foreach($res["successDataSets"] as $data){
                            $this->files_model->insertData($data);
                        }
                    }
                }
            }
                

            redirect("message/");
        }
        
        $data["messageList"] = $this->Message_model->getUserMessageList($this->userId);
        $data["total"] = $this->Message_model->getUserMessageListTotal($this->userId);
        $data["total_unread"] = $this->unreadMessages;
        $title = "Message";
        $data = ["page" => "message_view", "data" => $data, "breadcrumbData" => [["label" => "home", "url" => "welcome"], "Message"]];
        $this->render($title, $data);
    }

    public function newMessage() {
        $uers = $this->Users_model->getUers();

        if ($data = $this->input->post()) {
            $data = $data["data"];
            $subscribedUsers = isset($data['users']) ? $data['users'] : [];
            $subscribedUsers[] = $this->session->userdata('user_details')->id;
            //insert Message and get message id
            $mId = $this->Message_model->postMessage($data["title"], $data["content"]);
            if ($mId != 0) {
                $this->Message_model->subscribeMessage($mId, $subscribedUsers, $this->userId);
                if (isset($_FILES)) {
                    $res = $this->do_upload("message_file",$mId);
                    if($res["status"]){
                        foreach($res["successDataSets"] as $data){
                            $this->files_model->insertData($data);
                        }
                    }
                }
            }

            redirect("message/");
        }

        $title = "New Message";
        $data = ["page" => "newMessage_view", "data" => $uers, "breadcrumbData" => [["label" => "home", "url" => "welcome"], ["label" => "Message", "url" => "message"], "New Message"]];
        $this->render($title, $data);
    }

}
