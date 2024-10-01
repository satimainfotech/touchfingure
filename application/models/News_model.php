<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class news_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'news_master';
    }
	
	public function get_total_news_data_count($news){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($news != ''){
			$this->db->like('news_name',$news);
		}
		$this->db->where_not_in('news_status','delete');
		$this->db->order_by('news_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_news_data($news,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->table_name);
		if($news != ''){
			$this->db->like('news_name',$news);
		}
		$this->db->where_not_in('news_status','delete');
		$this->db->order_by('news_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_news_details($news_id,$news_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('news_id',$news_id);
		$this->db->where('news_token',$news_token);
		return $this->db->get()->result_array();
	}
}