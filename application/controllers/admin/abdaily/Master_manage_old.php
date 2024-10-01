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
			$config['base_url'] = base_url() . "abdaily/master_manage/country".$searchurl;
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
            $this->load->view('back/abdaily/index', $data);
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
            $this->load->view('back/bdaily/index', $page_data);
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
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_n'];
			$page_data['country'] = $country;
			
			$page_data['country_data'] = $this->master_manage_model->get_country_details($country_id);
			$page_data['country_id'] = $country_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/country_edit";
            $page_data['page_name_link'] = "country";
            $this->load->view('back/abdaily/index', $page_data);
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
            $this->load->view('back/abdaily/index', $page_data);
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
			$config['base_url'] = base_url() . "abdaily/master_manage/state".$searchurl;
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
            $this->load->view('back/abdaily/index', $data);
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
            $this->load->view('back/abdaily/index', $page_data);
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
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function state_view(){
		$state_id = @$_GET['s_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('state_view')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			
			$page_data['state_data'] = $this->master_manage_model->get_state_details($state_id);
			$page_data['state_id'] = $state_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/state_view";
            $page_data['page_name_link'] = "state";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function state_added($para1 = '', $para2 = '', $para3 = ''){
		$data['country_id'] = $this->input->post('country');
		$data['state_name'] = $this->input->post('state_name');
		$data['state_status'] = 'active';
		$this->db->insert('state', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function state_update($para1 = '', $para2 = '', $para3 = ''){
		$data['country_id'] = $this->input->post('country');
		$data['state_name'] = $this->input->post('state_name');
		$this->db->where('state_id', $para1);
		$this->db->update('state', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function states($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('state')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$data['state_status'] = 'delete';
            $this->db->where('state_id', $para2);
			$this->db->update('state', $data);
        }else if ($para1 == 'approval_set') {
            $state = $para2;
			if ($para3 == 'true') {
                $data['state_status'] = 'active';
            } else {
                $data['state_status'] = 'de-active';
            }
            $this->db->where('state_id', $state);
            $this->db->update('state', $data);
        }
    }
	
	/* City add, edit, view, delete */
	public function city()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('city')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->city_excel_export();
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$city = @$_GET['c_n'];
			
			
			$data['country'] = $country;
			$data['state'] = $state;
			$data['city'] = $city;
			
			if($country != ''){
				$searchurl='?c_i='.$country.'&s_i='.$state.'&c_n='.$city;
			}else{
				$searchurl='';
			}
			
			
			$count_data = $this->master_manage_model->get_total_city_data_count($city,$state,$country);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "abdaily/master_manage/city".$searchurl;
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
			
			$data['all_city'] = $this->master_manage_model->get_total_city_data($city,$state,$country,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_arows'] = $config["total_rows"];
			$data['country_data'] = get_all_country();
			$data['page_id'] = $page;
			$data['page_name'] = "master/city";
            $data['page_name_link'] = "city";
            $this->load->view('back/abdaily/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function city_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('city_add')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$city = @$_GET['c_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			$page_data['city'] = $city;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/city_add";
			$page_data['country_data'] = get_all_country();
            $page_data['page_name_link'] = "city";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function city_edit(){
		$city_id = @$_GET['ci_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('city_edit')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$city = @$_GET['c_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			$page_data['city'] = $city;
			
			$page_data['city_data'] = $this->master_manage_model->get_edit_city_details($city_id);
			$page_data['city_id'] = $city_id;
			$page_data['page_id'] = $page_id;
			$page_data['country_data'] = get_all_country();
            $page_data['page_name'] = "master/city_edit";
            $page_data['page_name_link'] = "city";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function city_view(){
		$city_id = @$_GET['ci_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('city_view')) {
				redirect(base_url() . 'admin');
			}
			$country = @$_GET['c_i'];
			$state = @$_GET['s_i'];
			$city = @$_GET['c_n'];
			$page_data['country'] = $country;
			$page_data['state'] = $state;
			$page_data['city'] = $city;
			
			$page_data['city_data'] = $this->master_manage_model->get_city_details($city_id);
			$page_data['city_id'] = $city_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "master/city_view";
            $page_data['page_name_link'] = "city";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function city_added($para1 = '', $para2 = '', $para3 = ''){
		$data['city_name'] = $this->input->post('city_name');
		$data['state_id'] = $this->input->post('state');
		$data['country_id'] = $this->input->post('country');
		$data['city_status'] = 'active';
		$this->db->insert('city', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function city_update($para1 = '', $para2 = '', $para3 = ''){
		$data['city_name'] = $this->input->post('city_name');
		$data['state_id'] = $this->input->post('state');
		$data['country_id'] = $this->input->post('country');
		$this->db->where('city_id', $para1);
		$this->db->update('city', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function citys($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('city')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$data['city_status'] = 'delete';
            $this->db->where('city_id', $para2);
			$this->db->update('city', $data);
        }else if ($para1 == 'approval_set') {
            $city = $para2;
			if ($para3 == 'true') {
                $data['city_status'] = 'active';
            } else {
                $data['city_status'] = 'de-active';
            }
            $this->db->where('city_id', $city);
            $this->db->update('city', $data);
        }else if ($para1 == 'get_states') {
		    echo $this->crud_model->select_name_html('state', 'state', 'state_id', 'add', 'demo-chosen-select required', '', 'country_id', $para2, '');
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
}