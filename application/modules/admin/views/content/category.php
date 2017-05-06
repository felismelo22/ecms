<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
// $this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');

// if(!empty($data_user))
// {
// 	$user_value = $data_user['username'];
// }
// if(!empty($data_user))
// {
// 	pr($data_user);
// }
// pr($parent);
$pagination = $data_cat_list['pagination'];
$cat_list   = $data_cat_list['cat_list'];
$id         = !empty(@intval($data_cat['id'])) ? $data_cat['id'] : '';
$par_id     = @intval($data_cat['par_id']);
$publish = isset($data_cat['publish']) ? $data_cat['publish'] : 1;
pr(@$data_cat);
// pr(@$_POST['description']);
?>
<div class="col-md-4">
	<?php echo form_open(base_url('admin/content_category/'.$id), 'id="cat_edit"');?>
		<div class="panel panel-default">
			<div class="panel panel-heading">
				<h4 class="panel-title">
					<?php echo !empty($id) ? 'Edit' : 'Add'; echo ' Category'; ?>
				</h4>
			</div>
			<div class="panel panel-body">
				<?php
				echo form_hidden('id',$id);
				echo form_label('Parent', 'parent');
				echo form_dropdown(array(
					'name'     => 'par_id',
					'class'=>'form-control',
					'options' => $parent,
					'selected'=> $par_id));
				echo form_label('Title', 'title');
				echo form_input(array(
					'name'     => 'title',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$data_cat['title']));
				echo '			<div id="title_error"></div>';
				// echo form_label('Image', 'image');
				// echo form_upload(array(
				// 	'name'     => 'title',
				// 	'required' => 'required',
				// 	'class'    => 'form-control',
				// 	'value'    => ''));
				// echo '			<div id="title_error"></div>';

				echo form_label('description', 'description');
				echo form_textarea(array(
					'name'  => 'description',
					// 'id'    => 'textckeditor',
					'class' => 'form-control',
					'rows'  => '2',
					'value' => @$data_cat['description']));

				echo form_label('Publish', 'publish');
				echo '<div class="checkbox">';
				echo '<label>';
				echo form_checkbox(array(
					'name' => 'publish',
					'value'=> 'publish',
					'checked' => $publish
					)).' Published';
				echo '</label>';
				echo '</div>';
				?>
			</div>
			<div class="panel panel-footer">
				<?php
				echo form_button(array(
	        'name'    => 'submit',
	        'id'      => 'submit',
	        'value'   => 'true',
	        'type'    => 'success',
	        'content' => 'submit',
	        'class'   => 'btn btn-success'));
				echo form_button(array(
	        'name'    => 'reset',
	        'id'      => 'reset',
	        'value'   => 'true',
	        'type'    => 'reset',
	        'content' => 'reset',
	        'class'   => 'btn btn-warning'));
				?>
			</div>
		</div>
	<?php echo form_close();?>
</div>
<div class="col-md-8">
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
	$this->session->__set('link_js', base_url().'templates/admin/modules/content/js/script.js');
	?>
	<form method="post" action="<?php echo base_url('user/list'); ?>">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<!-- <th>id</th> -->
						<!-- <th>parent id</th> -->
						<th>title</th>
						<th><input id="selectAllPub" type="checkbox">Publish</th>
						<th><input id="selectAllDel" type="checkbox">Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($cat_list))
					{
						foreach ($cat_list as $key => $value)
						{
							?>
							<tr data-id="<?php echo $value['id'] ?>">
								<!-- <td>
									<?php echo $value['id'] ?>
								</td> -->
								<!-- <td>
									<?php echo $value['par_id'] ?>
								</td> -->
								<td><a href="<?php echo base_url('admin/content_category/'.$value['id']) ?>"><?php echo $value['title'] ?></a></td>
								<td>
									<div class="checkbox">
										<label>
											<input type="checkbox" class="pub_check" name="pub_cat[]" value="<?php echo $value['id']; ?>" <?php echo !empty($value['publish']) ? 'checked':''; ?>> Publish
										</label>
									</div>
								</td>
								<td><input type="checkbox" class="del_check" name="del_cat[]" value="<?php echo $value['id']; ?>"> <span class="glyphicon glyphicon-trash"></span></td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<td colspan="3"><?php msg('data kosong', 'danger'); ?></td>
						</tr>
						<?php
					}
					?>
					<tr>
						<td colspan="2">
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
</div>

<!-- <script type="text/javascript">
	CKEDITOR.replace('textckeditor');
</script> -->