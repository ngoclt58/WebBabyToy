<?php

class Home extends MY_controller
{

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