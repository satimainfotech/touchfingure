<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('category_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('category')) {
				redirect(base_url() . 'admin');
			}
			
			$category = @$_GET['c_n'];
			$data['category'] = $category;
			
			if($category != ''){
				$searchurl='?c_n='.$category;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->category_model->get_total_category_data_count($category);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/category".$searchurl;
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
			
			$data['all_category'] = $this->category_model->get_total_category_data($category,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "product_master/category/category";
            $data['page_name_link'] = "category";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function category_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('category_add')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_n'];
			$page_data['category'] = $category;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/category/category_add";
            $page_data['page_name_link'] = "category";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function category_edit(){
		$category_id = @$_GET['c_i'];
		$category_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('category_edit')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_n'];
			$page_data['category'] = $category;
			
			$page_data['category_data'] = $this->category_model->get_category_details($category_id,$category_token);
			$page_data['category_id'] = $category_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/category/category_edit";
            $page_data['page_name_link'] = "category";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function category_view(){
		$category_id = @$_GET['c_i'];
		$category_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('category_view')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_n'];
			$page_data['category'] = $category;
			
			$page_data['category_data'] = $this->category_model->get_category_details($category_id,$category_token);
			$page_data['category_id'] = $category_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/category/category_view";
            $page_data['page_name_link'] = "category";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function category_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['category_token'] = $token;
		$data['category_name'] = $this->input->post('category_name');
		$data['category_status'] = 'Active';
		$data['category_position'] = '0';
		
		$category_image = $_FILES['category_image']['name'];
		if($category_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($category_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['category_image']['tmp_name']; 
			$dirPath = "uploads/category_image/";
			$newFileName = $otp2."_category";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['category_image'] = $otp2.'_category.'.$ext;
			}
		}
		$this->db->insert('category', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function category_update($para1 = '', $para2 = '', $para3 = ''){
		$data['category_name'] = $this->input->post('category_name');
		
		$category_image = $_FILES['category_image']['name'];
		if($category_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$category_images = @$this->db->get_where('category',array('category_id'=>$para1))->row()->category_image;
			if($category_images != ''){
				$rpersonal = "uploads/category_image/".$category_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($category_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['category_image']['tmp_name']; 
			$dirPath = "uploads/category_image/";
			$newFileName = $otp2."_category";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['category_image'] = $otp2.'_category.'.$ext;
			}
		}
		
		$this->db->where('category_id', $para1);
		$this->db->update('category', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function categorys($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('category')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$category_images = @$this->db->get_where('category',array('category_id'=>$id))->row()->category_image;
			if($category_images != ''){
				$rpersonal = "uploads/category_image/".$category_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['category_image'] = NULL;
			$data['category_status'] = 'delete';
            $this->db->where('category_id', $id);
			$this->db->update('category', $data);
        }else if ($para1 == 'status_set') {
            $category = $para2;
			if ($para3 == 'true') {
                $data['category_status'] = 'Active';
            } else {
                $data['category_status'] = 'De-active';
            }
            $this->db->where('category_id', $category);
            $this->db->update('category', $data);
        }
    }
	
	function update_category_position(){
		$position_value = $this->input->post('position_value');
		$category_id = $this->input->post('category_id');
		
		$data['category_position'] = $position_value;
		$this->db->where('category_id',$category_id);
		$this->db->update('category',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}