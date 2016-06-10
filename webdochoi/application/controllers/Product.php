<?php
Class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load model san pham
        $this->load->model('product_model');
    }
    
    /*
     * Hiển thị danh sách sản phẩm theo danh mục
     */
    function index()
    {
        // lay tong so luong ta ca cac san pham trong website
        $total_rows = $this->product_model->get_total();
        $this->data['total_rows'] = $total_rows;
    
        // kiem tra co thuc hien loc du lieu hay khong
        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if ($id > 0) {
            $input['where']['id'] = $id;
        }
        $name = $this->input->get('name');
        if ($name) {
            $input['like'] = array(
                'name',
                $name
            );
        }
        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if ($catalog_id > 0) {
            $input['where']['catalog_id'] = $catalog_id;
        }
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows']=$total_rows;
        // lay danh sach san pham
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;
    
        // lay danh sach danh muc san pham
        $this->load->model('catalog_model');
        $input = array();
        $input['where'] = array(
            'parent_id' => 0
        );
        $catalogs = $this->catalog_model->get_list($input);
        $count = 0;
        foreach ($catalogs as $row) {
            $input['where'] = array(
                'parent_id' => $row->id
            );
            $subs = $this->catalog_model->get_list($input);
            $row->subs = $subs;
            $count = $count +1;
        }
        $this->data['catalogs'] = $catalogs;
        // lay nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
    
        // load view
        $this->data['temp'] = 'site/product/filter';
        $this->load->view('site/main_layout', $this->data);
    }
    
    function catalog()
    {
        //lấy ID của thể loại
        $id = intval($this->uri->rsegment(3));
        //lay ra thông tin của thể loại
        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info($id);
        if(!$catalog)
        {
            redirect();
        }
        
        $this->data['catalog'] = $catalog;
        $input = array();
        
        //kiêm tra xem đây là danh con hay danh mục cha
        if($catalog->parent_id == 0)
        {
            $input_catalog = array();
            $input_catalog['where']  = array('parent_id' => $id);
            $catalog_subs = $this->catalog_model->get_list($input_catalog);
            if(!empty($catalog_subs)) //neu danh muc hien tai co danh muc con
            {
                $catalog_subs_id = array();
                foreach ($catalog_subs as $sub)
                {
                    $catalog_subs_id[] = $sub->id;
                }
                //lay tat ca san pham thuoc cac danh mục con do
                $this->db->where_in('catalog_id', $catalog_subs_id);
            }else{
                $input['where'] = array('catalog_id' => $id);
            }
        }else{
            $input['where'] = array('catalog_id' => $id);
        }
 
        //lấy ra danh sách sản phẩm thuộc danh mục đó
        //lay tong so luong ta ca cac san pham trong website
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        
        //load ra thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;//tong tat ca cac san pham tren website
        $config['base_url']   = base_url('product/catalog/'.$id); //link hien thi ra danh sach san pham
        $config['per_page']   = 15;//so luong san pham hien thi tren 1 trang
        $config['uri_segment'] = 4;//phan doan hien thi ra so trang tren url
        $config['next_link']   = 'Trang kế tiếp';
        $config['prev_link']   = 'Trang trước';
        //khoi tao cac cau hinh phan trang
        $this->pagination->initialize($config);
        
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'], $segment);
        
        
        //lay danh sach san pham
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;
        
        //hiển thị ra view
        $this->data['temp'] = 'site/product/catalog';
        $this->load->view('site/main_layout', $this->data);
    }
    
    /*
     * Xem chi tiết sản phẩm
     */
    function view()
    {
        //lay id san pham muon xem
        $id = $this->uri->rsegment(3);
        $product = $this->product_model->get_info($id);
        if(!$product) redirect();
        $this->data['product'] = $product;
        
        //lấy danh sách ảnh sản phẩm kèm theo
        $image_list = @json_decode($product->image_list);
        $this->data['image_list'] = $image_list;
        
        //lay thong tin cua danh mục san pham
        $catalog = $this->catalog_model->get_info($product->catalog_id);
        $this->data['catalog'] = $catalog;

        //hiển thị ra view
        $this->data['temp'] = 'site/product/view';
        $this->load->view('site/main_layout', $this->data);
    }
}

