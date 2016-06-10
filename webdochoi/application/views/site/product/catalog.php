
<div class="box-center">
	<!-- The box-center product-->
	<!-- <div class="tittle-box-center">
		<h2><?php echo $catalog->name?> (Có <?php echo $total_rows?> sản phẩm)</h2>
	</div> -->
	
	<nav class="navbar navbar-default" style = "background-color:#DCDCDC;height:3px;">
        <div class="container-fluid" >
	       <div class="navbar-header" >
		      <a class="navbar-brand" style = "color:#2385c4 ;"><?php echo $catalog->name?> (Có <?php echo $total_rows?> sản phẩm)</a>
	       </div>
        </div>
    </nav>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		
		            <?php foreach ($list as $row):?>
		            <div class="product_item">
			<h3>
				<a title="Sản phẩm" href=""> <?php echo $row->name?> </a>
			</h3>
			<div class="product_img">

				<a title="Sản phẩm"
					href="<?php echo base_url('product/view/'.$row->id)?>"> <img
					style="max-width: 130px; max-height: 130px;" alt=""
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
	</div>
	<!-- End box-content-center -->

	<div class="pagination">
		          <?php echo $this->pagination->create_links()?>
             </div>
</div>
