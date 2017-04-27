<?php defined('BASEPATH') OR exit('No direct script access allowed');
function msg($msg = 'alert', $alert = 'default')
{
	?>
	<div class="alert alert-<?php echo $alert; ?>">
	  <strong><?php echo $alert; ?>!</strong> <?php echo $msg; ?>.
	</div>
	<?php
}

function image_module($module = '', $image = '')
{
	$src = base_url().'images/modules/content/none.gif';
	$check_path = FCPATH.'images/modules/';
	if(!empty($module))
	{
		$url = base_url().'images/modules/'.$module;
		$check_path = $check_path.$module;
		if(!empty($image))
		{
			$url = $url.$image;
			$check_path = $check_path.$image;
			if(file_exists($check_path))
			{
				$src = $url;
			}
		}
	}
	return $src;
}

function image_upload($image = '')
{
	$src        = base_url().'images/modules/content/none.gif';
	$url        = base_url().'images/uploads/';
	$check_path = FCPATH.'images/uploads/';

	if(!empty($image))
	{
		$url = $url.$image;
		$check_path = $check_path.$image;
		if(file_exists($check_path))
		{
			$src = $url;
		}
	}
	return $src;
}