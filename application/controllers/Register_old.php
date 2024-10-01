<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller
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
		$data["member_type_data"] = get_member_type();
		$data["country_data"] = get_all_country();
		
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
		$data["page_slug"] = "register";
		$data["page_class"] = "register";
		$data["main_content"] = "cms_pages/register";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
		function register_added($para1 = '', $para2 = '', $para3 = ''){
		
		
		
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$length = 6;
		$characters = '01234567899876543210';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$otp2 = $randomString;
		
		
		$data['user_token'] = $token;
		$data['member_type_id'] = $this->input->post('member_type_id');
		$data['member_type_name'] = get_field_id_name('member_type','member_type_id','member_type_name',$this->input->post('member_type_id'));	
		$data['gender'] = $this->input->post('gender');
		$data['police_station_name'] = $this->input->post('police_station_name');
						
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile');
		$data['password'] = $this->input->post('password');
		$data['address'] = $this->input->post('address');
		$data['adharcard'] = $this->input->post('adharcard');
		$data['pancard'] = $this->input->post('pancard');
		
		$profile_main_images = $_FILES['profile_main_images']['name'];
		if($profile_main_images != ''){
			$profileext = pathinfo($profile_main_images, PATHINFO_EXTENSION);
			
			$profileuploadedFile = $_FILES['profile_main_images']['tmp_name']; 
			$profiledirPath = "uploads/abdaily_profile_images/";
			$profilenewFileName = $otp2."_profile_main_images";
			
			if (!file_exists($profiledirPath)) {
			mkdir($profiledirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($profiledirPath, 0777);
			
			if(move_uploaded_file($profileuploadedFile, $profiledirPath. $profilenewFileName. ".". $profileext)){
				$data['profile_image'] = $otp2.'_profile_main_images.'.$profileext;
			}
			
		}
			
		$adharcard_main_images = $_FILES['adharcard_main_images']['name'];
		if($adharcard_main_images != ''){
			$adharcardext = pathinfo($adharcard_main_images, PATHINFO_EXTENSION);
			
			$adharuploadedFile = $_FILES['adharcard_main_images']['tmp_name']; 
			$adhardirPath = "uploads/abdaily_adharcard_images/";
			$adharnewFileName = $otp2."_adharcard_main_images";
			if (!file_exists($adhardirPath)) {
			mkdir($adhardirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($adhardirPath, 0777);
			
			if(move_uploaded_file($adharuploadedFile, $adhardirPath. $adharnewFileName. ".". $adharcardext)){
				$data['adharcard_image'] = $otp2.'_adharcard_main_images.'.$adharcardext;
			}
		}
		$pancard_main_images = $_FILES['pancard_main_images']['name'];
		if($pancard_main_images != ''){
			$pancardext = pathinfo($pancard_main_images, PATHINFO_EXTENSION);
			
			$pancarduploadedFile = $_FILES['pancard_main_images']['tmp_name']; 
			$pancarddirPath = "uploads/abdaily_pancard_images/";
			$pancardnewFileName = $otp2."_pancard_main_images";
			if (!file_exists($pancarddirPath)) {
			mkdir($pancarddirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($pancarddirPath, 0777);
			
			
			if(move_uploaded_file($pancarduploadedFile, $pancarddirPath. $pancardnewFileName. ".". $pancardext)){
				$data['pancard_image'] = $otp2.'_pancard_main_images.'.$pancardext;
			}
		}
		
		
		$data['status'] = 'deactive';
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['country'] = $this->input->post('country');
		$data['state'] = $this->input->post('state');
		$data['division'] = $this->input->post('division');
		$data['district'] = $this->input->post('district');
		$data['taluka'] = $this->input->post('taluka');
		$data['gram_panchayat'] = $this->input->post('gram_panchayat');
		$this->db->insert('user', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('message', 'Mobile and Password Not Correct .');
			redirect(base_url('register'), 'refresh');
		} else {
			$this->session->set_flashdata('message', 'Thank you for registering. Please wait for approval from the admin !!!');
			redirect(base_url('register'), 'refresh');
			}
	}
	
	public function get_state(){
		$country = $this->input->post('country');
		$state_data = $this->db->get_where('state',array('country_id'=>$country))->result_array();
		$html = '<option value="0" >Select State</option>';
		foreach($state_data as $state_row){
			$state_id = $state_row['state_id'];
			$state_name = $state_row['state_name'];
			$html .= "<option value='$state_id' selected >$state_name</option>";
		}	
		echo $html;
	}
	
	public function get_division(){
		$state = $this->input->post('state');
		$division_data = $this->db->get_where('division',array('state_id'=>$state))->result_array();
		$html = '';
		foreach($division_data as $division_row){
			$division_id = $division_row['division_id'];
			$division_name = $division_row['division_name'];
			$html .= "<option value='$division_id' >$division_name</option>";
		}	
		echo $html;
	}
	public function get_district(){
		$division = $this->input->post('division');
		$district_data = $this->db->get_where('district',array('division_id'=>$division))->result_array();
		$html = '';
		foreach($district_data as $district_row){
			$district_id = $district_row['district_id'];
			$district_name = $district_row['district_name'];
			$html .= "<option value='$district_id' >$district_name</option>";
		}	
		echo $html;
	}
	public function get_district_m(){
		$division = $this->input->post('division');
		$district_data = $this->db->get_where('district_m',array('division_id'=>$division))->result_array();
		$html = '';
		foreach($district_data as $district_row){
			$district_id = $district_row['district_m_id'];
			$district_name = $district_row['district_m_name'];
			$html .= "<option value='$district_id' >$district_name</option>";
		}	
		echo $html;
	}
	
	
	
	public function get_taluka(){
		$district = $this->input->post('district');
		$taluka_data = $this->db->get_where('taluka',array('district_id'=>$district))->result_array();
		$html = '';
		foreach($taluka_data as $taluka_row){
			$taluka_id = $taluka_row['taluka_id'];
			$taluka_name = $taluka_row['taluka_name'];
			$html .= "<option value='$taluka_id' >$taluka_name</option>";
		}	
		echo $html;
	}
	public function get_taluka_m(){
		$district = $this->input->post('district_m');
		$taluka_data = $this->db->get_where('taluka_m',array('district_id'=>$district,'taluka_m_status'=>'active'))->result_array();
		$html = '';
		foreach($taluka_data as $taluka_row){
			$taluka_id = $taluka_row['taluka_m_id'];
			$taluka_name = $taluka_row['taluka_m_name'];
			$html .= "<option value='$taluka_id' >$taluka_name</option>";
		}	
		echo $html;
	}
	public function get_gram_panchayat(){
		$taluka = $this->input->post('taluka');
		$gram_panchayat_data = $this->db->get_where('gram_panchayat',array('taluka_id'=>$taluka))->result_array();
		$html = '';
		foreach($gram_panchayat_data as $gram_panchayat_row){
			$gram_panchayat_id = $gram_panchayat_row['gram_panchayat_id'];
			$gram_panchayat_name = $gram_panchayat_row['gram_panchayat_name'];
			$html .= "<option value='$gram_panchayat_id' >$gram_panchayat_name</option>";
		}	
		echo $html;
	}
	
	
	
}