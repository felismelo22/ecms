<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form method="get" action="<?php echo base_url('admin/content_category') ?>" class="form-inline pull-right">
	<input type="text" name="keyword" class="form-control" placeholder="keyword" value="<?php echo @$_GET['keyword'] ?>">
	<button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
</form>
<hr>
<div class="clearfix"></div>
<?php
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
?>
<form method="post" action="<?php echo base_url('admin/content_list'); ?>">
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>IMAGE</th>
					<th>TITLE</th>
					<th>
						<div class="checkbox">
							<label>
								<input id="selectAllPub" type="checkbox">PUBLISH
							</label>
						</div>
					</th>
					<th>
						<div class="checkbox">
							<label>
								<input id="selectAllDel" type="checkbox">DELETE
							</label>
						</div>
					</th>
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
							<td><a href="<?php echo base_url('admin/content_edit/'.$value['id']) ?>"><?php echo $value['id'] ?></a></td>
							<td><img src="<?php echo content_image($value['image'],$value['id']); ?>" data-toggle="modal" data-target="#cat_img_<?php echo $value['id']?>" class="img-thumbnail img-responsive" style="cursor:pointer; object-fit: cover;width: 30px;height: 30px;"></td>
							<!-- <td><a href="<?php echo base_url('admin/content_category/'.$value['id']) ?>"><?php echo $value['image'] ?></a></td> -->
							<td><a href="<?php echo base_url('admin/content_edit/'.$value['id']) ?>"><?php echo $value['title'] ?></a></td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="pub_check" name="pub_cat[]" value="<?php echo $value['id']; ?>" <?php echo !empty($value['publish']) ? 'checked':''; ?>> Publish
									</label>
								</div>
							</td>
							<td>
								<div class="checkbox">
									<label>
										<input type="checkbox" class="del_check" name="del_cat[]" value="<?php echo $value['id']; ?>"> <span class="glyphicon glyphicon-trash"></span>
									</label>
								</div>
							</td>
						</tr>
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
						<button type="submit" class="btn btn-success btn-sm">
							<span class="glyphicon glyphicon-floppy-disk"></span> SAVE
						</button>
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
		        <img src="<?php echo content_image($value['image'], $value['id']); ?>" data-toggle="modal" data-target="#cat_img_<?php echo $value['id']?>" class="img-thumbnail img-responsive" style="cursor:pointer; object-fit: cover;width: 350px;height: 350px;">
		      </div>
		      <div class="modal-footer">
		      </div>
		    </div>
		  </div>
		</div>
		<?php
	}
}?>