<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class services extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('services_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('services')) {
				redirect(base_url() . 'admin');
			}
			
			$services = @$_GET['c_n'];
			$data['services'] = $services;
			
			if($services != ''){
				$searchurl='?c_n='.$services;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->services_model->get_total_services_data_count($services);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/services".$searchurl;
			$config['per_page'] = 20;
			$config['uri_segment'] = '3';
			$config['page_query_string']= TRUE;
			$config['query_string_segment'] = "page";
			$choice = $config["total_rows"] / $config["per_page"];
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
		 
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="firstpage page">';
			$config['first_tag_close'] = '</li>';
		 
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li class="lastpage page">';
			$config['last_tag_close'] = '</li>';
		 
			$config['next_link'] = '»';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
		 
			$config['prev_link'] = '«';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
		 
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
		 
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			if($this->input->get('page') != '')
			{
				$page = ($this->input->get('page'));
			}
			else
			{
				$page = 0;
			}
			
			$data['all_services'] = $this->services_model->get_total_services_data($services,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "services/services";
            $data['page_name_link'] = "services";
            $this->load->view('back/abdaily/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function services_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('services_add')) {
				redirect(base_url() . 'admin');
			}
			$services = @$_GET['c_n'];
			$page_data['services'] = $services;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "services/services_add";
            $page_data['page_name_link'] = "services";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function services_edit(){
		$services_id = @$_GET['c_i'];
		$services_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('services_edit')) {
				redirect(base_url() . 'admin');
			}
			$services = @$_GET['c_n'];
			$page_data['services'] = $services;
			
			$page_data['services_data'] = $this->services_model->get_services_details($services_id,$services_token);
			$page_data['services_id'] = $services_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "services/services_edit";
            $page_data['page_name_link'] = "services";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function services_view(){
		$services_id = @$_GET['c_i'];
		$services_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('services_view')) {
				redirect(base_url() . 'admin');
			}
			$services = @$_GET['c_n'];
			$page_data['services'] = $services;
			
			$page_data['services_data'] = $this->services_model->get_services_details($services_id,$services_token);
			$page_data['services_id'] = $services_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "services/services_view";
            $page_data['page_name_link'] = "services";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function services_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['services_token'] = $token;
		$data['services_name'] = $this->input->post('services_name');
		$data['services_description'] = $this->input->post('services_description');
		$data['services_status'] = 'Active';
		$data['services_position'] = 0;
		
		$services_image = $_FILES['services_image']['name'];
		if($services_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($services_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['services_image']['tmp_name']; 
			$dirPath = "uploads/abdaily_services_image/";
			$newFileName = $otp2."_services";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['services_image'] = $otp2.'_services.'.$ext;
			}
		}
		
		$services_inner_image = $_FILES['services_inner_image']['name'];
		if($services_inner_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($services_image, PATHINFO_EXTENSION);
			
			$serviceuploadedFile = $_FILES['services_inner_image']['tmp_name']; 
			$servicedirPath = "uploads/abdaily_services_inner_image/";
			$servicenewFileName = $otp2."_services";
			
			if(move_uploaded_file($serviceuploadedFile, $servicedirPath. $servicenewFileName. ".". $ext)){
				$data['services_inner_image'] = $otp2.'_services.'.$ext;
			}
		}
		$this->db->insert('services_master', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function services_update($para1 = '', $para2 = '', $para3 = ''){
		$data['services_name'] = $this->input->post('services_name');
		$data['services_position'] = $this->input->post('services_position');
		
		$services_image = $_FILES['services_image']['name'];
		if($services_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$services_images = @$this->db->get_where('services',array('services_id'=>$para1))->row()->services_image;
			if($services_images != ''){
				$rpersonal = "uploads/abdaily_services_image/".$services_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($services_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['services_image']['tmp_name']; 
			$dirPath = "uploads/abdaily_services_image/";
			$newFileName = $otp2."_services";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['services_image'] = $otp2.'_services.'.$ext;
			}
		}
		
		$services_inner_image = $_FILES['services_inner_image']['name'];
		if($services_inner_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($services_image, PATHINFO_EXTENSION);
			
			$serviceuploadedFile = $_FILES['services_inner_image']['tmp_name']; 
			$servicedirPath = "uploads/abdaily_services_inner_image/";
			$servicenewFileName = $otp2."_services";
			
			if(move_uploaded_file($serviceuploadedFile, $servicedirPath. $servicenewFileName. ".". $ext)){
				$data['services_inner_image'] = $otp2.'_services.'.$ext;
			}
		}
		
		$this->db->where('services_id', $para1);
		$this->db->update('services_master', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function servicess($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('services')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$services_images = @$this->db->get_where('services_master',array('services_id'=>$id))->row()->services_image;
			if($services_images != ''){
				$rpersonal = "uploads/abdaily_services_image/".$services_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['services_image'] = NULL;
			$data['services_status'] = 'delete';
            $this->db->where('services_id', $id);
			$this->db->update('services_master', $data);
			
        }else if ($para1 == 'status_set') {
            $services = $para2;
			if ($para3 == 'true') {
                $data['services_status'] = 'Active';
            } else {
                $data['services_status'] = 'De-active';
            }
            $this->db->where('services_id', $services);
            $this->db->update('services_master', $data);
        }
    }
	
	function update_services_position(){
		$position_value = $this->input->post('position_value');
		$services_id = $this->input->post('services_id');
		
		$data['services_position'] = $position_value;
		$this->db->where('services_id',$services_id);
		$this->db->update('services_master',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}