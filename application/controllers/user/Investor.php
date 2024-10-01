<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class investor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('investor_model');
		$this->load->model('bank_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
	
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('investor')) {
				redirect(base_url() . 'admin');
			}
			
			$investor = @$_GET['b_n'];
			$data['investor'] = $investor;
			
			if($investor != ''){
				$searchurl='?b_n='.$investor;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->investor_model->get_total_investor_data_count($investor);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/investor".$searchurl;
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
			
			$data['all_investor'] = $this->investor_model->get_total_investor_data($investor,$config["per_page"],$page);
			
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "investor/investor";
            $data['page_name_link'] = "investor";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function investor_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			
			if (!$this->crud_model->admin_permission('investor_add')) {
				redirect(base_url() . 'admin');
			}
			$investor = @$_GET['b_n'];
			$page_data['investor'] = $investor;
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "investor/investor_add";
            $page_data['page_name_link'] = "investor";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function investor_edit(){
		$investor_id = @$_GET['b_i'];
		$investor_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('investor_edit')) {
				redirect(base_url() . 'admin');
			}
			$investor = @$_GET['b_n'];
			$page_data['investor'] = $investor;
			
			$page_data['investor_data'] = $this->investor_model->get_investor_details($investor_id,$investor_token);
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
			$page_data['investor_id'] = $investor_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "investor/investor_edit";
            $page_data['page_name_link'] = "investor";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function investor_view(){
		$investor_id = @$_GET['b_i'];
		$investor_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('investor_view')) {
				redirect(base_url() . 'admin');
			}
			$investor = @$_GET['b_n'];
			$page_data['investor'] = $investor;
			
			$page_data['investor_data'] = $this->investor_model->get_investor_details($investor_id,$investor_token);
			$page_data['investor_id'] = $investor_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "investor/investor_view";
            $page_data['page_name_link'] = "investor";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function investor_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['investor_token'] = $token;
		$data['investor_name'] = $this->input->post('investor_name');
		$data['investor_mobile'] = $this->input->post('investor_mobile');
		$data['investor_email'] = $this->input->post('investor_email');
		$data['investor_address'] = $this->input->post('investor_address');
		$data['bank_account_number'] = $this->input->post('bank_account_number');
		$data['bank_id'] = $this->input->post('bank_id');
		$data['intrest_rate'] = $this->input->post('intrest_rate');
		$data['investor_status'] = 'Active';
		
		$this->db->insert('investor_master', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function investor_update($para1 = '', $para2 = '', $para3 = ''){
		$data['investor_name'] = $this->input->post('investor_name');
		$data['investor_mobile'] = $this->input->post('investor_mobile');
		$data['investor_email'] = $this->input->post('investor_email');
		$data['investor_address'] = $this->input->post('investor_address');
		$data['bank_account_number'] = $this->input->post('bank_account_number');
		$data['bank_id'] = $this->input->post('bank_id');
		$data['intrest_rate'] = $this->input->post('intrest_rate');
		
		$this->db->where('investor_id', $para1);
		$this->db->update('investor_master', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function investors($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('investor')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$investor_images = @$this->db->get_where('investor',array('investor_id'=>$id))->row()->investor_image;
			if($investor_images != ''){
				$rpersonal = "uploads/investor_image/".$investor_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['investor_image'] = NULL;
			$data['investor_status'] = 'delete';
            $this->db->where('investor_id', $id);
			$this->db->update('investor', $data);
        }else if ($para1 == 'status_set') {
            $investor = $para2;
			if ($para3 == 'true') {
                $data['investor_status'] = 'Active';
            } else {
                $data['investor_status'] = 'De-active';
            }
            $this->db->where('investor_id', $investor);
            $this->db->update('investor', $data);
        }
    }
	function update_investor_position(){
		$position_value = $this->input->post('position_value');
		$investor_id = $this->input->post('investor_id');
		
		$data['investor_position'] = $position_value;
		$this->db->where('investor_id',$investor_id);
		$this->db->update('investor',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}