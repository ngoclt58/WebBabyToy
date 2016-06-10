<?php
Class Home extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }
    
    function index()
    {
        $input = array();
        $input['order'] = array('created', 'DESC');
        $nums_record = 3;
        if(isset($_GET['page'])) {
            $input['limit'] = array($nums_record * $_GET['page'], $nums_record * $_GET['page'] - $nums_record);
        }
        else {
            $input['limit'] = array($nums_record, "0");
        }
        $list = $this->product_model->get_list($input);
        $data['total'] = $this->product_model->get_total();
        $data['list'] = $this->product_model->get_list($input);
        $data['temp']='site/home/index';
        $this->load->view('site/main_layout',$data);
    }
}