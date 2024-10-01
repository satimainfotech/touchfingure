<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'product';
		$this->category_table_name = 'category';
		$this->sub_category_table_name = 'sub_category';
		$this->vendor_table_name = 'vendor';
		$this->product_variation_table_name = 'product_variation';
    }
	
	public function get_total_admin_product_data_count($category,$sub_category,$product_name){
		$categoyrs = explode(",",$category);
		$ids = array('delete','pending');
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		if($category != ''){
			$this->db->where_in($this->table_name.'.category',$categoyrs);
		}
		if($sub_category != ''){
			$this->db->where($this->table_name.'.sub_category',$sub_category);
		}
		if($product_name != ''){
			$this->db->like($this->table_name.'.title',$product_name,'both');
		}
		$this->db->where_not_in($this->table_name.'.status',$ids);
		$this->db->where($this->table_name.'.vendor_id',NULL);
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_admin_product_data($category,$sub_category,$product_name,$limit,$start){
		$categoyrs = explode(",",$category);
		$ids = array('delete','pending');
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		if($category != ''){
			$this->db->where_in($this->table_name.'.category',$categoyrs);
		}
		if($sub_category != ''){
			$this->db->where($this->table_name.'.sub_category',$sub_category);
		}
		if($product_name != ''){
			$this->db->like($this->table_name.'.title',$product_name,'both');
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->table_name.'.status',$ids);
		$this->db->where($this->table_name.'.vendor_id',NULL);
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_produtc_details($product_id){
		$this->db->select('*, '.$this->table_name.'.category as product_category');
		$this->db->from($this->table_name);
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		$this->db->where($this->table_name.'.product_id',$product_id);
		return $this->db->get()->result_array();
	}
	
	public function get_total_product_request_data_count($category,$sub_category,$product_name,$mobile_number){
		$not_id = array('pending');
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->vendor_table_name,$this->vendor_table_name.'.vendor_id = '.$this->table_name.'.vendor_id','left');
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		if($category != ''){
			$this->db->where($this->table_name.'.category',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->table_name.'.sub_category',$sub_category);
		}
		if($product_name != ''){
			$this->db->like($this->table_name.'.title',$product_name,'both');
		}
		$this->db->where_in($this->table_name.'.status',$not_id);
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_total_request_product_data($category,$sub_category,$product_name,$mobile_number,$limit,$start){
		$not_id = array('pending');
		$this->db->select('*,'.$this->table_name.'.status as pr_status');
		$this->db->from($this->table_name);
		$this->db->join($this->vendor_table_name,$this->vendor_table_name.'.vendor_id = '.$this->table_name.'.vendor_id','left');
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		if($category != ''){
			$this->db->where($this->table_name.'.category',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->table_name.'.sub_category',$sub_category);
		}
		if($product_name != ''){
			$this->db->like($this->table_name.'.title',$product_name,'both');
		}
		$this->db->limit($limit,$start);
		$this->db->where_in($this->table_name.'.status',$not_id);
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();

	}
	
	public function get_product_request_details($request_id){
		$this->db->select('*, '.$this->table_name.'.category as product_category,'.$this->table_name.'.status as pr_status,'.$this->table_name.'.description as pr_description');
		$this->db->from($this->table_name);
		$this->db->join($this->vendor_table_name,$this->vendor_table_name.'.vendor_id = '.$this->table_name.'.vendor_id','left');
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		$this->db->where($this->table_name.'.product_id',$request_id);
		return $this->db->get()->result_array();
	}
	
	public function get_total_vendor_product_data_count($category,$sub_category,$product_name,$vendor_id){
		$ids = array('delete');
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		if($category != ''){
			$this->db->where($this->table_name.'.category',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->table_name.'.sub_category',$sub_category);
		}
		if($product_name != ''){
			$this->db->like($this->table_name.'.title',$product_name,'both');
		}
		$this->db->where($this->table_name.'.vendor_id',$vendor_id);
		$this->db->where_not_in($this->table_name.'.status',$ids);
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_total_vendor_product_data($category,$sub_category,$product_name,$vendor_id,$limit,$start){
		$ids = array('delete');
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		if($category != ''){
			$this->db->where($this->table_name.'.category',$category);
		}
		if($sub_category != ''){
			$this->db->where($this->table_name.'.sub_category',$sub_category);
		}
		if($product_name != ''){
			$this->db->like($this->table_name.'.title',$product_name,'both');
		}
		$this->db->where($this->table_name.'.vendor_id',$vendor_id);
		$this->db->where_not_in($this->table_name.'.status',$ids);
		$this->db->limit($limit,$start);
		$this->db->order_by($this->table_name.'.product_id','desc');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_vendor_product_details($product_id,$vendor_id){
		$this->db->select('*, '.$this->table_name.'.category as product_category,'.$this->table_name.'.status as pr_status,'.$this->table_name.'.description as pr_description');
		$this->db->from($this->table_name);
		$this->db->join($this->vendor_table_name,$this->vendor_table_name.'.vendor_id = '.$this->table_name.'.vendor_id','left');
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->table_name.'.category','left');
		$this->db->join($this->sub_category_table_name,$this->sub_category_table_name.'.sub_category_id = '.$this->table_name.'.sub_category','left');
		$this->db->where($this->table_name.'.product_id',$product_id);
		$this->db->where($this->table_name.'.vendor_id',$vendor_id);
		return $this->db->get()->result_array();
	}
	
	public function get_all_category(){
		$this->db->select('*');
		$this->db->from($this->category_table_name);
		$this->db->where_not_in('category_status','delete');
		$this->db->order_by('category_id','asc');
		return $this->db->get()->result_array();
	}
	
	public function get_all_sub_category($category_id){
		$this->db->select('*,'.$this->sub_category_table_name.'.banner as sub_banner');
		$this->db->from($this->sub_category_table_name);
		$this->db->join($this->category_table_name,$this->category_table_name.'.category_id = '.$this->sub_category_table_name.'.categoryID','left');
		if($category_id != ''){
			$this->db->where($this->sub_category_table_name.'.category',$category_id);
		}
		$this->db->where_not_in($this->sub_category_table_name.'.sub_category_status','delete');
		$this->db->order_by($this->sub_category_table_name.'.sub_category_id','asc');
		return$this->db->get()->result_array();
	}
	public function get_product_variation($product_id){
		$this->db->select('*');
		$this->db->from($this->product_variation_table_name);
		$this->db->where('product_var_status','Active');
		$this->db->where('product_id',$product_id);
		$this->db->order_by('product_var_id','asc');
		return $this->db->get()->result_array();
	}
}