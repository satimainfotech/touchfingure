<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faqs extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

    public function index()
    {
		$data['home_page_data'] = $this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
		$data['faqs_data'] = $this->db->order_by('position','asc')->get_where('faq',array('faq_status'=>'yes'))->result_array();
		
		$data["page_names"] = $content_data[0]['page_title'];
		$data["header_image"] = $content_data[0]['header_image'];
		$data["page_title"] = $content_data[0]['page_title'];
		$data["page_title_bottom_text"] = $content_data[0]['page_title_bottom_text'];
		$data["system_name"] = 'Reddmica';
		$data["meta_description"] = 'Reddmica is fantasy app. Play fantasy cricket sports on Reddmica. Select a match and create your team now!';
		$data["meta_keywords"] = 'Reddmica Fantasy, Fantasy Sports, Sports Leagues';
		$data["meta_author"] = 'Reddmica';
		$data["page_slug"] = "faqs";
		$data["page_class"] = "FAQ";
		$data["main_content"] = "cms_pages/faq";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
}