<?php

class Home extends MY_controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        if ($this->session->userdata('login')) {
            $this->data['temp'] = 'admin/home/index';
            $this->load->view('admin/main', $this->data);
        } else {
            redirect(admin_url('login'));
        }
    }
}