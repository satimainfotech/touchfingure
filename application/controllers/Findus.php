<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Findus extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

    public function index()
    {
		$image_url = base_url().'uploads/images/innerBanner.png';
			$oth_image_url = base_url().'uploads/images/thinklam.png';
			
			$data['contactus_data'] = $this->db->get_where('contactus',array('contactus_id'=>'1'))->result_array();
			$contactus_data = $data['contactus_data'];
			$data["page_names"] = $contactus_data[0]['page_main_title'];
			$data["header_image"] = $image_url;
			$data["oth_image_url"] = $oth_image_url;
			$data["page_small_title"] = $contactus_data[0]['page_small_title'];
			$data["page_title"] = $contactus_data[0]['page_main_title'];
			$data["page_title_bottom_text"] = "";
			$data["system_name"] = 'Convart';
			$data["meta_description"] = '';
			$data["meta_keywords"] = '';
			$data["meta_author"] = 'Convart';
			$data["page_slug"] = "Find us";
			$data["page_class"] = "Find us";
			$data["main_content"] = "cms_pages/findus";
			$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item active'>Find Us</li>";
			$data["form_msg"] = "";
			$this->load->view("common_file/template",$data);
	}	
}