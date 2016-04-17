<?php

class MY_controller extends CI_Controller
{
    // bien gui du lieu sang ben view
    public $data = array();

    function __construct()
    {
        // ke thua tu CI_Controller
        parent::__construct();
        
        $controller = $this->uri->segment(1);
        switch ($controller) {
            case 'admin':
                {
                    // xu ly cac du lieu khi truy cap vao trang admin
                    $this->load->helper('admin');
                    $this->_check_login();
                    break;
                }
            default:
                {
                    // xu ly du lieu o trang ngoai
                    
                    break;
                }
        }
    }
    
    /*
     * Kiem tra trang thai dang nhap cua admin
     */
    private function _check_login()
    {
    }
}