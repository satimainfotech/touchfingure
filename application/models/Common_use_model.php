<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Common_use_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->competition_data_table_name = 'competition_data';
		$this->app_banner_table_name = 'app_banner';
		$this->shopping_banner_table_name = 'shopping_banner';
		$this->master_contests_table_name = 'master_contests';
		$this->contests_type_table_name = 'contests_type';
		$this->match_contests_list_table_name = 'match_contests_list';
		$this->area_table_name = 'area';
		$this->city_table_name = 'city';
		$this->country_table_name = 'country';
		$this->district_table_name = 'district';
		$this->state_table_name = 'state';
		$this->notification_table_name = 'notification';
		$this->match_data_table_name = 'match_data';
		$this->my_joining_match_data_table_name = 'my_joining_match_data';
		$this->product_table_name = 'product';
		$this->category_table_name = 'category';
		$this->sub_category_table_name = 'sub_category';
		$this->brand_table_name = 'brand';
		$this->shopping_address_book_table_name = 'shopping_address_book';
		$this->orders_table_name = 'orders';
		$this->status_table_name = 'order_status_manage';
		$this->order_items_table_name = 'order_items';
		$this->my_joining_contests_data = 'my_joining_contests_data';
		$this->my_teams_data = 'my_teams';
		$this->my_teams_players_data = 'my_teams_players';
		$this->matchs_teams_data = 'matchs_teams';
		$this->my_joining_contests_team_data = 'my_joining_contests_team_data';
		$this->user_data = 'user';
	}
	
	public function get_total_match_data_count($mid,$cid,$sdate,$edate,$sname,$stype,$ortype,$orvalue){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($stype != ''){
			$this->db->where($this->match_data_table_name.'.status',$stype);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where_not_in($this->match_data_table_name.'.status','10'); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.'.$ortype,$orvalue);
		return $this->db->get()->result_array();
	}
	
	public function get_total_match_data($mid,$cid,$sdate,$edate,$sname,$stype,$ortype,$orvalue,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($stype != ''){
			$this->db->where($this->match_data_table_name.'.status',$stype);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where_not_in($this->match_data_table_name.'.status','10'); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.'.$ortype,$orvalue);
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_match_details($match_id,$our_match_id,$our_match_token){
		$this->db->select('*, '.$this->match_data_table_name.'.cid as m_cid');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		$this->db->where($this->match_data_table_name.'.match_id',$match_id);
		$this->db->where($this->match_data_table_name.'.our_match_id',$our_match_id);
		$this->db->where($this->match_data_table_name.'.our_match_token',$our_match_token);
		return $this->db->get()->result_array();
	}
	
	public function get_total_banner_data_count(){
		$this->db->select('*');
		$this->db->from($this->app_banner_table_name);
		$this->db->where_not_in('app_banner_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_total_banner_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->app_banner_table_name);
		$this->db->where_not_in('app_banner_status','delete');
		$this->db->order_by('app_banner_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_app_banner_information($app_banner_id,$app_banner_token){
		$this->db->select('*');
		$this->db->from($this->app_banner_table_name);
		$this->db->where('app_banner_id',$app_banner_id);
		$this->db->where('app_banner_token',$app_banner_token);
		return $this->db->get()->result_array();
	}
	
	public function get_total_shopping_banner_data_count(){
		$this->db->select('*');
		$this->db->from($this->shopping_banner_table_name);
		$this->db->where_not_in('shopping_banner_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_total_shopping_banner_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->shopping_banner_table_name);
		$this->db->where_not_in('shopping_banner_status','delete');
		$this->db->order_by('shopping_banner_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_app_shopping_banner_information($app_banner_id,$app_banner_token){
		$this->db->select('*');
		$this->db->from($this->shopping_banner_table_name);
		$this->db->where('shopping_banner_id',$app_banner_id);
		$this->db->where('shopping_banner_token',$app_banner_token);
		return $this->db->get()->result_array();
	}
	
	public function get_total_live_match_data_count($mid,$cid,$sdate,$edate,$sname){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where($this->match_data_table_name.'.status','3'); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.date_start','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_live_match_data($mid,$cid,$sdate,$edate,$sname,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where($this->match_data_table_name.'.status','3'); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.date_start','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_total_completed_match_data_count($mid,$cid,$sdate,$edate,$sname){
		$ids = array('2','4');
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where_in($this->match_data_table_name.'.status',$ids); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.date_start','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_completed_match_data($mid,$cid,$sdate,$edate,$sname,$limit,$start){
		$ids = array('2','4');
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where_in($this->match_data_table_name.'.status',$ids); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.date_start','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_total_in_review_match_data_count($mid,$cid,$sdate,$edate,$sname){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where($this->match_data_table_name.'.status','5'); /* 5 is in review status */
		$this->db->order_by($this->match_data_table_name.'.date_start','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_in_review_match_data($mid,$cid,$sdate,$edate,$sname,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where($this->match_data_table_name.'.status','5'); /* 5 is in review status */
		$this->db->order_by($this->match_data_table_name.'.date_start','asc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_total_upcomming_match_data_count($mid,$cid,$sdate,$edate,$sname){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where($this->match_data_table_name.'.status','1'); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.date_start','asc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_upcomming_match_data($mid,$cid,$sdate,$edate,$sname,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->match_data_table_name);
		$this->db->join($this->competition_data_table_name,$this->competition_data_table_name.'.cid = '.$this->match_data_table_name.'.cid','left');
		if($mid != ''){
			$this->db->like($this->match_data_table_name.'.match_id',$mid,'both');
		}
		if($cid != ''){
			$this->db->where($this->match_data_table_name.'.cid',$cid);
		}
		if($sname != ''){
			$this->db->where($this->competition_data_table_name.'.c_season',$sname);
		}
		if($sdate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_start >=',$sdate);
		}
		if($edate != ''){
			$this->db->where($this->match_data_table_name.'.timestamp_end <=',$edate);
		}
		$this->db->where($this->match_data_table_name.'.status','1'); /* 10 is delete status */
		$this->db->order_by($this->match_data_table_name.'.date_start','asc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_master_contests_list($master_contests_id){
		$this->db->select('*');
		$this->db->from($this->master_contests_table_name);
		$this->db->where('master_contests_status','Active');
		$this->db->where('master_contests_type',$master_contests_id);
		$this->db->order_by('master_contests_id','asc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_total_match_contests_data_count($contests_type,$join_fee,$match_id){
		$this->db->select('*');
		$this->db->from($this->match_contests_list_table_name);
		if($join_fee != ''){
			$this->db->where('match_contests_joining_prize',$join_fee);
		}
		if($contests_type != ''){
			$this->db->where('match_contests_master_contest_type',$contests_type);
		}
		$this->db->where('match_contests_match_id',$match_id);
		$this->db->where_not_in('match_contests_status','delete');
		$this->db->order_by('match_contests_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_match_contests_data($contests_type,$join_fee,$match_id,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->match_contests_list_table_name);
		if($join_fee != ''){
			$this->db->where('match_contests_joining_prize',$join_fee);
		}
		if($contests_type != ''){
			$this->db->where('match_contests_master_contest_type',$contests_type);
		}
		$this->db->where('match_contests_match_id',$match_id);
		$this->db->where_not_in('match_contests_status','delete');
		$this->db->order_by('match_contests_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_match_contests_details($match_contests_id,$match_contests_token){
		$this->db->select('*');
		$this->db->from($this->match_contests_list_table_name);
		$this->db->where('match_contests_id',$match_contests_id);
		$this->db->where('match_contests_token',$match_contests_token);
		return $this->db->get()->result_array();
	}
	
	/* COUNT PLAYER POINTS */
		public function get_players_data($match_id,$expo_team){
			$this->db->select('short_name,player_id,match_id,macth_fantacy_point');
			$this->db->from($this->matchs_teams_data);
			$this->db->where('match_id',$match_id);
			$this->db->where_in('player_id',$expo_team);
			return $this->db->get()->result_array();
		}
	/* COUNT PLAYER POINTS */
	/* GET FROM TO TO TEAM LIST */
		public function get_this_rank_team_data($match_id,$contests_id,$from_number,$to_number){
			$this->db->select('*');
			$this->db->from($this->my_joining_contests_team_data);
			if($from_number != ''){
				$this->db->where('team_rank >=',$from_number);
			}
			if($to_number != ''){
				$this->db->where('team_rank <=',$to_number);
			}
			$this->db->where('match_id',$match_id);
			$this->db->where('contests_id',$contests_id);
			$this->db->where('com_status',NULL);
			$this->db->where('fee_status','joined');
			$this->db->order_by('team_rank','asc');
			return $this->db->get()->result_array();
			//echo $this->db->last_query();
		}
		
		public function get_players_data_demo($match_id,$expo_team,$caption_id,$vice_caption_id){
			$this->db->select('sum(macth_fantacy_point) As total_points');
			$this->db->from($this->matchs_teams_data);
			$this->db->where('match_id',$match_id);
			$this->db->where_in('player_id',$expo_team);
			$this->db->where_not_in('player_id',$caption_id);
			$this->db->where_not_in('player_id',$vice_caption_id);
			$total_player_data = $this->db->get()->result_array();			
			$player_total = $total_player_data[0]['total_points'];
			
			$this->db->select('sum(macth_fantacy_point) As total_points');
			$this->db->from($this->matchs_teams_data);
			$this->db->where('match_id',$match_id);			
			$this->db->where('player_id',$caption_id);			
			$cap_data = $this->db->get()->result_array();
			$cap_total = $cap_data[0]['total_points']*2;
			
			$this->db->select('sum(macth_fantacy_point) As total_points');
			$this->db->from($this->matchs_teams_data);
			$this->db->where('match_id',$match_id);			
			$this->db->where('player_id',$vice_caption_id);
			$vice_cap_data = $this->db->get()->result_array();
			$vice_cap_total = $vice_cap_data[0]['total_points']*1.5;
			return ($player_total + $cap_total + $vice_cap_total);
			
		}
		
		public function get_franchise_team_users($match_id){
			$this->db->select('*');
			$this->db->from($this->my_joining_contests_team_data);
			$this->db->where('match_id',$match_id);
			$this->db->where_not_in('user_franchise_id',NULL);
			$this->db->where('com_status','yes');
			$this->db->where('wal_com_status','yes');
			$this->db->where('franchise_com_status','no');
			$this->db->where('fee_status','joined');
			return $this->db->get()->result_array();
			//echo $this->db->last_query();
		}
		public function not_com_claluclate($match_id){
			$this->db->select('*');
			$this->db->from($this->my_joining_contests_team_data);
			$this->db->where('match_id',$match_id);
			$this->db->where('user_franchise_id !=',NULL);
			$this->db->where('com_status','yes');
			$this->db->where('wal_com_status','yes');
			$this->db->where('franchise_com_status','no');
			$this->db->where('fee_status','joined');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		}
		public function done_com_claluclate($match_id){
			$this->db->select('*');
			$this->db->from($this->my_joining_contests_team_data);
			$this->db->where('match_id',$match_id);
			$this->db->where('user_franchise_id !=',NULL);
			$this->db->where('com_status','yes');
			$this->db->where('wal_com_status','yes');
			$this->db->where('franchise_com_status','yes');
			$this->db->where('fee_status','joined');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		} 
		public function check_inreview_contents($match_id){
			$this->db->select('*');
			$this->db->from($this->match_contests_list_table_name);
			$this->db->where('match_contests_match_id',$match_id);
			$this->db->where('match_contests_statuss','In-review');
			$this->db->where('match_contests_full','yes');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		}
		public function check_contest_inreview_contents($match_id,$contest_id){
			$this->db->select('*');
			$this->db->from($this->match_contests_list_table_name);
			$this->db->where('match_contests_match_id',$match_id);
			$this->db->where('match_contests_id',$contest_id);
			$this->db->where('match_contests_status','inreview');
			$this->db->where('match_contests_statuss','In-review');
			$this->db->where('match_contests_full','yes');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		}
		public function check_paid_contents($match_id){
			$this->db->select('*');
			$this->db->from($this->match_contests_list_table_name);
			$this->db->where('match_contests_match_id',$match_id);
			$this->db->where('match_contests_statuss','Declare');  
			$this->db->where('match_contests_full','yes');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		}
		public function check_contest_paid_contents($match_id,$contest_id){
			$this->db->select('*');
			$this->db->from($this->match_contests_list_table_name);
			$this->db->where('match_contests_match_id',$match_id);
			$this->db->where('match_contests_id',$contest_id);
			$this->db->where('match_contests_status','inreview');
			$this->db->where('match_contests_statuss','Declare');  
			$this->db->where('match_contests_full','yes');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		}
		public function if_check_not_found_remaing($match_id){
			$ids = array('Live','In-review','Paid');
			$this->db->select('*');
			$this->db->from($this->match_contests_list_table_name);
			$this->db->where('match_contests_match_id',$match_id);
			$this->db->where_in('match_contests_statuss',$ids);
			$this->db->where('match_contests_full','yes');
			return $this->db->get()->num_rows();
			//echo $this->db->last_query();
		}
		public function get_franchise_yes_team_users($match_id){
			$this->db->select('*');
			$this->db->from($this->my_joining_contests_team_data);
			$this->db->where('match_id',$match_id);
			$this->db->where('user_franchise_id !=',NULL);
			$this->db->where('com_status','yes');
			$this->db->where('wal_com_status','yes');
			$this->db->where('franchise_com_status','yes');
			$this->db->where('fee_status','joined');
			return $this->db->get()->result_array();
			//echo $this->db->last_query();
		}
		public function get_franchise_total_amount($match_id,$user_id){
			$this->db->select('ROUND(SUM(user_franchise_total_commission), 2) as total_commission');
			$this->db->from($this->my_joining_contests_team_data);
			$this->db->where('match_id',$match_id);
			$this->db->where('user_franchise_id',$user_id);
			$this->db->where('com_status','yes');
			$this->db->where('wal_com_status','yes');
			$this->db->where('franchise_com_status','yes');
			$this->db->where('fee_status','joined');
			return $this->db->get()->result_array();
			//echo $this->db->last_query();
		}
	/* GET FROM TO TO TEAM LIST */
	
	public function get_all_users(){
		$this->db->select('*');
		$this->db->from($this->user_data);
		$this->db->where_not_in($this->user_data.'.device_token','');
		return $this->db->get()->result_array();
	}
	
	public function get_total_match_contests_team_data_count($match_id,$contests_id,$user_name){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->my_joining_contests_team_data.'.join_user_id','left');
		if($user_name != ''){
			$this->db->like($this->user_data.'.team_name',$user_name,'both');
		}
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$match_id);
		$this->db->where($this->my_joining_contests_team_data.'.contests_id',$contests_id);
		$this->db->order_by($this->my_joining_contests_team_data.'.my_contests_team_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_match_contests_team_data($match_id,$contests_id,$user_name,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->my_joining_contests_team_data.'.join_user_id','left');
		$this->db->join($this->my_teams_data,$this->my_teams_data.'.team_id = '.$this->my_joining_contests_team_data.'.joined_team_id','left');
		if($user_name != ''){
			$this->db->like($this->user_data.'.team_name',$user_name,'both');
		}
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$match_id);
		$this->db->where($this->my_joining_contests_team_data.'.contests_id',$contests_id);
		$this->db->order_by($this->my_joining_contests_team_data.'.team_rank','asc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_match_contests_team_details($match_id,$contests_id,$team_id,$user_id){
		$this->db->select('*');
		$this->db->from($this->my_teams_data);
		//$this->db->join($this->matchs_teams_data,$this->matchs_teams_data.'.player_id = '.$this->my_teams_players_data.'.my_player_id','left');
		$this->db->where($this->my_teams_data.'.match_id',$match_id);
		$this->db->where($this->my_teams_data.'.team_id',$team_id);
		$this->db->where($this->my_teams_data.'.user_id',$user_id);
		return  $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function count_total_fantasy_point($pid,$match_id,$cid){
		$this->db->select('SUM(macth_fantacy_point) as total_point');
		$this->db->from($this->matchs_teams_data);
		//$this->db->where($this->matchs_teams_data.'.match_id',$match_id);
		$this->db->where($this->matchs_teams_data.'.cid',$cid);
		$this->db->where($this->matchs_teams_data.'.player_id',$pid);
		return  $this->db->get()->result_array();
	}
	
	public function check_play_in_last_match($pid,$cid,$match_id){
		$this->db->select('*');
		$this->db->from($this->matchs_teams_data);
		$this->db->where($this->matchs_teams_data.'.cid',$cid);
		$this->db->where($this->matchs_teams_data.'.player_id',$pid);
		$this->db->where_not_in($this->matchs_teams_data.'.match_id',$match_id);
		$this->db->order_by($this->matchs_teams_data.'.match_id','desc');
		$this->db->limit(1);
		return $this->db->get()->result_array();
		// echo $this->db->last_query();
	}
	
	public function get_this_player_info($pid,$match_id,$cid){
		$this->db->select('*');
		$this->db->from($this->matchs_teams_data);
		$this->db->where($this->matchs_teams_data.'.cid',$cid);
		$this->db->where($this->matchs_teams_data.'.player_id',$pid);
		$this->db->where($this->matchs_teams_data.'.match_id',$match_id);
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	/* GET MATCHS */
	
		public function get_upcomming_match_list_data($date_time){
			$this->db->select('*');
			$this->db->from($this->match_data_table_name);
			$this->db->where($this->match_data_table_name.'.timestamp_start >',$date_time);
			$this->db->where('status','1');
			$this->db->order_by('date_start','asc');
			$res = $this->db->get()->result_array();
			if(!empty($res)){
				foreach($res as $row){
					if($row['match_id'] != ''){
						$match_id = $row['match_id'];
					}else{
						$match_id = "";
					}
					if($row['our_match_id'] != ''){
						$our_match_id = $row['our_match_id'];
					}else{
						$our_match_id = "";
					}
					if($row['our_match_token'] != ''){
						$our_match_token = $row['our_match_token'];
					}else{
						$our_match_token = "";
					}
					if($row['short_title'] != ''){
						$short_title = $row['short_title'];
					}else{
						$short_title = "";
					}
					if($row['teama_short_name'] != ''){
						$teama_short_name = $row['teama_short_name'];
					}else{
						$teama_short_name = "";
					}
					if($row['teamb_short_name'] != ''){
						$teamb_short_name = $row['teamb_short_name'];
					}else{
						$teamb_short_name = "";
					}
					if($row['date_start'] != ''){
						$date_start = get_orignal_app_datetime($row['timestamp_start']); 
					}else{
						$date_start = "";
					}
					if($row['timestamp_start'] != ''){
						$timestamp_start = get_orignalss_only_time($row['timestamp_start']); 
					}else{
						$timestamp_start = "";
					}
					$match_data[] = array(
						'our_match_id' => $our_match_id,
						'our_match_token' => $our_match_token,
						'match_id' => $match_id,
						'title' => $short_title,
						'team_one_name' => $teama_short_name,
						'team_two_name' => $teamb_short_name,
						'date_start' => $date_start,
						'time' => $timestamp_start,
					);
				}
				return $match_data;
			}else{
				$match_data = array();
				return $match_data;
			}
		}
		
	/* GET MATCHS */
	
	public function get_join_added_amount($match_id,$contest_id){
		$this->db->select('SUM(added_amount_minus_fee) as total_added_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_join_winning_amount($match_id,$contest_id){
		$this->db->select('SUM(winning_amount_minus_fee) as total_winning_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_join_cashback_amount($match_id,$contest_id){
		$this->db->select('SUM(winning_cashback_minus_fee) as total_cashback_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_join_bonus_amount($match_id,$contest_id){
		$this->db->select('SUM(bonus_minus_fee) as total_bonus_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cash_c_s_amount($match_id,$contest_id){
		$this->db->select('SUM(winning_amount) as total_win_cash_s_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('content_types','syatem');
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cashback_c_s_amount($match_id,$contest_id){
		$this->db->select('SUM(winning_voucher) as total_win_cashback_s_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('content_types','syatem');
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cash_c_u_amount($match_id,$contest_id){
		$this->db->select('SUM(winning_amount) as total_win_cash_u_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('content_types',NULL);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cashback_c_u_amount($match_id,$contest_id){
		$this->db->select('SUM(winning_voucher) as total_win_cashback_u_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('contests_id',$contest_id);
		$this->db->where('content_types',NULL);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_join_added_total_amount($match_id){
		$this->db->select('SUM(added_amount_minus_fee) as total_added_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_join_winning_total_amount($match_id){
		$this->db->select('SUM(winning_amount_minus_fee) as total_winning_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_join_cashback_total_amount($match_id){
		$this->db->select('SUM(winning_cashback_minus_fee) as total_cashback_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_join_bonus_total_amount($match_id){
		$this->db->select('SUM(bonus_minus_fee) as total_bonus_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_win_cash_c_s_total_amount($match_id){
		$this->db->select('SUM(winning_amount) as total_win_cash_s_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('content_types','syatem');
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cashback_c_s_total_amount($match_id){
		$this->db->select('SUM(winning_voucher) as total_win_cashback_s_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('content_types','syatem');
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cash_c_u_total_amount($match_id){
		$this->db->select('SUM(winning_amount) as total_win_cash_u_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('content_types',NULL);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_win_cashback_c_u_total_amount($match_id){
		$this->db->select('SUM(winning_voucher) as total_win_cashback_u_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where('match_id',$match_id);
		$this->db->where('content_types',NULL);
		$this->db->where('fee_status','joined');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	public function get_total_match_played_user_data_count($mid){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->my_joining_contests_team_data.'.join_user_id','left');
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid); /* 10 is delete status */
		$this->db->where($this->my_joining_contests_team_data.'.content_types',NULL);
		$this->db->group_by($this->my_joining_contests_team_data.'.join_user_id');
		$this->db->order_by($this->my_joining_contests_team_data.'.join_user_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_match_played_user_data($mid,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->join($this->user_data,$this->user_data.'.user_id = '.$this->my_joining_contests_team_data.'.join_user_id','left');
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid); /* 10 is delete status */
		$this->db->where($this->my_joining_contests_team_data.'.content_types',NULL);
		$this->db->group_by($this->my_joining_contests_team_data.'.join_user_id');
		$this->db->order_by($this->my_joining_contests_team_data.'.join_user_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
	
	public function get_added_amount_total($user_id,$mid){
		$this->db->select('*, SUM(added_amount_minus_fee) as total_added_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid);
		$this->db->where($this->my_joining_contests_team_data.'.join_user_id',$user_id);
		$this->db->where($this->my_joining_contests_team_data.'.fee_status','joined');
		return $this->db->get()->result_array();
	}
	
	public function get_winning_amount_total($user_id,$mid){
		$this->db->select('*, SUM(winning_amount_minus_fee) as total_winning_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid);
		$this->db->where($this->my_joining_contests_team_data.'.join_user_id',$user_id);
		$this->db->where($this->my_joining_contests_team_data.'.fee_status','joined');
		return $this->db->get()->result_array();
	}
	
	public function get_cashback_amount_total($user_id,$mid){
		$this->db->select('*, SUM(winning_cashback_minus_fee) as total_cashback_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid); 
		$this->db->where($this->my_joining_contests_team_data.'.join_user_id',$user_id);
		$this->db->where($this->my_joining_contests_team_data.'.fee_status','joined');
		return $this->db->get()->result_array();
	}
	
	public function get_bonus_amount_total($user_id,$mid){
		$this->db->select('*, SUM(bonus_minus_fee) as total_bonus_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid);
		$this->db->where($this->my_joining_contests_team_data.'.join_user_id',$user_id);
		$this->db->where($this->my_joining_contests_team_data.'.fee_status','joined');
		return $this->db->get()->result_array();
	}
	
	public function get_match_win_amount_total($user_id,$mid){
		$this->db->select('*, SUM(winning_amount) as total_win_amount');
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid);
		$this->db->where($this->my_joining_contests_team_data.'.join_user_id',$user_id);
		$this->db->where($this->my_joining_contests_team_data.'.fee_status','joined');
		return $this->db->get()->result_array();
	}
	
	public function get_match_win_cashback_total($user_id,$mid){
		$this->db->select('*, SUM(winning_voucher) as total_win_cashback'); 
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$mid);
		$this->db->where($this->my_joining_contests_team_data.'.join_user_id',$user_id);
		$this->db->where($this->my_joining_contests_team_data.'.fee_status','joined');
		return $this->db->get()->result_array();
	}
	
	public function get_team_total($user_id,$mid){
		$this->db->select('*'); 
		$this->db->from($this->my_teams_data);
		$this->db->where($this->my_teams_data.'.match_id',$mid);
		$this->db->where($this->my_teams_data.'.user_id',$user_id);
		return $this->db->get()->num_rows();
	}
	
	public function get_our_user_join($match_id,$contests_id){
		$ids = array('1','4','2256','36','2','478');
		$this->db->select('*'); 
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where_in($this->my_joining_contests_team_data.'.join_user_id',$ids);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$match_id);
		$this->db->where($this->my_joining_contests_team_data.'.contests_id',$contests_id);
		return $this->db->get()->num_rows();
	}
	
	public function get_normal_user_join($match_id,$contests_id){
		$ids = array('1','4','2256','36','2','478');
		$this->db->select('*'); 
		$this->db->from($this->my_joining_contests_team_data);
		$this->db->where_not_in($this->my_joining_contests_team_data.'.join_user_id',$ids);
		$this->db->where($this->my_joining_contests_team_data.'.match_id',$match_id);
		$this->db->where($this->my_joining_contests_team_data.'.contests_id',$contests_id);
		$this->db->where($this->my_joining_contests_team_data.'.content_types',NULL);
		return $this->db->get()->num_rows();
	}
	
	public function get_total_user_team_data($match_id,$user_id){
		$this->db->select('*'); 
		$this->db->from($this->my_teams_data);
		$this->db->where($this->my_teams_data.'.match_id',$match_id);
		$this->db->where($this->my_teams_data.'.user_id',$user_id);
		return $this->db->get()->result_array();
	}
	
	public function get_my_team_all_players_list($match_id,$my_team_id){
		$this->db->select('*');
		$this->db->from($this->matchs_teams_data);
		$this->db->where($this->matchs_teams_data.'.match_id',$match_id);
		$this->db->where_in($this->matchs_teams_data.'.player_id',$my_team_id);
		return $this->db->get()->result_array();
	}
	
	public function get_join_contests_total($user_id,$match_id){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_data);
		$this->db->where($this->my_joining_contests_data.'.join_user_id',$user_id);
		$this->db->where_in($this->my_joining_contests_data.'.match_id',$match_id);
		return $this->db->get()->num_rows();
	}
	
	public function get_total_user_join_contests_data_count($match_id,$user_id){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_data);
		$this->db->join($this->match_contests_list_table_name,$this->match_contests_list_table_name.'.match_contests_id = '.$this->my_joining_contests_data.'.contests_id','left');
		$this->db->where($this->my_joining_contests_data.'.match_id',$match_id);
		$this->db->where($this->my_joining_contests_data.'.join_user_id',$user_id);
		$this->db->order_by($this->my_joining_contests_data.'.contests_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_user_join_contests_data($match_id,$user_id,$limit,$start){
		$this->db->select('*');
		$this->db->from($this->my_joining_contests_data);
		$this->db->join($this->match_contests_list_table_name,$this->match_contests_list_table_name.'.match_contests_id = '.$this->my_joining_contests_data.'.contests_id','left');
		$this->db->where($this->my_joining_contests_data.'.match_id',$match_id);
		$this->db->where($this->my_joining_contests_data.'.join_user_id',$user_id);
		$this->db->order_by($this->my_joining_contests_data.'.contests_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}
}