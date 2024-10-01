<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Send_all_notification_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'user';
    }
	public function get_total_users(){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('device_token !=','');
		return $this->db->get()->result_array();
	}
}