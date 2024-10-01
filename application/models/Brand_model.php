<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Brand_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'brand';
    }
	
	public function get_total_brand_data_count($brand){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($brand != ''){
			$this->db->like('brand_name',$brand);
		}
		$this->db->where_not_in('brand_status','delete');
		$this->db->order_by('brand_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_brand_data($brand,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($brand != ''){
			$this->db->like('brand_name',$brand);
		}
		$this->db->where_not_in('brand_status','delete');
		$this->db->order_by('brand_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_brand_details($brand_id,$brand_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('brand_id',$brand_id);
		$this->db->where('brand_token',$brand_token);
		return $this->db->get()->result_array();
	}
}