<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Our_range_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'our_range';
		$this->sub_category_table_name = 'sub_category';
		$this->category_table_name = 'category';
    }
	
	public function get_exal_our_range(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('our_range_status','delete');
		$this->db->order_by('our_range_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_our_range_data_count(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('our_range_status','delete');
		$this->db->order_by('our_range_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_our_range_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->limit($limit,$start);
		$this->db->where_not_in('our_range_status','delete');
		$this->db->order_by('our_range_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_our_range_details($our_range_id,$our_range_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('our_range_id',$our_range_id);
		$this->db->where('our_range_token',$our_range_token);
		return $this->db->get()->result_array();
	}
	
	public function get_our_range_edit_details($our_range_id,$our_range_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('our_range_id',$our_range_id);
		$this->db->where('our_range_token',$our_range_token);
		return $this->db->get()->result_array();
	}
}