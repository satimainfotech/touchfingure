<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Bank extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('bank_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('bank')) {
				redirect(base_url() . 'admin');
			}
			
			$bank = @$_GET['b_n'];
			$data['bank'] = $bank;
			
			if($bank != ''){
				$searchurl='?b_n='.$bank;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->bank_model->get_total_bank_data_count($bank);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/bank".$searchurl;
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
			
			$data['all_bank'] = $this->bank_model->get_total_bank_data($bank,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "bank/bank";
            $data['page_name_link'] = "bank";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function bank_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('bank_add')) {
				redirect(base_url() . 'admin');
			}
			$bank = @$_GET['b_n'];
			$page_data['bank'] = $bank;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "bank/bank_add";
            $page_data['page_name_link'] = "bank";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function bank_edit(){
		$bank_id = @$_GET['b_i'];
		$bank_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('bank_edit')) {
				redirect(base_url() . 'admin');
			}
			$bank = @$_GET['b_n'];
			$page_data['bank'] = $bank;
			
			$page_data['bank_data'] = $this->bank_model->get_bank_details($bank_id,$bank_token);
			$page_data['bank_id'] = $bank_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "bank/bank_edit";
            $page_data['page_name_link'] = "bank";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function bank_view(){
		$bank_id = @$_GET['b_i'];
		$bank_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('bank_view')) {
				redirect(base_url() . 'admin');
			}
			$bank = @$_GET['b_n'];
			$page_data['bank'] = $bank;
			
			$page_data['bank_data'] = $this->bank_model->get_bank_details($bank_id,$bank_token);
			$page_data['bank_id'] = $bank_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "bank/bank_view";
            $page_data['page_name_link'] = "bank";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function bank_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['bank_token'] = $token;
		$data['bank_name'] = $this->input->post('bank_name');
		$data['branch_name'] = $this->input->post('branch_name');
		$data['ifsc_code'] = $this->input->post('ifsc_code');
		$data['bank_status'] = 'Active';
		
		$this->db->insert('bank', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function bank_update($para1 = '', $para2 = '', $para3 = ''){
		$data['bank_name'] = $this->input->post('bank_name');
		$data['branch_name'] = $this->input->post('branch_name');	
		$data['ifsc_code'] = $this->input->post('ifsc_code');
		
		$this->db->where('bank_id', $para1);
		$this->db->update('bank', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function banks($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('bank')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');		
			$data['bank_status'] = 'delete';
            $this->db->where('bank_id', $id);
			$this->db->update('bank', $data);
			echo 'done';
        }else if ($para1 == 'status_set') {
            $bank = $para2;
			if ($para3 == 'true') {
                $data['bank_status'] = 'Active';
            } else {
                $data['bank_status'] = 'De-active';
            }
            $this->db->where('bank_id', $bank);
            $this->db->update('bank', $data);
        }
    }
	function update_bank_position(){
		$position_value = $this->input->post('position_value');
		$bank_id = $this->input->post('bank_id');
		
		$data['bank_position'] = $position_value;
		$this->db->where('bank_id',$bank_id);
		$this->db->update('bank',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}