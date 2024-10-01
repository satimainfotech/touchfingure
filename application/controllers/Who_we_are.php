<?php
	if ( ! defined("BASEPATH")) exit("No direct script access allowed");
	class Who_we_are extends CI_Controller
	{ 
		function __construct()
		{
			parent::__construct();
			$this->load->model('manage_website_model');
		}
		public function index()
		{
			$image_url = base_url().'uploads/images/innerBanner.png';
			$oth_image_url = base_url().'uploads/images/thinklam.png';
			
			$data['who_we_are_data'] = $this->db->get_where('who_we_are',array('who_we_are_id'=>'1'))->result_array();
			$who_we_are_data = $data['who_we_are_data'];
			$technolgy_show = $who_we_are_data[0]['our_technolgy_item_show'];
			$data['our_technology'] = $this->db->limit($technolgy_show)->order_by('position','asc')->get_where('our_technology',array('our_technology_status'=>'yes'))->result_array();
			$data["page_names"] = $who_we_are_data[0]['page_main_title'];
			$data["header_image"] = $image_url;
			$data["oth_image_url"] = $oth_image_url;
			$data["page_small_title"] = $who_we_are_data[0]['page_small_title'];
			$data["page_title"] = $who_we_are_data[0]['page_main_title'];
			$data["page_title_bottom_text"] = "";
			$data["system_name"] = 'Reddmica';
			$data["meta_description"] = '';
			$data["meta_keywords"] = '';
			$data["meta_author"] = 'Reddmica';
			$data["page_slug"] = "who_we_are";
			$data["page_class"] = "who_we_are";
			$data["main_content"] = "cms_pages/who_we_are";
			$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item active'>Who we are</li>";
			$data["form_msg"] = "";
			$this->load->view("common_file/template",$data);
		}
	}
?>