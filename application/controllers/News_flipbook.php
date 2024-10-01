<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_flipbook extends CI_Controller
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
			$data['social_media_data'] = $this->db->get_where('web_social_media',array('status'=>'Active'))->result_array();
			$contactus_data = $data['contactus_data'];
			$data["page_names"] = $contactus_data[0]['page_main_title'];
			$data["header_image"] = $image_url;
			$data["oth_image_url"] = $oth_image_url;
			$data["page_small_title"] = $contactus_data[0]['page_small_title'];
			$data["page_title"] = $contactus_data[0]['page_main_title'];
			$data["page_title_bottom_text"] = "";
			$data["system_name"] = 'Urban Vivaah';
			$data["meta_description"] = '';
			$data["meta_keywords"] = '';
			$data["meta_author"] = 'Urban Vivaah';
			$data["page_slug"] = "contact";
			$data["page_class"] = "Urban Vivaah";
			$data["main_content"] = "cms_pages/news_flipbook";
			$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item active'>News</li>";
			$data["form_msg"] = "";
			$this->load->view("common_file/template",$data);
	}
	
	public function distributors()
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
			$data["system_name"] = 'Urban Vivaah';
			$data["meta_description"] = '';
			$data["meta_keywords"] = '';
			$data["meta_author"] = 'Urban Vivaah';
			$data["page_slug"] = "contactus";
			$data["page_class"] = "Urban Vivaah";
			$data["main_content"] = "cms_pages/Distributors";
			$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item active'>Contact Us</li>";
			$data["form_msg"] = "";
			$this->load->view("common_file/template",$data);
	}
	
	public function submit_enquiry(){
		$length1= 25;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$city = $this->input->post('city');
		$subject = $this->input->post('subject');
		$comment = $this->input->post('message');
		
		$data['contact_enquire_token'] = $token;
		$data['contact_enquire_name'] = $name;
		$data['contact_enquire_email'] = $email;
		$data['contact_enquire_phone'] = $phone;
		$data['contact_enquire_city'] = $city;
		$data['contact_enquire_subject'] = $subject;
		$data['contact_enquire_message'] = $comment;
		$data['contact_enquire_created_date'] = time();
		$data['contact_enquire_status'] = 'Active';
		$this->db->insert('contact_us_data', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			//$this->product_model->send_email($data);
			echo 'done';
		}
		
	}
	
}