<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Event_enquire_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'event_inquiry';
		$this->product_table_name = 'product';
		$this->sub_category_table_name = 'sub_category';
		$this->category_table_name = 'category';
		$this->our_range_table_name = 'our_range';
		$this->brand_table_name = 'brand';
		$this->city_table_name = 'city';
		$this->event_table_name = 'event';
    }
	
	public function get_exal_event_inquirey(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->order_by('inq_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_event_enquire_data_count($category,$sub_category,$product_name,$use_from_date,$use_to_date,$our_range){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->event_table_name,$this->event_table_name.'.event_id = '.$this->table_name.'.event_id','left');
		$this->db->where($this->table_name.'.event_type','entrypass');
		if($category != ''){
			$this->db->where($this->event_table_name.'.category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->event_table_name.'.sub_category_id',$sub_category);
		}
		if($our_range != ''){
			$this->db->where($this->event_table_name.'.our_range',$our_range);
		}
		if($product_name != ''){
			$this->db->like($this->event_table_name.'.event_name',$product_name,'both');
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		
		$this->db->order_by($this->table_name.'.inq_id','desc');
	
		return $this->db->get()->result_array();
	}
	
	public function get_total_event_enquire_data_stall_count($category,$sub_category,$product_name,$use_from_date,$use_to_date,$our_range){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->event_table_name,$this->event_table_name.'.event_id = '.$this->table_name.'.event_id','left');
		$this->db->where($this->table_name.'.event_type','stall');
		if($category != ''){
			$this->db->where($this->event_table_name.'.category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->event_table_name.'.sub_category_id',$sub_category);
		}
		if($our_range != ''){
			$this->db->where($this->event_table_name.'.our_range',$our_range);
		}
		if($product_name != ''){
			$this->db->like($this->event_table_name.'.event_name',$product_name,'both');
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		
		$this->db->order_by($this->table_name.'.inq_id','desc');
	
		return $this->db->get()->result_array();
	}
	
	public function get_total_event_enquire_data($category,$sub_category,$product_name,$use_from_date,$use_to_date,$our_range,$limit,$start){
		$this->db->select('*,'.$this->table_name.'.created_date as enquire_date');
		$this->db->from($this->table_name);
		$this->db->join($this->event_table_name,$this->event_table_name.'.event_id = '.$this->table_name.'.event_id','left');
		$this->db->join($this->city_table_name,$this->city_table_name.'.city_id = '.$this->event_table_name.'.city_id','left');
	
		$this->db->where($this->table_name.'.event_type','entrypass');
		if($category != ''){
			$this->db->where($this->event_table_name.'.category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->event_table_name.'.sub_category_id',$sub_category);
		}
		if($our_range != ''){
			$this->db->where($this->event_table_name.'.our_range',$our_range);
		}
		if($product_name != ''){
			$this->db->like($this->event_table_name.'.event_name',$product_name,'both');
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		$this->db->limit($limit,$start);
		$this->db->order_by($this->table_name.'.event_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_event_enquire_stall_data($category,$sub_category,$product_name,$use_from_date,$use_to_date,$our_range,$limit,$start){
		$this->db->select('*,'.$this->table_name.'.created_date as enquire_date');
		$this->db->from($this->table_name);
		$this->db->join($this->event_table_name,$this->event_table_name.'.event_id = '.$this->table_name.'.event_id','left');
		$this->db->join($this->city_table_name,$this->city_table_name.'.city_id = '.$this->event_table_name.'.city_id','left');
	
		$this->db->where($this->table_name.'.event_type','stall');
		
		if($category != ''){
			$this->db->where($this->event_table_name.'.category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->event_table_name.'.sub_category_id',$sub_category);
		}
		if($our_range != ''){
			$this->db->where($this->event_table_name.'.our_range',$our_range);
		}
		if($product_name != ''){
			$this->db->like($this->event_table_name.'.event_name',$product_name,'both');
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		$this->db->limit($limit,$start);
		$this->db->order_by($this->table_name.'.event_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_event_enquire_details($inq_id,$inq_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->event_table_name,$this->event_table_name.'.event_id = '.$this->table_name.'.event_id','left');
		$this->db->join($this->city_table_name,$this->city_table_name.'.city_id = '.$this->event_table_name.'.city_id','left');
	
		$this->db->where($this->table_name.'.inq_id',$inq_id);
		
		return $this->db->get()->result_array();
	}
}