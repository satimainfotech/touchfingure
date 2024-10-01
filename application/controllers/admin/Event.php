<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Event extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('event_model');
        $this->load->model('product_model');
    }
    
    /* Dashboard */
	public function index()
    {     
        
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('product')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->excel_export();
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$event_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$data['category'] = $category;
			$data['sub_category'] = $sub_category;
			$data['event_name'] = $event_name;
			$data['brand'] = $brand;
			$data['our_range'] = $our_range;
			
			if($category != '' || $sub_category != '' || $event_name != '' || $brand != '' || $our_range != ''){
				$searchurl='?c_i='.$category.'&s_c_i='.$sub_category.'&b_i='.$brand.'&or_i='.$our_range.'&p_n='.$event_name;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->event_model->get_total_event_data_count($category,$sub_category,$event_name,$brand,$our_range);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/event".$searchurl;
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
			
			$data['all_event'] = $this->event_model->get_total_event_data($category,$sub_category,$event_name,$brand,$our_range,$config["per_page"],$page);
			
			
			$data["links"] = $this->pagination->create_links();
			$data["category_data"] = get_category();
			$data["brand_data"] = get_brand();
			$data["our_range_data"] = get_our_range();
			$data["city_data"] = get_city();
			
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "product_master/event/event";
            $data['page_name_link'] = "event";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	function event_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$event_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			$page_data['event_name'] = $event_name;
			$page_data['brand'] = $brand;
			$page_data['our_range'] = $our_range;
			$page_data["category_data"] = get_category();
			$page_data['page_id'] = $page_id;
			$page_data["brand_data"] = get_brand();
			$page_data["city_data"] = get_city();
			$page_data["our_range_data"] = get_our_range();
			$data["city_data"] = get_city();
		    $page_data['page_name'] = "product_master/event/event_add";
            $page_data['page_name_link'] = "event";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function event_added($para1 = '', $para2 = '', $para3 = ''){
		
		
		
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
		
		$data['event_name'] = $this->input->post('event_name');
		
		$main_title = $data['event_name'];
		$final_main_title = str_replace(' ', '-', strtolower($main_title));
		
		$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
		
		$data['event_slug'] = $final_main_title2;
		$data['event_token'] = $token;
		//$data['category_id'] = $this->input->post('category_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['start_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');
		$data['address'] = $this->input->post('address');
		$data['description'] = $this->input->post('description');
		$data['event_time'] = $this->input->post('event_time');
		
		$event_main_images = $_FILES['event_main_images']['name'];
		if($event_main_images != ''){
			$ext = pathinfo($event_main_images, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['event_main_images']['tmp_name']; 
			$dirPath = "uploads/event_main_images/";
			$newFileName = $otp2."_p_main_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['main_event_image'] = $otp2.'_p_main_image.'.$ext;
			}
		}
		
		$event_main_pass = $_FILES['event_pass']['name'];
		if($event_main_pass != ''){
			$ext = pathinfo($event_main_pass, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['event_pass']['tmp_name']; 
			$dirPath = "uploads/event_pass/";
			$newFileName = $otp2."_p_pass_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['event_pass'] = $otp2.'_p_pass_image.'.$ext;
			}
		}
			
		
		
		$data['status'] = 'Active';
		$data['created_date'] = date('Y-m-d');
		$this->db->insert('event', $data);
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function event_edit(){
		$event_id = @$_GET['p_i'];
		$event_token = @$_GET['p_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$event_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			$page_data['event_name'] = $event_name;
			$page_data['brand'] = $brand;
			$page_data['our_range'] = $our_range;
			$page_data["category_data"] = get_category();
			$page_data["brand_data"] = get_brand();
			$page_data["our_range_data"] = get_our_range();
			$page_data["city_data"] = get_city();
			$page_data['event_data'] = $this->event_model->get_event_edit_details($event_id,$event_token);
			
			
			$page_data['event_id'] = $event_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/event/event_edit";
            $page_data['page_name_link'] = "event";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function event_update($para1 = '', $para2 = '', $para3 = ''){
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
		
		$data['event_name'] = $this->input->post('event_name');
		
		$main_title = $data['event_name'];
		$final_main_title = str_replace(' ', '-', strtolower($main_title));
		
		$final_main_title2 = str_replace('_', '-', strtolower($final_main_title));
		
		$data['event_slug'] = $final_main_title2;
		$data['event_token'] = $token;
		//$data['category_id'] = $this->input->post('category_id');
		$data['city_id'] = $this->input->post('city_id');
		$data['start_date'] = $this->input->post('start_date');
		$data['end_date'] = $this->input->post('end_date');
		$data['address'] = $this->input->post('address');
		$data['description'] = $this->input->post('description');
		$data['event_time'] = $this->input->post('event_time');
		
	
		
		$event_main_images = $_FILES['event_main_images']['name'];
		if($event_main_images != ''){
			
			$main_event_image = @$this->db->get_where('event',array('event_id'=>$para1))->row()->main_event_image;
			if($main_event_image != ''){
				$rpersonal = "uploads/event_main_images/".$main_event_image;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($main_event_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['event_main_images']['tmp_name']; 
			$dirPath = "uploads/event_main_images/";
			$newFileName = $otp2."_p_main_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['main_event_image'] = $otp2.'_p_main_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
		
		$event_pass = $_FILES['event_pass']['name'];
		if($event_pass != ''){
			
			$main_pass_image = @$this->db->get_where('event',array('event_id'=>$para1))->row()->event_pass;
			if($event_pass != ''){
				$rpersonal = "uploads/event_pass/".$main_pass_image;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$ext = pathinfo($main_pass_image, PATHINFO_EXTENSION);			
			$uploadedFile = $_FILES['event_pass']['tmp_name']; 
			$dirPath = "uploads/event_pass/";
			$newFileName = $otp2."_p_pass_image";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['event_pass'] = $otp2.'_p_pass_image.'.$ext;
			}else{
				$op_name = "";
			}
		}
					
		$this->db->where('event_id', $para1);
		$this->db->update('event', $data);
		
		//echo $this->db->last_query();die;
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			
			echo 'done';
		}
	}
	
	function events($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
			$id = $this->input->post('id');
            $this->crud_model->file_dlt('event', $id, '.jpg', 'multi');
            $data['status'] = 'delete';
            $this->db->where('event_id', $id);
            $this->db->update('event',$data);
        } else if ($para1 == 'dlt_img') {
            $a = explode('_', $para2);
            $this->crud_model->file_dlt('event', $a[0], '.jpg', 'multi', $a[1]);
        } else if ($para1 == 'status_set') {
            $event = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'Active';
            } else {
                $data['status'] = 'De-active';
            }
            $this->db->where('event_id', $event);
            $this->db->update('event', $data);
		}
		else if ($para1 == 'reminder_status_set') {
            $event = $para2;
            if ($para3 == 'true') {
                $data['reminder_status'] = 'Active';
            } else {
                $data['reminder_status'] = 'De-active';
            }
            $this->db->where('event_id', $event);
            $this->db->update('event', $data);
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
	
	function event_view(){
		$event_id = @$_GET['p_i'];
		$event_token = @$_GET['p_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$event_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			$page_data['event_name'] = $event_name;
			$page_data['brand'] = $brand;
			$page_data['our_range'] = $our_range;
			
			$page_data['event_data'] = $this->event_model->get_event_details($event_id,$event_token);
			$page_data['event_id'] = $event_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/event/event_view";
            $page_data['page_name_link'] = "event";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	} 
	
	public function excel_export()
	{
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("No.", "Product id", "Name" , "Category", "Sub Category", "Sale qty", "Sale unit", "Status", "Description", "Disclaimer", "Storage tip");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$product_data = $this->event_model->get_exal_product();

		$excel_row = 2;
		$r = 1;
		foreach($product_data as $row)
		{
			$category = $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name');
			$sub_category = $this->crud_model->get_type_name_by_id('sub_category',$row['sub_category'],'sub_category_name');
			if($row['status'] == 'ok'){ $status = "Active"; } else { $status = "De-active"; }
			
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $r++);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['product_id']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['title']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['category_name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['sub_category_name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['sale_unit_qty']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['unit_name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $status);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['description']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['disclaimer']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['storage_tip']);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Products.xls"');
		$object_writer->save('php://output');
	}
	
	public function get_search_sub_category_data(){
		$category = $this->input->post('category');
		$sub_category_data = get_search_sub_category($category);
		$html = "<select id='sub_category' name='s_c_i' placeholder='Select a Sub Category ' class='demo-chosen-select'><option value=''>Select Sub Category</option>";
		foreach($sub_category_data as $sc_data){
			$sub_category_id = $sc_data['sub_category_id'];
			$sub_category_name = $sc_data['sub_category_name'];
			$html .= "<option value='$sub_category_id' >$sub_category_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
   
}