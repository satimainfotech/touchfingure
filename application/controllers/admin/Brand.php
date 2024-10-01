<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Brand extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('brand_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('brand')) {
				redirect(base_url() . 'admin');
			}
			
			$brand = @$_GET['b_n'];
			$data['brand'] = $brand;
			
			if($brand != ''){
				$searchurl='?b_n='.$brand;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->brand_model->get_total_brand_data_count($brand);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/brand".$searchurl;
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
			
			$data['all_brand'] = $this->brand_model->get_total_brand_data($brand,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "product_master/brand/brand";
            $data['page_name_link'] = "brand";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function brand_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('brand_add')) {
				redirect(base_url() . 'admin');
			}
			$brand = @$_GET['b_n'];
			$page_data['brand'] = $brand;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/brand/brand_add";
            $page_data['page_name_link'] = "brand";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function brand_edit(){
		$brand_id = @$_GET['b_i'];
		$brand_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('brand_edit')) {
				redirect(base_url() . 'admin');
			}
			$brand = @$_GET['b_n'];
			$page_data['brand'] = $brand;
			
			$page_data['brand_data'] = $this->brand_model->get_brand_details($brand_id,$brand_token);
			$page_data['brand_id'] = $brand_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/brand/brand_edit";
            $page_data['page_name_link'] = "brand";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function brand_view(){
		$brand_id = @$_GET['b_i'];
		$brand_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('brand_view')) {
				redirect(base_url() . 'admin');
			}
			$brand = @$_GET['b_n'];
			$page_data['brand'] = $brand;
			
			$page_data['brand_data'] = $this->brand_model->get_brand_details($brand_id,$brand_token);
			$page_data['brand_id'] = $brand_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/brand/brand_view";
            $page_data['page_name_link'] = "brand";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function brand_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['brand_token'] = $token;
		$data['brand_name'] = $this->input->post('brand_name');
		$data['brand_status'] = 'Active';
		
		$brand_image = $_FILES['brand_image']['name'];
		if($brand_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($brand_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['brand_image']['tmp_name']; 
			$dirPath = "uploads/brand_image/";
			$newFileName = $otp2."_brand";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['brand_image'] = $otp2.'_brand.'.$ext;
			}
		}
		$this->db->insert('brand', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function brand_update($para1 = '', $para2 = '', $para3 = ''){
		$data['brand_name'] = $this->input->post('brand_name');
		
		$brand_image = $_FILES['brand_image']['name'];
		if($brand_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$brand_images = @$this->db->get_where('brand',array('brand_id'=>$para1))->row()->brand_image;
			if($brand_images != ''){
				$rpersonal = "uploads/brand_image/".$brand_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($brand_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['brand_image']['tmp_name']; 
			$dirPath = "uploads/brand_image/";
			$newFileName = $otp2."_brand";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['brand_image'] = $otp2.'_brand.'.$ext;
			}
		}
		
		$this->db->where('brand_id', $para1);
		$this->db->update('brand', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function brands($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$brand_images = @$this->db->get_where('brand',array('brand_id'=>$id))->row()->brand_image;
			if($brand_images != ''){
				$rpersonal = "uploads/brand_image/".$brand_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['brand_image'] = NULL;
			$data['brand_status'] = 'delete';
            $this->db->where('brand_id', $id);
			$this->db->update('brand', $data);
        }else if ($para1 == 'status_set') {
            $brand = $para2;
			if ($para3 == 'true') {
                $data['brand_status'] = 'Active';
            } else {
                $data['brand_status'] = 'De-active';
            }
            $this->db->where('brand_id', $brand);
            $this->db->update('brand', $data);
        }
    }
	function update_brand_position(){
		$position_value = $this->input->post('position_value');
		$brand_id = $this->input->post('brand_id');
		
		$data['brand_position'] = $position_value;
		$this->db->where('brand_id',$brand_id);
		$this->db->update('brand',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}