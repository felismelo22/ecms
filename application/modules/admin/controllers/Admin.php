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
    if(!empty($this->input->post('delete')))
    {
      if(!empty($_POST['del_user']))
      {
        $this->admin_model->del_user($_POST['del_user']);
        $data['msg']   = 'data berhasil dihapus';
        $data['alert'] = 'success';
      }
    }
    if(!empty($this->input->post('publish')))
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
        {
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
      $data['msg']           = '';
      $data['alert']         = '';
      $data['parent']        = $this->content_model->get_cat_ids();
      $data['data_cat_list'] = $this->content_model->get_cat_list();
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
      // echo $this->input->post('description');
      // pr($_POST);die();
      $title  = $this->input->post('title');
      $par_id = $this->input->post('par_id');
      if($id > 0)
      {
        $row = $this->content_model->get_cat_data('WHERE id = '.$id);
        $cat_row       = $this->content_model->get_cat_data('WHERE par_id = '.$par_id.' AND title = "'.$title.'"');

        if($title != $row['title'])
        {
          $data['msg']   = 'Failed Saving Data, title exist';
          $data['alert'] = 'danger';

          if(empty($cat_row))
          {
            $data['msg'] = 'Success Saving Data';
            $data['alert'] = 'success';
            $this->content_model->set_cat($id);
          }
        }else{
          $data['msg']   = 'Failed Saving Data, title exist';
          $data['alert'] = 'danger';

          if(!empty($cat_row))
          {
            $data['msg'] = 'Success Saving Data';
            $data['alert'] = 'success';
            $this->content_model->set_cat($id);
          }
        }
        // $data['data_cat']  = $this->content_model->get_cat($id);

        // $this->content_model->set_user();
      }else{

        $cat_row       = $this->content_model->get_cat_data('WHERE par_id = '.$par_id.' AND title = "'.$title.'"');
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

      if(!empty($_POST['del_cat']))
      {
        $this->content_model->del_data('category',$_POST['del_cat']);
        $data['msg']   = 'data berhasil dihapus';
        $data['alert'] = 'success';
      }

      if(!empty($this->input->post('id')))
      {
        $this->content_model->update_data('category',$this->input->post('pub_cat'));
        $data['msg']   = 'data berhasil di update';
        $data['alert'] = 'success';
      }

      $this->load->view('admin/index', $data);
    }
  }
  public function content_edit($id = 0)
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('title', 'Title', 'required');

    $data['category'] = $this->content_model->get_cat_ids();
    $category = array();
    $data['category_data'] = $this->content_model->get_cat_all('id,par_id,title', 'WHERE publish = 1');

    foreach ($data['category'] as $key => $value)
    {
      $category[$value['id']] = $value['title'];
    }
    $data['category'] = $category;

    if ($this->form_validation->run() === FALSE)
    {

    }else{
      $data['msg'] = 'Content Saved Failed';
      $data['alert'] = 'danger';
      if($id > 0)
      {
        if(!empty($_FILES['image']['name']))
        {
          $type = $_FILES['image']['type'];
          if($type != 'image/jpeg')
          {
            $data['msg'] = 'only upload image with jpg/jpeg format';
            $data['alert'] = 'danger';
          }else{
            $data['msg'] = 'Content Saved Successfully';
            $data['alert'] = 'success';
            $this->content_model->set_content($id);
          }
        }else{
          $data['msg'] = 'Content Saved Successfully';
          $data['alert'] = 'success';
          $this->content_model->set_content($id);
        }
      }else{
        if(!empty($_FILES['image']['name']))
        {
          $type = $_FILES['image']['type'];
          if($type != 'image/jpeg')
          {
            $data['msg'] = 'only upload image with jpg/jpeg format';
            $data['alert'] = 'danger';
          }else{
            $data['msg'] = 'Content Saved Successfully';
            $data['alert'] = 'success';
            $this->content_model->set_content();
          }
        }else{
          $data['msg'] = 'Content Saved Successfully';
          $data['alert'] = 'success';
          $this->content_model->set_content();
        }
      }
    }
    // pr($data);
    $data['data'] = $this->content_model->get_content($id);
    $this->load->view('admin/index', $data);
  }
  public function content_list()
  {
    $this->load->helper('date');
    if(!empty($this->input->post('publish')))
    {
      $this->content_model->publish_data('content', $this->input->post('pub_content'));
      $data['msg']   = 'Content Updated Successfully';
      $data['alert'] = 'success';
    }
    if(!empty($this->input->post('delete')))
    {
      $this->content_model->del_data('content', $this->input->post('del_content'));
      $data['msg']   = 'Content Deleted Successfully';
      $data['alert'] = 'success';
      if(empty($this->input->post('del_content')))
      {
        $data['msg']   = 'No Data selected to delete';
        $data['alert'] = 'success';
      }
    }
    $data['data'] = $this->content_model->get_content_list();
    $this->load->view('admin/index',$data);
  }
}
