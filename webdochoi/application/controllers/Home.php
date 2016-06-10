<?php

class Home extends MY_controller
{

    function index()
    {
        //lay danh sach san pham moi
	    $this->load->model('product_model');
	    $input = array();
	    $input['limit'] = array(3, 0);
	    $product_newest = $this->product_model->get_list($input);
	    $this->data['product_newest'] = $product_newest;
	    
	    $input['order'] = array('count_buy', 'DESC');
	    $product_buy = $this->product_model->get_list($input);
		$this->data['product_buy']  = $product_buy;
		
		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/main_layout', $this->data);
		
    }
}