<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty(@$this->session->userdata['logged_in']))
{
	$mod['name'] = $this->router->fetch_class();
	$mod['task'] = $this->router->fetch_method();
	// $content = ($mod['task'] == 'index') ? 'admin/content' : $mod['name'].'/'.$mod['task'];

	$mod['string'] = explode('_',$mod['task']);
	$mod['name'] = $mod['string'][0];
	unset($mod['string'][0]);
	$mod['task'] = implode('_',$mod['string']);

	// $content         = $mod['name'].'/'.$mod['task'];
	$content = ($mod['name'] == 'index') ? 'admin/content' : $mod['name'].'/'.$mod['task'];
	$data['content'] = $content;
	$data['task']    = $mod['task'];
	$data['module']  = $mod['name'];

	$this->session->__set('link_js','');
	$this->session->__set('link_css','');
	$this->load->view('admin/home',$data);
}else{
	$this->load->view('user/login');
	// redirect(base_url('user/login'));
}
