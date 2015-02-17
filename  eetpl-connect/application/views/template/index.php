<?php
    //var_dump($data); exit;
    $page=isset($page) ? $page : "welcome_message";
    $data = isset($data) ? $data : "";
    $breadcrumbData = isset($breadcrumbData) ? $breadcrumbData : []; // ["label"=>"","url"=>""]
    //["last5msgs"=>$last5Msgs]
    $this->load->view('template/header',["last5msgs"=>$last5Msgs]);
    $this->load->view('template/left_nav');
    $this->load->view("template/breadcrumb",["breadcrumbData"=>$breadcrumbData]);
    $this->load->view($page,["data"=>$data]);
    $this->load->view('template/footer');
    
    ?>

