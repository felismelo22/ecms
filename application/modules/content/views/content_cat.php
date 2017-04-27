<ul class="nav nav-tabs" style="margin-left: 0;">
  <li class="active"><a data-toggle="tab" href="#menu1"><?php echo 'pilih jasa expedisi' ?></a></li>
  <li><a data-toggle="tab" href="#menu2"><?php echo 'detail expedisi ditawarkan' ?></a></li>
</ul>
<div class="tab-content">
  <div id="menu1" class="tab-pane fade in active">
		<?php include 'cat_list.php' ?>
  </div>
  <div id="menu2" class="tab-pane fade">
	  <?php include 'cat_edit.php' ?>
  </div>
</div>