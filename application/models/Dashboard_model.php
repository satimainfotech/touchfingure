<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'user';
		$this->transaction_table_name = 'transaction';
		$this->withdraw_request_table_name = 'withdraw_request';
		$this-> my_joining_contests_team_data_table_name = 'my_joining_contests_team_data';
    }
	
	public function get_total_users(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('type','user');
		return $this->db->get()->num_rows();
	}
	
	public function get_active_total_users(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('account_status','Active');
		$this->db->where('type','user');
		return $this->db->get()->num_rows();
	}
	
	public function get_total_de_active_users(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('account_status','De-active');
		$this->db->where('type','user');
		return $this->db->get()->num_rows();
	}
	
	public function get_total_not_verified_users(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('account_status','Not-verified');
		$this->db->where('type','user');
		return $this->db->get()->num_rows();
	}
	
	public function get_total_system_users(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('type','system');
		return $this->db->get()->num_rows();
	}
	
	public function get_total_paykun_amount(){
		$ids= array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(txt_amount) as success_amount');
		$this->db->from($this->transaction_table_name);
		$this->db->where('txt_type','add');
		$this->db->where('txt_contents','Deposited Cash');
		$this->db->where_not_in('txt_user_id',$ids);
		return $this->db->get()->result_array();
	}
	
	public function get_total_paykun_fail_amount(){
		$ids= array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(txt_amount) as fail_amount');
		$this->db->from($this->transaction_table_name);
		$this->db->where('txt_type','minus');
		$this->db->where('txt_contents','Deposited Failed');
		$this->db->where_not_in('txt_user_id',$ids);
		return $this->db->get()->result_array();
	}
	
	public function get_total_pending_withdraw_amount(){
		$this->db->select('*, SUM(withdraw_request_amount) as pending_withdraw_amount');
		$this->db->from($this->withdraw_request_table_name);
		$this->db->where('withdraw_request_status','1');
		return $this->db->get()->result_array();
	}
	
	public function get_total_process_withdraw_amount(){
		$this->db->select('*, SUM(withdraw_request_amount) as process_withdraw_amount');
		$this->db->from($this->withdraw_request_table_name);
		$this->db->where('withdraw_request_status','2');
		return $this->db->get()->result_array();
	}
	
	public function get_total_paid_withdraw_amount(){
		$this->db->select('*, SUM(withdraw_request_amount) as paid_withdraw_amount');
		$this->db->from($this->withdraw_request_table_name);
		$this->db->where('withdraw_request_status','3');
		return $this->db->get()->result_array();
	}
	
	public function get_total_fail_withdraw_amount(){
		$this->db->select('*, SUM(withdraw_request_amount) as fail_withdraw_amount');
		$this->db->from($this->withdraw_request_table_name);
		$this->db->where('withdraw_request_status','4');
		return $this->db->get()->result_array();
	}
	public function get_winning_amount(){
		$ids = array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(my_winning_amount) as winning_amount');
		$this->db->from($this->table_name);
		$this->db->where_not_in('user_id',$ids);
		$this->db->where_not_in('type','system');
		return $this->db->get()->result_array();
	}
	public function get_winning_cashback_amount(){
		$ids = array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(my_winning_cashback) as winning_cashback_amount');
		$this->db->from($this->table_name);
		$this->db->where_not_in('user_id',$ids);
		$this->db->where_not_in('type','system');
		return $this->db->get()->result_array();
	}
	public function get_bonus_amount(){
		$ids = array('1','4','2256','36','2','478');
		$this->db->select('*, SUM(my_cash_bonus) as bonus_amount');
		$this->db->from($this->table_name);
		$this->db->where_not_in('user_id',$ids);
		$this->db->where_not_in('type','system');
		return $this->db->get()->result_array();
	}
}