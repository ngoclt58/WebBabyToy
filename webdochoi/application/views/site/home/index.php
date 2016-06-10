<?php $this->load->view('site/slide');?>

<div class="box-center">
	<!-- The box-center product-->
	<div class="tittle-box-center">
		<h2>Sản phẩm mới</h2>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		<?php foreach ($list as $row):?>
		<div class="product_item">
			<h3>
				<a title="Sản phẩm" href=""> <?php echo $row->name?> </a>
			</h3>
			<div class="product_img">
				<a title="Sản phẩm" href="san-pham-Tivi-LG-520/9.html"> <img alt=""
					src="<?php echo base_url()?>/upload/product/<?php echo $row->image_link?>">
				</a>
			</div>
			<p class="price"><?php echo $row->price-$row->discount?> đ<span
					class="price_old"><?php echo $row->price?> đ</span>
			</p>
			<div class="action">
				<p style="float: left; margin-left: 10px">
					Lượt xem: <b><?php echo $row->view?></b>
				</p>
				<a title="Mua ngay" href="them-vao-gio-9.html" class="button">Mua
					ngay</a>
				<div class="clear"></div>
			</div>
		</div>
		<?php endforeach;?>

		<div class="clear"></div>
<!--        --><?php
//           $nums_page = 3;
//        ?>
<!--        <span style="margin-left: 400px"> Trang: </span>-->
<!--        <span>-->
<!--        --><?php
//            for($page =1; $page<$nums_page;$page++) {
//                echo "<a href='index.php?page={$page}'>{$page} </a>";
//                echo " ";
//            }
//        ?>
<!--        </span>-->
        <?php
        class Pagination
        {
            protected $_config = array(
                'current_page'  => 1, // Trang hiện tại
                'total_record'  => 1, // Tổng số record
                'total_page'    => 1, // Tổng số trang
                'limit'         => 10,// limit
                'start'         => 0, // start
                'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
                'link_first'    => '',// Link trang đầu tiên
            );

            /*
             * Hàm khởi tạo ban đầu để sử dụng phân trang
             */
            function init($config = array())
            {
                /*
                 * Lặp qua từng phần tử config truyền vào và gán vào config của đối tượng
                 * trước khi gán vào thì phải kiểm tra thông số config truyền vào có nằm
                 * trong hệ thống config không, nếu có thì mới gán
                 */
                foreach ($config as $key => $val){
                    if (isset($this->_config[$key])){
                        $this->_config[$key] = $val;
                    }
                }

                /*
                 * Kiểm tra thông số limit truyền vào có nhỏ hơn 0 hay không?
                 * Nếu nhỏ hơn thì gán cho limit = 0, vì trong mysql không cho limit bé hơn 0
                 */
                if ($this->_config['limit'] < 0){
                    $this->_config['limit'] = 0;
                }

                /*
                 * Tính total page, công tức tính tổng số trang như sau:
                 * total_page = ciel(total_record/limit).
                 * Tại sao lại như vậy? Đây là công thức tính trung bình thôi, ví
                 * dụ tôi có 1000 record và tôi muốn mỗi trang là 100 record thì
                 * đương nhiên sẽ lấy 1000/100 = 10 trang đúng không nào :D
                 */
                $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);

                /*
                 * Sau khi có tổng số trang ta kiểm tra xem nó có nhỏ hơn 0 hay không
                 * nếu nhỏ hơn 0 thì gán nó băng 1 ngay. Vì mặc định tổng số trang luôn bằng 1
                 */
                if (!$this->_config['total_page']){
                    $this->_config['total_page'] = 1;
                }

                /*
                 * Trang hiện tại sẽ rơi vào một trong các trường hợp sau:
                 *  - Nếu người dùng truyền vào số trang nhỏ hơn 1 thì ta sẽ gán nó = 1
                 *  - Nếu trang hiện tại người dùng truyền vào lớn hơn tổng số trang
                 *    thì ta gán nó bằng tổng số trang
                 * Đây là vấn đề giúp web chạy trơn tru hơn, vì đôi khi người dùng cố ý
                 * thay đổi tham số trên url nhằm kiểm tra lỗi web của chúng ta
                 */
                if ($this->_config['current_page'] < 1){
                    $this->_config['current_page'] = 1;
                }

                if ($this->_config['current_page'] > $this->_config['total_page']){
                    $this->_config['current_page'] = $this->_config['total_page'];
                }

                /*
                 * Tính start, Như bạn biết trong mysql truy vấn sẽ có limit và start
                 * Muốn tính start ta phải dựa vào số trang hiện tại và số limit trên mỗi trang
                 * và áp dụng công tức start = (current_page - 1)*limit
                */
                $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
            }

            /*
             * Hàm lấy link theo trang
             */
            private function __link($page)
            {
                // Nếu trang < 1 thì ta sẽ lấy link first
                if ($page <= 1 && $this->_config['link_first']){
                    return $this->_config['link_first'];
                }
                // Ngược lại ta lấy link_full
                // Như tôi comment ở trên, link full có dạng domain.com/page/{page}.
                // Trong đó {page} là nơi bạn muốn số trang sẽ thay thế vào
                return str_replace('{page}', $page, $this->_config['link_full']);
            }

            /*
             * Hàm lấy mã html
             * Hàm này ban tạo giống theo giao diện của bạn
             * tôi không có config nhiều vì rất rối
             * Bạn thay đổi theo giao diện của bạn nhé
             */
            function html()
            {
                $p = '';
                // Kiểm tra tổng số trang lớn hơn 1 mới phân trang1
                if ($this->_config['total_record'] > $this->_config['limit'])
                {
                    $p = '<span style="margin-left: 300px">';
                    $p.= "Trang: ";
                    // Nút prev và first
                    if ($this->_config['current_page'] > 1)
                    {
                        $p .= '<a href="'.$this->__link('1').'">First</a>' . " ";
                        $p .= '<a href="'.$this->__link($this->_config['current_page']-1).'">Prev</a>' . " ";
                    }

                    // lặp trong khoảng cách giữa min và max để hiển thị các nút
                    for ($i = 1; $i <= $this->_config['total_page']; $i++)
                    {
                        // Trang hiện tại
                        if ($this->_config['current_page'] == $i){
                            $p .= '<span>'.$i.'</span>' . " ";
                        }
                        else{
                            $p .= '<a href="'.$this->__link($i).'">'.$i.'</a>' . " ";
                        }
                    }

                    // Nút last và next
                    if ($this->_config['current_page'] < $this->_config['total_page'])
                    {
                        $p .= '<a href="'.$this->__link($this->_config['current_page'] + 1).'">Next</a>' . " ";
                        $p .= '<a href="'.$this->__link($this->_config['total_page']).'">Last</a>' . " ";
                    }

                    $p .= '</span>';
                }
                return $p;
            }
        }

        $config = array(
            'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
            'total_record'  => 4, // Tổng số record
            'limit'         => 2,// limit
            'link_full'     => 'index.php?page={page}',// Link full có dạng như sau: domain/com/page/{page}
            'link_first'    => 'index.php',// Link trang đầu tiên
        );

        $paging = new Pagination();

        $paging->init($config);

        echo $paging->html();

        ?>

        <style>


        </style>

	</div>
	<!-- End box-content-center -->
</div>