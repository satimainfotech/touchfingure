<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once 'vendor/autoload.php';
use Mpdf\Mpdf; // Import MPDF
class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->load->model('user_model');
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
			$member_type = @$_GET['member_type'];
			$name = @$_GET['name'];
			$mobile = @$_GET['mobile'];
			
			$data['member_type'] = $member_type;
			$data['name'] = $name;
			$data['mobile'] = $mobile;
			
			if($member_type != '' || $name != '' || $mobile != '' ){
				$searchurl='?member_type='.$member_type.'&name='.$name.'&mobile='.$mobile;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->user_model->get_total_user_data_count($member_type,$name,$mobile);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/abdaily/user".$searchurl;
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
			
			$data['all_user'] = $this->user_model->get_total_user_data($member_type,$name,$mobile,$config["per_page"],$page);
			
			$data["links"] = $this->pagination->create_links();
			$data["category_data"] = get_category();
			$data["brand_data"] = get_brand();
			$data["our_range_data"] = get_our_range();
			$data["city_data"] = get_city();
			$data["member_type_data"] = get_member_type();
			
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "user/user/user";
            $data['page_name_link'] = "user";
            $this->load->view('back/abdaily/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	function user_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$product_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			$page_data['product_name'] = $product_name;
			$page_data['brand'] = $brand;
			$page_data['our_range'] = $our_range;
			$page_data["category_data"] = get_category();
			$page_data["member_type_data"] = get_member_type();
			$page_data["country_data"] = get_all_country();
			
			$data['blood_data'] = $this->db->order_by('blood_position','asc')->get_where('blood_master',array('blood_status'=>'Active'))->result_array();
			
			$page_data['page_id'] = $page_id;
			$page_data["brand_data"] = get_brand();
			$page_data["city_data"] = get_city();
			$page_data["our_range_data"] = get_our_range();
			$data["city_data"] = get_city();
		    $page_data['page_name'] = "user/user/user_add";
            $page_data['page_name_link'] = "user";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function user_added($para1 = '', $para2 = '', $para3 = ''){
		/*$length1= 50;
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
		
		
		$data['user_token'] = $token;
		$data['member_type_id'] = $this->input->post('member_type_id');
		$data['member_type_name'] = get_field_id_name('member_type','member_type_id','member_type_name',$this->input->post('member_type_id'));		
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile');
		$data['password'] = $this->input->post('password');
		$data['address'] = $this->input->post('address');
		$data['adharcard'] = $this->input->post('adharcard');
		$data['pancard'] = $this->input->post('pancard');
		
		$profile_main_images = $_FILES['profile_main_images']['name'];
		if($profile_main_images != ''){
			$profileext = pathinfo($profile_main_images, PATHINFO_EXTENSION);
			
			$profileuploadedFile = $_FILES['profile_main_images']['tmp_name']; 
			$profiledirPath = "uploads/abdaily_profile_images/";
			$profilenewFileName = $otp2."_profile_main_images";
			
			if (!file_exists($profiledirPath)) {
			mkdir($profiledirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($profiledirPath, 0777);
			
			if(move_uploaded_file($profileuploadedFile, $profiledirPath. $profilenewFileName. ".". $profileext)){
				$data['profile_image'] = $otp2.'_profile_main_images.'.$profileext;
			}
			
		}
			
		$adharcard_main_images = $_FILES['adharcard_main_images']['name'];
		if($adharcard_main_images != ''){
			$adharcardext = pathinfo($adharcard_main_images, PATHINFO_EXTENSION);
			
			$adharuploadedFile = $_FILES['adharcard_main_images']['tmp_name']; 
			$adhardirPath = "uploads/abdaily_adharcard_images/";
			$adharnewFileName = $otp2."_adharcard_main_images";
			if (!file_exists($adhardirPath)) {
			mkdir($adhardirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($adhardirPath, 0777);
			
			if(move_uploaded_file($adharuploadedFile, $adhardirPath. $adharnewFileName. ".". $adharcardext)){
				$data['adharcard_image'] = $otp2.'_adharcard_main_images.'.$adharcardext;
			}
		}
		$pancard_main_images = $_FILES['pancard_main_images']['name'];
		if($pancard_main_images != ''){
			$pancardext = pathinfo($pancard_main_images, PATHINFO_EXTENSION);
			
			$pancarduploadedFile = $_FILES['pancard_main_images']['tmp_name']; 
			$pancarddirPath = "uploads/abdaily_pancard_images/";
			$pancardnewFileName = $otp2."_pancard_main_images";
			if (!file_exists($pancarddirPath)) {
			mkdir($pancarddirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($pancarddirPath, 0777);
			
			
			if(move_uploaded_file($pancarduploadedFile, $pancarddirPath. $pancardnewFileName. ".". $pancardext)){
				$data['pancard_image'] = $otp2.'_pancard_main_images.'.$pancardext;
			}
		}
		
		
		$data['status'] = 'active';
		$data['created_date'] = date('Y-m-d H:i:s');
		$this->db->insert('user', $data);*/
		
		
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
		
		
		$data['user_token'] = $token;
		$data['member_type_id'] = $this->input->post('member_type_id');
		$data['member_type_name'] = get_field_id_name('member_type','member_type_id','member_type_name',$this->input->post('member_type_id'));	
		$data['gender'] = $this->input->post('gender');
		$data['police_station_name'] = $this->input->post('police_station_name');
						
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile');
		$data['password'] = $this->input->post('password');
		$data['address'] = $this->input->post('address');
		$data['adharcard'] = $this->input->post('adharcard');
		$data['pancard'] = $this->input->post('pancard');
		
		$profile_main_images = $_FILES['profile_main_images']['name'];
		if($profile_main_images != ''){
			$profileext = pathinfo($profile_main_images, PATHINFO_EXTENSION);
			
			$profileuploadedFile = $_FILES['profile_main_images']['tmp_name']; 
			$profiledirPath = "uploads/abdaily_profile_images/";
			$profilenewFileName = $otp2."_profile_main_images";
			
			if (!file_exists($profiledirPath)) {
			mkdir($profiledirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($profiledirPath, 0777);
			
			if(move_uploaded_file($profileuploadedFile, $profiledirPath. $profilenewFileName. ".". $profileext)){
				$data['profile_image'] = $otp2.'_profile_main_images.'.$profileext;
			}
			
		}
			
		$adharcard_main_images = $_FILES['adharcard_main_images']['name'];
		if($adharcard_main_images != ''){
			$adharcardext = pathinfo($adharcard_main_images, PATHINFO_EXTENSION);
			
			$adharuploadedFile = $_FILES['adharcard_main_images']['tmp_name']; 
			$adhardirPath = "uploads/abdaily_adharcard_images/";
			$adharnewFileName = $otp2."_adharcard_main_images";
			if (!file_exists($adhardirPath)) {
			mkdir($adhardirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($adhardirPath, 0777);
			
			if(move_uploaded_file($adharuploadedFile, $adhardirPath. $adharnewFileName. ".". $adharcardext)){
				$data['adharcard_image'] = $otp2.'_adharcard_main_images.'.$adharcardext;
			}
		}
		$pancard_main_images = $_FILES['pancard_main_images']['name'];
		if($pancard_main_images != ''){
			$pancardext = pathinfo($pancard_main_images, PATHINFO_EXTENSION);
			
			$pancarduploadedFile = $_FILES['pancard_main_images']['tmp_name']; 
			$pancarddirPath = "uploads/abdaily_pancard_images/";
			$pancardnewFileName = $otp2."_pancard_main_images";
			if (!file_exists($pancarddirPath)) {
			mkdir($pancarddirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($pancarddirPath, 0777);
			
			
			if(move_uploaded_file($pancarduploadedFile, $pancarddirPath. $pancardnewFileName. ".". $pancardext)){
				$data['pancard_image'] = $otp2.'_pancard_main_images.'.$pancardext;
			}
		}
		
		
		$data['status'] = 'deactive';
		$data['created_date'] = date('Y-m-d H:i:s');
		$data['country'] = $this->input->post('country');
		$data['state'] = $this->input->post('state');
		$data['division'] = $this->input->post('division');
		$data['district'] = $this->input->post('district');
		$data['taluka'] = $this->input->post('taluka');
		$data['gram_panchayat'] = $this->input->post('gram_panchayat');
		$data['area'] = $this->input->post('area');
		$data['payment_mode'] = $this->input->post('payment_mode');
		$data['fees'] = $this->input->post('fees');
		$data['blood_group'] = $this->input->post('blood_group');
		$this->db->insert('user', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function user_edit(){
		
		$user_id = @$_GET['p_i'];
		$user_token = @$_GET['p_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('user')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$product_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			$page_data['product_name'] = $product_name;
			$page_data['brand'] = $brand;
			$page_data['our_range'] = $our_range;
			$page_data["category_data"] = get_category();
			$page_data["brand_data"] = get_brand();
			$page_data["our_range_data"] = get_our_range();
			$page_data["member_type_data"] = get_member_type();
			$page_data['user_data'] = $this->user_model->get_user_edit_details($user_id,$user_token);
			$page_data['user_id'] = $user_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "user/user/user_edit";
            $page_data['page_name_link'] = "user";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function user_update($para1 = '', $para2 = '', $para3 = ''){
		$length = 6;
		$characters = '01234567899876543210';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$otp2 = $randomString;
		
		$data['user_token'] = $token;
		$data['member_type_id'] = $this->input->post('member_type_id');
		$data['member_type_name'] = get_field_id_name('member_type','member_type_id','member_type_name',$this->input->post('member_type_id'));		
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		$data['mobile'] = $this->input->post('mobile');
		$data['password'] = $this->input->post('password');
		$data['address'] = $this->input->post('address');
		$data['adharcard'] = $this->input->post('adharcard');
		$data['pancard'] = $this->input->post('pancard');
		
		$profile_main_images = $_FILES['profile_main_images']['name'];
		if($profile_main_images != ''){
			$profileext = pathinfo($profile_main_images, PATHINFO_EXTENSION);
			
			$profileuploadedFile = $_FILES['profile_main_images']['tmp_name']; 
			$profiledirPath = "uploads/abdaily_profile_images/";
			$profilenewFileName = $otp2."_profile_main_images";
			
			if (!file_exists($profiledirPath)) {
			mkdir($profiledirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($profiledirPath, 0777);
			
			if(move_uploaded_file($profileuploadedFile, $profiledirPath. $profilenewFileName. ".". $profileext)){
				$data['profile_image'] = $otp2.'_profile_main_images.'.$profileext;
			}
			
		}
			
		$adharcard_main_images = $_FILES['adharcard_main_images']['name'];
		if($adharcard_main_images != ''){
			$adharcardext = pathinfo($adharcard_main_images, PATHINFO_EXTENSION);
			
			$adharuploadedFile = $_FILES['adharcard_main_images']['tmp_name']; 
			$adhardirPath = "uploads/abdaily_adharcard_images/";
			$adharnewFileName = $otp2."_adharcard_main_images";
			if (!file_exists($adhardirPath)) {
			mkdir($adhardirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($adhardirPath, 0777);
			
			if(move_uploaded_file($adharuploadedFile, $adhardirPath. $adharnewFileName. ".". $adharcardext)){
				$data['adharcard_image'] = $otp2.'_adharcard_main_images.'.$adharcardext;
			}
		}
		$pancard_main_images = $_FILES['pancard_main_images']['name'];
		if($pancard_main_images != ''){
			$pancardext = pathinfo($pancard_main_images, PATHINFO_EXTENSION);
			
			$pancarduploadedFile = $_FILES['pancard_main_images']['tmp_name']; 
			$pancarddirPath = "uploads/abdaily_pancard_images/";
			$pancardnewFileName = $otp2."_pancard_main_images";
			if (!file_exists($pancarddirPath)) {
			mkdir($pancarddirPath, 0777, true); // Create the directory with 0777 permissions
			}
			chmod($pancarddirPath, 0777);
			
			
			if(move_uploaded_file($pancarduploadedFile, $pancarddirPath. $pancardnewFileName. ".". $pancardext)){
				$data['pancard_image'] = $otp2.'_pancard_main_images.'.$pancardext;
			}
		}
			
		$this->db->where('id', $para1);
		$this->db->update('user', $data);
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			
			echo 'done';
		}
	}
	
	function users($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
			$id = $this->input->post('id');
           // $this->crud_model->file_dlt('user', $id, '.jpg', 'multi');
            $data['status'] = 'delete';
            $this->db->where('id', $id);
            $this->db->update('user',$data);
        } else if ($para1 == 'dlt_img') {
            $a = explode('_', $para2);
            $this->crud_model->file_dlt('user', $a[0], '.jpg', 'multi', $a[1]);
        } else if ($para1 == 'status_set') {
            $user_id = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'active';
            } else {
                $data['status'] = 'deactive';
            }
            $this->db->where('id', $user_id);
            $this->db->update('user', $data);
		}
    }
	
	
	
	function user_view(){
		$user_id = @$_GET['p_i'];
		$user_token = @$_GET['p_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('user')) {
				redirect(base_url() . 'admin');
			}
			$category = @$_GET['c_i'];
			$sub_category = @$_GET['s_c_i'];
			$product_name = @$_GET['p_n'];
			$brand = @$_GET['b_i'];
			$our_range = @$_GET['or_i'];
			
			$page_data['category'] = $category;
			$page_data['sub_category'] = $sub_category;
			$page_data['product_name'] = $product_name;
			$page_data['brand'] = $brand;
			$page_data['our_range'] = $our_range;
			
			$page_data['user_data'] = $this->user_model->get_user_details($user_id,$user_token);
			$page_data['user_id'] = $user_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "user/user/user_view";
            $page_data['page_name_link'] = "user";
            $this->load->view('back/abdaily/index', $page_data);
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

		$product_data = $this->user_model->get_exal_product();

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
	
		
		public function letter()
		{	
			$user_id = @$_GET['p_i'];
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] =  $login_data->result_array();
			$data['user_detail'] = $data['user_detail'][0];		
			$html = $this->load->view('back/user/letter_pdf', $data, TRUE);		
			$filename = $user_id;
			$name = $data['user_detail']['name'];
			$mpdf = new \Mpdf\Mpdf([
			'default_font' => 'shruti'
			]);
			// Define the font data
			$mpdf->fontdata['shruti'] = [
			'R' => 'shruti.ttf',     // Regular
			'B' => __DIR__ . '/fonts/shrutib.ttf',    // Bold
			// Add other styles if needed
			];
			// Ensure paths to font files are correct
			$mpdf->autoScriptToLang = true;
			$mpdf->autoLangToFont = true;
			$mpdf->WriteHTML($html);		
			$mpdf->Output($name.'_'.$filename."_letter.pdf",'D');
			exit;
		} 


		public function idcard()
		{	
			$user_id = @$_GET['p_i'];
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] =  $login_data->result_array();
			$data['user_detail'] = $data['user_detail'][0];
			$html = $this->load->view('back/user/idcard_pdf', $data, TRUE);
			$filename = $data['user_detail']['id'];
			$name = $data['user_detail']['name'];
			$mpdf = new \Mpdf\Mpdf([
			'default_font' => 'shruti'
			]);
			// Define the font data
			$mpdf->fontdata['shruti'] = [
			'R' => 'shruti.ttf',     // Regular
			'B' => __DIR__ . '/fonts/shrutib.ttf',    // Bold
			// Add other styles if needed
			];
			// Ensure paths to font files are correct
			
			$mpdf->autoScriptToLang = true;
			$mpdf->autoLangToFont = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output($name.'_'.$filename."_idcard.pdf",'D');
			exit;
		} 
	public function visitingcard()
		{	
			$user_id = $this->input->get('p_i');
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] = $login_data->row_array(); 		
			$this->load->view('back/user/visitingcard_pdf', $data);			
		} 
		public function congratulations()
		{

			$user_id = $this->input->get('p_i');
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] = $login_data->row_array();   
			$this->load->view('back/user/congratulations_pdf', $data);
		}
	public function payment_receipt()
		{
			$user_id = $this->input->get('p_i');
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] = $login_data->row_array(); 
			$member_fees = $this->db->get_where('member_type', array('member_type_id' => $data['user_detail']['member_type_id']))->row_array(); 	
			$data['user_detail']['fees'] = $member_fees['fees'];
			$data['user_detail']['fees_word'] = number_to_words($member_fees['fees']);
			$data['user_detail']['name'] =$this->session->userdata('admin_name');
			
			$payment_receipt_data = $this->db->get_where('payment_receipt', array('payment_receipt_id' => '1'));
			$data['payment_receipt_details'] = $payment_receipt_data->row_array(); 
			
			$this->load->view('back/user/payment_receipt_pdf', $data);
		}
		
		public function certificate()
		{
			$user_id = $this->input->get('p_i');
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] = $login_data->row_array();   
			$this->load->view('back/user/certificate_pdf', $data);
		}
		public function appointment_letter()
		{
			$user_id = $this->input->get('p_i');
			$login_data = $this->db->get_where('user', array('id' => $user_id));
			$data['user_detail'] = $login_data->row_array();   
			$this->load->view('back/user/appointment_letter_pdf', $data);
		}
		
		
		public function get_state(){
		$country = $this->input->post('country');
		$state_data = $this->db->get_where('state',array('country_id'=>$country,'state_status'=>'active'))->result_array();
		$html = '<option value="0" >Select State</option>';
		foreach($state_data as $state_row){
			$state_id = $state_row['state_id'];
			$state_name = $state_row['state_name'];
			$html .= "<option value='$state_id' selected >$state_name</option>";
		}	
		echo $html;
	}
	
	public function get_division(){
		$state = $this->input->post('state');
		$division_data = $this->db->get_where('division',array('state_id'=>$state,'division_status'=>'active'))->result_array();
		$html = '<option value="0" >Select Division</option>';
		foreach($division_data as $division_row){
			$division_id = $division_row['division_id'];
			$division_name = $division_row['division_name'];
			$html .= "<option value='$division_id' >$division_name</option>";
		}	
		echo $html;
	}
	public function get_district(){
		$division = $this->input->post('division');
		$district_data = $this->db->get_where('district',array('division_id'=>$division,'district_status'=>'active'))->result_array();
		$html = '<option value="0" >Select District</option>';
		foreach($district_data as $district_row){
			$district_id = $district_row['district_id'];
			$district_name = $district_row['district_name'];
			$html .= "<option value='$district_id' >$district_name</option>";
		}	
		echo $html;
	}
	public function get_district_m(){
		$division = $this->input->post('division');
		$district_data = $this->db->get_where('district_m',array('division_id'=>$division,'district_m_status'=>'active'))->result_array();
		$html = '<option value="0" >Select District-M</option>';
		foreach($district_data as $district_row){
			$district_id = $district_row['district_m_id'];
			$district_name = $district_row['district_m_name'];
			$html .= "<option value='$district_id' >$district_name</option>";
		}	
		echo $html;
	}
	
	
	
	public function get_taluka(){
		$district = $this->input->post('district');
		$taluka_data = $this->db->get_where('taluka',array('district_id'=>$district,'taluka_status'=>'active'))->result_array();
		$html = '<option value="0" >Select Taluka</option>';
		foreach($taluka_data as $taluka_row){
			$taluka_id = $taluka_row['taluka_id'];
			$taluka_name = $taluka_row['taluka_name'];
			$html .= "<option value='$taluka_id' >$taluka_name</option>";
		}	
		echo $html;
	}
	public function get_taluka_m(){
		$district = $this->input->post('district');
		$taluka_data = $this->db->get_where('taluka_m',array('district_id'=>$district,'taluka_m_status'=>'active'))->result_array();
		$html = '<option value="0" >Select Taluka-M</option>';
		foreach($taluka_data as $taluka_row){
			$taluka_id = $taluka_row['taluka_m_id'];
			$taluka_name = $taluka_row['taluka_m_name'];
			$html .= "<option value='$taluka_id' >$taluka_name</option>";
		}	
		echo $html;
	}
	public function get_gram_panchayat(){
		$taluka = $this->input->post('taluka');
		$gram_panchayat_data = $this->db->get_where('gram_panchayat',array('taluka_id'=>$taluka,'gram_panchayat_status'=>'active'))->result_array();
		$html = '<option value="0" >Select Gram Panchayat</option>';
		foreach($gram_panchayat_data as $gram_panchayat_row){
			$gram_panchayat_id = $gram_panchayat_row['gram_panchayat_id'];
			$gram_panchayat_name = $gram_panchayat_row['gram_panchayat_name'];
			$html .= "<option value='$gram_panchayat_id' >$gram_panchayat_name</option>";
		}	
		echo $html;
	}
	public function get_area(){
		$taluka = $this->input->post('taluka');
		$area_data = $this->db->get_where('area',array('taluka_m_id'=>$taluka,'area_status'=>'active'))->result_array();
		$html = '<option value="0" >Select Area</option>';
		foreach($area_data as $area_row){
			$area_id = $area_row['area_id'];
			$area_name = $area_row['area_name'];
			$html .= "<option value='$area_id' >$area_name</option>";
		}	
		echo $html;
	}

	
}