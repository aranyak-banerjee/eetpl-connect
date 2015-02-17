<?php

class Users_model extends CI_Model {
    private $table =USERS;

    function __construct()
    {
        parent::__construct();
    }
    
    public function getUers($credentials = ["status"=>1],$excludeSelf=true){
        $currentUserId = $this->session->userdata('user_details') ->id    ;
        if($excludeSelf){
            $credentials["id !="]=$currentUserId;
        }
        
        return  $this->db->get_where($this->table, $credentials)->result_array();
        
    }
    
    public function validateUser($userName,$password){
        $password = md5($password);
        $credentials = ["user_name"=>$userName, "password"=>$password];
        $res = $this->db->get_where($this->table, $credentials, 1,0)->row();
       // var_dump($res->password); exit;
        if(count($res)==1 && $res->password==$password){
            return $res;
        }else{
            return false;
        }
    }
    
    
}

