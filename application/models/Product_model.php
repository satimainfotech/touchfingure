<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'product';
		$this->sub_category_table_name = 'sub_category';
		$this->category_table_name = 'category';
		$this->our_range_table_name = 'our_range';
		$this->brand_table_name = 'brand';
    }
	
	public function get_exal_product(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where_not_in('status','delete');
		$this->db->order_by('product_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_product_data_count($category,$sub_category,$product_name,$brand,$our_range){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($category != ''){
			$this->db->where('category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where('sub_category_id',$sub_category);
		}
		if($product_name != ''){
			$this->db->like('product_name',$product_name,'both');
		}
		if($brand != ''){
			$this->db->where('brand_logo',$brand);
		}
		if($our_range != ''){
			$this->db->where('our_range',$our_range);
		}
		$this->db->where_not_in('status','delete');
		$this->db->order_by('product_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_product_data($category,$sub_category,$product_name,$brand,$our_range,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($category != ''){
			$this->db->where('category_id',$category);
		}
		if($sub_category != ''){
			$this->db->where('sub_category_id',$sub_category);
		}
		if($product_name != ''){
			$this->db->like('product_name',$product_name,'both');
		}
		if($brand != ''){
			$this->db->where('brand_logo',$brand);
		}
		if($our_range != ''){
			$this->db->where('our_range',$our_range);
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in('status','delete');
		$this->db->order_by('product_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_produtc_details($product_id,$product_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('product_id',$product_id);
		$this->db->where('product_token',$product_token);
		return $this->db->get()->result_array();
	}
	
	public function get_produtc_edit_details($product_id,$product_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('product_id',$product_id);
		$this->db->where('product_token',$product_token);
		return $this->db->get()->result_array();
	}
	
	/* WEB PRODUCT LISTING */
		public function get_total_web_product_data_count($category,$range_id){
			$this->db->select('*');
			$this->db->from($this->table_name);
			if($category != ''){
				$this->db->where('category_id',$category);
			}
			$this->db->where('our_range',$range_id);
			$this->db->where_not_in('status','delete');
			$this->db->order_by('product_id','desc');
			return $this->db->get()->result_array();
		}
		
		public function get_total_web_product_data($category,$range_id,$limit,$start){
			$this->db->select('*');
			$this->db->from($this->table_name);
			if($category != ''){
				$this->db->where('category_id',$category);
			}
			$this->db->where('our_range',$range_id);
			$this->db->where_not_in('status','delete');
			$this->db->order_by('product_id','desc');
			$this->db->limit($limit,$start);
			return $this->db->get()->result_array();
		}
		public function get_web_produtc_details($product_id,$product_na){
			$this->db->select('*');
			$this->db->from($this->table_name);
			$this->db->join($this->brand_table_name,$this->brand_table_name.'.brand_id = '.$this->table_name.'.brand_logo','left');
			$this->db->where($this->table_name.'.product_id',$product_id);
			$this->db->where($this->table_name.'.product_slug',$product_na);
			return $this->db->get()->result_array();
			//echo $this->db->last_query();
		}
	/* WEB PRODUCT LISTING */
	
	/* WEB OUR RANGE LISTING */
		public function get_total_web_our_range_data_count(){
			$this->db->select('*');
			$this->db->from($this->our_range_table_name);
			$this->db->where_not_in('our_range_status','delete');
			$this->db->order_by('our_range_id','desc');
			return $this->db->get()->result_array();
		}
		
		public function get_total_web_our_range_data($limit,$start){
			$this->db->select('*');
			$this->db->from($this->our_range_table_name);
			$this->db->join($this->brand_table_name,$this->brand_table_name.'.brand_id = '.$this->our_range_table_name.'.our_range_brand','left');
			$this->db->limit($limit,$start);
			$this->db->where_not_in($this->our_range_table_name.'.our_range_status','delete');
			$this->db->order_by($this->our_range_table_name.'.our_range_id','desc');
			return $this->db->get()->result_array();
		}
	/* WEB OUR RANGE LISTING */
	
	function send_email($data = array())
    {
		$email = $data['email'];
		$name = $data['name'];
		$to_email = 'Inquiry.reddmica@gmail.com';
		$this->load->database();
        $from = $email;
        $from_name = $name;
		$sub    = "Product enquire";
		$data1['q_data'] = $data;
		$msg_body = $this->load->view('back/admin/email_template/email_temp',$data1, TRUE);
		$send_mail  = $this->do_email($from,$from_name,$to_email, $sub, $msg_body);
		return $send_mail;
    }
	
	function do_email($from = '', $from_name = '', $email = '', $sub ='', $msg ='')
    {   
		$to = $email;
		$subject = $sub;
		$headers = "MIME-Version: 1.0 \r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8 \r\n";
		//$headers .= "CC: italiyatushar8@gmail.com \r\n";
		$headers .= "From: $from_name $from";
		
		$message = "$msg";

		if(mail($to,$subject,$message,$headers)){
			return true;
		}else{
			return false;
		}
    }
}