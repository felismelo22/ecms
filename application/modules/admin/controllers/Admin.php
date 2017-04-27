<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
		$this->load->library('session');
  }
	public function index()
	{
		$this->load->view('admin/index');
	}
}
