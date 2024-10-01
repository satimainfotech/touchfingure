<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

   public function index()
    {
		
		if($this->input->post('member_type_id') != '')
		{
			 $member_type_id = $this->input->post('member_type_id'); 
			 $data['user'] = $this->db->order_by('id','desc')->get_where('user',array('status'=>'active','member_type_id'=>$member_type_id))->result_array();
		}
		else if($this->input->post('mobile') != '')
		{
			 $mobile = $this->input->post('mobile'); 
			 $data['user'] = $this->db->order_by('id','desc')->get_where('user',array('status'=>'active','mobile'=>$mobile))->result_array();
		}
		else if($this->input->post('name') != '')
		{
			 $name = $this->input->post('name'); 
			$data['user'] = $this->db->order_by('id', 'desc')->like('name', $name )->get_where('user', array('status' => 'active'))->result_array();
		}
		else if($this->input->post('area') != '')
		{
			$this->db->select('u.*, s.state_name, d.division_name, dis.district_name, dis_m.district_m_name, 
			t.taluka_name, t_m.taluka_m_name, g.gram_panchayat_name, a.area_name');
			$this->db->from('user u');
			$this->db->join('state s', 's.state_id = NULLIF(u.state, "")', 'left');
			$this->db->join('division d', 'd.division_id = NULLIF(u.division, "")', 'left');
			$this->db->join('district dis', 'dis.district_id = NULLIF(u.district, "")', 'left');
			$this->db->join('district_m dis_m', 'dis_m.district_m_id = NULLIF(u.district_m, "")', 'left');
			$this->db->join('taluka t', 't.taluka_id = NULLIF(u.taluka, "")', 'left');
			$this->db->join('taluka_m t_m', 't_m.taluka_m_id = NULLIF(u.taluka_m, "")', 'left');
			$this->db->join('gram_panchayat g', 'g.gram_panchayat_id = NULLIF(u.gram_panchayat, "")', 'left');
			$this->db->join('area a', 'a.area_id = NULLIF(u.area, "")', 'left');

			// Add WHERE conditions
			$this->db->group_start(); // Open parentheses for OR conditions
			$this->db->like('s.state_name', 'guj');
			$this->db->or_like('d.division_name', 'guj');
			$this->db->or_like('dis.district_name', 'guj');
			$this->db->or_like('dis_m.district_m_name', 'guj');
			$this->db->or_like('t.taluka_name', 'guj');
			$this->db->or_like('t_m.taluka_m_name', 'guj');
			$this->db->or_like('g.gram_panchayat_name', 'guj');
			$this->db->or_like('a.area_name', 'guj');
			$this->db->group_end(); // Close parentheses for OR conditions

			$this->db->where('u.id IS NOT NULL');
			$this->db->where('u.status','active');

			// Execute the query
			$data['user'] =  $this->db->get()->result_array();
			
		}
		else
		{
			$data['user'] = $this->db->order_by('id','desc')->get_where('user',array('status'=>'active','member_type_id'=>'0'))->result_array();
		}
		
		
		
    	$data['home_page_data'] = $this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
		$data['content_data'] = $this->db->get_where('aboutus',array('aboutus_id'=>'1'))->result_array();
		
		$data["member_type_data"] = get_member_type();
		$content_data = $this->db->get_where('aboutus',array('aboutus_id'=>'1'))->result_array();
		$data["page_names"] = @$content_data[0]['page_title'];
		$data["header_image"] = @$content_data[0]['header_image'];
		$data["page_title"] = @$content_data[0]['page_title'];
		$data["page_title_bottom_text"] = @$content_data[0]['page_title_bottom_text'];
		$data['social_media_data'] = $this->db->get_where('web_social_media',array('status'=>'Active'))->result_array();
		$data['category_data'] = $this->db->order_by('category_position','asc')->get_where('category',array('category_status'=>'Active'))->result_array();
		$data['brand_data'] = $this->db->order_by('brand_position','asc')->get_where('brand',array('brand_status'=>'Active'))->result_array();
		$data['sub_category_data'] = $this->db->order_by('sub_category_position','asc')->get_where('sub_category',array('sub_category_status'=>'Active'))->result_array();
		$data['testominal_data'] = $this->db->order_by('testimonials_position','asc')->get_where('testimonials',array('testimonials_status'=>'Active'))->result_array();
		$data['our_technology'] = $this->db->limit($technolgy_show)->order_by('position','asc')->get_where('our_technology',array('our_technology_status'=>'yes'))->result_array();
		$data["system_name"] = 'Convart';
		$data["meta_description"] = 'Convart';
		$data["meta_keywords"] = 'Convart';
		$data["meta_author"] = 'Convart';
		$data["page_slug"] = "community";
		$data["page_class"] = "about";
		$data["main_content"] = "cms_pages/community";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
}