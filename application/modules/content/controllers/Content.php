<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->library('session');
    $this->load->model('content_model');
    $this->load->library('pagination');
  }

  public function index()
	{
		$this->load->view('admin/index');
	}

  public function cat_list($par_id = 0, $page = 0, $keyword = NULL)
  {
    if(!empty($_POST['del_cat']))
    {
      $this->content_model->del_cat($_POST['del_user']);
      $data['msg']   = 'data berhasil dihapus';
      $data['alert'] = 'success';
    }

    $data = $this->content_model->get_all_category($par_id, $page, $keyword);
    $this->load->view('admin/index',$data);
  }

  public function cat_edit($id = 0)
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->load->view('admin/index');
    // echo 'iwan';
  }
  public function content_cat()
  {
    $this->load->view('admin/index');
  }
}