<?php
$mod['name'] = $this->router->fetch_class();
$mod['task'] = $this->router->fetch_method();
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Esoftgreat <small>Admin Panel</small>
		</h1>
		<ol class="breadcrumb">
			<li class="active">
				<i class="fa fa-dashboard"></i><a href="<?php echo base_url('admin'); ?>"> Dashboard</a>
			</li>
			<?php
			if(!empty($mod['name']))
			{
				?>
				<li class="active">
					<a href="<?php echo base_url($mod['name']); ?>"> <?php echo $mod['name'] ?></a>
				</li>
				<?php
			}
			// pr($mod);
			if(!empty($mod['task']) || $mod['task'] == 'admin')
			{
				?>
				<li class="active">
					<a href="<?php echo base_url($mod['name'].'/'.$mod['task']); ?>"> <?php echo $mod['task'] ?></a>
				</li>
				<?php
			}?>
		</ol>
	</div>
</div>