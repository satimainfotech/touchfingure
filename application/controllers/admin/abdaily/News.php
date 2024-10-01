<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class news extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('news_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('news')) {
				redirect(base_url() . 'admin');
			}
			
			$news = @$_GET['c_n'];
			$data['news'] = $news;
			
			if($news != ''){
				$searchurl='?c_n='.$news;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->news_model->get_total_news_data_count($news);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/news".$searchurl;
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
			
			$data['all_news'] = $this->news_model->get_total_news_data($news,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "news/news";
            $data['page_name_link'] = "news";
            $this->load->view('back/abdaily/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function news_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('news_add')) {
				redirect(base_url() . 'admin');
			}
			$news = @$_GET['c_n'];
			$page_data['news'] = $news;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "news/news_add";
            $page_data['page_name_link'] = "news";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function news_edit(){
		$news_id = @$_GET['c_i'];
		$news_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('news_edit')) {
				redirect(base_url() . 'admin');
			}
			$news = @$_GET['c_n'];
			$page_data['news'] = $news;
			
			$page_data['news_data'] = $this->news_model->get_news_details($news_id,$news_token);
			$page_data['news_id'] = $news_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "news/news_edit";
            $page_data['page_name_link'] = "news";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function news_view(){
		$news_id = @$_GET['c_i'];
		$news_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('news_view')) {
				redirect(base_url() . 'admin');
			}
			$news = @$_GET['c_n'];
			$page_data['news'] = $news;
			
			$page_data['news_data'] = $this->news_model->get_news_details($news_id,$news_token);
			$page_data['news_id'] = $news_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "news/news_view";
            $page_data['page_name_link'] = "news";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function news_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['news_token'] = $token;
	    $data['news_name'] = date("Y-m-d", strtotime($this->input->post('news_name')));
		$data['news_status'] = 'Active';
		
		
		$news_image = $_FILES['news_image']['name'];
		if($news_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($news_image, PATHINFO_EXTENSION);
			
			
			$uploadedFile = $_FILES['news_image']['tmp_name']; 
			$dirPath = "uploads/abdaily_news_image/";
			$newFileName = $otp2."_news";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['news_image'] = $otp2.'_news.'.$ext;
			}
		}
		
		$news_inner_image = $_FILES['news_inner_image']['name'];
if ($news_inner_image != '') {
    $length = 6;
    $characters = '01234567899876543210';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $otp2 = $randomString;

    // Get the file extension
    $ext = pathinfo($news_inner_image, PATHINFO_EXTENSION);
    
    // Check if the file is a PDF
    if ($ext == 'pdf') {
        $uploadedFile = $_FILES['news_inner_image']['tmp_name']; 
        $dirPath = "uploads/abdaily_news_inner_image/";
        $newFileName = $otp2 . "_news";

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($uploadedFile, $dirPath . $newFileName . "." . $ext)) {
            $data['news_inner_image'] = $otp2 . '_news.' . $ext;
        }
    } else {
        // Handle error if the file is not a PDF
        echo "Only PDF files are allowed.";
    }
}
		
		$this->db->insert('news_master', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function news_update($para1 = '', $para2 = '', $para3 = ''){
	  $data['news_name'] = date("Y-m-d", strtotime($this->input->post('news_name')));
		$data['news_position'] = $this->input->post('news_position');
		
		$news_image = $_FILES['news_image']['name'];
		if($news_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$news_images = @$this->db->get_where('news',array('news_id'=>$para1))->row()->news_image;
			if($news_images != ''){
				$rpersonal = "uploads/abdaily_news_image/".$news_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($news_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['news_image']['tmp_name']; 
			$dirPath = "uploads/abdaily_news_image/";
			$newFileName = $otp2."_news";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['news_image'] = $otp2.'_news.'.$ext;
			}
		}
		
		$news_inner_image = $_FILES['news_inner_image']['name'];
		if($news_inner_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($news_image, PATHINFO_EXTENSION);
			
			$serviceuploadedFile = $_FILES['news_inner_image']['tmp_name']; 
			$servicedirPath = "uploads/abdaily_news_inner_image/";
			$servicenewFileName = $otp2."_news";
			
			if(move_uploaded_file($serviceuploadedFile, $servicedirPath. $servicenewFileName. ".". $ext)){
				$data['news_inner_image'] = $otp2.'_news.'.$ext;
			}
		}
		
		$this->db->where('news_id', $para1);
		$this->db->update('news_master', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function newss($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('news')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$news_images = @$this->db->get_where('news_master',array('news_id'=>$id))->row()->news_image;
			if($news_images != ''){
				$rpersonal = "uploads/abdaily_news_image/".$news_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['news_image'] = NULL;
			$data['news_status'] = 'delete';
            $this->db->where('news_id', $id);
			$this->db->update('news_master', $data);
			
        }else if ($para1 == 'status_set') {
            $news = $para2;
			if ($para3 == 'true') {
                $data['news_status'] = 'Active';
            } else {
                $data['news_status'] = 'De-active';
            }
            $this->db->where('news_id', $news);
            $this->db->update('news_master', $data);
        }
    }
	
	function update_news_position(){
		$position_value = $this->input->post('position_value');
		$news_id = $this->input->post('news_id');
		
		$data['news_position'] = $position_value;
		$this->db->where('news_id',$news_id);
		$this->db->update('news_master',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}