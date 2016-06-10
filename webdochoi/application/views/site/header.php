<!-- The box-header-->
<link rel="stylesheet"
	href="<?php echo public_url()?>/js/jquery/autocomplete/css/smoothness/jquery-ui-1.8.16.custom.css"
	type="text/css">
<script
	src="<?php echo public_url()?>/js/jquery/autocomplete/jquery-ui-1.8.16.custom.min.js"
	type="text/javascript"></script>



<div class="top">
	<!-- The top -->
	<div id="logo">
		<!-- the logo -->
		<a title="Website đồ chơi group TTN" href=""> <img
			alt="Website đồ chơi group TTN"
			src="<?php echo public_url()?>/site/images/banner.png">
		</a>
	</div>
	<!-- End logo -->
	<div class="clear"></div>
	<!--  load gio hàng -->
	<div class="helper" style="">
		<div style="height: 33px; text-align: right;">
			<?php if($this->session->userdata('email')){?>
				<a style="vertical-align: 12px; line-height: 10px;" href="<?php echo base_url('cart')?>">Giỏ hàng(<span
				id="totalItem"><?php echo $total_items?></span>) 
				<img src="<?php echo public_url()?>/site/images/icon_cart.png" style="width: 20px; height: 20px;"/>  
			<?php }else{?>
				<a style="vertical-align: 1px; line-height: 10px;" href="">Giỏ hàng(<span
				id="totalItem">0</span>) 
				<img
				src="<?php echo public_url()?>/site/images/icon_cart.png" style="width: 20px; height: 20px;"/>  
			<?php }?>
			<!--  </a> <a href="#" id="btnSearch"
				onclick="$('#searchBox').animate({opacity:'toggle'});"><img
				src="<?php echo public_url()?>/site/images/btn_search.png" /></a>
			<div id="searchBox" class="hide">
				<span class="close" onclick=""></span>
				<form id="fSearch" action="/ket-qua-tim-kiem.8.0.html" method="POST">
				</form>
			</div>-->
			<form id="login" action="" method="post">
				<?php if($this->session->userdata('email')){?>
					<span style="color: red;">Xin chào: <b><?php echo $this->session->userdata('email')?></b></span>
					<input name="dangnhap" value="Đăng xuất" type="submit" class="btn-log logout">
				<?php }else{?>	
					<input name="dangnhap" value="Đăng nhập" type="submit" class="btn-log login">
				<?php }?>
				<input name="dangnhap" value="Đăng ký" type="button" class="btn-login1">
			</form>
			<script type="text/javascript">
    			$('.btn-login1').click(function(e){            
    	            window.location = "<?php echo base_url('/site/user/register')?>";
    	            return false;
    			});	
    			$('.login').click(function(e){            
            		window.location = "<?php echo base_url('/site/user/login')?>";
    	            return false;
				});
    			$('.logout').click(function(e){            
            		window.location = "<?php echo base_url('/site/user/logout')?>";
    	            return false;
				});	
			</script>
		</div>
	</div>
	<!-- clear float -->
</div>
<!-- End top -->
<!-- End box-header  -->

<!-- The box-header-->
<div id="menu">
	<!-- the menu -->
	<ul class="menu_top">
		<div class="inner">

			<div id="menu">
				<ul class="parent">
					<li><a href="<?php echo base_url()?>" class="first lblue p1">Trang
							chủ</a></li>
					<li><a href="" class="lblue p1">Giới thiệu</a></li>
					<li><a href="" class="lblue p1">Hướng dẫn</a></li>
					<li><a href="" class="lblue p1">Thông tin</a></li>
				</ul>
			</div>
		</div>
	</ul>
</div>
<script type="text/javascript">
$(function() {
    $( "#text-search" ).autocomplete({
        source: "product/search_ac.html",
    });
});

$('#menu .parent li').each(function(){
    $(this).hover(function(){
        $(this).find('a').eq(0).addClass('active');
    }, function(){
        $(this).find('a').eq(0).removeClass('active');
    });
});

</script>
<!-- End menu -->
<!-- End box-header  -->