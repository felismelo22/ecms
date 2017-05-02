<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->helper('email');
    $this->load->model('admin_model');
    $this->load->model('content_model');
		$this->load->library('session');
		$this->load->library('pagination');
  }
	public function index()
	{
		$this->load->view('admin/index');
	}

  public function login()
  {
    if(!empty($_POST))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $allow = $this->admin_model->login($username,$password);
      if(!empty($allow))
      {
        $user_data = array(
                      'id' => $allow['id'],
                      'username'=> $allow['username']
                      );
        $this->session->set_userdata('logged_in', $user_data);

        redirect(base_url('admin'));
      }else{
        $data['msg'] = 'pastikan username dan password anda benar';
        $data['alert'] = 'danger';
        $this->load->view('admin/index', $data);
      }
    }else{
      $this->load->view('admin/index');
    }
  }
	public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url('admin'));
  }

  /*USER*/
	public function user_list($page = 0, $keyword = NULL)
	{
    if(!empty($_POST['del_user']))
    {
      $this->admin_model->del_user($_POST['del_user']);
      $data['msg']   = 'data berhasil dihapus';
      $data['alert'] = 'success';
    }

    $data = $this->admin_model->get_all_user($page, $keyword);
		$this->load->view('admin/index',$data);
	}
  public function user_edit($id = 0)
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $data['msg'] = '';
      $data['alert'] = '';
      // if($username != NULL)
      // {
      //   $data['data_user']  = $this->admin_model->get_user($username);
      // }
      if($id != 0)
      {
        $data['data_user']  = $this->admin_model->get_user($id);
      }
      $this->load->view('admin/index', $data);
    }else{
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      if(valid_email($email))
      {
        if($id > 0)
        {pr($_POST);
          $this->admin_model->set_user($id);
          $data['data_user']  = $this->admin_model->get_user($id);
        }else{
          $user = $this->admin_model->get_user($username);
          $data['msg'] = 'Success Saving Data';
          $data['alert'] = 'success';
          if($user['username'] == $username)
          {
            $data['msg'] = 'Failed Saving Data, username exist';
            $data['alert'] = 'danger';
          }
          $this->admin_model->set_user();
        }
      }else{
        $data['msg'] = 'Please insert valid email';
        $data['alert'] = 'danger';
      }
      $this->load->view('admin/index', $data);
    }
  }

  /*CONTENT*/
  public function content_category($id = 0)
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $data['msg'] = '';
      $data['alert'] = '';
      // if($username != NULL)
      // {
      //   $data['data_user']  = $this->admin_model->get_user($username);
      // }
      $data['parent']        = $this->content_model->get_cat_ids();
      $data['data_cat_list'] = $this->content_model->get_cat_list();
      // pr($this->db->last_query());die();
      $parent                = array();

      foreach ($data['parent'] as $key => $value)
      {
        $parent[$value['id']] = $value['title'];
      }
      $parent[0] = 'None';
      $data['parent'] = $parent;
      if($id != 0)
      {
        $data['data_cat']  = $this->content_model->get_cat($id);
      }
      $this->load->view('admin/index', $data);
    }else{
      $title  = $this->input->post('title');
      $par_id = $this->input->post('par_id');
      if($id > 0)
      {
        $row = $this->content_model->get_cat_row('WHERE id = '.$id);
        if($title != $row['title'])
        {
          $cat_row       = $this->content_model->get_cat_row('WHERE par_id = '.$par_id.' AND title = "'.$title.'"');
          $data['msg']   = 'Failed Saving Data, title exist';
          $data['alert'] = 'danger';

          if(empty($cat_row))
          {
            $data['msg'] = 'Success Saving Data';
            $data['alert'] = 'success';
            $this->content_model->set_cat($id);
          }
        }
        // $data['data_cat']  = $this->content_model->get_cat($id);

        $this->content_model->set_user();
      }else{

        $cat_row       = $this->content_model->get_cat_row('WHERE par_id = '.$par_id.' AND title = "'.$title.'"');
        $data['msg']   = 'Failed Saving Data, title exist';
        $data['alert'] = 'danger';

        if(empty($cat_row))
        {
          $data['msg'] = 'Success Saving Data';
          $data['alert'] = 'success';
          $this->content_model->set_cat();
        }
      }

      $data['parent']        = $this->content_model->get_cat_ids();
      $data['data_cat_list'] = $this->content_model->get_cat_list();
      $parent                = array();

      foreach ($data['parent'] as $key => $value)
      {
        $parent[$value['id']] = $value['title'];
      }
      $parent[0] = 'None';
      $data['parent'] = $parent;

      $this->load->view('admin/index', $data);
    }
  }
}
