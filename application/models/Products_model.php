<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class products_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'products';
    }
	
	public function get_total_products_data_count($products){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($products != ''){
			$this->db->like('products_name',$products);
		}
		$this->db->where_not_in('products_status','delete');
		$this->db->order_by('products_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_products_data($products,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($products != ''){
			$this->db->like('products_name',$products);
		}
		$this->db->where_not_in('products_status','delete');
		$this->db->order_by('products_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_products_details($products_id,$products_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('products_id',$products_id);
		$this->db->where('products_token',$products_token);
		return $this->db->get()->result_array();
	}
	public function get_products_data(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('products_status','delete');
		$this->db->order_by('products_id','desc');
		return $this->db->get()->result_array();
	}
	public function get_agent_data(){
		$this->db->select('*');
		$this->db->from('agent_master');
		$this->db->where_not_in('agent_status','delete');
		$this->db->order_by('agent_id','desc');
		return $this->db->get()->result_array();
	}
	public function get_investor_data(){
		$this->db->select('*');
		$this->db->from('investor_master');
		$this->db->where_not_in('investor_status','delete');
		$this->db->order_by('investor_id','desc');
		return $this->db->get()->result_array();
	}
}