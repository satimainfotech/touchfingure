<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Our_range extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('our_range_model');
    }
    
    /* Dashboard */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('our_range')) {
				redirect(base_url() . 'admin');
			}
			
			$count_data = $this->our_range_model->get_total_our_range_data_count();
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/our_range";
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
			
			$data['all_our_range'] = $this->our_range_model->get_total_our_range_data($config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data["category_data"] = get_category();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "our_range_master/our_range/our_range";
            $data['page_name_link'] = "our_range";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	function our_range_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('our_range')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_id'] = $page_id;
			$page_data["brand_data"] = get_brand();
            $page_data['page_name'] = "our_range_master/our_range/our_range_add";
            $page_data['page_name_link'] = "our_range";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function our_range_added($para1 = '', $para2 = '', $para3 = ''){
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
		
		$data['our_range_name'] = $this->input->post('our_range_name');
		
		$main_title = $data['our_range_name'];
		$final_main_title = str_replace(' ', '-', strtolower($main_title));
		
		$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
		
		$data['our_range_slug'] = $final_main_title2;
		$data['our_range_token'] = $token;
		$data['our_range_content'] = $this->input->post('our_range_content');
		$data['our_range_brand'] = $this->input->post('brand');
		
		$our_range_main_image = $_FILES['our_range_main_image']['name'];
		if($our_range_main_image != ''){
			$ext = pathinfo($our_range_main_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_main_image']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_o_main_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_main_image'] = $otp2.'_o_main_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$our_range_image_1 = $_FILES['our_range_image_1']['name'];
		if($our_range_image_1 != ''){
			$ext = pathinfo($our_range_image_1, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_image_1']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_ot_one_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_image_1'] = $otp2.'_ot_one_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$our_range_image_2 = $_FILES['our_range_image_2']['name'];
		if($our_range_image_2 != ''){
			$ext = pathinfo($our_range_image_2, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_image_2']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_ot_two_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_image_2'] = $otp2.'_ot_two_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$our_range_image_3 = $_FILES['our_range_image_3']['name'];
		if($our_range_image_3 != ''){
			$ext = pathinfo($our_range_image_3, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_image_3']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_ot_three_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_image_3'] = $otp2.'_ot_three_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$data['our_range_status'] = 'Active';
		$this->db->insert('our_range', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function our_range_edit(){
		$our_range_id = @$_GET['or_i'];
		$our_range_token = @$_GET['or_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('our_range')) {
				redirect(base_url() . 'admin');
			}
			$page_data["brand_data"] = get_brand();
			$page_data['our_range_data'] = $this->our_range_model->get_our_range_edit_details($our_range_id,$our_range_token);
			$page_data['our_range_id'] = $our_range_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "our_range_master/our_range/our_range_edit";
            $page_data['page_name_link'] = "our_range";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function our_range_update($para1 = '', $para2 = '', $para3 = ''){
		$length = 6;
		$characters = '01234567899876543210';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$otp2 = $randomString;
		
		$data['our_range_name'] = $this->input->post('our_range_name');
		
		$main_title = $data['our_range_name'];
		$final_main_title = str_replace(' ', '-', strtolower($main_title));
		
		$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
		
		$data['our_range_slug'] = $final_main_title2;
		$data['our_range_content'] = $this->input->post('our_range_content');
		$data['our_range_brand'] = $this->input->post('brand');
		
		$our_range_main_image = $_FILES['our_range_main_image']['name'];
		if($our_range_main_image != ''){
			
			$our_range_main_images = @$this->db->get_where('our_range',array('our_range_id'=>$para1))->row()->our_range_main_image;
			if($our_range_main_images != ''){
				$rpersonal = "uploads/our_range_image/".$our_range_main_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($our_range_main_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_main_image']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_o_main_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_main_image'] = $otp2.'_o_main_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$our_range_image_1 = $_FILES['our_range_image_1']['name'];
		if($our_range_image_1 != ''){
			
			$our_range_image1 = @$this->db->get_where('our_range',array('our_range_id'=>$para1))->row()->our_range_image_1;
			if($our_range_image1 != ''){
				$rpersonal = "uploads/our_range_image/".$our_range_image1;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($our_range_image_1, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_image_1']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_ot_one_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_image_1'] = $otp2.'_ot_one_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$our_range_image_2 = $_FILES['our_range_image_2']['name'];
		if($our_range_image_2 != ''){
			
			$our_range_image2 = @$this->db->get_where('our_range',array('our_range_id'=>$para1))->row()->our_range_image_2;
			if($our_range_image2 != ''){
				$rpersonal = "uploads/our_range_image/".$our_range_image2;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($our_range_image_2, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_image_2']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_ot_two_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_image_2'] = $otp2.'_ot_two_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$our_range_image_3 = $_FILES['our_range_image_3']['name'];
		if($our_range_image_3 != ''){
			
			$our_range_image3 = @$this->db->get_where('our_range',array('our_range_id'=>$para1))->row()->our_range_image_3;
			if($our_range_image3 != ''){
				$rpersonal = "uploads/our_range_image/".$our_range_image3;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($our_range_image_3, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['our_range_image_3']['tmp_name']; 
			$dirPath = "uploads/our_range_image/";
			$newFileName = $otp2."_ot_three_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['our_range_image_3'] = $otp2.'_ot_three_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$this->db->where('our_range_id', $para1);
		$this->db->update('our_range', $data);
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			
			echo 'done';
		}
	}
	
	function our_ranges($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('our_range')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
			$id = $this->input->post('id');
            $data['our_range_status'] = 'delete';
            $this->db->where('our_range_id', $id);
            $this->db->update('our_range',$data);
			echo 'done';
        } else if ($para1 == 'status_set') {
            $our_range = $para2;
            if ($para3 == 'true') {
                $data['our_range_status'] = 'Active';
            } else {
                $data['our_range_status'] = 'De-active';
            }
            $this->db->where('our_range_id', $our_range);
            $this->db->update('our_range', $data);
			echo 'done';
		}
    }
	
	public function get_sub_category(){
		$category = $this->input->post('category_id');
		$sub_category_data = get_sub_category($category);
		$html = "<select id='sub_category' name='sub_category_id' placeholder='Select a Sub Category ' class='demo-chosen-select'><option value=''>Select Sub Category</option>";
		foreach($sub_category_data as $sc_data){
			$sub_category_id = $sc_data['sub_category_id'];
			$sub_category_name = $sc_data['sub_category_name'];
			$html .= "<option value='$sub_category_id' >$sub_category_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	function our_range_view(){
		$our_range_id = @$_GET['or_i'];
		$our_range_token = @$_GET['or_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('our_range')) {
				redirect(base_url() . 'admin');
			}
			$page_data['our_range_data'] = $this->our_range_model->get_our_range_details($our_range_id,$our_range_token);
			$page_data['our_range_id'] = $our_range_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "our_range_master/our_range/our_range_view";
            $page_data['page_name_link'] = "our_range";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	} 
	
}