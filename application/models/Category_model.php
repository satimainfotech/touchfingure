<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'category';
    }
	
	public function get_total_category_data_count($category){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($category != ''){
			$this->db->like('category_name',$category);
		}
		$this->db->where_not_in('category_status','delete');
		$this->db->order_by('category_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_category_data($category,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($category != ''){
			$this->db->like('category_name',$category);
		}
		$this->db->where_not_in('category_status','delete');
		$this->db->order_by('category_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_category_details($category_id,$category_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('category_id',$category_id);
		$this->db->where('category_token',$category_token);
		return $this->db->get()->result_array();
	}
}