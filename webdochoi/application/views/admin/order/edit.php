<!-- head -->
<div class="line"></div>
<div class="line"></div>
<div class="line"></div>

<div class="wrapper">
    
	   	<!-- Form -->
		<form enctype="multipart/form-data" method="post" action="" id="form" class="form">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img class="titleIcon" src="<?php echo public_url('admin')?>/images/icons/dark/add.png">
						<h6>Cập nhật đơn hàng</h6>
					</div>
					
				    <ul class="tabs">
		                <li class="activeTab"><a href="#tab1">Thông tin chung</a></li>
		                
					</ul>
					
					<div class="tab_container">
					     <div class="tab_content pd0" id="tab1" style="display: block;">
					         <div class="formRow">
	<label for="param_name" class="formLeft">Số lượng<span class="req">*</span></label>
	<div class="formRight">
		<span class="oneTwo"><input type="text" _autocheck="true" id="param_title" value="<?php echo $news->qty?>" name="title"></span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error"></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label for="param_name" class="formLeft">Giá tiền<span class="req">*</span></label>
	<div class="formRight">
		<span class="oneTwo"><input type="text" _autocheck="true" id="param_title" value="<?php echo $news->amount?>" name="title"></span>
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error"></div>
	</div>
	<div class="clear"></div>
</div>


				         <div class="formRow hide"></div>
						 </div>
						 
						 <div class="tab_content pd0" id="tab2" style="display: none;">
						     			


<div class="formRow">
	<label for="param_meta_desc" class="formLeft">Meta description:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_desc" name="meta_desc"><?php echo $news->meta_desc?></textarea></span>
		<span class="autocheck" name="meta_desc_autocheck"></span>
		<div class="clear error" name="meta_desc_error"></div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label for="param_meta_key" class="formLeft">Meta keywords:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea cols="" rows="4" _autocheck="true" id="param_meta_key" name="meta_key"><?php echo $news->meta_key?></textarea></span>
		<span class="autocheck" name="meta_key_autocheck"></span>
		<div class="clear error" name="meta_key_error"></div>
	</div>
	<div class="clear"></div>
</div>
						     <div class="formRow hide"></div>
						 </div>
						 
						 <div class="tab_content pd0" id="tab3" style="display: none;">
						      <div class="formRow">
                            	<label class="formLeft">Nội dung:</label>
                            	<div class="formRight">
                            		<textarea class="editor" id="param_content" name="content"><?php echo $news->content?></textarea>
                            		<div class="clear error" name="content_error"></div>
                            	</div>
                            	<div class="clear"></div>
                            </div>
						      <div class="formRow hide"></div>
						 </div>
						
						
	        		</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" class="redB" value="Cập nhật">
	           			<input type="reset" class="basic" value="Hủy bỏ">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>
