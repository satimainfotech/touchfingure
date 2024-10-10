<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Order_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'order';
		$this->order_item_table_name = 'order_items';
		$this->order_status_table_name = 'order_status_manage';
		$this->prodcut_table_name = 'product';
		
    }
	public function get_total_order_data_count_assigned($status,$order_id){
		$this->db->select('*');
		$this->db->from($this->table_name);		
		if($status != ""){
			$this->db->where('order_status',$status);
		}
		if($order_id != ""){
			$this->db->where('orderno',$order_id);
		}
		$this->db->where('parentid IS NOT NULL');
		$this->db->order_by($this->table_name.'.orderno','desc');
		return $this->db->get()->result_array();
	}
	public function get_total_order_data_assigned($status,$order_id,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($status != ""){
			$this->db->where('order_status',$status);
		}
		if($order_id != ""){
			$this->db->where('orderno',$order_id);
		}
		$this->db->where('parentid IS NOT NULL');
		$this->db->limit($limit,$start);
		//$this->db->where($this->table_name.'.order_delete_status',NULL);
		$this->db->order_by($this->table_name.'.orderno','desc');
		return $this->db->get()->result_array();
	}


	public function get_total_order_data_count($from_date,$to_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name){
		$this->db->select('*');
		$this->db->from($this->table_name);
		/*$this->db->join($this->order_status_table_name,$this->order_status_table_name.'.order_status_id = '.$this->table_name.'.order_status','left');
		if($from_date != ''){
			$this->db->where($this->table_name.'.order_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->table_name.'.order_date <=',$to_date);
		}
		if($payment_status != ''){
			$this->db->where($this->table_name.'.order_paymnet_status',$payment_status);
		}
		if($order_status != ''){
			$this->db->where($this->table_name.'.order_status',$order_status);
		}
		if($customer_name != ''){
			$this->db->where($this->table_name.'.order_user_name',$customer_name);
		}
		if($mobile_number != ''){
			$this->db->where($this->table_name.'.order_mobile_number',$mobile_number);
		}
		if($order_id != ''){
			$this->db->where($this->table_name.'.order_id',$order_id);
		}*/
		//$this->db->where($this->table_name.'.order_delete_status',NULL);
		$this->db->where('parentid IS NOT NULL');
		$this->db->order_by($this->table_name.'.orderno','desc');
		return $this->db->get()->result_array();
	}

	public function get_total_ordermain_data_count($from_date,$to_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$to_date);
		}
		$this->db->where('parentid', NULL);
		$this->db->order_by($this->table_name.'.orderno','desc');
		
		return $this->db->get()->result_array();
	}

	public function get_total_ordermain_data($from_date,$to_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($from_date != ''){
			$this->db->where($this->table_name.'.order_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->table_name.'.order_date <=',$to_date);
		}
		/*
		if($order_status != ''){
			$this->db->where($this->table_name.'.order_status',$order_status);
		}
		if($order_id != ''){
			$this->db->where($this->table_name.'.order_id',$order_id);
		}*/
		$this->db->where('parentid', NULL);
		$this->db->limit($limit,$start);
		//$this->db->where($this->table_name.'.order_delete_status',NULL);
		$this->db->order_by($this->table_name.'.orderno','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_order_data($from_date,$to_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		/*$this->db->join($this->order_status_table_name,$this->order_status_table_name.'.order_status_id = '.$this->table_name.'.order_status');
		if($from_date != ''){
			$this->db->where($this->table_name.'.order_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->table_name.'.order_date <=',$to_date);
		}
		if($payment_status != ''){
			$this->db->where($this->table_name.'.order_paymnet_status',$payment_status);
		}
		if($order_status != ''){
			$this->db->where($this->table_name.'.order_status',$order_status);
		}
		if($customer_name != ''){
			$this->db->where($this->table_name.'.order_user_name',$customer_name);
		}
		if($mobile_number != ''){
			$this->db->where($this->table_name.'.order_mobile_number',$mobile_number);
		}
		if($order_id != ''){
			$this->db->where($this->table_name.'.order_id',$order_id);
		}*/
		$this->db->where('parentid IS NOT NULL');
		$this->db->limit($limit,$start);
		//$this->db->where($this->table_name.'.order_delete_status',NULL);
		$this->db->order_by($this->table_name.'.orderno','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_single_order_details($order_id,$order_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		//$this->db->join($this->order_status_table_name,$this->order_status_table_name.'.order_status_id = '.$this->table_name.'.order_status');
		$this->db->where($this->table_name.'.order_id',$order_id);
		//$this->db->where($this->table_name.'.order_token',$order_token);
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();
		return $query;
	}
	
	public function get_single_order_item_details($order_id){
		$this->db->select('*');
		$this->db->from($this->order_item_table_name);
		$this->db->join($this->prodcut_table_name,$this->prodcut_table_name.'.product_id = '.$this->order_item_table_name.'.order_product_id');
		$this->db->where($this->order_item_table_name.'.order_id',$order_id);
		$query = $this->db->get();
		$data = array();
		if($query !== FALSE && $query->num_rows() > 0){
			$data = $query->result_array();
		}
		return $data;
		//echo $this->db->last_query();
	}
}