<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function get_row($sql = '')
	{
		if(!empty($sql))
		{
			$query = $this->db->query($sql);
			return $query->row_array();
		}
	}

	public function get_all($sql = '')
	{
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function set_data()
	{
		$this->load->helper('url');

		$data = array(
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password'))
		);

		return $this->db->insert('user', $data);
	}
}