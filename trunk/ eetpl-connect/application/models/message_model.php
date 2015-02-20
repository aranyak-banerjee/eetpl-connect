<?php

class Message_model extends CI_Model {

    private $table = MESSAGE;
    private $subTable = MESSAGE_SUBSCRIPTION;

    function __construct() {
        parent::__construct();
    }

    public function getMessageDetails($messageId, $is_deleted = 0) {
        if (!isset($messageId))
            return false;
        $credentials = [
            "id" => $messageId,
            "is_deleted" => $is_deleted
        ];
        $query = $this->db->get_where($this->table, $credentials)->get();
        if ($query->num_rows > 0) {
            return $query->result_array('array');
        } else {
            return false;
        }
    }

    public function getAllMessages($is_deleted = 0) {

        $credentials = [
            "is_deleted" => $is_deleted
        ];
        $query = $this->db->get_where($this->table, $credentials)->get();
        if ($query->num_rows > 0) {
            return $query->result_array('array');
        } else {
            return false;
        }
    }

    public function getUserMessageList($userId,$limit=NULL) {
        $limitString = "";
        if($limit!=NULL AND is_array($limit) ){
            $limitString ="LIMIT $limit[0], $limit[1]";
        }
        $sql = "SELECT msg.id, msg.title, msg.text, msg.created_by, msg.created_on, sub.is_read FROM " . $this->table . " as msg INNER JOIN " . $this->subTable . " as sub on sub.message_id = msg.id WHERE sub.user_id = " . $userId . " and msg.is_deleted = 0 ORDER BY sub.is_read ASC, msg.id DESC ".$limitString;
        $query =  $this->db->query($sql);
        return $query->result();
    }
    
    public function getMessage($messageId) {
        
        $sql = "SELECT * FROM ".$this->table."  where id = ".$messageId;
        $query =  $this->db->query($sql);
        return $query->result();
    }
    
    public function getUserMessageListTotal($userId) {
        
        $sql = "SELECT count(msg.id) as total FROM " . $this->table . " as msg INNER JOIN " . $this->subTable . " as sub on sub.message_id = msg.id WHERE sub.user_id = " . $userId . " and msg.is_deleted = 0 ";
        $query =  $this->db->query($sql);
        $res = $query->result();
        return $res[0]->total;
    }
    
    public function getUserMessageListTotalUnread($userId) {
        
        $sql = "SELECT count(msg.id) as total FROM " . $this->table . " as msg INNER JOIN " . $this->subTable . " as sub on sub.message_id = msg.id WHERE ( sub.user_id = " . $userId . " and msg.is_deleted = 0 and  sub.is_read = 0 )";
        $query =  $this->db->query($sql);
        $res = $query->result();
        return $res[0]->total;
    }
    
    

    public function postMessage($title, $text) {
        $params = [
            "title" => $title,
            "text" => $text,
            "created_by" => $this->session->userdata('user_details')->id,
            "created_on" => getCurrentDateTime()
        ];
        $this->db->insert($this->table, $params);
        if ($this->db->affected_rows() != 1) {
            return 0;
        } else {
            return $this->db->insert_id();
        }
    }

    public function subscribeMessage($id, $users,$postedBy) {
        if (!isset($users) || !isset($id) || !is_array($users)) {
            return 0;
        }
        foreach ($users as $user) {
            $isread = $postedBy == $user ? 1 : 0;
            $params = [
                "message_id" => $id,
                "user_id" => $user,
                "is_read"=>$isread
            ];
            $this->db->insert($this->subTable, $params);
        }
    }
    
    public function markMsgAsRead($msgId,$userId){
        //$sql = "UPDATE ".$this->subTable." SET is_read = 1 where message_id = $msgId AND user_id =  $userId";
        $whrParams = [
                "message_id" => $msgId,
                "user_id" => $userId
                
            ];
        $this->db->update($this->subTable, ["is_read"=>1], $whrParams);
    }

}
