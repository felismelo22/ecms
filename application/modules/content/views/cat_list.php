<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form method="get" action="<?php echo base_url('content/cat_list') ?>" class="form-inline pull-right">
	<input type="text" name="keyword" class="form-control" placeholder="keyword">
	<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
</form>
<hr>
<div class="clearfix"></div>
<?php
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
// $this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');
?>
<form method="post" action="<?php echo base_url('content/cat_list'); ?>">
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Image</th>
					<th>Title</th>
					<th><input id="selectAll" type="checkbox">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($data))
				{
					foreach ($data as $key => $value)
					{
						?>
						<tr data-id="<?php echo $value['id'] ?>">
							<td><?php echo $value['id'] ?></td>
							<td><img src="<?php echo image_module('content',$value['image']); ?>" data-toggle="modal" data-target="#cat_img_<?php echo $value['id']?>" class="img-thumbnail img-responsive" style="cursor:pointer; object-fit: cover;width: 30px;height: 30px;"></td>
							<td><a href="<?php echo base_url('content/cat_edit/'.$value['id']) ?>"><?php echo $value['title'] ?></a></td>
							<td><input type="checkbox" name="del_cat[]" value="<?php echo $value['id']; ?>"> <span class="glyphicon glyphicon-trash"></span></td>
						</tr>
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="cat_img_<?php echo $value['id']?>">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="cat_img_title_<?php echo $value['id']?>">cat_img_<?php echo $value['id']?></h4>
						      </div>
						      <div class="modal-body">
						        ...
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <button type="button" class="btn btn-primary">Save changes</button>
						      </div>
						    </div>
						  </div>
						</div>
						<?php
					}
				}else{
					?>
					<tr>
						<td colspan="4"><?php msg('data kosong', 'danger'); ?></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="3">
						<?php
						 echo $pagination;
						 ?>
					</td>
					<td>
						<button type="submit" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-trash"></span> DELETE
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>
<?php
if(!empty($data))
{
	foreach ($data as $key => $value)
	{
		?>
		<div class="modal fade" id="cat_img_<?php echo $value['id']?>" tabindex="-1" role="dialog" aria-labelledby="cat_img_<?php echo $value['id']?>">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="cat_img_title_<?php echo $value['id']?>">cat_img_<?php echo $value['id']?></h4>
		      </div>
		      <div class="modal-body" style="text-align: center;">
		        <img src="<?php echo image_module('content',$value['image']); ?>" data-toggle="modal" data-target="#cat_img_<?php echo $value['id']?>" class="img-thumbnail img-responsive" style="cursor:pointer; object-fit: cover;width: 350px;height: 350px;">
		      </div>
		      <div class="modal-footer">
		      </div>
		    </div>
		  </div>
		</div>
		<?php
	}
}?>
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->