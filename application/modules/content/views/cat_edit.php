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
$id = @intval($data_user['id']);
?>
<?php echo form_open(base_url('content/cat_edit/'.$id), 'id="cat_edit"');?>
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4 class="panel-title">
				<?php echo 'Add Category'; ?>
			</h4>
		</div>
		<div class="panel panel-body">
			<?php
			echo form_hidden('id',$id);
			echo form_label('Title', 'title');
			if($id>0)
			{
				echo form_label(@$user_value, @$user_value,array('class'=>'form-control'));
			}else{
				echo form_input(array(
					'name'     => 'title',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$user_value));
				echo '			<div id="title_error"></div>';
			}
			echo form_label('description', 'description');
			echo form_textarea(array(
				'name'     => 'description',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => @$user_value));
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