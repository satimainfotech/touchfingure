<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product_enquire_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'product_inquirey';
		$this->product_table_name = 'product';
		$this->sub_category_table_name = 'sub_category';
		$this->category_table_name = 'category';
		$this->our_range_table_name = 'our_range';
		$this->brand_table_name = 'brand';
    }
	
	public function get_exal_product_inquirey(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('status','delete');
		$this->db->order_by('inq_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_product_enquire_data_count($category,$sub_category,$product_name,$use_from_date,$use_to_date,$our_range){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->product_table_name,$this->product_table_name.'.product_id = '.$this->table_name.'.product_id','left');
		if($category != ''){
			$this->db->where($this->product_table_name.'.category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->product_table_name.'.sub_category_id',$sub_category);
		}
		if($our_range != ''){
			$this->db->where($this->product_table_name.'.our_range',$our_range);
		}
		if($product_name != ''){
			$this->db->like($this->product_table_name.'.product_name',$product_name,'both');
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		$this->db->where_not_in($this->table_name.'.status','delete');
		$this->db->order_by($this->table_name.'.inq_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_product_enquire_data($category,$sub_category,$product_name,$use_from_date,$use_to_date,$our_range,$limit,$start){
		$this->db->select('*,'.$this->table_name.'.created_date as enquire_date');
		$this->db->from($this->table_name);
		$this->db->join($this->product_table_name,$this->product_table_name.'.product_id = '.$this->table_name.'.product_id','left');
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->product_table_name.'.category_id','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->product_table_name.'.sub_category_id','left');
		$this->db->join($this->our_range_table_name,$this->our_range_table_name.'.our_range_id = '.$this->product_table_name.'.our_range','left');
		$this->db->join($this->brand_table_name,$this->brand_table_name.'.brand_id = '.$this->product_table_name.'.brand_logo','left');
		if($category != ''){
			$this->db->where($this->product_table_name.'.category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->product_table_name.'.sub_category_id',$sub_category);
		}
		if($our_range != ''){
			$this->db->where($this->product_table_name.'.our_range',$our_range);
		}
		if($product_name != ''){
			$this->db->like($this->product_table_name.'.product_name',$product_name,'both');
		}
		if($use_from_date != ''){
			$this->db->where($this->table_name.'.created_date >=',$use_from_date);
		}
		if($use_to_date != ''){
			$this->db->where($this->table_name.'.created_date <=',$use_to_date);
		} 
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->table_name.'.status','delete');
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_product_enquire_details($inq_id,$inq_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->product_table_name,$this->product_table_name.'.product_id = '.$this->table_name.'.product_id','left');
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->product_table_name.'.category_id','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->product_table_name.'.sub_category_id','left');
		$this->db->join($this->our_range_table_name,$this->our_range_table_name.'.our_range_id = '.$this->product_table_name.'.our_range','left');
		$this->db->join($this->brand_table_name,$this->brand_table_name.'.brand_id = '.$this->product_table_name.'.brand_logo','left');
		$this->db->where($this->table_name.'.inq_id',$inq_id);
		$this->db->where($this->table_name.'.inq_token',$inq_token);
		return $this->db->get()->result_array();
	}
}