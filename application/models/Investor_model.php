<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class investor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'investor_master';
    }
	
	public function get_total_investor_data_count($investor){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($investor != ''){
			$this->db->like('investor_name',$investor);
		}
		$this->db->where_not_in('investor_status','delete');
		$this->db->order_by('investor_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_investor_data($investor,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($investor != ''){
			$this->db->like('investor_name',$investor);
		}
		$this->db->join('bank', "{$this->table_name}.bank_id = bank.bank_id");
		$this->db->where_not_in('investor_status','delete');
		$this->db->order_by('investor_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	
	public function get_investor_data(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('investor_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_investor_details($investor_id,$investor_token){
		$this->db->select('*');
$this->db->from($this->table_name);
$this->db->join('bank', "{$this->table_name}.bank_id = bank.bank_id");
$this->db->where('investor_id', $investor_id);
$this->db->where('investor_token', $investor_token);
$query = $this->db->get();
return $query->result_array();
	}
}