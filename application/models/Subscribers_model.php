<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Subscribers_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'subscriber_master';
    }
	
	public function get_exal_contact_inquirey(){
		$this->db->select('*');
		$this->db->from($this->table_name);		
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_subscribers_data_count($email,$use_from_date,$use_to_date){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($email != ''){
			$this->db->where($this->table_name.'.email',$email);
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		$this->db->order_by($this->table_name.'.id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_subscribers_data($email,$use_from_date,$use_to_date,$limit,$start){
		
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($email != ''){
			$this->db->where($this->table_name.'.email',$email);
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		$this->db->limit($limit,$start);
		$this->db->order_by($this->table_name.'.id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_subscribers_details($subscribers_id){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('id',$subscribers_id);
		return $this->db->get()->result_array();
	}
}