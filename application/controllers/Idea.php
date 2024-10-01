<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Idea extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

   public function index()
    {
		
		$data['sub_category_data'] = $this->db->order_by('sub_category_position','asc')->get_where('sub_category',array('sub_category_status'=>'Active'))->result_array();
		$data['category_data'] = $this->db->order_by('category_position','asc')->get_where('category',array('category_status'=>'Active'))->result_array();
		$data['social_media_data'] = $this->db->get_where('web_social_media',array('status'=>'Active'))->result_array();
		$data["page_names"] = @$content_data[0]['page_title'];
		$data["header_image"] = @$content_data[0]['header_image'];
		$data["page_title"] = @$content_data[0]['page_title'];
		$data["page_title_bottom_text"] = @$content_data[0]['page_title_bottom_text'];
		//$data['achievement'] = $this->db->order_by('position','asc')->get_where('achievement',array('status'=>'Active'))->result_array();
		$data["system_name"] = 'Convart';
		$data["meta_description"] = '';
		$data["meta_keywords"] = '';
		$data["meta_author"] = 'Gallery';
		$data["page_slug"] = "gallery";
		$data["page_class"] = "Gallery";
		$data["main_content"] = "cms_pages/idea";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
}