<?php 
//namespace controller;
//use CI_Controller;
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller {
    
    public function index(){
        if($this->checkIfLoggedIn()){
            redirect('welcome/');
        }else{
            $this->load->view("login_view");
        }
        
         
    }
    
    public function validateLogin(){
        if($userData = $this->input->post()){
             $userDetais = $this->Users_model->validateUser($userData["userid"],$userData["password"]);
           //var_dump($userDetais); exit;
             if( $userDetais = $this->Users_model->validateUser($userData["userid"],$userData["password"]) ){
               $this->setLoginSession($userDetais);
                redirect('welcome/');
            }
            
        }
        redirect('login/');
    }
    
    private function setLoginSession($details){
        $this->session->set_userdata('user_details',$details);
    }
    
    public function checkIfLoggedIn(){
        if($this->session->userdata('user_details')){
            return true;
        }else{
            return false;
        }
    }
    
    public function logout(){
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('login/');
    }
    
    
}