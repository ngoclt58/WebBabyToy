<div id="left">
	<?php foreach ($catalog_list as $row):?>
	<ul class="catalog-main">
		<div class="m1">
			<a href="<?php echo base_url('product/catalog/'.$row->id)?>"
				title="<?php echo $row->name?>"><?php echo $row->name?></a>
		</div>

        <?php if(!empty($row->subs)):?>
        <!-- lay danh sach danh muc con -->

		<ul class="menu1">
    		<?php foreach ($row->subs as $sub):?>    					                    
    			<li class="first"><h3 class="i1" style="padding-left: 25px">
					<a class="active"
						href="<?php echo base_url('product/catalog/'.$sub->id)?>"
						title="<?php echo $sub->name?>"> 
    						<?php echo $sub->name?></a>
				</h3></li>
            <?php endforeach;?>		 			                    
    	</ul>
		<?php endif;?>
	</ul>
	<?php endforeach;?>
</div>