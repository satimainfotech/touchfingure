<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Manage_website_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->city_table_name = 'city';
		$this->country_table_name = 'country';
		$this->state_table_name = 'state';
		$this->social_media_table_name = 'web_social_media';
		$this->testimonials_table_name = 'testimonials';
		$this->sliders_table_name = 'sliders';
		$this->second_sliders_table_name = 'second_sliders';
		$this->our_technology_table_name = 'our_technology';
		$this->our_range_table_name = 'our_range';
		$this->brand_table_name = 'brand';
		$this->our_network_table_name = 'our_network';
		$this->faq_table_name = 'faq';
	}
	
	public function get_total_social_media_data_count(){
		$this->db->select('*');
		$this->db->from($this->social_media_table_name);
		$this->db->where_not_in('status','delete');
		$this->db->order_by('w_s_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_total_social_media_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->social_media_table_name);
		$this->db->limit($limit,$start);
		$this->db->where_not_in('status','delete');
		$this->db->order_by('w_s_id','desc');
		return $this->db->get()->result_array();
	}
	
	public function get_social_media_details($w_s_id){
		$this->db->select('*');
		$this->db->from($this->social_media_table_name);
		$this->db->where('w_s_id',$w_s_id);
		return $this->db->get()->result_array();
	}
	
	public function get_testimonials_data_count(){
		$this->db->select('*');
		$this->db->from($this->testimonials_table_name);
		$this->db->order_by('testimonials_id','desc');
		$this->db->where_not_in('testimonials_status','delete');
		return $this->db->get()->num_rows();
	}
	
	public function get_testimonials_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->testimonials_table_name);
		$this->db->limit($limit,$start);
		$this->db->order_by('testimonials_id','desc');
		$this->db->where_not_in('testimonials_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_our_network_data_count(){
		$this->db->select('*');
		$this->db->from($this->our_network_table_name);
		$this->db->order_by('our_net_id','desc');
		$this->db->where_not_in('our_net_status','delete');
		return $this->db->get()->num_rows();
	}
	
	public function get_our_network_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->our_network_table_name);
		$this->db->limit($limit,$start);
		$this->db->order_by('our_net_id','desc');
		$this->db->where_not_in('our_net_status','delete');
		return $this->db->get()->result_array();
	}
	
	
	public function get_sliders_data_count(){
		$this->db->select('*');
		$this->db->from($this->sliders_table_name);
		$this->db->order_by('slider_id','desc');
		$this->db->where_not_in('slider_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_sliders_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->sliders_table_name);
		$this->db->limit($limit,$start);
		$this->db->order_by('slider_id','desc');
		$this->db->where_not_in('slider_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_second_sliders_data_count(){
		$this->db->select('*');
		$this->db->from($this->second_sliders_table_name);
		$this->db->order_by('second_slider_id','desc');
		$this->db->where_not_in('second_slider_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_second_sliders_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->second_sliders_table_name);
		$this->db->limit($limit,$start);
		$this->db->order_by('second_slider_id','desc');
		$this->db->where_not_in('second_slider_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_our_technology_data_count(){
		$this->db->select('*');
		$this->db->from($this->our_technology_table_name);
		$this->db->order_by('our_technology_id','desc');
		$this->db->where_not_in('our_technology_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_our_technology_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->our_technology_table_name);
		$this->db->limit($limit,$start);
		$this->db->order_by('our_technology_id','desc');
		$this->db->where_not_in('our_technology_status','delete');
		return $this->db->get()->result_array();
	}
	
	public function get_our_range($limit){
		$this->db->select('*');
		$this->db->from($this->our_range_table_name);
		$this->db->join($this->brand_table_name,$this->brand_table_name.'.brand_id = '.$this->our_range_table_name.'.our_range_brand','left');
		$this->db->limit($limit);
		$this->db->order_by($this->our_range_table_name.'.our_range_id','desc');
		$this->db->where_not_in($this->our_range_table_name.'.our_range_status','delete');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	public function get_faq_data_count(){
		$this->db->select('*');
		$this->db->from($this->faq_table_name);
		$this->db->order_by('faq_id','desc');
		$this->db->where_not_in('faq_status','delete');
		return $this->db->get()->num_rows();
	}
	
	public function get_faq_data($limit,$start){
		$this->db->select('*');
		$this->db->from($this->faq_table_name);
		$this->db->limit($limit,$start);
		$this->db->order_by('faq_id','desc');
		$this->db->where_not_in('faq_status','delete');
		return $this->db->get()->result_array();
	}
}