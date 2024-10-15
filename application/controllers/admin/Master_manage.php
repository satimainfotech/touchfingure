<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Master_manage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('master_manage_model');
	}
  
    /* Country add, edit, view, delete */
	public function country()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('country')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->country_excel_export();
			}
			$country = @$_GET['c_n'];
			
			$data['country'] = $country;
			
			if($country != ''){
				$searchurl='?c_n='.$country;
			}else{
				$searchurl='';
			}
			
			
			$count_data = $this->master_manage_model->get_total_country_data_count($country);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/master_manage/country".$searchurl;
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
			
			$data['all_country'] = $this->master_manage_model->get_total_country_data($country,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "master/country";
            $data['page_name_link'] = "country";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function country_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('country_add')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_n'];
			$page_data['country'] = $country;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/country_add";
            $page_data['page_name_link'] = "country";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function country_edit(){
		$country_id = @$_GET['c_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('country_edit')) {
				redirect(base_url() . 'mind1992gameadmin');
			}
			$country = @$_GET['c_n'];
			$page_data['country'] = $country;
			
			$page_data['country_data'] = $this->master_manage_model->get_country_details($country_id);
			$page_data['country_id'] = $country_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/country_edit";
            $page_data['page_name_link'] = "country";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function country_view(){
		$country_id = @$_GET['c_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('country_view')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_n'];
			$page_data['country'] = $country;
			
			$page_data['country_data'] = $this->master_manage_model->get_country_details($country_id);
			$page_data['country_id'] = $country_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/country_view";
            $page_data['page_name_link'] = "country";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function country_added($para1 = '', $para2 = '', $para3 = ''){
		$data['country_name'] = $this->input->post('country_name');
		$data['country_status'] = 'active';
		$this->db->insert('country', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
			$country_name = $data['country_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has added new Material ".$country_name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']= $id; 
			$this->db->insert('logs',$datanui);

		}
	}
	
	function country_update($para1 = '', $para2 = '', $para3 = ''){
		$data['country_name'] = $this->input->post('country_name');
		$this->db->where('country_id', $para1);
		$this->db->update('country', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
			$country_name = $data['country_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has updated Material name ".$country_name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']=  $para1; 
			$this->db->insert('logs',$datanui);
		}
	}
	
    function countrys($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('country')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$data['country_status'] = 'delete';
            $this->db->where('country_id', $para2);
			$this->db->update('country', $data);

			$resultdata = $this->db->select('country_name')->get_where('country',array('country_id'=>$para2))->result_array();

			$country_name = $resultdata[0]['country_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has deleted Material ".@$country_name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']=  $para2; 
			$this->db->insert('logs',$datanui);


        }else if ($para1 == 'approval_set') {
            $country = $para2;
			if ($para3 == 'true') {
                $data['country_status'] = 'active';
            } else {
                $data['country_status'] = 'de-active';
            }
            $this->db->where('country_id', $country);
            $this->db->update('country', $data);
        }
    }

	/* Country add, edit, view, delete */
	public function process_master()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('process_master')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->country_excel_export();
			}
			$country = @$_GET['c_n'];
			
			$data['country'] = $country;
			
			if($country != ''){
				$searchurl='?c_n='.$country;
			}else{
				$searchurl='';
			}
			
			
			$count_data = $this->master_manage_model->get_total_pm_data_count($country);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/master_manage/process_master".$searchurl;
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
			
			$data['all_country'] = $this->master_manage_model->get_total_pm_data($country,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "master/process_master";
            $data['page_name_link'] = "Process Master";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function pm_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('pm_add')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_n'];
			$page_data['country'] = $country;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/pm_add";
            $page_data['page_name_link'] = "Process Master";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function pm_edit(){
		$country_id = @$_GET['c_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('pm_edit')) {
				redirect(base_url() . 'mind1992gameadmin');
			}
			$country = @$_GET['c_n'];
			$page_data['country'] = $country;
			
			$page_data['country_data'] = $this->master_manage_model->get_pm_details($country_id);
			$page_data['country_id'] = $country_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/pm_edit";
            $page_data['page_name_link'] = "Process Master";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function pm_added($para1 = '', $para2 = '', $para3 = ''){
		$data['pm_name'] = $this->input->post('country_name');
		$data['pm_status'] = 'active';
		$this->db->insert('process_master', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';

			$name = $data['pm_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has added new process ".$name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']= $id; 
			$this->db->insert('logs',$datanui);
		}
	}
	
	function pm_update($para1 = '', $para2 = '', $para3 = ''){
		$data['pm_name'] = $this->input->post('country_name');
		$this->db->where('process_master_id', $para1);
		$this->db->update('process_master', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
			
		$name = $data['pm_name'];
		$pm_status =$data['pm_status'];
		$datanui['notification_user_id']= $_SESSION['admin_id'];
		$datanui['notification_content']= $_SESSION['admin_name']." has updated process ".$name;
		$datanui['notification_read']= 1;
		$datanui['created_by']= $_SESSION['admin_id'];
		$datanui['created_date']= date('Y-m-d H:i:s'); 
		$datanui['order_id']= $id; 
		$this->db->insert('logs',$datanui);

		}
	}
	
    function pms($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('process_master')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$data['pm_status'] = 'delete';
            $this->db->where('process_master_id', $para2);
			$this->db->update('process_master', $data);
			$resultdata = $this->db->select('pm_name')->get_where('process_master',array('process_master_id'=>$para2))->result_array();

			$name = $resultdata[0]['pm_name'];
			$pm_status =$data['pm_status'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has ".$pm_status." process ".$name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']= $id; 
			$this->db->insert('logs',$datanui);
        }else if ($para1 == 'approval_set') {
            $country = $para2;
			if ($para3 == 'true') {
                $data['pm_status'] = 'active';
            } else {
                $data['pm_status'] = 'de-active';
            }
            $this->db->where('process_master_id', $country);
            $this->db->update('process_master', $data);
        }
    }
	
	/* state add, edit, view, delete */
	public function state()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('state')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->state_excel_export();
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_n'];
			
			
			$data['country'] = $country;
			$data['state'] = $state;
			
			if($country != ''){
				$searchurl='?c_i='.$country.'&s_n='.$state;
			}else{
				$searchurl='';
			}
			
			
			$count_data = $this->master_manage_model->get_total_state_data_count($state,$country);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/master_manage/state".$searchurl;
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
			
			$data['all_state'] = $this->master_manage_model->get_total_state_data($state,$country,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_arows'] = $config["total_rows"];
			$data['country_data'] = get_all_country();
			$data['page_id'] = $page;
			$data['page_name'] = "master/state";
            $data['page_name_link'] = "state";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function state_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('state_add')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			
			$page_data['page_id'] = $page_id;
			$page_data['country_data'] = get_all_country();
            $page_data['page_name'] = "master/state_add";
            $page_data['page_name_link'] = "state";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function state_edit(){
		$state_id = @$_GET['s_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('state_edit')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			
			$page_data['state_data'] = $this->master_manage_model->get_edit_state_details($state_id);
			$page_data['state_id'] = $state_id;
			$page_data['page_id'] = $page_id;
			$page_data['country_data'] = get_all_country();
            $page_data['page_name'] = "master/state_edit";
            $page_data['page_name_link'] = "state";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	public function get_state_data(){
		$country_id = $this->input->post('country_id');
		$state_data = get_all_state($country_id);
		$html = "<select id='state' name='state' placeholder='Select a State ' class='demo-chosen-select required' onchange='select_state(this.value);'><option value=''>Select State</option>";
		foreach($state_data as $se_data){
			$state_id = $se_data['state_id'];
			$state_name = $se_data['state_name'];
			$html .= "<option value='$state_id' >$state_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_district_data(){
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		$district_data = get_all_district($country_id,$state_id);
		$html = "<select id='district' name='district' placeholder='Select a district ' class='demo-chosen-select required' onchange='select_district(this.value);'><option value=''>Select district</option>";
		foreach($district_data as $se_data){
			$district_id = $se_data['district_id'];
			$district_name = $se_data['district_name'];
			$html .= "<option value='$district_id' >$district_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_city_data(){
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		$district_id = $this->input->post('district_id');
		$city_data = get_all_city($country_id,$state_id,$district_id);
		$html = "<select id='city' name='city' placeholder='Select a City ' class='demo-chosen-select required' onchange='select_city(this.value);'><option value=''>Select City</option>";
		foreach($city_data as $se_data){
			$city_id = $se_data['city_id'];
			$city_name = $se_data['city_name'];
			$html .= "<option value='$city_id' >$city_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_area_data(){
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		$city_name = $this->input->post('city_name');
		$area_data = get_all_area($country_id,$state_id,$city_name);
		$html = "<select id='area' name='area' placeholder='Select a Area ' class='demo-chosen-select required'><option value=''>Select Area</option>";
		foreach($area_data as $se_data){
			$area_id = $se_data['area_id'];
			$area_name = $se_data['area_name'];
			$html .= "<option value='$area_id' >$area_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_search_state_data(){
		$country_id = $this->input->post('country_id');
		$state_data = get_all_state($country_id);
		$html = "<select id='state' name='s_i' placeholder='Select a State ' class='demo-chosen-select' onchange='select_state(this.value);'><option value=''>Select State</option>";
		foreach($state_data as $se_data){
			$state_id = $se_data['state_id'];
			$state_name = $se_data['state_name'];
			$html .= "<option value='$state_id' >$state_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_search_district_data(){
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		$district_data = get_all_district($country_id,$state_id);
		$html = "<select id='district' name='d_i' placeholder='Select a district ' class='demo-chosen-select' onchange='select_district(this.value);'><option value=''>Select district</option>";
		foreach($district_data as $se_data){
			$district_id = $se_data['district_id'];
			$district_name = $se_data['district_name'];
			$html .= "<option value='$district_id' >$district_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_search_city_data(){
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		$district_id = $this->input->post('district_id');
		$city_data = get_all_city($country_id,$state_id,$district_id);
		$html = "<select id='city' name='c_i' placeholder='Select a City ' class='demo-chosen-select' onchange='select_city(this.value);'><option value=''>Select City</option>";
		foreach($city_data as $se_data){
			$city_id = $se_data['city_id'];
			$city_name = $se_data['city_name'];
			$html .= "<option value='$city_id' >$city_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	public function get_search_area_data(){
		$country_id = $this->input->post('country_id');
		$state_id = $this->input->post('state_id');
		$city_id = $this->input->post('city_id');
		$area_data = get_all_area($country_id,$state_id,$city_id);
		$html = "<select id='area' name='a_i' placeholder='Select a Area ' class='demo-chosen-select'><option value=''>Select Area</option>";
		foreach($area_data as $se_data){
			$area_id = $se_data['area_id'];
			$area_name = $se_data['area_name'];
			$html .= "<option value='$area_id' >$area_name</option>";
		}
		$html .= "</select>
			<script> $('.demo-chosen-select').chosen();</script>";
		echo $html;
	}
	
	/* Area add, edit, view, delete */
	public function area()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('area')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->area_excel_export();
			}
			$taluka_m = @$_GET['c_i'];			
			$area = @$_GET['a_n'];
			
			
			$data['taluka_m'] = $taluka_m;			
			$data['area'] = $area;
			
			if($taluka_m != '' || $area != ''){
				$searchurl='?c_i='.$taluka_m.'&a_n='.$area;
			}else{
				$searchurl='';
			}
			
			
			$count_data = $this->master_manage_model->get_total_area_data_count($area,$taluka_m);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/master_manage/area".$searchurl;
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
			
			$data['all_area'] = $this->master_manage_model->get_total_area_data($area,$taluka_m,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_arows'] = $config["total_rows"];
			$data['taluka_m_data'] = get_all_taluka_m_data();
			$data['page_id'] = $page;
			$data['page_name'] = "master/area";
            $data['page_name_link'] = "area";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function area_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('area_add')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$district = @$_GET['d_i'];
			$city = @$_GET['ct_i'];
			$area = @$_GET['a_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			$page_data['district'] = $district;
			$page_data['city'] = $city;
			$page_data['area'] = $area;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/area_add";
			$page_data['taluka_m_data'] = get_all_taluka_m_data();
            $page_data['page_name_link'] = "area";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function area_edit(){
		$area_id = @$_GET['a_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('area_edit')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$district = @$_GET['d_i'];
			$city = @$_GET['ct_i'];
			$area = @$_GET['a_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			$page_data['district'] = $district;
			$page_data['city'] = $city;
			$page_data['area'] = $area;
			
			$page_data['area_data'] = $this->master_manage_model->get_edit_area_details($area_id);
			$page_data['area_id'] = $area_id;
			$page_data['page_id'] = $page_id;
			$page_data['taluka_m_data'] = get_all_taluka_m_data();
            $page_data['page_name'] = "master/area_edit";
            $page_data['page_name_link'] = "area";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function area_view(){
		$area_id = @$_GET['a_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('area_view')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$district = @$_GET['d_i'];
			$city = @$_GET['ct_i'];
			$area = @$_GET['a_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			$page_data['district'] = $district;
			$page_data['city'] = $city;
			$page_data['area'] = $area;
			
			$page_data['area_data'] = $this->master_manage_model->get_area_details($area_id);
			$page_data['area_id'] = $area_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/area_view";
            $page_data['page_name_link'] = "area";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function area_added($para1 = '', $para2 = '', $para3 = ''){
		$data['taluka_m_id'] = $this->input->post('taluka_m');
		$data['area_name'] = $this->input->post('area_name');
		$data['area_status'] = 'active';
		$this->db->insert('area', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function area_update($para1 = '', $para2 = '', $para3 = ''){
		$data['taluka_m_id'] = $this->input->post('taluka_m');
		$data['area_name'] = $this->input->post('area_name');
		$this->db->where('area_id', $para1);
		$this->db->update('area', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function areas($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('area')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$data['area_status'] = 'delete';
            $this->db->where('area_id', $para2);
			$this->db->update('area', $data);
        }else if ($para1 == 'approval_set') {
            $area = $para2;
			if ($para3 == 'true') {
                $data['area_status'] = 'active';
            } else {
                $data['area_status'] = 'de-active';
            }
            $this->db->where('area_id', $area);
            $this->db->update('area', $data);
        }else if ($para1 == 'get_states') {
		    echo $this->crud_model->select_name_html('state', 'state', 'state_id', 'add', 'demo-chosen-select required', '', 'country_id', $para2, '');
        } 
    }
    
    /* Country add, edit, view, delete */
	public function member_type()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('member_type')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->country_excel_export();
			}
			$member_type = @$_GET['c_n'];
			
			$data['member_type'] = $member_type;
			
			if($member_type != ''){
				$searchurl='?c_n='.$member_type;
			}else{
				$searchurl='';
			}
			
			
			$count_data = $this->master_manage_model->get_total_member_type_data_count($member_type);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/master_manage/member_type".$searchurl;
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
			
			$data['all_member_type'] = $this->master_manage_model->get_total_member_type_data($member_type,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "master/member_type";
            $data['page_name_link'] = "member_type";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function member_type_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('member_type_add')) {
				redirect(base_url() . 'admin');
			}
			$member_type = @$_GET['c_n'];
			$page_data['member_type'] = $member_type;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/member_type_add";
            $page_data['page_name_link'] = "member_type";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function member_type_edit(){
		$country_id = @$_GET['c_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('member_type_edit')) {
				redirect(base_url() . 'admin/');
			}
			$member_type = @$_GET['c_n'];
			$page_data['member_type'] = $member_type;
			
			$page_data['member_type_data'] = $this->master_manage_model->get_member_type_details($country_id);
			$page_data['country_id'] = $country_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/member_type_edit";
            $page_data['page_name_link'] = "member_type";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function member_type_view(){
		$member_type_id = @$_GET['c_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('member_type_view')) {
				redirect(base_url() . 'admin');
			}
			$member_type = @$_GET['c_n'];
			$page_data['member_type'] = $member_type;
			
			$page_data['member_type_data'] = $this->master_manage_model->get_member_type_details($member_type_id);
			$page_data['member_type_id'] = $member_type_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/member_type_view";
            $page_data['page_name_link'] = "member_type";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function member_type_added($para1 = '', $para2 = '', $para3 = ''){
		$data['member_type_name'] = $this->input->post('member_type_name');
			$data['fees'] = $this->input->post('fees');
		$data['member_type_status'] = 'active';
		$this->db->insert('member_type', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';

			$name = $data['member_type_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has added new Models ".@$name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']=  $id; 
			$this->db->insert('logs',$datanui);


		}
	}
	
	function member_type_update($para1 = '', $para2 = '', $para3 = ''){
		$data['member_type_name'] = $this->input->post('member_type_name');
			$data['fees'] = $this->input->post('fees');
		$this->db->where('member_type_id', $para1);
		$this->db->update('member_type', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';

			$name = $data['member_type_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has added updated Models ".@$name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']=  $id; 
			$this->db->insert('logs',$datanui);
		}
	}
	
    function member_types($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('member_type')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$data['member_type_status'] = 'delete';
            $this->db->where('member_type_id', $para2);
			$this->db->update('member_type', $data);


			$resultdata = $this->db->select('member_type_name')->get_where('member_type',array('member_type_id'=>$para2))->result_array();

			$name = $resultdata[0]['member_type_name'];
			$datanui['notification_user_id']= $_SESSION['admin_id'];
			$datanui['notification_content']= $_SESSION['admin_name']." has deleted models ".@$name;
			$datanui['notification_read']= 1;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']=  $para2; 
			$this->db->insert('logs',$datanui);


        }else if ($para1 == 'approval_set') {
            $member_type = $para2;
			if ($para3 == 'true') {
                $data['member_type_status'] = 'active';
            } else {
                $data['member_type_status'] = 'de-active';
            }
            $this->db->where('member_type_id', $member_type);
            $this->db->update('member_type', $data);
        }
    }	
	
}