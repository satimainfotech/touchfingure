<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Our_network extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
	}

    public function index()
    {
		$image_url = base_url().'uploads/images/innerBanner.png';
		$oth_image_url = base_url().'uploads/images/thinklam.png';
		
		$data["get_our_networks"] = @$this->db->get_where('our_network', array('our_net_status' =>'Active'))->result_array();
		$data["page_names"] = 'Our Network';
		$data["header_image"] = $image_url;
		$data["oth_image_url"] = $oth_image_url;
		$data["page_title"] = "Our Network";
		$data["page_title_bottom_text"] = "";
		$data["system_name"] = 'Reddmica';
		$data["meta_description"] = '';
		$data["meta_keywords"] = '';
		$data["meta_author"] = 'Reddmica';
		$data["page_slug"] = "our_network";
		$data["page_class"] = "our_network";
		$data["main_content"] = "cms_pages/our_network";
		$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item active'>Our Network</li>";
		$data["form_msg"] = "";

		$this->load->view("common_file/product_inner_template",$data);
	}
	
}