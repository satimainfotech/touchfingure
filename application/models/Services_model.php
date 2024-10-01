<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class services_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'services_master';
    }
	
	public function get_total_services_data_count($services){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($services != ''){
			$this->db->like('services_name',$services);
		}
		$this->db->where_not_in('services_status','delete');
		$this->db->order_by('services_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_services_data($services,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($services != ''){
			$this->db->like('services_name',$services);
		}
		$this->db->where_not_in('services_status','delete');
		$this->db->order_by('services_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_services_details($services_id,$services_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('services_id',$services_id);
		$this->db->where('services_token',$services_token);
		return $this->db->get()->result_array();
	}
}