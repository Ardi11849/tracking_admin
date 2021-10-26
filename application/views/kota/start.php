<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('kota/css/css')?>
</head>
<body>
	<div class="container-scroller">
		<?php $this->load->view('template/navbar');?>
		<div class="container-fluid page-body-wrapper">
			<?php $this->load->view('template/sidebar');?>
			<div class="main-panel">
				<?php $this->load->view('kota/kotaBesar');?>
				<?php $this->load->view('kota/kota');?>
				<?php $this->load->view('template/footer');?>
			</div>
		</div>
	</div>
</body>
<?php $this->load->view('kota/js/js')?>
</html>