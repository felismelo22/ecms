<?php defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($msg)&&!empty($alert))
{
	msg($msg,$alert);
}
$this->session->__set('link_js', base_url().'templates/admin/modules/user/js/script.js');

if(!empty($data_user))
{
	$user_value = $data_user['username'];
	$user_email = $data_user['email'];
	$user_role  = $data_user['role'];
}
if(!empty($data_user))
{
	pr($data_user);
}
$id = !empty(@intval($data_user['id'])) ? $data_user['id']: '';
$validate_error = validation_errors();
if(!empty($validate_error))
{
	msg($validate_error, 'danger');
}
?>
<?php echo form_open(base_url('admin/user_edit/'.$id), 'id="user_edit"');?>
	<div class="panel panel-default">
		<div class="panel panel-heading">
			<h4 class="panel-title">
				<?php echo !empty($id) ? 'Edit ' : 'Add '; echo ucfirst($module); ?>
			</h4>
		</div>
		<div class="panel panel-body">
			<?php
			echo form_hidden('id',$id);
			echo form_label('Email', 'email');
			echo form_input(array(
				'name'     => 'email',
				'required' => 'required',
				'class'    => 'form-control',
				'value'    => @$user_email));
			echo form_label('Username', 'username');
			if($id>0)
			{
				echo form_label(@$user_value, @$user_value,array('class'=>'form-control'));
				echo form_hidden('username',@$user_value);
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
			echo '<div id="pass_error"></div>';
			echo form_label('Role', 'role');
			echo form_dropdown(array(
				'name'     => 'role',
				'class'=>'form-control',
				'options'    => array(
					'1'=>'admin',
					'2'=>'editor',
					'3'=>'author',
					'4'=>'contributor',
					'5'=>'subscriber'
					),
				'selected'=>@$user_role));
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