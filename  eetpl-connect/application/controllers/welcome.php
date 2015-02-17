<?php 
include_once 'common_controler.php';
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Welcome extends Common_controler {
        
        private function dummy(){
            $title = "It All Starts Here";
            $data = ["page"=>"content","data"=>"HELLO","breadcrumbData"=>[["label"=>"home","url"=>"welcome"],"hello"]];
            $this->render($title,$data);
        }
	
	public function index(){
                $title = "It All Starts Here";
                $data = ["page"=>"content","data"=>base_url(),"breadcrumbData"=>[["label"=>"home","url"=>"welcome"],"hello"]];
                $this->render($title,$data);
        }
        
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */