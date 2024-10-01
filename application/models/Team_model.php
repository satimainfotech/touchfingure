<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class team_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'team_master';
    }
	
	public function get_total_team_data_count($team){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($team != ''){
			$this->db->like('team_name',$team);
		}
		$this->db->where_not_in('team_status','delete');
		$this->db->order_by('team_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_team_data($team,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($team != ''){
			$this->db->like('team_name',$team);
		}
		$this->db->where_not_in('team_status','delete');
		$this->db->order_by('team_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_team_details($team_id,$team_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('team_id',$team_id);
		$this->db->where('team_token',$team_token);
		return $this->db->get()->result_array();
	}
}