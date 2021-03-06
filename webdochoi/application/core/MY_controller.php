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
                    //lay danh sach danh muc san pham
                    $this->load->model('catalog_model');
                    $input = array();
                    $input['where'] = array('parent_id' => 0);
                    $catalog_list = $this->catalog_model->get_list($input);
                    foreach ($catalog_list as $row)
                    {
                        $input['where'] = array('parent_id' => $row->id);
                        $subs = $this->catalog_model->get_list($input);
                        $row->subs = $subs;
                    }
                    $this->data['catalog_list'] = $catalog_list;
                    
                    //goi toi thu vien
                    $this->load->library('cart');
                    $this->data['total_items']  = $this->cart->total_items();
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