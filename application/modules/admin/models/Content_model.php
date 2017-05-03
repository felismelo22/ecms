<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/*get*/
	public function get_cat($id = 0)
	{
		// if ($username === FALSE || $id ===0)
		// {
		// 	$query = $this->db->get('user');
		// 	// $query = $this->db->get_where('user', '1',2,5);
		// 	return $query->result_array();
		// }

		$query = $this->db->get_where('content_cat', array('id' => $id));

		return $query->row_array();
	}

	public function get_cat_row($where = '')
	{
		$sql = !empty($where) ? $where : '';
		$query = $this->db->query('SELECT * FROM content_cat '.$sql);
		return $query->row_array();
	}

	public function get_cat_ids()
	{
		$query = $this->db->query('SELECT `id`,`title` FROM `content_cat` WHERE 1 AND `publish` = 1');
		return $query->result_array();
	}
	public function get_cat_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = '';
		$limit = 3;

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
      $total_rows = $this->db->count_all('content_cat');
    }else{
      $query = $this->db->query('SELECT id FROM `content_cat` WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"');
      $total_rows = $query->num_rows();
    }

    $config['base_url']   = base_url('admin/content_category').$url_get;
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
		if($keyword != NULL)
		{
			$sql = ' WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"';
		}
		$query = $this->db->query('SELECT *,CASE WHEN par_id = 0 THEN id ELSE par_id END AS Sort FROM `content_cat` '.@$sql.' ORDER BY sort,id LIMIT '.$page.','.$limit);
		$data['cat_list'] = $query->result_array();
		return $data;

		// untuk menampilkan query terakhir
		// pr($this->db->last_query());die();

	}

	/*set*/
	public function set_cat($id = 0)
	{
		$this->load->helper('url');

		$data = array(
			'title' => $this->input->post('title'),
			'par_id' => $this->input->post('par_id'),
			'description' => $this->input->post('description'),
			'publish' => $this->input->post('publish')
		);
		if($id > 0)
		{
			return $this->db->update('content_cat', $data, 'id = '.$id);
		}else{
			return $this->db->insert('content_cat', $data);
		}
	}

	/*del*/
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