<?php

	if ( ! defined("BASEPATH")) exit("No direct script access allowed");
	class Homepage extends CI_Controller
	{ 
		function __construct()
		{
			parent::__construct();
			$this->load->model('manage_website_model');
		}
		public function index()
		{
			$get_time =  time();
			$data['home_page_data'] = $this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
			$data['social_media_data'] = $this->db->get_where('web_social_media',array('status'=>'Active'))->result_array();
			$data['category_data'] = $this->db->order_by('category_position','asc')->get_where('category',array('category_status'=>'Active'))->result_array();
			$data['brand_data'] = $this->db->order_by('brand_position','asc')->get_where('brand',array('brand_status'=>'Active'))->result_array();
			$data['sub_category_data'] = $this->db->order_by('sub_category_position','asc')->get_where('sub_category',array('sub_category_status'=>'Active'))->result_array();
			$data['testominal_data'] = $this->db->order_by('testimonials_position','asc')->get_where('testimonials',array('testimonials_status'=>'Active'))->result_array();
			$this->db->order_by('event_id', 'desc'); // Replace 'your_date_column' with the actual column you want to use for ordering
			$this->db->limit(4);
			$event_data = $this->db->get_where('event', array('status' => 'Active'))->result_array();
			foreach($event_data as $event_row)
			{
				$event_rows[$event_row['start_date']][] = $event_row;
			}
			$data['event_data'] = $event_rows;
			
			$this->db->where('status', 'Active');
			$this->db->where('start_date >', date('Y-m-d')); // Filter events with a start date greater than the current date
			$this->db->order_by('start_date', 'ASC'); // Order events by start date in ascending order
			$this->db->limit(1);
			$data['event_register_data'] = $this->db->get('event')->result_array();
			
			$data['services_data'] = $this->db->order_by('services_position','asc')->get_where('services_master',array('services_status'=>'Active'))->result_array();
			
			$today_date = date("Y-m-d");
			$data['user_data'] = $this->db->get_where('user',array('birth_date'=>$today_date))->result_array();

					
			$home_page_data = $data['home_page_data'];
			$our_range_show = $home_page_data[0]['our_brand_show_item'];
			$technolgy_show = $home_page_data[0]['our_technolgy_show_item'];
			$data['slider_data'] = $this->db->order_by('position','asc')->get_where('sliders',array('slider_status'=>'yes'))->result_array();
			$data['second_slider_data'] = $this->db->order_by('position','asc')->get_where('second_sliders',array('second_slider_status'=>'yes'))->result_array();
			$data['our_range'] = $this->manage_website_model->get_our_range($our_range_show);
			$data['our_technology'] = $this->db->limit($technolgy_show)->order_by('position','asc')->get_where('our_technology',array('our_technology_status'=>'yes'))->result_array();
			
			
			$data["header_image"] = '';
			$data["page_title"] = 'Convart';
			$data["system_name"] = 'Convart';
			$data["meta_description"] = '';
			$data["meta_keywords"] = '';
			$data["meta_author"] = 'Convart';
			$data["action_name"] = "normal";
			$data["page_slug"] = "home";
			$data["main_content"] = "cms_pages/home_page";
			$this->load->view("common_file/template",$data);
		}
		public function price_calculate()
		{
			$category = $this->input->post('category');
			$height_feet = $this->input->post('height_feet');
			$height_inch = $this->input->post('height_inch');
			$width_feet = $this->input->post('width_feet');
			$width_inch = $this->input->post('width_inch');
			
			if($category == 1)
			{
				$price_master = $this->db->get_where('price_master',array('price_master_category'=>'1'))->row();
				
				if($width_feet>7 && $width_inch >= 0 )
				{
					$width_inch = $width_inch/10;
					$price = $price_master->price;
					$price_extra = $price_master->extra_price*($width_feet-10);					
					$price_extra_inch = $price_master->extra_price*$width_inch;					
					echo $total_price = $price+$price_extra+$price_extra_inch;
				}
				
			}
			else
				{
					$price_master = $this->db->get_where('price_master',array('price_master_category'=>'2'))->row();
					$width_inch = $width_inch/10;
					$price = $price_master->price;
					
					$price_extra = $price_master->extra_price*($width_feet-10);					
					$price_extra_inch = $price_master->extra_price*$width_inch;	

					$design_price=$price_master->design_price;	
					
					$design_pric_extra=$price_master->extra_design_price*($width_feet-10);	
					
					$design_extra_inch = $price_master->extra_design_price*$width_inch;					
					$total_price = $price+$price_extra+$price_extra_inch;
					echo $total_price +=$design_price+$design_pric_extra+$design_extra_inch;
					
				}
			
		}
		
		public function submit_contact_enquiry(){
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
			$message = $this->input->post('message');
			
			$data['contact_enquire_token'] = $token;
			$data['contact_enquire_name'] = $name;
			$data['contact_enquire_city'] = $city;
			$data['contact_enquire_email'] = $email;
			$data['contact_enquire_phone'] = $phone;
			$data['contact_enquire_message'] = $message;
			$data['contact_enquire_created_date'] = time();
			$data['contact_enquire_status'] = 'Active';
			$this->db->insert('contact_us_data', $data);
			
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo 'not_done';
			} else {
				echo 'done';
			}
		}
		public function create_order()
		{			
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name'] = $this->input->post('last_name');
			$data['wall_name'] = $this->input->post('wall_name');
			$data['phone_number'] = $this->input->post('phone_number');
			$data['height_foot'] = $this->input->post('height_foot');
			$data['height_inch'] = $this->input->post('height_inch');
			$data['width_feet'] = $this->input->post('width_feet');
			$data['width_inch'] = $this->input->post('width_inch');
			$data['category'] = $this->input->post('category');
			$data['total'] = $this->input->post('final_price_convart');
			$data['gst'] = $this->input->post('final_price_convart')*18/100;
			$data['grand_total'] = $data['total']+$data['gst'];
			
			if(isset($_POST['theme']))
			{
				$data['theme'] = str_replace('#', '', $this->input->post('theme'));
			}
			else
			{
				$data['theme'] = 0;
			}
			
		
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			if (isset($_FILES['upload-file'])) 
			{
				$event_main_images = $_FILES['upload-file']['name'];
				if($event_main_images != '')
				{
					$ext = pathinfo($event_main_images, PATHINFO_EXTENSION);

					$uploadedFile = $_FILES['upload-file']['tmp_name']; 
					$dirPath = "uploads/convart_image/";
					$newFileName = $otp2."_p_main_image";

					if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext))
					{
						$data['convart_image'] = $otp2.'_p_main_image.'.$ext;
					}
				}
			}
		
		$data['created_date'] = date('Y-m-d');
		$this->db->insert('order_master', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
			
		}
	}
?>