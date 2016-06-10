

<!-- The Fanpage -->
<div>
	<nav class="navbar navbar-default" style = "background-color:#DCDCDC;height:3px;">
        <div class="container-fluid" >
	       <div class="navbar-header" >
		      <a class="navbar-brand" style = "color:#2385c4 ;">Tìm kiếm</a>
	       </div>
        </div>
    </nav>
	<div>
		<center>
			<form method="get" action="<?php echo base_url('product')?>"
				class="form-item">
				<table width="80%" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
						    <div class="form-group">
                                <input type="text" class="form-control" placeholder = "Mã số">
                            </div>
						</tr>
						<tr>
							<div class="form-group">
                                <input type="text" class="form-control" placeholder = "Tên"
                                id="filter_id" value="<?php echo $this->input->get('id')?>"
    							name="id">
                            </div>
								
						</tr>
						<tr>
						    <div class="form-group">	
    							<input type="text" class="form-control" placeholder="Thể loại"
                                 id="filter_iname" value="<?php echo $this->input->get('name')?>"
                                name = "name"> 
                            </div>
						</tr>
						<tr> 
						<div class="row">
                            <div class="col-xs-12">
						    <div class = "form-group">
						     <select class = "selectpicker form-control" name="catalog" value ="abc">
									 <option value="Lua chon"></option> 
									<!-- kiem tra danh muc co danh muc con hay khong -->
										<?php foreach ($catalogs as $row):?>
										<?php if(count($row->subs) > 1):?>
    				      				<optgroup label="<?php echo $row->name?>">
    				      				    <?php foreach ($row->subs as $sub):?>
    				               			<option value="<?php echo $sub->id?>"
											<?php echo ($this->input->get('catalog') == $sub->id) ? 'selected' : ''?>> <?php echo $sub->name?> </option>
    						                <?php endforeach;?>
    				               		</optgroup>
    				               		<?php else:?>
    				               		  <option value="<?php echo $row->id?>"
										<?php echo ($this->input->get('catalog') == $row->id) ? 'selected' : ''?>><?php echo $row->name?></option>
    				               		<?php endif;?>
    				               		<?php endforeach;?>
								</select>
							</div>
							</div>
							</div>
						</tr>
						<tr>
							<div class="form-group">
						         <button type="submit" class="btn btn-primary" >Lọc</button>
						         <button type="submit" class="btn btn-primary" onclick="window.location.href = '<?php echo base_url('product')?>'; " >Reset</button>
                            </div>
						</tr>
					</tbody>
				</table>
			</form>
		</center>
	</div>
</div>
<!-- End Fanpage -->


