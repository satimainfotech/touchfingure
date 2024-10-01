<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'users';
		
    }
	
	public function get_total_users_data_count($name,$mobile_number,$refrence_code,$account_status,$plan_type){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_users_data($name,$mobile_number,$refrence_code,$account_status,$plan_type,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);	
		$this->db->limit($limit,$start);		
		$this->db->order_by($this->table_name.'.id','desc');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	
}