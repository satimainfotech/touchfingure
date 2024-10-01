<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Application_setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
	}
    
    /* Dashboard */
    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('application_setting')) {
				redirect(base_url() . 'admin');
			}
            $page_data['country_data'] = $this->db->get_where('country',array('country_status'=>'Active'))->result_array();
            $page_data['state_data'] = $this->db->get_where('state',array('state_status'=>'Active'))->result_array();
            $page_data['city_data'] = $this->db->get_where('city',array('city_status'=>'Active'))->result_array();
            $page_data['page_name'] = "application_setting/application_setting";
			$page_data['page_name_link'] = "application_setting";
			$page_data['table_info']  = $this->db->get_where('application_setting',array('show_setting'=>'yes'))->result_array();;
			$this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    
	/* Manage Email Template */
    function update_setting($para1 = "", $para2 = "")
    {
        if($para1 = "update"){
			$data['application_setting_value'] = $this->input->post('application_setting_value');
			$data['application_setting_type'] = $this->input->post('application_setting_type');
			$data['version'] = $this->input->post('version');
			$data['cms_content'] = $this->input->post('cms_content');
			$data['cms_page_link'] = $this->input->post('cms_page_link');
			
			if($para2 == '18'){
				$advertisement_image = $_FILES['advertisement_image']['name'];
				if($advertisement_image != ''){
					$length = 6;
					$characters = '01234567899876543210';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					$otp2 = $randomString;
					
					$ext = pathinfo($advertisement_image, PATHINFO_EXTENSION);
					
					$uploadedFile = $_FILES['advertisement_image']['tmp_name']; 
					$dirPath = "uploads/advertisement_image/";
					$newFileName = $otp2."_advertisement";
					
					if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
						$data['app_menu_title'] = $otp2.'_advertisement.'.$ext;
					}
				}
			}else{
				$data['app_menu_title'] = $this->input->post('app_menu_title');
			}
			
			
			
			$this->db->where('application_setting_id', $para2);
            $this->db->update('application_setting', $data);
		}
    }
}