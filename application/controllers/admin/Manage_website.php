<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Manage_website extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('manage_website_model');
		
		$this->admin_id = $this->session->userdata('admin_id');
	}
  
	public function social_media()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('social_media')) {
				redirect(base_url() . 'admin');
			}
			$count_data = $this->manage_website_model->get_total_social_media_data_count();
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/manage_website/social_media";
			$config['per_page'] = 10;
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
			
			$data['all_social_media'] = $this->manage_website_model->get_total_social_media_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "manage_website/social_media/social_media";
            $data['page_name_link'] = "web_social_media";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function social_media_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('social_media_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			
			$data['page_name'] = "manage_website/social_media/social_media_add";
			$data['page_name_link'] = "web_social_media";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function social_media_do_add(){
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['name'] = $this->input->post('name');
		$data['w_s_token'] = $token;
		$data['link'] = $this->input->post('link');
		$data['status'] = 'Active';
		
		$social_icon = $_FILES['social_icon']['name'];
		if($social_icon != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($social_icon, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['social_icon']['tmp_name']; 
			$dirPath = "uploads/web_social_icon/";
			$newFileName = $otp2."_icon";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['icon'] = $otp2.'_icon.'.$ext;
			}
		}
		$this->db->insert('web_social_media', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
		
	}
	
	public function social_media_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$w_s_id = @$_GET['s_i'];
			$w_s_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('social_media_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['social_media_data'] = $this->db->get_where('web_social_media', array('w_s_id' => $w_s_id,'w_s_token'=>$w_s_token))->result_array();
			$data['page_name'] = "manage_website/social_media/social_media_edit";
            $data['page_name_link'] = "web_social_media";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function social_media_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$w_s_id = @$_GET['s_i'];
			$w_s_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('social_media_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['social_media_data'] = $this->manage_website_model->get_social_media_information($w_s_id,$w_s_token);
			$data['page_name'] = "manage_website/social_media/social_media_view";
            $data['page_name_link'] = "web_social_media";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function social_media_update($para1 = '', $para2 = '', $para3 = ''){
		$data['name'] = $this->input->post('name');
		$data['link'] = $this->input->post('link');
		
		$social_icon = $_FILES['social_icon']['name'];
		if($social_icon != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('web_social_media',array('w_s_id'=>$para1))->result_array();
			if($check_account[0]['icon'] != ''){
				$rpersonal = "uploads/web_social_icon/".$check_account[0]['icon'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($social_icon, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['social_icon']['tmp_name']; 
			$dirPath = "uploads/web_social_icon/";
			$newFileName = $otp2."_icon";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['icon'] = $otp2.'_icon.'.$ext;
			}
		}
		
		$this->db->where('w_s_id', $para1);
		$this->db->update('web_social_media', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function social_medias($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('social_media')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$w_s_id = $this->input->post('id');
            $this->db->where('w_s_id',$w_s_id);
            
			$data['status'] = 'delete';
			$this->db->where('w_s_id', $w_s_id);
            $this->db->update('web_social_media',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $social_media = $para2;
			if ($para3 == 'true') {
                $data['status'] = 'Active';
            } else {
                $data['status'] = 'De-active';
            }
            $this->db->where('w_s_id', $social_media);
            $this->db->update('web_social_media', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
        }
    }
	
	
	public function sliders()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('sliders')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->manage_website_model->get_sliders_data_count();
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/manage_website/sliders";
			$config['per_page'] = 10;
			$config['uri_segment'] = '3';
			$config['page_query_string']= TRUE;
			$config['query_string_segment'] = "page";
			$choice = $config["total_rows"] / $config["per_page"];
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
		 
			$config['first_link'] = 'First';
			$config['firsf_tag_open'] = '<li class="firstpage page">';
			$config['firsf_tag_close'] = '</li>';
		 
			$config['last_link'] = 'Last';
			$config['lasf_tag_open'] = '<li class="lastpage page">';
			$config['lasf_tag_close'] = '</li>';
		 
			$config['next_link'] = '»';
			$config['nexf_tag_open'] = '<li class="next page">';
			$config['nexf_tag_close'] = '</li>';
		 
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
			
			$data['all_sliders'] = $this->manage_website_model->get_sliders_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "manage_website/sliders/sliders";
            $data['page_name_link'] = "sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function sliders_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('sliders_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_name'] = "manage_website/sliders/sliders_add";
            $data['page_name_link'] = "sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function sliders_do_add(){
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['text_one'] = $this->input->post('text_one');
		$data['slider_token'] = $token;
		$data['text_tow'] = $this->input->post('text_tow');
		//$data['content'] = $this->input->post('content');
		//$data['button_show_hide'] = $this->input->post('button_show_hide');
		//$data['button_text'] = $this->input->post('button_text');
		//$data['button_link'] = $this->input->post('button_link');
		
		//$data['text_one_text_align'] = $this->input->post('text_one_text_align');
		//$data['text_one_font_size'] = $this->input->post('text_one_font_size');
		//$data['text_one_min_360px'] = $this->input->post('text_one_min_360px');
		//$data['text_one_min_767px'] = $this->input->post('text_one_min_767px');
		//$data['text_one_min_992px'] = $this->input->post('text_one_min_992px');
		//$data['text_one_color'] = $this->input->post('text_one_color');
		//$data['text_two_text_align'] = $this->input->post('text_two_text_align');
		//$data['text_two_font_size'] = $this->input->post('text_two_font_size');
		//$data['text_two_min_360px'] = $this->input->post('text_two_min_360px');
		//$data['text_two_min_767px'] = $this->input->post('text_two_min_767px');
		//$data['text_two_min_992px'] = $this->input->post('text_two_min_992px');
		//$data['text_two_color'] = $this->input->post('text_two_color');
		//$data['content_text_align'] = $this->input->post('content_text_align');
		//$data['content_font_size'] = $this->input->post('content_font_size');
		//$data['content_min_360px'] = $this->input->post('content_min_360px');
		//$data['content_min_767px'] = $this->input->post('content_min_767px');
		//$data['content_min_992px'] = $this->input->post('content_min_992px');
		//$data['button_text_align'] = $this->input->post('button_text_align');
		//$data['content_color'] = $this->input->post('content_color');
		$data['slider_status'] = 'yes';
		$slider_image = $_FILES['slider_image']['name'];
		if($slider_image != '' && $slider_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($slider_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['slider_image']['tmp_name']; 
			$dirPath = "uploads/slider_image/";
			$newFileName = $otp2."_slider.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['slider_image'] = $otp2.'_slider.'.$ext;
			}
		}
		
		$this->db->insert('sliders', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
    public function sliders_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$slider_id = @$_GET['s_i'];
			$slider_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('sliders_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['sliders_data'] = $this->db->get_where('sliders', array('slider_id' => $slider_id,'slider_token' => $slider_token))->result_array();
			$data['page_name'] = "manage_website/sliders/sliders_view";
            $data['page_name_link'] = "sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	
	
	public function sliders_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$slider_id = @$_GET['s_i'];
			$slider_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('sliders_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['sliders_data'] = $this->db->get_where('sliders', array('slider_id' => $slider_id,'slider_token'=>$slider_token))->result_array();
			$data['page_name'] = "manage_website/sliders/sliders_edit";
            $data['page_name_link'] = "sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function sliders_update($para1 = '', $para2 = '', $para3 = ''){
		$data['text_one'] = $this->input->post('text_one');
		$data['text_tow'] = $this->input->post('text_tow');
		//$data['content'] = $this->input->post('content');
		//$data['button_show_hide'] = $this->input->post('button_show_hide');
		//$data['button_text'] = $this->input->post('button_text');
		//$data['button_link'] = $this->input->post('button_link');
		
		//$data['text_one_text_align'] = $this->input->post('text_one_text_align');
		//$data['text_one_font_size'] = $this->input->post('text_one_font_size');
		//$data['text_one_min_360px'] = $this->input->post('text_one_min_360px');
		//$data['text_one_min_767px'] = $this->input->post('text_one_min_767px');
		//$data['text_one_min_992px'] = $this->input->post('text_one_min_992px');
		//$data['text_one_color'] = $this->input->post('text_one_color');
		//$data['text_two_text_align'] = $this->input->post('text_two_text_align');
		//$data['text_two_font_size'] = $this->input->post('text_two_font_size');
		//$data['text_two_min_360px'] = $this->input->post('text_two_min_360px');
		//$data['text_two_min_767px'] = $this->input->post('text_two_min_767px');
		//$data['text_two_min_992px'] = $this->input->post('text_two_min_992px');
		//$data['text_two_color'] = $this->input->post('text_two_color');
		//$data['content_text_align'] = $this->input->post('content_text_align');
		//$data['content_font_size'] = $this->input->post('content_font_size');
		//$data['content_min_360px'] = $this->input->post('content_min_360px');
		//$data['content_min_767px'] = $this->input->post('content_min_767px');
		//$data['content_min_992px'] = $this->input->post('content_min_992px');
		//$data['button_text_align'] = $this->input->post('button_text_align');
		//$data['content_color'] = $this->input->post('content_color');
		
		$slider_image = $_FILES['slider_image']['name'];
		if($slider_image != '' && $slider_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$main_product_image = @$this->db->get_where('sliders',array('slider_id'=>$para1))->row()->slider_image;
			if($main_product_image != ''){
				$rpersonal = "uploads/slider_image/".$main_product_image;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($slider_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['slider_image']['tmp_name']; 
			$dirPath = "uploads/slider_image/";
			$newFileName = $otp2."_slider.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['slider_image'] = $otp2.'_slider.'.$ext;
			}
		}
		
		$this->db->where('slider_id', $para1);
		$this->db->update('sliders', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function sliderss($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('sliders')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$id = $this->input->post('id');
			$get_old_image_name = @$this->db->get_where('sliders',array('slider_id'=>$id))->row()->slider_image;
			$data['slider_status'] = 'delete';
            $this->db->where('slider_id',$id);
            $this->db->update('sliders',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				if($get_old_image_name != ''){
					$rpersonal = "uploads/slider_image/".$get_old_image_name;
					unlink($rpersonal);
				}
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $team = $para2;
			if ($para3 == 'true') {
                $data['slider_status'] = 'yes';
            } else {
                $data['slider_status'] = 'no';
            }
            $this->db->where('slider_id', $team);
            $this->db->update('sliders', $data);
        }
    }
	
/* MANAGE testimonials */
	public function testimonials()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('testimonials')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->manage_website_model->get_testimonials_data_count();
			
			$config = array();		
			$config['total_rows'] = $count_data;
			$config['base_url'] = base_url() . "admin/manage_website/testimonials";
			$config['per_page'] = 10;
			$config['uri_segment'] = '3';
			$config['page_query_string']= TRUE;
			$config['query_string_segment'] = "page";
			$choice = $config["total_rows"] / $config["per_page"];
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
		 
			$config['first_link'] = 'First';
			$config['firsf_tag_open'] = '<li class="firstpage page">';
			$config['firsf_tag_close'] = '</li>';
		 
			$config['last_link'] = 'Last';
			$config['lasf_tag_open'] = '<li class="lastpage page">';
			$config['lasf_tag_close'] = '</li>';
		 
			$config['next_link'] = '»';
			$config['nexf_tag_open'] = '<li class="next page">';
			$config['nexf_tag_close'] = '</li>';
		 
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
			
			$data['all_testimonials'] = $this->manage_website_model->get_testimonials_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "manage_website/testimonials/testimonials";
            $data['page_name_link'] = "testimonials";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
    public function testimonials_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$testimonials_id = @$_GET['b_i'];
			$testimonials_token = @$_GET['b_t'];
			if (!$this->crud_model->admin_permission('testimonials_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['testimonials_data'] = $this->db->get_where('testimonials', array('testimonials_id' => $testimonials_id,'testimonials_token' => $testimonials_token))->result_array();
			$data['page_name'] = "manage_website/testimonials/testimonials_view";
            $data['page_name_link'] = "testimonials";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
    /*User Management */
    function testimonialss($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('testimonials')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$id = $this->input->post('id');
			$get_old_image_name = @$this->db->get_where('testimonials',array('testimonials_id'=>$id))->row()->testimonials_image;
			$data['testimonials_status'] = 'delete';
            $this->db->where('testimonials_id',$id);
            $this->db->update('testimonials',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				if($get_old_image_name != ''){
					$rpersonal = "uploads/testimonials_image/".$get_old_image_name;
					unlink($rpersonal);
				}
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $testimonials = $para2;
			if ($para3 == 'true') {
                $data['testimonials_status'] = 'Active';
            } else {
                $data['testimonials_status'] = 'De-active';
            }
            $this->db->where('testimonials_id', $testimonials);
            $this->db->update('testimonials', $data);
        }
    }
	
	public function testimonials_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('testimonials_add')) {
				redirect(base_url() . 'admin');
			}
			$data['page_name'] = "manage_website/testimonials/testimonials_add";
            $data['page_name_link'] = "testimonials";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function testimonials_do_add(){
		$length1= 200;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['testimonials_token'] = $token;
		$data['testimonials_name'] = $this->input->post('testimonials_name');
		$data['testimonials_desicription'] = $this->input->post('testimonials_desicription');
		$data['designation'] = $this->input->post('designation');
		$data['testimonials_rate'] = $this->input->post('testimonials_rate');
		$data['testimonials_status'] = 'Active';
		$data['testimonials_date'] = time();
		
		$testimonials_image = $_FILES['testimonials_image']['name'];
		if($testimonials_image != '' && $testimonials_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($testimonials_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['testimonials_image']['tmp_name']; 
			$dirPath = "uploads/testimonials_image/";
			$newFileName = $otp2."_testimonials.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['testimonials_image'] = $otp2.'_testimonials.'.$ext;
			}
		}
		
		$this->db->insert('testimonials', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function testimonials_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$testimonials_id = @$_GET['b_i'];
			$testimonials_token = @$_GET['b_t'];
			if (!$this->crud_model->admin_permission('testimonials_edit')) {
				redirect(base_url() . 'admin');
			}
			$data['page_id'] = @$_GET['page'];
			$data['testimonials_data'] = $this->db->get_where('testimonials', array('testimonials_id' => $testimonials_id,'testimonials_token'=>$testimonials_token))->result_array();
			$data['page_name'] = "manage_website/testimonials/testimonials_edit";
            $data['page_name_link'] = "testimonials";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function testimonials_update($para1 = '', $para2 = '', $para3 = ''){
		$data['testimonials_name'] = $this->input->post('testimonials_name');
		$data['testimonials_desicription'] = $this->input->post('testimonials_desicription');
		$data['designation'] = $this->input->post('designation');
		$data['testimonials_date'] = time();
		$data['testimonials_rate'] = $this->input->post('testimonials_rate');
		
		$testimonials_image = $_FILES['testimonials_image']['name'];
		if($testimonials_image != '' && $testimonials_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$get_old_image_name = @$this->db->get_where('testimonials',array('testimonials_id'=>$para1))->row()->testimonials_image;
			if($get_old_image_name != ''){
				$rpersonal = "uploads/testimonials_image/".$get_old_image_name;
				unlink($rpersonal);
			}
			
			$ext = pathinfo($testimonials_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['testimonials_image']['tmp_name']; 
			$dirPath = "uploads/testimonials_image/";
			$newFileName = $otp2."_testimonials.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['testimonials_image'] = $otp2.'_testimonials.'.$ext;
			}
		}
		
		$this->db->where('testimonials_id', $para1);
		$this->db->update('testimonials', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function cms_pages($para1 = '', $para2 = '')
    {
    	
       if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('cms_pages')) {
				redirect(base_url() . 'admin');
			}
			if($para1 == 'home_page' && $para2 == '1'){
				$data['home_page_data'] = @$this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
				$data['page_name'] = "manage_website/cms_pages/home_page";
				$data['page_name_link'] = "cms_pages";
				$this->load->view('back/admin/index', $data);
			}else if($para1 == 'terms_conditions' && $para2 == '1'){
				$data['terms_conditions_data'] = @$this->db->get_where('termandcondition',array('termandcondition_id'=>'1'))->result_array();
				$data['page_name'] = "manage_website/cms_pages/terms_conditions";
				$data['page_name_link'] = "cms_pages";
				$this->load->view('back/admin/index', $data);
			}else if($para1 == 'who_we_are' && $para2 == '1'){
				$data['who_we_are_data'] = @$this->db->get_where('who_we_are',array('who_we_are_id'=>'1'))->result_array();
				$data['page_name'] = "manage_website/cms_pages/who_we_are";
				$data['page_name_link'] = "cms_pages";
				$this->load->view('back/admin/index', $data);
			}else if($para1 == 'contactus' && $para2 == '1'){
				$data['contactus_data'] = @$this->db->get_where('contactus',array('contactus_id'=>'1'))->result_array();
				$data['page_name'] = "manage_website/cms_pages/contactus";
				$data['page_name_link'] = "cms_pages";
				$this->load->view('back/admin/index', $data);
			}else{
				$data['page_name'] = "manage_website/cms_pages/cms_pages";
				$data['page_name_link'] = "cms_pages";
				$this->load->view('back/admin/index', $data);
			}
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function update_contactus($para1 = '', $para2 = '', $para3 = ''){
		$data['page_small_title'] = $this->input->post('page_small_title');
		$data['page_main_title'] = $this->input->post('page_main_title');
		$data['title'] = $this->input->post('title');
		$data['fectory_address'] = $this->input->post('fectory_address');
		$data['office_address'] = $this->input->post('office_address');
		$data['email'] = $this->input->post('email');
		$data['contact_one'] = $this->input->post('contact_one');
		$data['contact_two'] = $this->input->post('contact_two');
		$data['factory_address_map'] = $this->input->post('factory_address_map');
		$data['office_address_map'] = $this->input->post('office_address_map');
		
		$this->db->where('contactus_id', $para1);
		$this->db->update('contactus', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_home_page($para1 = '', $para2 = '', $para3 = ''){
		$data['main_slider_show_hide'] = $this->input->post('main_slider_show_hide');
		$data['header_social_media_show_hide'] = $this->input->post('header_social_media_show_hide');
		
		$tag_line_image = $_FILES['tag_line_image']['name'];
		if($tag_line_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('home_page',array('home_page_id'=>$para1))->result_array();
			if($check_account[0]['tag_line_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['tag_line_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($tag_line_image, PATHINFO_EXTENSION);
			if($ext != ''){
				$use_ext = $ext;
			}else{
				$use_ext = 'png';
			}
			$uploadedFile = $_FILES['tag_line_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_tag_line";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $use_ext)){
				$data['tag_line_image'] = $otp2.'_tag_line.'.$use_ext;
			}
		}

		$data['about_us_show_hide'] = $this->input->post('about_us_show_hide');
		$data['about_us_title'] = $this->input->post('about_us_title');
		$data['about_us_content'] = $this->input->post('about_us_content');
		$data['moredetails_button_show_hide'] = $this->input->post('moredetails_button_show_hide');
		$about_us_image = $_FILES['about_us_image']['name'];
		if($about_us_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('home_page',array('home_page_id'=>$para1))->result_array();
			if($check_account[0]['about_us_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['about_us_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($about_us_image, PATHINFO_EXTENSION);
			if($ext != ''){
				$use_ext = $ext;
			}else{
				$use_ext = 'png';
			}
			$uploadedFile = $_FILES['about_us_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_abouut";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $use_ext)){
				$data['about_us_image'] = $otp2.'_abouut.'.$use_ext;
			}
		}
		
		$data['second_slider_show_hide'] = $this->input->post('second_slider_show_hide');
		$second_slider_bottom_image = $_FILES['second_slider_bottom_image']['name'];
		if($second_slider_bottom_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('home_page',array('home_page_id'=>$para1))->result_array();
			if($check_account[0]['second_slider_bottom_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['second_slider_bottom_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($second_slider_bottom_image, PATHINFO_EXTENSION);
			if($ext != ''){
				$use_ext = $ext;
			}else{
				$use_ext = 'png';
			}
			$uploadedFile = $_FILES['second_slider_bottom_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_bottom_im";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $use_ext)){
				$data['second_slider_bottom_image'] = $otp2.'_bottom_im.'.$use_ext;
			}
		}
		
		$data['our_brand_section_show_hide'] = $this->input->post('our_brand_section_show_hide');
		$data['our_brand_show_item'] = $this->input->post('our_brand_show_item');
		$data['our_brand_first_title'] = $this->input->post('our_brand_first_title');
		$data['our_brand_second_title'] = $this->input->post('our_brand_second_title');
		$data['our_brand_content'] = $this->input->post('our_brand_content');
		
		$data['our_technolgy_show_hide'] = $this->input->post('our_technolgy_show_hide');
		$data['our_technolgy_show_item'] = $this->input->post('our_technolgy_show_item');
		$data['our_technolgy_first_title'] = $this->input->post('our_technolgy_first_title');
		$data['our_technolgy_second_title'] = $this->input->post('our_technolgy_second_title');
		$data['our_technolgy_content'] = $this->input->post('our_technolgy_content');
		
		$this->db->where('home_page_id', $para1);
		$this->db->update('home_page', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_who_we_are($para1 = '', $para2 = '', $para3 = ''){
		$data['page_small_title'] = $this->input->post('page_small_title');
		$data['page_main_title'] = $this->input->post('page_main_title');
		$data['section_one_title'] = $this->input->post('section_one_title');
		$data['section_one_content'] = $this->input->post('section_one_content');
		
		$who_we_are_image = $_FILES['who_we_are_image']['name'];
		if($who_we_are_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('who_we_are',array('who_we_are_id'=>$para1))->result_array();
			if($check_account[0]['who_we_are_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['who_we_are_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($who_we_are_image, PATHINFO_EXTENSION);
			if($ext != ''){
				$use_ext = $ext;
			}else{
				$use_ext = 'png';
			}
			$uploadedFile = $_FILES['who_we_are_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_img1";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $use_ext)){
				$data['who_we_are_image'] = $otp2.'_img1.'.$use_ext;
			}
		}

		$data['section_two_title'] = $this->input->post('section_two_title');
		$data['section_two_content'] = $this->input->post('section_two_content');
		$data['our_technolgy_item_show'] = $this->input->post('our_technolgy_item_show');
		$section_three_image = $_FILES['section_three_image']['name'];
		if($section_three_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('who_we_are',array('who_we_are_id'=>$para1))->result_array();
			if($check_account[0]['section_three_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['section_three_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($section_three_image, PATHINFO_EXTENSION);
			if($ext != ''){
				$use_ext = $ext;
			}else{
				$use_ext = 'png';
			}
			$uploadedFile = $_FILES['section_three_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_iomg2";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $use_ext)){
				$data['section_three_image'] = $otp2.'_iomg2.'.$use_ext;
			}
		}
		
		$data['section_four_content'] = $this->input->post('section_four_content');
		$section_four_image = $_FILES['section_four_image']['name'];
		if($section_four_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('who_we_are',array('who_we_are_id'=>$para1))->result_array();
			if($check_account[0]['section_four_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['section_four_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($section_four_image, PATHINFO_EXTENSION);
			if($ext != ''){
				$use_ext = $ext;
			}else{
				$use_ext = 'png';
			}
			$uploadedFile = $_FILES['section_four_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_img3";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $use_ext)){
				$data['section_four_image'] = $otp2.'_img3.'.$use_ext;
			}
		}
		
		$this->db->where('who_we_are_id', $para1);
		$this->db->update('who_we_are', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_terms_conditions($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('termandcondition',array('termandcondition_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
		$this->db->where('termandcondition_id', $para1);
		$this->db->update('termandcondition', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	public function update_about_us($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$data['show_achivement'] = $this->input->post('show_achivement');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('termandcondition',array('termandcondition_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
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
			
			$check_account = @$this->db->get_where('aboutus',array('aboutus_id'=>$para1))->result_array();
			if($check_account[0]['about_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['about_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($about_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['about_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_about";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['about_image'] = $otp2.'_about.'.$ext;
			}
		}
		$this->db->where('aboutus_id', $para1);
		$this->db->update('aboutus', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	public function update_communityguidelines($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('termandcondition',array('termandcondition_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
		$this->db->where('communityguidelines_id', $para1);
		$this->db->update('communityguidelines', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_privacy_policy($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('privacypolicy',array('privacypolicy_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
		$this->db->where('privacypolicy_id', $para1);
		$this->db->update('privacypolicy', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_legality($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('legality',array('legality_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
		$this->db->where('legality_id', $para1);
		$this->db->update('legality', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_howtoplay($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$data['video_url'] = $this->input->post('video_url');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('howtoplay',array('howtoplay_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
		$this->db->where('howtoplay_id', $para1);
		$this->db->update('howtoplay', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function update_faqpage($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['page_title'] = $this->input->post('page_title');
		$data['page_title_bottom_text'] = $this->input->post('page_title_bottom_text');
		$header_image = $_FILES['header_image']['name'];
		if($header_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('faqpage',array('faqpage_id'=>$para1))->result_array();
			if($check_account[0]['header_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['header_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($header_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['header_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_header";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['header_image'] = $otp2.'_header.'.$ext;
			}
		}
		$this->db->where('faqpage_id', $para1);
		$this->db->update('faqpage', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	/* Update About Us */
	
		
	public function update_aboutus($para1 = '', $para2 = '', $para3 = ''){
		$data['main_banner_show_hide'] = $this->input->post('main_banner_show_hide');
		
		$data['about_show_hide'] = $this->input->post('about_show_hide');
		$data['about_main_title'] = $this->input->post('about_main_title');
		$data['about_content'] = $this->input->post('about_content');
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
			
			$check_account = @$this->db->get_where('aboutus',array('aboutus_id'=>$para1))->result_array();
			if($check_account[0]['about_image'] != ''){
				$rpersonal = "uploads/other_images/".$check_account[0]['about_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($about_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['about_image']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_about";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['about_image'] = $otp2.'_about.'.$ext;
			}
		}
		
		$data['review_show_hide'] = $this->input->post('review_show_hide');
		$data['review_main_title'] = $this->input->post('review_main_title');
		$data['review_content'] = $this->input->post('review_content');
		$data['review_item_show'] = $this->input->post('review_item_show');
		
		$data['how_to_play_show_hide'] = $this->input->post('how_to_play_show_hide');
		$data['how_to_play_item_show'] = $this->input->post('how_to_play_item_show');
		$data['how_to_play_main_title'] = $this->input->post('how_to_play_main_title');
		$data['how_to_play_content'] = $this->input->post('how_to_play_content');
		
		$data['achivement_show_hide'] = $this->input->post('achivement_show_hide');
		$data['achivement_item_show'] = $this->input->post('achivement_item_show');
		$data['contact_show_hide'] = $this->input->post('contact_show_hide');
		
		$this->db->where('aboutus_id', $para1);
		$this->db->update('aboutus', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	/* Update About Us */
	
	
	function update_sliders_position(){
		$position_value = $this->input->post('position_value');
		$slider_id = $this->input->post('slider_id');
		
		$data['position'] = $position_value;
		$this->db->where('slider_id',$slider_id);
		$this->db->update('sliders',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	} 
	
	function update_web_social_media_position(){
		$position_value = $this->input->post('position_value');
		$w_s_id = $this->input->post('w_s_id');
		
		$data['position'] = $position_value;
		$this->db->where('w_s_id',$w_s_id);
		$this->db->update('web_social_media',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	/* SECOND SLIDER */
	public function second_sliders()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('second_sliders')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->manage_website_model->get_second_sliders_data_count();
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/manage_website/second_sliders";
			$config['per_page'] = 10;
			$config['uri_segment'] = '3';
			$config['page_query_string']= TRUE;
			$config['query_string_segment'] = "page";
			$choice = $config["total_rows"] / $config["per_page"];
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
		 
			$config['first_link'] = 'First';
			$config['firsf_tag_open'] = '<li class="firstpage page">';
			$config['firsf_tag_close'] = '</li>';
		 
			$config['last_link'] = 'Last';
			$config['lasf_tag_open'] = '<li class="lastpage page">';
			$config['lasf_tag_close'] = '</li>';
		 
			$config['next_link'] = '»';
			$config['nexf_tag_open'] = '<li class="next page">';
			$config['nexf_tag_close'] = '</li>';
		 
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
			
			$data['all_second_sliders'] = $this->manage_website_model->get_second_sliders_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "manage_website/second_sliders/second_sliders";
            $data['page_name_link'] = "second_sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function second_sliders_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('second_sliders_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_name'] = "manage_website/second_sliders/second_sliders_add";
            $data['page_name_link'] = "second_sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function second_sliders_do_add(){
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['second_slider_token'] = $token;
		$data['second_slider_status'] = 'yes';
		$second_slider_image = $_FILES['second_slider_image']['name'];
		if($second_slider_image != '' && $second_slider_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($second_slider_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['second_slider_image']['tmp_name']; 
			$dirPath = "uploads/second_slider_image/";
			$newFileName = $otp2."_second_slider.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['second_slider_image'] = $otp2.'_second_slider.'.$ext;
			}
		}
		
		$this->db->insert('second_sliders', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
    public function second_sliders_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$second_slider_id = @$_GET['s_i'];
			$second_slider_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('second_sliders_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['second_sliders_data'] = $this->db->get_where('second_sliders', array('second_slider_id' => $second_slider_id,'second_slider_token' => $second_slider_token))->result_array();
			$data['page_name'] = "manage_website/second_sliders/second_sliders_view";
            $data['page_name_link'] = "second_sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	
	
	public function second_sliders_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$second_slider_id = @$_GET['s_i'];
			$second_slider_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('second_sliders_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['second_sliders_data'] = $this->db->get_where('second_sliders', array('second_slider_id' => $second_slider_id,'second_slider_token'=>$second_slider_token))->result_array();
			$data['page_name'] = "manage_website/second_sliders/second_sliders_edit";
            $data['page_name_link'] = "second_sliders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function second_sliders_update($para1 = '', $para2 = '', $para3 = ''){
		$second_slider_image = $_FILES['second_slider_image']['name'];
		if($second_slider_image != '' && $second_slider_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$main_product_image = @$this->db->get_where('second_sliders',array('second_slider_id'=>$para1))->row()->second_slider_image;
			if($main_product_image != ''){
				$rpersonal = "uploads/second_slider_image/".$main_product_image;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($second_slider_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['second_slider_image']['tmp_name']; 
			$dirPath = "uploads/second_slider_image/";
			$newFileName = $otp2."_second_slider.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['second_slider_image'] = $otp2.'_second_slider.'.$ext;
			}
		}
		
		$this->db->where('second_slider_id', $para1);
		$this->db->update('second_sliders', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function second_sliderss($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('second_sliders')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$id = $this->input->post('id');
			$get_old_image_name = @$this->db->get_where('second_sliders',array('second_slider_id'=>$id))->row()->second_slider_image;
			$data['second_slider_status'] = 'delete';
            $this->db->where('second_slider_id',$id);
            $this->db->update('second_sliders',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				if($get_old_image_name != ''){
					$rpersonal = "uploads/second_slider_image/".$get_old_image_name;
					unlink($rpersonal);
				}
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $team = $para2;
			if ($para3 == 'true') {
                $data['second_slider_status'] = 'yes';
            } else {
                $data['second_slider_status'] = 'no';
            }
            $this->db->where('second_slider_id', $team);
            $this->db->update('second_sliders', $data);
        }
    }
	
	function update_second_sliders_position(){
		$position_value = $this->input->post('position_value');
		$second_slider_id = $this->input->post('second_slider_id');
		
		$data['position'] = $position_value;
		$this->db->where('second_slider_id',$second_slider_id);
		$this->db->update('second_sliders',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	/* OUR TECVHNOLOGY */
	
	public function our_technology()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('our_technology')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->manage_website_model->get_our_technology_data_count();
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/manage_website/our_technology";
			$config['per_page'] = 10;
			$config['uri_segment'] = '3';
			$config['page_query_string']= TRUE;
			$config['query_string_segment'] = "page";
			$choice = $config["total_rows"] / $config["per_page"];
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
		 
			$config['first_link'] = 'First';
			$config['firsf_tag_open'] = '<li class="firstpage page">';
			$config['firsf_tag_close'] = '</li>';
		 
			$config['last_link'] = 'Last';
			$config['lasf_tag_open'] = '<li class="lastpage page">';
			$config['lasf_tag_close'] = '</li>';
		 
			$config['next_link'] = '»';
			$config['nexf_tag_open'] = '<li class="next page">';
			$config['nexf_tag_close'] = '</li>';
		 
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
			
			$data['all_our_technology'] = $this->manage_website_model->get_our_technology_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "manage_website/our_technology/our_technology";
            $data['page_name_link'] = "our_technology";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function our_technology_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('our_technology_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_name'] = "manage_website/our_technology/our_technology_add";
            $data['page_name_link'] = "our_technology";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function our_technology_do_add(){
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['our_technology_title'] = $this->input->post('our_technology_title');
		$data['our_technology_token'] = $token;
		$data['our_technology_status'] = 'yes';
		$our_technology_image = $_FILES['our_technology_image']['name'];
		if($our_technology_image != '' && $our_technology_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($our_technology_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_technology_image']['tmp_name']; 
			$dirPath = "uploads/our_technology_image/";
			$newFileName = $otp2."_our_technology.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['our_technology_image'] = $otp2.'_our_technology.'.$ext;
			}
		}
		
		$this->db->insert('our_technology', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
    public function our_technology_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$our_technology_id = @$_GET['s_i'];
			$our_technology_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('our_technology_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['our_technology_data'] = $this->db->get_where('our_technology', array('our_technology_id' => $our_technology_id,'our_technology_token' => $our_technology_token))->result_array();
			$data['page_name'] = "manage_website/our_technology/our_technology_view";
            $data['page_name_link'] = "our_technology";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	
	
	public function our_technology_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$our_technology_id = @$_GET['s_i'];
			$our_technology_token = @$_GET['s_t'];
			if (!$this->crud_model->admin_permission('our_technology_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_id'] = @$_GET['page'];
			$data['our_technology_data'] = $this->db->get_where('our_technology', array('our_technology_id' => $our_technology_id,'our_technology_token'=>$our_technology_token))->result_array();
			$data['page_name'] = "manage_website/our_technology/our_technology_edit";
            $data['page_name_link'] = "our_technology";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function our_technology_update($para1 = '', $para2 = '', $para3 = ''){
		$data['our_technology_title'] = $this->input->post('our_technology_title');
		$our_technology_image = $_FILES['our_technology_image']['name'];
		if($our_technology_image != '' && $our_technology_image != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$main_product_image = @$this->db->get_where('our_technology',array('our_technology_id'=>$para1))->row()->our_technology_image;
			if($main_product_image != ''){
				$rpersonal = "uploads/our_technology_image/".$main_product_image;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($our_technology_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_technology_image']['tmp_name']; 
			$dirPath = "uploads/our_technology_image/";
			$newFileName = $otp2."_our_technology.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['our_technology_image'] = $otp2.'_our_technology.'.$ext;
			}
		}
		
		$this->db->where('our_technology_id', $para1);
		$this->db->update('our_technology', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function our_technologys($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('our_technology')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$id = $this->input->post('id');
			$get_old_image_name = @$this->db->get_where('our_technology',array('our_technology_id'=>$id))->row()->our_technology_image;
			$data['our_technology_status'] = 'delete';
            $this->db->where('our_technology_id',$id);
            $this->db->update('our_technology',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				if($get_old_image_name != ''){
					$rpersonal = "uploads/our_technology_image/".$get_old_image_name;
					unlink($rpersonal);
				}
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $team = $para2;
			if ($para3 == 'true') {
                $data['our_technology_status'] = 'yes';
            } else {
                $data['our_technology_status'] = 'no';
            }
            $this->db->where('our_technology_id', $team);
            $this->db->update('our_technology', $data);
        }
    }
	
	function update_our_technology_position(){
		$position_value = $this->input->post('position_value');
		$our_technology_id = $this->input->post('our_technology_id');
		
		$data['position'] = $position_value;
		$this->db->where('our_technology_id',$our_technology_id);
		$this->db->update('our_technology',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	/* MANAGE our_net */
	public function our_network()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('our_network')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->manage_website_model->get_our_network_data_count();
			
			$config = array();		
			$config['total_rows'] = $count_data;
			$config['base_url'] = base_url() . "admin/manage_website/our_network";
			$config['per_page'] = 10;
			$config['uri_segment'] = '3';
			$config['page_query_string']= TRUE;
			$config['query_string_segment'] = "page";
			$choice = $config["total_rows"] / $config["per_page"];
			
			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
		 
			$config['first_link'] = 'First';
			$config['firsf_tag_open'] = '<li class="firstpage page">';
			$config['firsf_tag_close'] = '</li>';
		 
			$config['last_link'] = 'Last';
			$config['lasf_tag_open'] = '<li class="lastpage page">';
			$config['lasf_tag_close'] = '</li>';
		 
			$config['next_link'] = '»';
			$config['nexf_tag_open'] = '<li class="next page">';
			$config['nexf_tag_close'] = '</li>';
		 
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
			
			$data['all_our_network'] = $this->manage_website_model->get_our_network_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "manage_website/our_network/our_network";
            $data['page_name_link'] = "our_network";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
    public function our_network_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$our_net_id = @$_GET['on_i'];
			$our_net_token = @$_GET['on_t'];
			if (!$this->crud_model->admin_permission('our_network_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['our_network_data'] = $this->db->get_where('our_network', array('our_net_id' => $our_net_id,'our_net_token' => $our_net_token))->result_array();
			$data['page_name'] = "manage_website/our_network/our_network_view";
            $data['page_name_link'] = "our_network";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
    /*User Management */
    function our_networks($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('our_network')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$id = $this->input->post('id');
			$data['our_net_status'] = 'delete';
            $this->db->where('our_net_id',$id);
            $this->db->update('our_network',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'status_set') {
            $our_net = $para2;
			if ($para3 == 'true') {
                $data['our_net_status'] = 'Active';
            } else {
                $data['our_net_status'] = 'De-active';
            }
            $this->db->where('our_net_id', $our_net);
            $this->db->update('our_network', $data);
        }
    }
	
	public function our_network_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('our_net_add')) {
				redirect(base_url() . 'admin');
			}
			$data['page_name'] = "manage_website/our_network/our_network_add";
            $data['page_name_link'] = "our_network";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function our_network_do_add(){
		$length1= 200;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['our_net_token'] = $token;
		$data['our_net_state'] = $this->input->post('our_net_state');
		$data['our_net_title'] = $this->input->post('our_net_title');
		$data['our_net_address'] = $this->input->post('our_net_address');
		$data['our_net_contact'] = $this->input->post('our_net_contact');
		$data['our_net_email'] = $this->input->post('our_net_email');
		$data['our_net_map'] = $this->input->post('our_net_map');
		$data['our_net_status'] = 'Active';
		$this->db->insert('our_network', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function our_network_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$our_net_id = @$_GET['on_i'];
			$our_net_token = @$_GET['on_t'];
			if (!$this->crud_model->admin_permission('our_net_edit')) {
				redirect(base_url() . 'admin');
			}
			$data['page_id'] = @$_GET['page'];
			$data['all_our_network'] = $this->db->get_where('our_network', array('our_net_id' => $our_net_id,'our_net_token'=>$our_net_token))->result_array();
			$data['page_name'] = "manage_website/our_network/our_network_edit";
            $data['page_name_link'] = "our_network";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function our_network_update($para1 = '', $para2 = '', $para3 = ''){
		$data['our_net_state'] = $this->input->post('our_net_state');
		$data['our_net_title'] = $this->input->post('our_net_title');
		$data['our_net_address'] = $this->input->post('our_net_address');
		$data['our_net_contact'] = $this->input->post('our_net_contact');
		$data['our_net_email'] = $this->input->post('our_net_email');
		$data['our_net_map'] = $this->input->post('our_net_map');
		$this->db->where('our_net_id', $para1);
		$this->db->update('our_network', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	public function footer_setting(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('social_media_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['footer_data'] = $this->db->get_where('footer_setting', array('footer_id' =>"1"))->result_array();
			$data['page_name'] = "manage_website/footer_setting/footer_setting";
            $data['page_name_link'] = "footer_setting";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function footer_setting_update($para1 = '', $para2 = '', $para3 = ''){
		$data['content'] = $this->input->post('content');
		$data['address'] = $this->input->post('address');
		$data['contact_one'] = $this->input->post('contact_one');
		$data['contact_two'] = $this->input->post('contact_two');
		$data['email'] = $this->input->post('email');
		$data['footer_map'] = $this->input->post('footer_map');
		$logo = $_FILES['logo']['name'];
		if($logo != '' && $logo != null){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$logo_image = @$this->db->get_where('footer_setting',array('footer_id'=>$para1))->row()->logo;
			if($logo_image != ''){
				$rpersonal = "uploads/other_images/".$logo_image;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($logo, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['logo']['tmp_name']; 
			$dirPath = "uploads/other_images/";
			$newFileName = $otp2."_footer_logo.". $ext;
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName)){
				$data['logo'] = $otp2.'_footer_logo.'.$ext;
			}
		}
		
		$this->db->where('footer_id', $para1);
		$this->db->update('footer_setting', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}