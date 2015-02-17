<?php
    //var_dump($data); exit;
    $page=isset($page) ? $page : "welcome_message";
    $data = isset($data) ? $data : "";
    $breadcrumbData = isset($breadcrumbData) ? $breadcrumbData : []; // ["label"=>"","url"=>""]
    $this->load->view('header');
    $this->load->view('left_nav');
    $this->load->view("breadcrumb",["breadcrumbData"=>$breadcrumbData]);
    $this->load->view($page,["data"=>$data]);
    $this->load->view('footer');
    
    ?>

