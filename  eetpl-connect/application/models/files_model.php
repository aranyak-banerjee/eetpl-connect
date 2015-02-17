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
}