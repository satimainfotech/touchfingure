<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

   public function index()
    {
    	$data['home_page_data'] = $this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
		$data['content_data'] = $this->db->get_where('aboutus',array('aboutus_id'=>'1'))->result_array();
		$data['attend_event_data'] = $this->db->order_by('position','asc')->get_where('our_technology',array('our_technology_status'=>'yes'))->result_array();
		
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
		$data['services_data'] = $this->db->order_by('services_position','asc')->get_where('services_master',array('services_status'=>'Active'))->result_array();
		$data["system_name"] = 'Convart';
		$data["meta_description"] = 'Convart';
		$data["meta_keywords"] = 'Convart';
		$data["meta_author"] = 'Convart';
		$data["page_slug"] = "services";
		$data["page_class"] = "about";
		$data["main_content"] = "cms_pages/services";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	public function view()
    {
		$token = $this->uri->segment(3);
		$id = $this->uri->segment(4); 
		$data['services_data'] = $this->db->order_by('services_position','asc')->get_where('services_master',array('services_status'=>'Active','services_token'=>$token,'services_id'=>$id))->result_array();
		
		$data["system_name"] = 'Convart';
		$data["meta_description"] = 'Convart';
		$data["meta_keywords"] = 'Convart';
		$data["meta_author"] = 'Convart';
		$data["page_slug"] = "services";
		$data["page_class"] = "about";
		$data["main_content"] = "cms_pages/services_view";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
}