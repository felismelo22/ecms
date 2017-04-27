<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_all_category($par_id = 0, $page = 0, $keyword = NULL)
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
      $query = $this->db->query('SELECT id FROM content_cat WHERE par_id = '.$par_id.' ORDER BY ID DESC');
    }else{
      $query = $this->db->query('SELECT id FROM content_cat WHERE id = "'.$keyword.'" OR username = "'.$keyword.'" AND par_id = '.$par_id.' ORDER BY ID DESC');
    }
      $total_rows = $query->num_rows();

    $config['base_url']   = base_url('content/cat_list').$url_get;
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
																'title'=>$keyword
															));
		}
		$query = $this->db->get('content_cat');
		$data['data'] = $query->result_array();
		return $data;

		// untuk menampilkan query terakhir
		// pr($this->db->last_query());die();

	}
}