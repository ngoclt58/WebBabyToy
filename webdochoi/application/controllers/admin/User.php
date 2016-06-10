<?php

class User extends MY_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    /*
     * Lay danh sach thành viên
     */
    function index()
    {
        $input = array();
        $list = $this->user_model->get_list($input);
        $this->data['total'] = $this->user_model->get_total();
        $this->data['list'] = $this->user_model->get_list($input);
        // lay noi dung bien message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * check username ton tai
     */
    function check_username()
    {
        $username = $this->input->post('email');
        $where = array(
            'email' => $username
        );
        // kiêm tra xem username đã tồn tại chưa
        if ($this->user_model->check_exists($where)) {
            // trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__, 'Tài khoản đã tồn tại');
            return false;
        }
        return true;
    }

    /*
     * Thêm mới thành viên
     */
    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        // neu ma co du lieu post len
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'name', 'required|min_length[8]');
            $this->form_validation->set_rules('email', 'email', 'required|callback_check_user');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
            $this->form_validation->set_rules('re_password', 'password verify', 'required|matches[password]');
            // nhap lieu chinh xac
            if ($this->form_validation->run()) {
                // them vao csdl
                $name = $this->input->post('name');
                $username = $this->input->post('email');
                $password = $this->input->post('password');
                $data = array(
                    'name' => $name,
                    'email' => $username,
                    'password' => md5($password)
                );
                if ($this->user_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Thêm dữ liệu thất bại');
                }
                redirect(user_url('user'));
            }
        }
        
        $this->data['temp'] = 'admin/user/add';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Ham chinh sua thong tin quan tri vien
     */
    function edit()
    {
        // lay id cua quan tri vien can chinh sua
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        // lay thong cua quan trị viên
        $info = $this->user_model->get_info($id);
        if (! $info) {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        $this->data['info'] = $info;
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required|min_length[8]');
            $this->form_validation->set_rules('email', 'Tài khoản đăng nhập', 'required|callback_check_user');
            
            $password = $this->input->post('password');
            if ($password) {
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]');
                $this->form_validation->set_rules('re_password', 'Nhập lại mật khẩu', 'matches[password]');
            }
            if ($this->form_validation->run()) {
                // them vao csdl
                $name = $this->input->post('name');
                $username = $this->input->post('email');
                
                $data = array(
                    'name' => $name,
                    'email' => $username
                );
                // neu ma thay doi mat khau thi moi gan du lieu
                if ($password) {
                    $data['password'] = md5($password);
                }
                
                if ($this->user_model->update($id, $data)) {
                    // tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                } else {
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                // chuyen tới trang danh sách quản trị viên
                redirect(admin_url('admin'));
            }
        }
        
        $this->data['temp'] = 'admin/user/edit';
        $this->load->view('admin/main', $this->data);
    }

    /*
     * Hàm xóa dữ liệu
     */
    function delete()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        // lay thong tin cua quan tri vien
        $info = $this->user_model->get_info($id);
        if (! $info) {
            $this->session->set_flashdata('message', 'Không tồn tại quản trị viên');
            redirect(admin_url('user'));
        }
        // thuc hiện xóa
        $this->user_model->delete($id);
        
        $this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
        redirect(admin_url('user'));
    }

    function logout()
    {
        if ($this->session->userdata('login')) {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }
}