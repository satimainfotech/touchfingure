<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Sub_category_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'sub_category';
		$this->category_table_name = 'category';
    }
	
	public function get_total_sub_category_data_count($category_id,$sub_category){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($category_id != ''){
			$this->db->where('category_id',$category_id);
		}
		if($sub_category != ''){
			$this->db->like('sub_category_name',$sub_category);
		}
		$this->db->where_not_in('sub_category_status','delete');
		$this->db->order_by('sub_category_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_sub_category_data($category_id,$sub_category,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($category_id != ''){
			$this->db->where('category_id',$category_id);
		}
		if($sub_category != ''){
			$this->db->like('sub_category_name',$sub_category);
		}
		$this->db->where_not_in('sub_category_status','delete');
		$this->db->order_by('sub_category_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_sub_category_details($sub_category_id,$sub_category_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('sub_category_id',$sub_category_id);
		$this->db->where('sub_category_token',$sub_category_token);
		return $this->db->get()->result_array();
	}
}