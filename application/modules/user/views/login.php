<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');
?>
<!DOCTYPE html>
<html>
	<head>
	 <?php $this->load->view('admin/header'); ?>
	 <style type="text/css">
	 	label{
	 		color: white;
	 	}
	 	.form-group{
	 		margin-top: 10px;
	 	}
	 </style>
	 <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url().'images/logo.png' ?>">
	</head>
	<body>
		<div id="login" style="max-width: 250px;margin:auto;padding-top: 7%;">
			<?php
			if(!empty($msg)&&!empty($alert))
			{
				msg($msg,$alert);
			}
			?>
			<div class="img_logo">
				<!-- <img src="<?php echo base_url().'images/logo.png' ?>" style="width: 100%;"> -->
				<img src="<?php echo image_upload('logo.png'); ?>" style="width: 100%;">
			</div>
			<form method="post" action="<?php echo base_url('user/login') ?>">
				<label>username</label>
				<input type="text" name="username" class="form-control">
				<label>password</label>
				<input type="password" name="password" class="form-control">
				<div class="form-group">
					<div class="col-md-6" style="padding: 0;">
						<button class="btn btn-sm btn-success form-control">login</button>
					</div>
					<div class="col-md-6" style="padding: 0;">
						<button class="btn btn-sm btn-warning form-control">reset</button>
					</div>
				</div>
			</form>
		</div>
		<?php $this->load->view('admin/footer'); ?>
	</body>
</html>