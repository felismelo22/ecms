<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('html');
    $this->load->model('admin_model');
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
      if($id > 0)
      {
        if($this->user_mode->is_exist($username))
        {
          $data['msg']   = 'username '.$username.' was exist';
          $data['alert'] = 'danger';
        }else{
          $this->admin_model->set_user($id);
          $data['data_user']  = $this->admin_model->get_user($id);
        }
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
      $this->load->view('admin/index', $data);
    }

  }
}
