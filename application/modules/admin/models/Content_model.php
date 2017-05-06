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

	public function get_cat_All($field = '*', $where = '')
	{
		$sql = !empty($where) ? $where : '';
		$query = $this->db->query('SELECT '.$field.' FROM content_cat '.$sql);
		return $query->result_array();
	}
	public function get_cat_data($where = '')
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
    $url_get = base_url('admin/content_category').'';
		$limit = 3;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/content_category').'?keyword='.$keyword;
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
    $config = pagination($total_rows,$limit,$url_get);
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

	public function get_content($id = 0)
	{
		if(!empty($id))
		{
			$query = $this->db->get_where('content', array('id'=>$id));
			return $query->row_array();
		}
	}

	public function get_content_list($page = 0, $keyword = NULL)
	{
		$data = array();
    $url_get = base_url('admin/content_list').'';
		$limit = 3;

    if(!empty($_GET))
    {
    	if(!empty($_GET['keyword']))
    	{
	      $keyword = @$_GET['keyword'];
	      $url_get = base_url('admin/content_list').'?keyword='.$keyword;
    	}
      if(!empty($_GET['page']))
      {
      	$page = @intval($_GET['page']);
      }
    }
    if($keyword==NULL)
    {
      $total_rows = $this->db->count_all('content');
    }else{
      $query = $this->db->query('SELECT id FROM `content` WHERE id = "'.$keyword.'" OR title LIKE "'.$keyword.'%"');
      $total_rows = $query->num_rows();
    }

    $config = pagination($total_rows,$limit,$url_get);
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
																'title'=>$keyword
															));
		}
		// $this->db->select('id,title');
		$query = $this->db->get('content');
		$data['data'] = $query->result_array();

		return $data;
		// untuk menampilkan query terakhir
		// pr($this->db->last_query());die();
	}
	/*set*/
	public function publish_data($table = '', $ids = array(''))
	{
		if(!empty($table))
		{
			$data_id = $this->input->post('id');
			if(!empty($data_id))
			{
				foreach ($data_id as $key => $id)
				{
					if(!empty($ids))
					{
						if(in_array($id, $ids))
						{
							$this->db->update($table, array('publish'=>1), 'id = '.$id);
						}else{
							$this->db->update($table, array('publish'=>0), 'id = '.$id);
						}
					}else{
						$this->db->update($table, array('publish'=>0), 'id = '.$id);
					}
				}
			}
			}
	}

	public function set_cat($id = 0)
	{
		$this->load->helper('url');

		// $description = trim($this->input->post('description'));
		// $description = stripslashes($description);
		// $description = htmlspecialchars($description);
		$publish = !empty($this->input->post('publish')) ? 1:0;
		$data = array(
			'title' => $this->input->post('title'),
			'par_id' => $this->input->post('par_id'),
			'description' => $this->input->post('description'),
			'publish' => $publish
		);
		if($id > 0)
		{
			return $this->db->update('content_cat', $data, 'id = '.$id);
		}else{
			return $this->db->insert('content_cat', $data);
		}
	}

	public function set_content($id = 0)
	{
		$this->load->helper('url');
		// $description = trim($this->input->post('description'));
		// $description = stripslashes($description);
		// $description = htmlspecialchars($description);
		$intro = !empty($this->input->post('intro')) ? $this->input->post('intro'): substr($this->input->post('content'), 0, 250);

		$cat_ids = $this->input->post('cat_ids');
		if(!empty($cat_ids))
		{
			$cat_ids = implode(',', $cat_ids);
		}else{
			$cat_ids = '';
		}
		$author = $this->session->userdata['logged_in']['username'];
		$publish = !empty($this->input->post('publish')) ? 1:0;
		$data = array(
			'title' => $this->input->post('title'),
	    'cat_ids' => $cat_ids,
	    'keyword' => $this->input->post('keyword'),
	    'intro' => $intro,
	    'description' => $this->input->post('description'),
	    'content' => $this->input->post('content'),
	    'author' => $author,
	    'publish' => $publish,
			);
		if($id > 0)
		{
			$this->db->update('content', $data, 'id = '.$id);
			if($this->db->affected_rows())
			{

				if(!empty($_FILES['image']['name']))
				{
					// $query = $this->db->query('SELECT LAST_INSERT_ID() AS id');
					// $data = $query->row_array();
					// $last_id = 0;
					// if(!empty($data))
					// {
					// 	$last_id = $data['id'];
					// }

					$image = $this->input->post('title').'_'.$id.'.jpg';
					$this->db->update('content', array('image'=>$image), 'id = '.$id);
					if($this->db->affected_rows())
					{
						$dir = FCPATH.'images/modules/content/'.$id.'/';
						mkdir($dir, 0755);
						copy($_FILES['image']['tmp_name'], $dir.$image);
					}
				}
			}else{

			}
		}else{
			$this->db->insert('content', $data);
			if($this->db->affected_rows())
			{

				if(!empty($_FILES['image']['name']))
				{
					$query = $this->db->query('SELECT LAST_INSERT_ID() AS id');
					$data = $query->row_array();
					$last_id = 0;
					if(!empty($data))
					{
						$last_id = $data['id'];
					}

					$image = $this->input->post('title').'_'.$last_id.'.jpg';
					$this->db->update('content', array('image'=>$image), 'id = '.$last_id);
					if($this->db->affected_rows())
					{
						$dir = FCPATH.'images/modules/content/'.$last_id.'/';
						mkdir($dir, 0755);
						copy($_FILES['image']['tmp_name'], $dir.$image);
					}
				}
			}else{

			}
		}
	}

	/*del*/
	public function del_data($table='',$ids = array())
	{
		if(!empty($ids)&&!empty($table))
		{
			foreach ($ids as $key => $id)
			{
				$this->db->delete($table, array('id'=>$id));
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