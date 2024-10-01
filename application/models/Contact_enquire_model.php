<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contact_enquire_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'contact_us_data';
    }
	
	public function get_exal_contact_inquirey(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('contact_enquire_status','delete');
		$this->db->order_by('contact_enquire_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_contact_enquire_data_count($phone,$use_from_date,$use_to_date){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($phone != ''){
			$this->db->where($this->table_name.'.contact_enquire_phone',$phone);
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.contact_enquire_created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.contact_enquire_created_date <=',$use_to_date);
		} 
		$this->db->where_not_in($this->table_name.'.contact_enquire_status','delete');
		$this->db->order_by($this->table_name.'.contact_enquire_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_contact_enquire_data($phone,$use_from_date,$use_to_date,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($phone != ''){
			$this->db->where('contact_enquire_phone',$phone);
		}
		if($use_from_date != ''){
			$this->db->where('contact_enquire_created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where('contact_enquire_created_date <=',$use_to_date);
		} 
		$this->db->limit($limit,$start);
		$this->db->where_not_in('contact_enquire_status','delete');
		$this->db->order_by('contact_enquire_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_contact_enquire_details($contact_enquire_id,$contact_enquire_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('contact_enquire_id',$contact_enquire_id);
		$this->db->where('contact_enquire_token',$contact_enquire_token);
		return $this->db->get()->result_array();
	}
}