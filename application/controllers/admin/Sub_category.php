<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Sub_category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('sub_category_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('sub_category')) {
				redirect(base_url() . 'admin');
			}
			
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['sc_n'];
			$data['category'] = $category;
			$data['sub_category'] = $sub_category;
			
			if($category != '' || $sub_category != ''){
				$searchurl='?c_i='.$category.'&sc_n='.$sub_category;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->sub_category_model->get_total_sub_category_data_count($category,$sub_category);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/sub_category".$searchurl;
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
			
			$data['category_data'] = @$this->db->get_where('category',array('category_status'=>'Active'))->result_array();
			$data['all_sub_category'] = $this->sub_category_model->get_total_sub_category_data($category,$sub_category,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "product_master/sub_category/sub_category";
            $data['page_name_link'] = "sub_category";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function sub_category_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('sub_category_add')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['sc_n'];
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			
			$page_data['category_data'] = @$this->db->get_where('category',array('category_status'=>'Active'))->result_array();
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/sub_category/sub_category_add";
            $page_data['page_name_link'] = "sub_category";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function sub_category_edit(){
		$sub_category_id = @$_GET['sc_i'];
		$sub_category_token = @$_GET['sc_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('sub_category_edit')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['sc_n'];
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			
			$page_data['category_data'] = @$this->db->get_where('category',array('category_status'=>'Active'))->result_array();
			$page_data['sub_category_data'] = $this->sub_category_model->get_sub_category_details($sub_category_id,$sub_category_token);
			$page_data['sub_category_id'] = $sub_category_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/sub_category/sub_category_edit";
            $page_data['page_name_link'] = "sub_category";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function sub_category_view(){
		$sub_category_id = @$_GET['sc_i'];
		$sub_category_token = @$_GET['sc_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('sub_category_view')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['sc_n'];
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			
			$page_data['sub_category_data'] = $this->sub_category_model->get_sub_category_details($sub_category_id,$sub_category_token);
			$page_data['sub_category_id'] = $sub_category_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/sub_category/sub_category_view";
            $page_data['page_name_link'] = "sub_category";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function sub_category_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['sub_category_token'] = $token;
		$data['sub_category_name'] = $this->input->post('sub_category_name');
		$data['category_id'] = $this->input->post('category_id');
		$data['sub_category_status'] = 'Active';
		$data['sub_category_position'] = '0';
		
		$sub_category_image = $_FILES['sub_category_image']['name'];
		if($sub_category_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($sub_category_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['sub_category_image']['tmp_name']; 
			$dirPath = "uploads/sub_category_image/";
			$newFileName = $otp2."_sub_category";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['sub_category_image'] = $otp2.'_sub_category.'.$ext;
			}
		}
		$this->db->insert('sub_category', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function sub_category_update($para1 = '', $para2 = '', $para3 = ''){
		$data['sub_category_name'] = $this->input->post('sub_category_name');
		$data['category_id'] = $this->input->post('category_id');
		
		$sub_category_image = $_FILES['sub_category_image']['name'];
		if($sub_category_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$sub_category_images = @$this->db->get_where('sub_category',array('sub_category_id'=>$para1))->row()->sub_category_image;
			if($sub_category_images != ''){
				$rpersonal = "uploads/sub_category_image/".$sub_category_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($sub_category_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['sub_category_image']['tmp_name']; 
			$dirPath = "uploads/sub_category_image/";
			$newFileName = $otp2."_sub_category";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['sub_category_image'] = $otp2.'_sub_category.'.$ext;
			}
		}
		
		$this->db->where('sub_category_id', $para1);
		$this->db->update('sub_category', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function sub_categorys($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('sub_category')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$sub_category_images = @$this->db->get_where('sub_category',array('sub_category_id'=>$id))->row()->sub_category_image;
			if($sub_category_images != ''){
				$rpersonal = "uploads/sub_category_image/".$sub_category_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['sub_category_image'] = NULL;
			$data['sub_category_status'] = 'delete';
            $this->db->where('sub_category_id', $id);
			$this->db->update('sub_category', $data);
        }else if ($para1 == 'status_set') {
            $sub_category = $para2;
			if ($para3 == 'true') {
                $data['sub_category_status'] = 'Active';
            } else {
                $data['sub_category_status'] = 'De-active';
            }
            $this->db->where('sub_category_id', $sub_category);
            $this->db->update('sub_category', $data);
        }
    }
	
	function update_sub_category_position(){
		$position_value = $this->input->post('position_value');
		$sub_category_id = $this->input->post('sub_category_id');
		
		$data['sub_category_position'] = $position_value;
		$this->db->where('sub_category_id',$sub_category_id);
		$this->db->update('sub_category',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}