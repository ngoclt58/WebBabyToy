<?php
Class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('order_model');
    }
    
    /*
     * Lay ra danh sach danh muc san pham
     */
    function index()
    {
        // lay tong so luong ta ca cac san pham trong websit
        $total_rows = $this->order_model->get_total();
        $this->data['total_rows'] = $total_rows;
        
        // load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows; // tong tat ca cac san pham tren website
        $config['base_url'] = admin_url('order/index'); // link hien thi ra danh sach san pham
        $config['per_page'] = 5; // so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4; // phan doan hien thi ra so trang tren url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';
        // khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        
        $input = array();
        $input['limit'] = array(
            $config['per_page'],
            $segment
        );
        
        // kiem tra co thuc hien loc du lieu hay khong
        // $id = $this->input->get('id');
        // $id = intval($id);
        // $input['where'] = array();
        // if ($id > 0) {
        //     $input['where']['id'] = $id;
        // }
        // $name = $this->input->get('name');
        // if ($name) {
        //     $input['like'] = array(
        //         'name',
        //         $name
        //     );
        // }
        // $catalog_id = $this->input->get('catalog');
        // $catalog_id = intval($catalog_id);
        // if ($catalog_id > 0) {
        //     $input['where']['catalog_id'] = $catalog_id;
        // }
        
        // lay danh sach san pham
        $list = $this->order_model->get_list($input);
        $this->data['list'] = $list;
        
        // lay danh sach danh muc san pham
        $this->load->model('order_model');
        $input = array();
        $input['where'] = array(
            'id' => 0
        );
        $catalogs = $this->order_model->get_list($input);
        foreach ($catalogs as $row) {
            $input['where'] = array(
                'id' => $row->id
            );
            $subs = $this->order_model->get_list($input);
            $row->subs = $subs;
        }
        $this->data['catalogs'] = $catalogs;
        
        // lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        
        // load view
        $this->data['temp'] = 'admin/order/index';
        $this->load->view('admin/main', $this->data);
    }
    
     function edit()
    {
        $id = $this->uri->rsegment('3');
        $news = $this->order_model->get_info($id);
        if(!$news)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
            redirect(admin_url('order'));
        } else {
            $this->session->set_flashdata('message', 'Không tồn tại bài viết này');
        }
        $this->data['news'] = $news;
       
       
        //load thư viện validate dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
        
        //neu ma co du lieu post len thi kiem tra
        if($this->input->post())
        {
            $this->form_validation->set_rules('qty', 'Qty', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
           
            
            //nhập liệu chính xác
            if($this->form_validation->run())
            {
               
                //lay ten file anh minh hoa duoc update len
            
                 //luu du lieu can them
                $data = array(
                    'qty'      => $this->input->post('qty'),
                    'amount'  => $this->input->post('amount'),
                ); 
               
                //them moi vao csdl
                if($this->order_model->update($order->id, $data))
                {
                    //tạo ra nội dung thông báo
                    $this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
                }else{
                    $this->session->set_flashdata('message', 'Không cập nhật được');
                }
                //chuyen tới trang danh sách
                redirect(admin_url('order'));
            }
        }
        
        
        //load view
        $this->data['temp'] = 'admin/order/edit';
        $this->load->view('admin/main', $this->data);
    }
    
    /*
     * Xoa du lieu
     */
    function del()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        
        //tạo ra nội dung thông báo
        $this->session->set_flashdata('message', 'Xóa bài viết thành công');
        redirect(admin_url('order'));
    }
    
    /*
     * Xóa nhiều bài viết
     */
    function delete_all()
    {
        //lay tat ca id bai viet muon xoa
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id);
        }
    }
    
    /*
     *Xoa bài viết
     */
    private function _del($id)
    {
        $order = $this->order_model->get_info($id);
        if(!$order)
        {
            //tạo ra nội dung thông báo
            $this->session->set_flashdata('message', 'không tồn tại bài viết này');
            redirect(admin_url('order'));
        }
        //thuc hien xoa bài viết
        $this->order_model->delete($id);
        //xoa cac anh cua bài viết
        
    }
}

