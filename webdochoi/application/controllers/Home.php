<?php
Class Home extends CI_Controller{
    function index(){
        $data=array();
        $data['temp']='site/home/index';
        $this->load->view('site/main_layout',$data);
    }
}