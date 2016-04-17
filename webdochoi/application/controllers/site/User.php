<?php

class User extends MY_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /*
     * Lấy thông tin của người sử dụng
     */
    function index()
    {}

    /*
     * check tai khoan ton tai
     */
    function check_email()
    {
        $email = $this->input->post('email');
        $where = array(
            'email' => $email
        );
        // kiêm tra xem email đã tồn tại chưa
        if ($this->user_model->check_exists($where)) {
            // trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }

    /*
     * Đăng ký tài khoản
     */
    function register()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        // neu ma co du lieu post len
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'name', 'required|min_length[8]');
            $this->form_validation->set_rules('email', 'email', 'required|callback_check_email');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
            $this->form_validation->set_rules('re_password', 'password verify', 'required|matches[password]');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            $this->form_validation->set_rules('address', 'address', 'required');
            // nhap lieu chinh xac
            if ($this->form_validation->run()) {
                // them vao csdl
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => md5($password),
                    'phone' => $phone,
                    'address' => $address
                );
                if ($this->user_model->create($data)) {
                    $this->session->set_flashdata('message', 'Đăng ký thành công');
                } else {
                    $this->session->set_flashdata('message', 'Đăng ký thất bại');
                }
                redirect(base_url());
            }
        }
        $data['temp'] = 'site/user/register/index';
        $this->load->view('site/main_layout', $data);
    }

    /*
     * Kiem tra email va password co chinh xac khong
     */
    function check_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = md5($password);
        
        $this->load->model('user_model');
        $where = array(
            'email' => $email,
            'password' => $password
        );
        if ($this->user_model->check_exists($where)) {
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Không đăng nhập thành công');
        return false;
    }

    /*
     * Đăng nhập
     */
    function login()
    {
        if(isset($this->session->username['email'])){
            $this->load->library('form_validation');
            $this->load->helper('form');
            if ($this->input->post()) {
                $this->form_validation->set_rules('login', 'login', 'callback_check_login');
                if ($this->form_validation->run()) {
                    $this->session->set_userdata('email', $this->input->post('email'));
                    redirect(base_url());
                }
            }
            $data['temp'] = 'site/user/login/index';
            $this->load->view('site/main_layout', $data);
        }else{
            redirect(base_url());
        }
    }
}