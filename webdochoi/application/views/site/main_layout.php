<html>
	<head></head>
	<body>
		<div id="wrapper">
			<div id="header">
				<?php $this->load->view('site/layout/header')?>
			</div>
			<div id="left">
				<?php $this->load->view('site/layout/left')?>
			</div>
			<div id="content">
				<?php $this->load->view($temp)?>
			</div>
			<div id="right">
				<?php $this->load->view('site/layout/right')?>
			</div>
			<div id="footer">
				<?php $this->load->view('site/layout/footer')?>
			</div>
		</div>
	</body>
</html>