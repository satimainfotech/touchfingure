<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class agent_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'agent_master';
		$this->deal_table_name = 'deal_master';
		$this->agent_products_table_name = 'agent_products';
    }
	
	public function get_total_agent_data_count($agent){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($agent != ''){
			$this->db->like('agent_name',$agent);
		}
		$this->db->where_not_in('agent_status','delete');
		$this->db->order_by('agent_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_agent_data($agent,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($agent != ''){
			$this->db->like('agent_name',$agent);
		}
	//	$this->db->join('bank', "{$this->table_name}.bank_id = bank.bank_id");
		$this->db->where_not_in('agent_status','delete');
		$this->db->order_by('agent_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	
	
	
	public function get_agent_data(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('agent_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_agent_details($agent_id,$agent_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		//$this->db->join('bank', "{$this->table_name}.bank_id = bank.bank_id");
		$this->db->where('agent_id', $agent_id);
		$this->db->where('agent_token', $agent_token);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_agent_products($agent_id){
		$this->db->select('*');
		$this->db->from($this->agent_products_table_name);		
		$this->db->where('agent_id', $agent_id);		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	public function get_total_student($agent_id){
		
		$this->db->from($this->deal_table_name);
		$this->db->where('agent_id', $agent_id);
		$total_students = $this->db->count_all_results();
	}
	public function get_agent_student($agent_id){
		
		$this->db->from($this->deal_table_name);
		$this->db->where('agent_id', $agent_id);
		$query = $this->db->get();
		return $query->result_array();
	}
}