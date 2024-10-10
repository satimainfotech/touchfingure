<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Master_manage_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->city_table_name = 'city';
		$this->country_table_name = 'country';
		$this->state_table_name = 'state';
		$this->district_table_name = 'district';
		$this->delivery_charge_table_name = 'delivery_charge';
		$this->area_table_name = 'area';
		$this->member_type_table_name = 'member_type';
		$this->division_table_name = 'division';
		$this->district_m_table_name = 'district_m';
		$this->taluka_table_name = 'taluka';
		$this->taluka_m_table_name = 'taluka_m';
		$this->gram_panchayat_table_name = 'gram_panchayat';
		$this->pm_table_name = 'process_master';
    }
	public function get_total_country_data_count($country){
		$this->db->select('*');
		$this->db->from($this->country_table_name);
		if($country != ''){
			$this->db->like('country_name',$country,'both');
		}
		
		$this->db->where_not_in('country_status','delete');
		$this->db->order_by('country_id','desc');
		return $this->db->get()->result_array();
	}

	public function get_total_pm_data_count($country){
		$this->db->select('*');
		$this->db->from($this->pm_table_name);
		if($country != ''){
			$this->db->like('pm_name',$country,'both');
		}
		
		$this->db->where_not_in('pm_status','delete');
		$this->db->order_by('process_master_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_country_data($country,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->country_table_name);
		if($country != ''){
			$this->db->like('country_name',$country,'both');
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in('country_status','delete');
		$this->db->order_by('country_id','desc');
		return $this->db->get()->result_array();
	}
	public function get_total_pm_data($country,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->pm_table_name);
		if($country != ''){
			$this->db->like('pm_name',$country,'both');
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in('pm_status','delete');
		$this->db->order_by('process_master_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_country_details($country){
		$this->db->select('*');
		$this->db->from($this->country_table_name);
		$this->db->where('country_id',$country);
		return $this->db->get()->result_array();
	}

	public function get_pm_details($country){
		$this->db->select('*');
		$this->db->from($this->pm_table_name);
		$this->db->where('process_master_id',$country);
		return $this->db->get()->result_array();
	}
	
	public function get_total_country_excel_data($country){
		$this->db->select('*');
		$this->db->from($this->country_table_name);
		if($country != ''){
			$this->db->where('country_name',$country);
		}
		$this->db->where_not_in('country_status','delete');
		$this->db->order_by('country_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_state_data_count($state,$country){
		$this->db->select('*');
		$this->db->from($this->state_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->state_table_name.'.country_id');
		if($state != ''){
			$this->db->like($this->state_table_name.'.state_name',$state,'both');
		}
		if($country != ''){
			$this->db->where($this->state_table_name.'.country_id',$country);
		}
		
		$this->db->where_not_in($this->state_table_name.'.state_status','delete');
		$this->db->order_by($this->state_table_name.'.state_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_state_data($state,$country,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->state_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->state_table_name.'.country_id');
		if($state != ''){
			$this->db->like($this->state_table_name.'.state_name',$state,'both');
		}
		if($country != ''){
			$this->db->where($this->state_table_name.'.country_id',$country);
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->state_table_name.'.state_status','delete');
		$this->db->order_by($this->state_table_name.'.state_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_state_details($state){
		$this->db->select('*');
		$this->db->from($this->state_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->state_table_name.'.country_id');
		$this->db->where($this->state_table_name.'.state_id',$state);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_state_details($state){
		$this->db->select('*');
		$this->db->from($this->state_table_name);
		$this->db->where($this->state_table_name.'.state_id',$state);
		return $this->db->get()->result_array();
	}
	
	public function get_total_state_excel_data($state,$country){
		$this->db->select('*');
		$this->db->from($this->state_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->state_table_name.'.country_id');
		if($state != ''){
			$this->db->like($this->state_table_name.'.state_name',$state,'both');
		}
		if($country != ''){
			$this->db->where($this->state_table_name.'.country_id',$country);
		}
		$this->db->where_not_in($this->state_table_name.'.state_status','delete');
		$this->db->order_by($this->state_table_name.'.state_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_district_data_count($district,$division){
		$this->db->select('*');
		$this->db->from($this->district_table_name);		
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_table_name.'.division_id');
		if($district != ''){
			$this->db->like($this->district_table_name.'.district_name',$district,'both');
		}
		if($division != ''){
			$this->db->where($this->district_table_name.'.division_id',$division);
		}
		
		$this->db->where_not_in($this->district_table_name.'.district_status','delete');
		$this->db->order_by($this->district_table_name.'.district_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_district_data($district,$division,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->district_table_name);		
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_table_name.'.division_id');
		if($district != ''){
			$this->db->like($this->district_table_name.'.district_name',$district,'both');
		}
		if($division != ''){
			$this->db->where($this->district_table_name.'.division_id',$division);
		}
		
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->district_table_name.'.district_status','delete');
		$this->db->order_by($this->district_table_name.'.district_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_district_details($district){
		$this->db->select('*');
		$this->db->from($this->district_table_name);
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_table_name.'.division_id');
		$this->db->where($this->district_table_name.'.district_id',$district);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_district_details($district){
		$this->db->select('*');
		$this->db->from($this->district_table_name);
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_table_name.'.division_id');
		$this->db->where($this->district_table_name.'.district_id',$district);
		return $this->db->get()->result_array();
	}
	
	public function get_total_district_excel_data($district,$state,$country){
		$this->db->select('*');
		$this->db->from($this->district_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->district_table_name.'.country_id');
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->district_table_name.'.state_id');
		if($district != ''){
			$this->db->like($this->district_table_name.'.district_name',$district,'both');
		}
		if($state != ''){
			$this->db->where($this->district_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->district_table_name.'.country_id',$country);
		}
		$this->db->where_not_in($this->district_table_name.'.district_status','delete');
		$this->db->order_by($this->district_table_name.'.district_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_city_data_count($city,$district,$state,$country){
		$this->db->select('*');
		$this->db->from($this->city_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->city_table_name.'.country_id');
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->city_table_name.'.state_id');
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->city_table_name.'.district_id');
		if($city != ''){
			$this->db->like($this->city_table_name.'.city_name',$city,'both');
		}
		if($state != ''){
			$this->db->where($this->city_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->city_table_name.'.country_id',$country);
		}
		$this->db->where_not_in($this->city_table_name.'.city_status','delete');
		$this->db->order_by($this->city_table_name.'.city_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_city_data($city,$district,$state,$country,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->city_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->city_table_name.'.country_id');
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->city_table_name.'.state_id');
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->city_table_name.'.district_id');
		if($city != ''){
			$this->db->like($this->city_table_name.'.city_name',$city,'both');
		}
		if($state != ''){
			$this->db->where($this->city_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->city_table_name.'.country_id',$country);
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->city_table_name.'.city_status','delete');
		$this->db->order_by($this->city_table_name.'.city_id','desc');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_city_details($city){
		$this->db->select('*');
		$this->db->from($this->city_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->city_table_name.'.country_id');
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->city_table_name.'.state_id');
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->city_table_name.'.district_id');
		$this->db->where($this->city_table_name.'.city_id',$city);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_city_details($city){
		$this->db->select('*');
		$this->db->from($this->city_table_name);
		$this->db->where($this->city_table_name.'.city_id',$city);
		return $this->db->get()->result_array();
	}
	
	public function get_total_city_excel_data($city,$district,$state,$country){
		$this->db->select('*');
		$this->db->from($this->city_table_name);
		$this->db->join($this->country_table_name,$this->country_table_name.'.country_id = '.$this->city_table_name.'.country_id');
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->city_table_name.'.state_id');
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->city_table_name.'.district_id');
		if($city != ''){
			$this->db->like($this->city_table_name.'.city_name',$city,'both');
		}
		if($state != ''){
			$this->db->where($this->city_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->city_table_name.'.country_id',$country);
		}
		$this->db->where_not_in($this->city_table_name.'.city_status','delete');
		$this->db->order_by($this->city_table_name.'.city_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_area_data_count($area,$taluka_m){
		$this->db->select('*');
		$this->db->from($this->area_table_name);
		$this->db->join($this->taluka_m_table_name,$this->taluka_m_table_name.'.taluka_m_id = '.$this->area_table_name.'.taluka_m_id');
		
		if($area != ''){
			$this->db->like($this->area_table_name.'.area_name',$area,'both');
		}
		if($taluka_m != ''){
			$this->db->where($this->area_table_name.'.taluka_m_id',$taluka_m);
		}
		
		$this->db->where_not_in($this->area_table_name.'.area_status','delete');
		$this->db->order_by($this->area_table_name.'.area_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_area_data($area,$taluka_m,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->area_table_name);
		$this->db->join($this->taluka_m_table_name,$this->taluka_m_table_name.'.taluka_m_id = '.$this->area_table_name.'.taluka_m_id');		
		if($area != ''){
			$this->db->like($this->area_table_name.'.area_name',$area,'both');
		}
		if($taluka_m != ''){
			$this->db->where($this->area_table_name.'.taluka_m_id',$taluka_m);
		}
		
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->area_table_name.'.area_status','delete');
		$this->db->order_by($this->area_table_name.'.area_id','desc');
		return $this->db->get()->result_array();
		
	}
	
	public function get_area_details($area){
		$this->db->select('*');
		$this->db->from($this->area_table_name);
		$this->db->join($this->taluka_m_table_name,$this->taluka_m_table_name.'.taluka_m_id = '.$this->area_table_name.'.taluka_m_id');		
		$this->db->where($this->area_table_name.'.area_id',$area);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_area_details($area){
		$this->db->select('*');
		$this->db->from($this->area_table_name);
		$this->db->where($this->area_table_name.'.area_id',$area);
		return $this->db->get()->result_array();
	}
	
	public function get_total_area_excel_data($area,$district,$state,$country){
		$this->db->select('*');
		$this->db->from($this->area_table_name);
		$this->db->join($this->taluka_m_table_name,$this->taluka_m_table_name.'.taluka_m_id = '.$this->area_table_name.'.taluka_m_id');	
		
		if($area != ''){
			$this->db->like($this->area_table_name.'.area_name',$area,'both');
		}
		if($state != ''){
			$this->db->where($this->area_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->area_table_name.'.country_id',$country);
		}
		if($city != ''){
			$this->db->where($this->area_table_name.'.city_id',$city);
		}
		$this->db->where_not_in($this->area_table_name.'.area_status','delete');
		$this->db->order_by($this->area_table_name.'.area_id','desc');
		return $this->db->get()->result_array();
	}
	
	/* member type*/
	public function get_total_member_type_data_count($member_type){
		$this->db->select('*');
		$this->db->from($this->member_type_table_name);
		if($member_type != ''){
			$this->db->like('member_type_name',$member_type,'both');
		}
		
		$this->db->where_not_in('member_type_status','delete');
		$this->db->order_by('member_type_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_member_type_data($member_type,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->member_type_table_name);
		if($member_type != ''){
			$this->db->like('member_type_name',$member_type,'both');
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in('member_type_status','delete');
		$this->db->order_by('member_type_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_member_type_details($member_type){
		$this->db->select('*');
		$this->db->from($this->member_type_table_name);
		$this->db->where('member_type_id',$member_type);
		return $this->db->get()->result_array();
	}
	
	public function get_total_member_type_excel_data($member_type){
		$this->db->select('*');
		$this->db->from($this->member_type_table_name);
		if($member_type != ''){
			$this->db->where('member_type_name',$member_type);
		}
		$this->db->where_not_in('$member_type_status','delete');
		$this->db->order_by('$member_type_id','desc');
		return $this->db->get()->result_array();
	}
	/* member type*/
	/* Division */
		public function get_total_division_data_count($district,$state,$country){
		$this->db->select('*');
		$this->db->from($this->division_table_name);
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->division_table_name.'.state_id');
		if($district != ''){
			$this->db->like($this->division_table_name.'.division_name',$district,'both');
		}
		if($state != ''){
			$this->db->where($this->division_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->division_table_name.'.country_id',$country);
		}
		$this->db->where_not_in($this->division_table_name.'.division_status','delete');
		$this->db->order_by($this->division_table_name.'.division_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_division_data($district,$state,$country,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->division_table_name);
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->division_table_name.'.state_id');
		if($district != ''){
			$this->db->like($this->division_table_name.'.division_name',$district,'both');
		}
		if($state != ''){
			$this->db->where($this->division_table_name.'.state_id',$state);
		}
		if($country != ''){
			$this->db->where($this->division_table_name.'.country_id',$country);
		}
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->division_table_name.'.division_status','delete');
		$this->db->order_by($this->division_table_name.'.division_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_division_details($city){
		$this->db->select('*');
		$this->db->from($this->division_table_name);
		$this->db->join($this->state_table_name,$this->state_table_name.'.state_id = '.$this->division_table_name.'.state_id');
		$this->db->where($this->division_table_name.'.division_id',$city);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_division_details($city){
		$this->db->select('*');
		$this->db->from($this->division_table_name);
		$this->db->where($this->division_table_name.'.division_id',$city);
		return $this->db->get()->result_array();
	}
	
	
	/* District M */
	
	public function get_total_district_m_data_count($district,$division){
		$this->db->select('*');
		$this->db->from($this->district_m_table_name);		
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_m_table_name.'.division_id');
		if($district != ''){
			$this->db->like($this->district_m_table_name.'.district_m_name',$district,'both');
		}
		if($division != ''){
			$this->db->where($this->district_m_table_name.'.division_id',$division);
		}
		
		$this->db->where_not_in($this->district_m_table_name.'.district_m_status','delete');
		$this->db->order_by($this->district_m_table_name.'.district_m_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_district_m_data($district,$division,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->district_m_table_name);		
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_m_table_name.'.division_id');
		if($district != ''){
			$this->db->like($this->district_m_table_name.'.district_m_name',$district,'both');
		}
		if($division != ''){
			$this->db->where($this->district_m_table_name.'.division_id',$division);
		}
				
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->district_m_table_name.'.district_m_status','delete');
		$this->db->order_by($this->district_m_table_name.'.district_m_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_district_m_details($district){
		$this->db->select('*');
		$this->db->from($this->district_m_table_name);
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_m_table_name.'.division_id');
		$this->db->where($this->district_m_table_name.'.district_m_id',$district);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_district_m_details($district){
		$this->db->select('*');
		$this->db->from($this->district_m_table_name);
		$this->db->join($this->division_table_name,$this->division_table_name.'.division_id = '.$this->district_m_table_name.'.division_id');
		$this->db->where($this->district_m_table_name.'.district_m_id',$district);
		return $this->db->get()->result_array();
	}
		
	/* District M */
	
	/* TALUKA */
	
	public function get_total_taluka_data_count($taluka,$district){
		$this->db->select('*');
		$this->db->from($this->taluka_table_name);		
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_table_name.'.district_id');
		if($taluka != ''){
			$this->db->like($this->taluka_table_name.'.taluka_name',$taluka,'both');
		}
		if($district != ''){
			$this->db->where($this->taluka_table_name.'.district_id',$district);
		}
		
		$this->db->where_not_in($this->taluka_table_name.'.taluka_status','delete');
		$this->db->order_by($this->taluka_table_name.'.taluka_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_taluka_data($taluka,$district,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->taluka_table_name);		
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_table_name.'.district_id');
		if($taluka != ''){
			$this->db->like($this->taluka_table_name.'.taluka_name',$taluka,'both');
		}
		if($district != ''){
			$this->db->where($this->taluka_table_name.'.district_id',$district);
		}
		
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->taluka_table_name.'.taluka_status','delete');
		$this->db->order_by($this->taluka_table_name.'.taluka_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_taluka_details($taluka){
		$this->db->select('*');
		$this->db->from($this->taluka_table_name);
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_table_name.'.district_id');
		$this->db->where($this->taluka_table_name.'.taluka_id',$taluka);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_taluka_details($taluka){
		$this->db->select('*');
		$this->db->from($this->taluka_table_name);
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_table_name.'.district_id');
		$this->db->where($this->taluka_table_name.'.taluka_id',$taluka);
		return $this->db->get()->result_array();
	}
	
	/* TALUKA */
	
	
	/* TALUKA M*/
	
	public function get_total_taluka_m_data_count($taluka,$district){
		$this->db->select('*');
		$this->db->from($this->taluka_m_table_name);		
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_m_table_name.'.district_id');
		if($taluka != ''){
			$this->db->like($this->taluka_m_table_name.'.taluka_m_name',$taluka,'both');
		}
		if($district != ''){
			$this->db->where($this->taluka_m_table_name.'.district_id',$district);
		}
		
		$this->db->where_not_in($this->taluka_m_table_name.'.taluka_m_status','delete');
		$this->db->order_by($this->taluka_m_table_name.'.taluka_m_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_taluka_m_data($taluka,$district,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->taluka_m_table_name);		
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_m_table_name.'.district_id');
		if($taluka != ''){
			$this->db->like($this->taluka_m_table_name.'.taluka_m_name',$taluka,'both');
		}
		if($district != ''){
			$this->db->where($this->taluka_m_table_name.'.district_id',$district);
		}
		
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->taluka_m_table_name.'.taluka_m_status','delete');
		$this->db->order_by($this->taluka_m_table_name.'.taluka_m_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_taluka_m_details($taluka){
		$this->db->select('*');
		$this->db->from($this->taluka_m_table_name);
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_m_table_name.'.district_id');
		$this->db->where($this->taluka_m_table_name.'.taluka_m_id',$taluka);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_taluka_m_details($taluka){
		$this->db->select('*');
		$this->db->from($this->taluka_m_table_name);
		$this->db->join($this->district_table_name,$this->district_table_name.'.district_id = '.$this->taluka_m_table_name.'.district_id');
		$this->db->where($this->taluka_m_table_name.'.taluka_m_id',$taluka);
		return $this->db->get()->result_array();
	}
	
	/* TALUKA M */
	
	/* Gram panchayat */ 
	
		public function get_total_gram_panchayat_data_count($gram_panchayat,$taluka){
		$this->db->select('*');
		$this->db->from($this->gram_panchayat_table_name);
		$this->db->join($this->taluka_table_name,$this->taluka_table_name.'.taluka_id = '.$this->gram_panchayat_table_name.'.taluka_id');
		
		if($area != ''){
			$this->db->like($this->gram_panchayat_table_name.'.gram_panchayat_name',$gram_panchayat,'both');
		}
		if($taluka_m != ''){
			$this->db->where($this->gram_panchayat_table_name.'.taluka_id',$gram_panchayat);
		}
		
		$this->db->where_not_in($this->gram_panchayat_table_name.'.gram_panchayat_status','delete');
		$this->db->order_by($this->gram_panchayat_table_name.'.gram_panchayat_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_gram_panchayat_data($area,$taluka_m,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->gram_panchayat_table_name);
		$this->db->join($this->taluka_table_name,$this->taluka_table_name.'.taluka_id = '.$this->gram_panchayat_table_name.'.taluka_id');
		
		if($area != ''){
			$this->db->like($this->gram_panchayat_table_name.'.gram_panchayat_name',$gram_panchayat,'both');
		}
		if($taluka_m != ''){
			$this->db->where($this->gram_panchayat_table_name.'.taluka_id',$gram_panchayat);
		}
		
		$this->db->limit($limit,$start);
		$this->db->where_not_in($this->gram_panchayat_table_name.'.gram_panchayat_status','delete');
		$this->db->order_by($this->gram_panchayat_table_name.'.gram_panchayat_id','desc');
		return $this->db->get()->result_array();
		
	}
	
	public function get_gram_panchayat_details($area){
		
		$this->db->select('*');
		$this->db->from($this->gram_panchayat_table_name);
		$this->db->join($this->taluka_table_name,$this->taluka_table_name.'.taluka_id = '.$this->gram_panchayat_table_name.'.taluka_id');
		$this->db->where($this->gram_panchayat_table_name.'.gram_panchayat_id',$area);
		return $this->db->get()->result_array();
	}
	
	public function get_edit_gram_panchayat_details($area){
		$this->db->select('*');
		$this->db->from($this->gram_panchayat_table_name);
		$this->db->where($this->gram_panchayat_table_name.'.gram_panchayat_id',$area);
		return $this->db->get()->result_array();
	}
	
	/* Gram panchayat*/
	
}