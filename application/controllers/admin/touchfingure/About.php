<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class About extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('plan_model');
	}
    
	public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('about')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->plan_model->get_total_about_data_count();
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/about";
			$config['per_page'] = 30;
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
			
			$data['all_about'] = $this->plan_model->get_total_about_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "about/about";
            $data['page_name_link'] = "about";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('about_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			
			$data['page_name'] = "about/about_add";
			$data['page_name_link'] = "about";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function do_add(){
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		$data['about_token'] = $token;
		$data['about_title'] = $this->input->post('about_title');
		$data['about_status'] = "Active";
		$about_image = $_FILES['about_image']['name'];
		if($about_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($about_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['about_image']['tmp_name']; 
			$dirPath = "uploads/about_image/";
			$newFileName = $otp2."_chart";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['about_image'] = $otp2.'_chart.'.$ext;
			}
		}
		
		$this->db->insert('about', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$about_id = @$_GET['p_i'];
			$about_token = @$_GET['p_t'];
			if (!$this->crud_model->admin_permission('about_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['about_data'] = $this->db->get_where('about', array('about_id' => $about_id,'about_token'=>$about_token))->result_array();
			$data['page_name'] = "about/about_edit";
            $data['page_name_link'] = "about";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$about_id = @$_GET['p_i'];
			$about_token = @$_GET['p_t'];
			if (!$this->crud_model->admin_permission('about_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['about_data'] = $this->plan_model->get_about_information($about_id,$about_token);
			$data['page_name'] = "about/about_view";
            $data['page_name_link'] = "about";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function update($para1 = '', $para2 = '', $para3 = ''){
		$data['about_title'] = $this->input->post('about_title');
		$about_image = $_FILES['about_image']['name'];
		if($about_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($about_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['about_image']['tmp_name']; 
			$dirPath = "uploads/about_image/";
			$newFileName = $otp2."_chart";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['about_image'] = $otp2.'_chart.'.$ext;
			}
		}
		
		$this->db->where('about_id', $para1);
		$this->db->update('about', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
		
	}
	
	function abouts($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('users')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$about_id = $this->input->post('id');
			
			$check_account = @$this->db->get_where('about',array('about_id'=>$about_id))->result_array();
			if($check_account[0]['about_image'] != ''){
				$rpersonal = "uploads/about_image/".$check_account[0]['about_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
            $this->db->where('about_id',$about_id);
			$data['about_status'] = 'delete';
			$this->db->where('about_id', $about_id);
            $this->db->update('about',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $plan_charts = $para2;
			if ($para3 == 'true') {
                $data['about_status'] = 'Active';
            } else {
                $data['about_status'] = 'De-active';
            }
            $this->db->where('about_id', $plan_charts);
            $this->db->update('about', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
        }
    }
}