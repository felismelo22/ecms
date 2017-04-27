<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
$this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');

if(!empty($data_user))
{
	$user_value = $data_user['username'];
}
if(!empty($data_user))
{
	pr($data_user);
}
$id = @intval($data_user['id']);
?>
<?php echo form_open(base_url('user/list_edit/'.$id), 'id="user_edit"');?>
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4 class="panel-title">
				<?php echo 'Add '.$this->router->fetch_class(); ?>
			</h4>
		</div>
		<div class="panel panel-body">
			<?php
			echo form_hidden('id',$id);
			echo form_label('Username', 'username');
			if($id>0)
			{
				echo form_label(@$user_value, @$user_value,array('class'=>'form-control'));
			}else{
				echo form_input(array(
					'name'     => 'username',
					'required' => 'required',
					'class'    => 'form-control',
					'value'    => @$user_value));
				echo '			<div id="user_error"></div>';
			}
			echo form_label('Password', 'password');
			echo form_password(array(
				'name'     => 'password',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => ''));
			echo form_label('Re-Type Password', 're-password');
			echo form_password(array(
				'name'     => 're-password',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => ''));
			?>
			<div id="pass_error"></div>
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