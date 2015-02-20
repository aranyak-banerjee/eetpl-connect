<?php

class files_model extends CI_Model {
    private $table = FILES;
    
    public function insertData($data){
        $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() != 1) {
            return 0;
        } else {
            return $this->db->insert_id();
        }
    }
    
    function getFiles($type,$ref_id){
        $sql = "SELECT * FROM ".$this->table."  where ref_id = ".$ref_id." AND type = '".$type."'";
        $query =  $this->db->query($sql);
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
        
    }
}