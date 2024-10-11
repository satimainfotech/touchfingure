<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

   public function index()
    {
		if($this->input->post('dates') != '')
		{
			 $news_date = $this->input->post('dates'); 
			 $data['news_master'] = $this->db->order_by('news_id','desc')->get_where('news_master',array('news_status'=>'Active','news_name'=>$news_date))->result_array();
		}
		else
		{
			$data['news_master'] = $this->db->order_by('news_id', 'desc')
                                ->get_where('news_master', array('news_status' => 'Active'), 3)
                                ->result_array();
			
		}
		
    	$data['home_page_data'] = $this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
		$data['content_data'] = $this->db->get_where('aboutus',array('aboutus_id'=>'1'))->result_array();
		$data['user'] = $this->db->order_by('id','desc')->get_where('user',array('status'=>'active'))->result_array();
		
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
		$data["page_slug"] = "news";
		$data["page_class"] = "about";
		$data["main_content"] = "cms_pages/news";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
}