<style>
table#cart_ccontents td {
	padding: 10px;
	border: 1px solid #ccc
}
</style>

<div class="box-center">
	<!-- The box-center product-->
	<div class="tittle-box-center">
		<h2>Thông tin giỏ hàng (Có <?php echo $total_items?> sản phẩm)</h2>
	</div>
	<div class="box-content-center product">
		<!-- The box-content-center -->
		<table border="0" cellpadding="0" cellspacing="2" id="boxCart"
			class="boxShadow borderLightGrey">
			<tbody>
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0"
							style="width: 100%">
							<tbody>
								<tr class="boxHeader bgGreen" style="height: 35px;">
									<td width="120"><h6 class="center bold">Hình ảnh</h6></td>
									<td width="*"><h6 class="center bold">Tên sản phẩm</h6></td>
									<td width="80"><h6 class="center bold">Số lượng</h6></td>
									<td width="80"><h6 class="center bold">Đơn giá</h6></td>
									<td width="80"><h6 class="center bold">Tổng</h6></td>
									<td width="60"><h6 class="center bold">Xóa</h6></td>
								</tr>
								<?php $total_amount = 0;?>
                                <?php foreach ($carts as $row):?>
                                <?php $total_amount = $total_amount + $row['subtotal'];?>
								<tr style="height: 60px;">

									<td><p class="center">
											<img
												src="<?php echo base_url()?>/upload/product/<?php echo $row['image_link']?>"
												class="smallImage">
										</p></td>
									<td><p class="">
											<a class="grey" href=""><?php echo $row['name'];?></a>
										</p></td>
									<td><p class="center">
											<input style="width: 20px; border: groove;" type="text"
												name="qty_<?php echo $row['id']?>"
												value="<?php echo $row['qty'];?>"
												onchange="<?php echo $row['id']?>">
										</p></td>
									<td><p class="center"><?php echo number_format($row['price']);?><span
												class="punderline">đ</span>
										</p></td>
									<td><p class="center"><?php echo number_format($row['subtotal']);?><span
												class="punderline">đ</span>
										</p></td>
									<td><p class="center">
											<a href="<?php echo base_url('cart/del/'.$row['id'])?>"><img
												src="<?php echo public_url('/site/images/bin.png')?>"></a>
										</p></td>
								</tr>
								<?php endforeach;?>
								<tr height="20">
									<td colspan="4" style="border-top: 1px dotted #afd789"
										class="right">
										<p class="green">Thành tiền:</p>
									</td>
									<td
										style="border-top: 1px dotted #afd789; font-size: 13px; color: #000000"
										class="center red"><?php echo $total_amount?> <span
										class="punderline">đ</span></td>
									<td style="border-top: 1px dotted #afd789">&nbsp;</td>
								</tr>
								<tr height="20">
									<td colspan="4" class="right">
										<p class="green">Phí vận chuyển:</p>
									</td>
									<td class="center red" style="font-size: 13px; color: #000000">Miễn
										phí <span class="punderline"></span>
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr class="boxHeader bgGreen" style="height: 35px">
									<td colspan="6"><p class="bold" style="padding-left: 20px;">Thông
											tin đặt hàng</p></td>
								</tr>
								<tr style="height: 60px;">
									<td colspan="3"><a href="<?php echo base_url()?>"> 
										<img alt="btn_giaodich" src="<?php echo public_url('/site/images/tieptucmuahang.gif')?>">
										<h6 class="bold content_btn_giaodich">Tiếp tục mua hàng</h6></a>
									</td>
									<td colspan="3"><a href="" >
										<img alt="btn_giaodich" src="<?php echo public_url('/site/images/shopping.gif')?>">
										<h6 class="bold content_btn_giaodich">Thanh toán</h6></a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>