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

function content_image($image='', $id = 0)
{
	$src = base_url().'images/modules/content/none.gif';
	$check_path = FCPATH.'images/modules/';
	if(!empty($id))
	{
		$url = base_url().'images/modules/content/'.$id.'/';
		$check_path = $check_path.'content/'.$id.'/';
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

function pagination($total_rows = 0,$limit = 0, $url_get = '')
{
  // $config['base_url']             = base_url('admin/content_list').$url_get;
  $config['base_url']             = $url_get;
  $config['total_rows']           = $total_rows;
  $config['per_page']             = $limit;
  $config['full_tag_open']        = '<ul class="pagination" style="margin-top: 0;margin-bottom: 0;">';
  $config['num_tag_open']         = '<li>';
  $config['num_tag_close']        = '</li>';
  $config['first_tag_open']       = '<li>';
  $config['first_tag_close']      = '</li>';
  $config['last_tag_open']        = '<li>';
  $config['last_tag_close']       = '</li>';
  $config['cur_tag_open']         = '<li class="active"><a href="#">';
  $config['cur_tag_close']        = '</a></li>';
  $config['next_tag_open']        = '<li>';
  $config['next_tag_close']       = '</li>';
  $config['prev_tag_open']        = '<li>';
  $config['prev_tag_close']       = '</li>';
  $config['full_tag_close']       = '</ul>';
  $config['enable_query_strings'] = TRUE;
  $config['page_query_string']    = TRUE;
  $config['query_string_segment'] = 'page';
  $config['use_page_numbers']     = TRUE;
  return $config;
  // $this->pagination->initialize($config);

  // return $this->pagination->create_links();
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