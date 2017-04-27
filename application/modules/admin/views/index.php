<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!empty(@$this->session->userdata['logged_in']))
{
	$mod['name'] = $this->router->fetch_class();
	$mod['task'] = $this->router->fetch_method();

	$content = ($mod['name'] == 'admin') ? 'admin/content' : $mod['name'].'/'.$mod['task'];
	$data['content'] = $content;

	$this->session->__set('link_js','');

	$this->load->view('admin/home',$data);
}else{
	// $this->load->view('user/login');
	redirect(base_url('user/login'));
}
