<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'user';
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
	
	public function get_total_user_data_count($member_type,$name,$mobile){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($member_type != ''){
			$this->db->where('member_type_id',$member_type);
		}
		if($name != ''){
			$this->db->where('name',$name);
		}
		
		if($mobile != ''){
			$this->db->where('mobile',$mobile);
		}
		if($our_range != ''){
			$this->db->where('our_range',$our_range);
		}
		$this->db->where_not_in('status','delete');
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_user_data($member_type,$name,$mobile,$limit,$start){
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
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
		echo $this->db->last_query();
	}
	
	public function get_user_details($user_id,$user_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('id',$user_id);
		$this->db->where('user_token',$user_token);
		return $this->db->get()->result_array();
	}
	
	public function get_user_edit_details($user_id,$user_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('id',$user_id);
		$this->db->where('user_token',$user_token);
		return $this->db->get()->result_array();
	}
	
	
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