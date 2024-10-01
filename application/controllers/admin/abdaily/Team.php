<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Team extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('team_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('team')) {
				redirect(base_url() . 'admin');
			}
			
			$team = @$_GET['c_n'];
			$data['team'] = $team;
			
			if($team != ''){
				$searchurl='?c_n='.$team;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->team_model->get_total_team_data_count($team);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/team".$searchurl;
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
			
			$data['all_team'] = $this->team_model->get_total_team_data($team,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "team/team";
            $data['page_name_link'] = "team";
            $this->load->view('back/abdaily/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function team_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('team_add')) {
				redirect(base_url() . 'admin');
			}
			$team = @$_GET['c_n'];
			$page_data['team'] = $team;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "team/team_add";
            $page_data['page_name_link'] = "team";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function team_edit(){
		$team_id = @$_GET['c_i'];
		$team_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('team_edit')) {
				redirect(base_url() . 'admin');
			}
			$team = @$_GET['c_n'];
			$page_data['team'] = $team;
			
			$page_data['team_data'] = $this->team_model->get_team_details($team_id,$team_token);
			$page_data['team_id'] = $team_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "team/team_edit";
            $page_data['page_name_link'] = "team";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function team_view(){
		$team_id = @$_GET['c_i'];
		$team_token = @$_GET['c_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('team_view')) {
				redirect(base_url() . 'admin');
			}
			$team = @$_GET['c_n'];
			$page_data['team'] = $team;
			
			$page_data['team_data'] = $this->team_model->get_team_details($team_id,$team_token);
			$page_data['team_id'] = $team_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "team/team_view";
            $page_data['page_name_link'] = "team";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function team_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['team_token'] = $token;
		$data['team_name'] = $this->input->post('team_name');
		$data['team_status'] = 'Active';
		$data['team_position'] = $this->input->post('team_position');
		
		$team_image = $_FILES['team_image']['name'];
		if($team_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$ext = pathinfo($team_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['team_image']['tmp_name']; 
			$dirPath = "uploads/abdaily_team_image/";
			$newFileName = $otp2."_team";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['team_image'] = $otp2.'_team.'.$ext;
			}
		}
		$this->db->insert('team_master', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function team_update($para1 = '', $para2 = '', $para3 = ''){
		$data['team_name'] = $this->input->post('team_name');
		$data['team_position'] = $this->input->post('team_position');
		
		$team_image = $_FILES['team_image']['name'];
		if($team_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$team_images = @$this->db->get_where('team',array('team_id'=>$para1))->row()->team_image;
			if($team_images != ''){
				$rpersonal = "uploads/abdaily_team_image/".$team_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($team_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['team_image']['tmp_name']; 
			$dirPath = "uploads/abdaily_team_image/";
			$newFileName = $otp2."_team";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['team_image'] = $otp2.'_team.'.$ext;
			}
		}
		
		$this->db->where('team_id', $para1);
		$this->db->update('team_master', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function teams($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('team')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$team_images = @$this->db->get_where('team_master',array('team_id'=>$id))->row()->team_image;
			if($team_images != ''){
				$rpersonal = "uploads/abdaily_team_image/".$team_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['team_image'] = NULL;
			$data['team_status'] = 'delete';
            $this->db->where('team_id', $id);
			$this->db->update('team_master', $data);
			
        }else if ($para1 == 'status_set') {
            $team = $para2;
			if ($para3 == 'true') {
                $data['team_status'] = 'Active';
            } else {
                $data['team_status'] = 'De-active';
            }
            $this->db->where('team_id', $team);
            $this->db->update('team_master', $data);
        }
    }
	
	function update_team_position(){
		$position_value = $this->input->post('position_value');
		$team_id = $this->input->post('team_id');
		
		$data['team_position'] = $position_value;
		$this->db->where('team_id',$team_id);
		$this->db->update('team',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}