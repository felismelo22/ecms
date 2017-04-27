<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_user($id = 0)
	{
		// if ($username === FALSE || $id ===0)
		// {
		// 	$query = $this->db->get('user');
		// 	// $query = $this->db->get_where('user', '1',2,5);
		// 	return $query->result_array();
		// }

		$query = $this->db->get_where('user', array('id' => $id));

		return $query->row_array();
	}

	public function get_all_user($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = '';
		$limit = 12;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = '?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('user');
    }else{
      $query = $this->db->query('SELECT id FROM user WHERE id = "'.$keyword.'" OR username = "'.$keyword.'" ORDER BY ID DESC');
      $total_rows = $query->num_rows();
    }

    $config['base_url']   = base_url('user/list').$url_get;
    $config['total_rows'] = $total_rows;
    $config['per_page']   = $limit;
    $config['full_tag_open'] = '<ul class="pagination" style="margin-top: 0;margin-bottom: 0;">';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['full_tag_close'] = '</ul>';
    $config['enable_query_strings'] = TRUE;
    $config['page_query_string'] = TRUE;
    $config['query_string_segment'] = 'page';
    $config['use_page_numbers'] = TRUE;
    $this->pagination->initialize($config);

    $data['pagination'] = $this->pagination->create_links();

		if($page>0)
		{
			$page = $page-1;
		}
		$page = @intval($page)*$limit;
		$this->db->limit($limit,$page);
		if($keyword != NULL)
		{
			$this->db->or_where(array(
																'id'=>$keyword,
																'username'=>$keyword
															));
		}
		$query = $this->db->get('user');
		$data['data_user'] = $query->result_array();
		return $data;

		// untuk menampilkan query terakhir
		// pr($this->db->last_query());die();

	}

	public function set_user($id = 0)
	{
		$this->load->helper('url');

		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);
		if($id > 0)
		{
			return $this->db->update('user', $data, 'id = '.$id);
		}else{
			return $this->db->insert('user', $data);
		}
	}

	public function del_user($ids = array())
	{
		if(!empty($ids))
		{
			foreach ($ids as $key => $id)
			{
				$this->db->delete('user', array('id'=>$id));
			}
		}
	}

	public function login($username = NULL, $password = NULL)
	{
		$query = $this->db->get_where('user', array('username' => $username, 'password'=>md5($password)));
		return $query->row_array();
	}
	public function is_exist($username = NULL, $id = 0)
	{
		if($id == NULL)
		{
			$query = $this->db->get_where('user', array('username' => $username));
		}else{
			$query = $this->db->get_where('user', array('username' => $username, 'id'=>$id));
		}
		return $query->row_array();
	}
}