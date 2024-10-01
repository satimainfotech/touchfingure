<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Report_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->transaction_table_name = 'transaction';
		$this->user_data = 'user';
	}
	
	public function get_total_online_transaction_data_count($m_n,$from_date,$to_date,$t_y){
		$idss = array('1','4','2256','36','2','478');
		$ids = array('Deposited Cash','Deposited Failed');
		$this->db->select('*');
		$this->db->from($this->transaction_table_name);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->transaction_table_name.'.txt_user_id','left');
		if($m_n != ''){
			$this->db->where($this->user_data.'.mobile_number',$m_n);
		}
		if($from_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date <=',$to_date);
		} 
		if($t_y != ''){
			$this->db->where($this->transaction_table_name.'.txt_contents',$t_y);
		}else{
			$this->db->where_in($this->transaction_table_name.'.txt_contents',$ids);
		}
		$this->db->order_by($this->transaction_table_name.'.created_date','desc');
		$this->db->where_not_in($this->transaction_table_name.'.txt_user_id',$idss);
		return $this->db->get()->result_array();
	}
	
	
	public function get_total_online_transaction_data($m_n,$from_date,$to_date,$t_y,$limit,$start){
		$idss = array('1','4','2256','36','2','478');
		$ids = array('Deposited Cash','Deposited Failed');
		$this->db->select('*');
		$this->db->from($this->transaction_table_name);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->transaction_table_name.'.txt_user_id','left');
		if($m_n != ''){
			$this->db->where($this->user_data.'.mobile_number',$m_n);
		}
		if($from_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date <=',$to_date);
		}
		if($t_y != ''){
			$this->db->where($this->transaction_table_name.'.txt_contents',$t_y);
		}else{
			$this->db->where_in($this->transaction_table_name.'.txt_contents',$ids);
		}
		$this->db->order_by($this->transaction_table_name.'.created_date','desc');
		$this->db->where_not_in($this->transaction_table_name.'.txt_user_id',$idss);
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	public function get_online_transaction_details($txt_token,$txt_id){
		$this->db->select('*');
		$this->db->from($this->transaction_table_name);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->transaction_table_name.'.txt_user_id','left');
		$this->db->where($this->transaction_table_name.'.txt_id',$txt_id);
		$this->db->where($this->transaction_table_name.'.txt_token',$txt_token);
		return $this->db->get()->result_array();
	}
	public function get_total_online_transaction_excel_data($m_n,$from_date,$to_date,$t_y){
		$idss = array('1','4','2256','36','2','478');
		$ids = array('Deposited Cash','Deposited Failed');
		$this->db->select('*');
		$this->db->from($this->transaction_table_name);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->transaction_table_name.'.txt_user_id','left');
		if($m_n != ''){
			$this->db->where($this->user_data.'.mobile_number',$m_n);
		}
		if($from_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date <=',$to_date);
		} 
		if($t_y != ''){
			$this->db->where($this->transaction_table_name.'.txt_contents',$t_y);
		}else{
			$this->db->where_in($this->transaction_table_name.'.txt_contents',$ids);
		}
		$this->db->order_by($this->transaction_table_name.'.created_date','desc');
		$this->db->where_not_in($this->transaction_table_name.'.txt_user_id',$idss);
		return $this->db->get()->result_array();
	}
	
	public function get_total_success_payment_amount($m_n,$from_date,$to_date){
		$ids= array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(txt_amount) as success_amount');
		$this->db->from($this->transaction_table_name);
		if($m_n != ''){
			$this->db->where($this->user_data.'.mobile_number',$m_n);
		}
		if($from_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date <=',$to_date);
		} 
		$this->db->where($this->transaction_table_name.'.txt_contents','Deposited Cash');
		$this->db->where_not_in($this->transaction_table_name.'.txt_user_id',$ids);
		return $this->db->get()->result_array();
	}
	public function get_total_faild_payment_amount($m_n,$from_date,$to_date){
		$ids = array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(txt_amount) as failed_amount');
		$this->db->from($this->transaction_table_name);
		if($m_n != ''){
			$this->db->where($this->user_data.'.mobile_number',$m_n);
		}
		if($from_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date >=',$from_date);
		}
		if($to_date != ''){
			$this->db->where($this->transaction_table_name.'.created_date <=',$to_date);
		} 
		$this->db->where($this->transaction_table_name.'.txt_contents','Deposited Failed');
		$this->db->where_not_in($this->transaction_table_name.'.txt_user_id',$ids);
		return $this->db->get()->result_array();
	}
	
}