<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TermsCondition extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

    public function index()
    {
		$data['content_data'] = $this->db->get_where('termandcondition',array('termandcondition_id'=>'1'))->row()->content;
		$content_data = $this->db->get_where('termandcondition',array('termandcondition_id'=>'1'))->result_array();
		$data["page_names"] = $content_data[0]['page_title'];
		$data["header_image"] = $content_data[0]['header_image'];
		$data["page_title"] = $content_data[0]['page_title'];
		$data["page_title_bottom_text"] = $content_data[0]['page_title_bottom_text'];
		$data["system_name"] = 'Reddmica';
		$data["meta_description"] = 'Reddmica is fantasy app. Play fantasy cricket sports on Reddmica. Select a match and create your team now!';
		$data["meta_keywords"] = 'Reddmica Fantasy, Fantasy Sports, Sports Leagues';
		$data["meta_author"] = 'Reddmica';
		$data["page_slug"] = "Term and Condition";
		$data["page_class"] = "Term and Condition";
		$data["main_content"] = "cms_pages/termandcondition";
		$data["form_msg"] = "";
		$this->load->view("common_file/inner_template",$data);
	}
	
}