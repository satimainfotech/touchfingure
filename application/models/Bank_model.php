<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class bank_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'bank';
    }
	
	public function get_total_bank_data_count($bank){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($bank != ''){
			$this->db->like('bank_name',$bank);
		}
		$this->db->where_not_in('bank_status','delete');
		$this->db->order_by('bank_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_bank_data($bank,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($bank != ''){
			$this->db->like('bank_name',$bank);
		}
		$this->db->where_not_in('bank_status','delete');
		$this->db->order_by('bank_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_bank_details($bank_id,$bank_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('bank_id',$bank_id);
		$this->db->where('bank_token',$bank_token);
		return $this->db->get()->result_array();
	}
	public function get_bank_data(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('bank_status','delete');
		$this->db->order_by('bank_id','desc');
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