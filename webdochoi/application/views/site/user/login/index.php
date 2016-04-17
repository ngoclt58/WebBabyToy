<div class="box-content-center register">
	<!-- The box-content-center -->
	<h1>Đăng nhập</h1>
	<form enctype="multipart/form-data" action="" method="post"
		class="t-form form_action">
		<div class="form-row">
			<label class="form-label" for="param_email">Email:<span class="req">*</span></label>
			<div class="form-item">
				<input type="text" value="" name="email" id="email" class="input">
				<div class="clear"></div>
				<div id="email_error" class="error"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="form-row">
			<label class="form-label" for="param_password">Mật khẩu:<span
				class="req">*</span></label>
			<div class="form-item">
				<input type="password" name="password" id="password" class="input">
				<div class="clear"></div>
				<div id="password_error" class="error"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="form-row">
			<div style="color:red;font-weight:blod"><?php echo form_error('login');?></div>
			<label class="form-label">&nbsp;</label>
			<div class="form-item">
				<input type="submit" name="submit" value="Đăng nhập" class="button">
			</div>
		</div>
	</form>
</div>