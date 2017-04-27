<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('crud_model');
  }
  public function index($id = 0)
  {
    $data['data'] = $this->crud_model->get_data($id);
    $this->load->view('admin/index');
  }
  public function list_edit($id = 0)
  {
    $data['data'] = $this->crud_model->get_row('SELECT * FROM user WHERE id = '.$id);
    $this->load->view('admin/index',$data);
  }
  public function list()
  {
    $data['data'] = $this->crud_model->get_All('SELECT * FROM user');
    $this->load->view('admin/index',$data);
  }
}