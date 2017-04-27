<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('home/meta'); ?>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
		<?php $this->load->view('home/top'); ?>
	</nav>
	<a name="about"></a>
	<div class="intro-header">
		<?php $this->load->view('home/header'); ?>
	</div>
	<!-- /.intro-header -->

	<!-- Page Content -->

	<a  name="services"></a>
	<?php $this->load->view('home/content'); ?>

	<a  name="contact"></a>
	<div class="banner">
		<?php $this->load->view('home/bottom'); ?>
	</div>
	<footer>
		<?php $this->load->view('home/footer'); ?>
	</footer>

	<!-- jQuery -->
	<script src="<?php echo base_url().'templates/admin/'; ?>js/jquery.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url().'templates/admin/'; ?>js/bootstrap.min.js"></script>

</body>

</html>
