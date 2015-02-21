<?php

class Comment_model extends CI_Model {
    public $table = COMMENTS;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insertComment($comment,$type,$ref_id) {
        $params = [
            "text"=>$comment,
            "type"=>$type,
            "ref_id"=>$ref_id,
            "created_by" => $this->session->userdata('user_details')->id,
            "created_on" => getCurrentDateTime()
        ];
        
        $this->db->insert($this->table, $params);
        if ($this->db->affected_rows() != 1) {
            return false;
        } else {
            return $this->db->insert_id();
        }
        
    }
    
    function getComments($type,$ref_id){
        $sql = "SELECT * FROM ".$this->table."  where ref_id = ".$ref_id." AND type = '".$type."'";
        $query =  $this->db->query($sql);
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
        
    }
    
}

