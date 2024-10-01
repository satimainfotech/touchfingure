<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Agent extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('agent_model');
		$this->load->model('bank_model');
		$this->load->model('products_model');
		
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {	
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('agent')) {
				redirect(base_url() . 'admin');
			}
			
			$agent = @$_GET['b_n'];
			$data['agent'] = $agent;
			
			if($agent != ''){
				$searchurl='?b_n='.$agent;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->agent_model->get_total_agent_data_count($agent);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/agent".$searchurl;
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
			
			$data['all_agent'] = $this->agent_model->get_total_agent_data($agent,$config["per_page"],$page);
			
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "agent/agent";
            $data['page_name_link'] = "agent";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function agent_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			
			if (!$this->crud_model->admin_permission('agent_add')) {
				redirect(base_url() . 'admin');
			}
			$agent = @$_GET['b_n'];
			$page_data['agent'] = $agent;
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
				$page_data['products_data'] = $this->products_model->get_products_data();
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "agent/agent_add";
            $page_data['page_name_link'] = "agent";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function agent_edit(){
		$agent_id = @$_GET['b_i'];
		$agent_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('agent_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$agent = @$_GET['b_n'];
			$page_data['agent'] = $agent;
			
			$page_data['agent_data'] = $this->agent_model->get_agent_details($agent_id,$agent_token);
			$page_data['agent_prodcut_data'] = $this->agent_model->get_agent_products($agent_id);
			
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
			$page_data['products_data'] = $this->products_model->get_products_data();
			
			$page_data['agent_id'] = $agent_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "agent/agent_edit";
            $page_data['page_name_link'] = "agent";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function agent_payment(){
		$agent_id = @$_GET['b_i'];
		$agent_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('agent_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$agent = @$_GET['b_n'];
			$page_data['agent'] = $agent;
			
			$page_data['agent_data'] = $this->agent_model->get_agent_details($agent_id,$agent_token);
			$page_data['agent_prodcut_data'] = $this->agent_model->get_agent_products($agent_id);
			$page_data['agent_student_data'] = $this->agent_model->get_agent_student($agent_id);
			
			
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
			$page_data['products_data'] = $this->products_model->get_products_data();
			
			$page_data['agent_id'] = $agent_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "agent/agent_payment";
            $page_data['page_name_link'] = "agent";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	
	function agent_view(){
		$agent_id = @$_GET['b_i'];
		$agent_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('agent_view')) {
				redirect(base_url() . 'admin');
			}
			$agent = @$_GET['b_n'];
			$page_data['agent'] = $agent;
			
			$page_data['agent_data'] = $this->agent_model->get_agent_details($agent_id,$agent_token);
			$page_data['agent_id'] = $agent_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "agent/agent_view";
            $page_data['page_name_link'] = "agent";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function agent_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['agent_token'] = $token;
		$data['agent_name'] = $this->input->post('agent_name');
		$data['agent_mobile'] = $this->input->post('agent_mobile');
		$data['agent_email'] = $this->input->post('agent_email');
		$data['agent_address'] = $this->input->post('agent_address');
		$data['bank_id'] = 1;
		$data['agent_code'] = $this->input->post('agent_code');
		
		
		
		$data['agent_intrest_rate'] = $this->input->post('agent_intrest_rate');
		
		$data['agent_status'] = 'Active';
		
		$this->db->insert('agent_master', $data);
		$id = $this->db->insert_id();
		
		$products =$this->input->post('product'); 
		$intrest_rate =$this->input->post('intrest_rate'); 
		$days =$this->input->post('days'); 
		$due_intrest =$this->input->post('due_intrest'); 
		
		for($i=0;$i<count($this->input->post('product'));$i++)
		{
			$products_details = explode("-",$products[$i]);
			$product_data['agent_id']  = $id;
			$product_data['product_id']  = $products_details[0];
			$product_data['product_name']  = $products_details[1];			
			$product_data['intrest_rate']  = $intrest_rate[$i];
			$product_data['days']  = $days[$i];
			$product_data['due_date_intrest_rate']  = $due_intrest[$i];
			$product_data['created_date'] = date("Y-m-d");
			$this->db->insert('agent_products', $product_data);
			
		}
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function agent_update($para1 = '', $para2 = '', $para3 = ''){
		$data['agent_name'] = $this->input->post('agent_name');
		$data['agent_mobile'] = $this->input->post('agent_mobile');
		$data['agent_email'] = $this->input->post('agent_email');
		$data['agent_address'] = $this->input->post('agent_address');
		$data['agent_code'] = $this->input->post('agent_code');
		$data['agent_intrest_rate'] = $this->input->post('agent_intrest_rate');
		
		$this->db->where('agent_id', $para1);
		$this->db->update('agent_master', $data);
		$this->db->trans_complete();
		
		
		$products =$this->input->post('product'); 
		$intrest_rate =$this->input->post('intrest_rate'); 
		$days =$this->input->post('days'); 
		$due_intrest =$this->input->post('due_intrest'); 
		
		$this->db->where('agent_id', $para1);
		$this->db->delete('agent_products');

		
		for($i=0;$i<count($this->input->post('product'));$i++)
		{
			$product_data['agent_id']  = $para1;
			$product_data['product_id']  = $products[$i];
			$product_data['intrest_rate']  = $intrest_rate[$i];
			$product_data['days']  = $days[$i];
			$product_data['due_date_intrest_rate']  = $due_intrest[$i];
			$product_data['created_date'] = date("Y-m-d");
			$this->db->insert('agent_products', $product_data);
			
		}

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function agents($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('agent')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$agent_images = @$this->db->get_where('agent_master',array('agent_id'=>$id))->row()->agent_image;
		
			$data['agent_status'] = 'delete';
            $this->db->where('agent_id', $id);
			$this->db->update('agent_master', $data);
			$this->db->where('agent_id', $id);
			$this->db->delete('agent_products');
			echo "done";
        }else if ($para1 == 'status_set') {
            $agent = $para2;
			if ($para3 == 'true') {
                $data['agent_status'] = 'Active';
            } else {
                $data['agent_status'] = 'De-active';
            }
            $this->db->where('agent_id', $agent);
            $this->db->update('agent_master', $data);
        }
    }
	function update_agent_position(){
		$position_value = $this->input->post('position_value');
		$agent_id = $this->input->post('agent_id');
		
		$data['agent_position'] = $position_value;
		$this->db->where('agent_id',$agent_id);
		$this->db->update('agent_master',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	function agent_intrest_amount()
	{
	    	$id = $this->input->post('agent_id');
	    echo $agent_images = @$this->db->get_where('agent_master',array('agent_id'=>$id))->row()->agent_intrest_rate;
	}
	
	function agent_add_payment($para1 = '', $para2 = '', $para3 = ''){		
		
		$agent_id = $this->input->post('agent_id');		
		$data['agent_remaining_amount'] = $this->input->post('remaining_agent_margin');		
		$this->db->where('agent_id', $para1);
		$this->db->update('deal_master', $data);
			
		$student_id = $this->input->post('student_id');
		$student_name = $this->input->post('student_name');
		$student_amount = $this->input->post('amount');
		for($i=0;$i<count($student_id);$i++)
		{
			$product_data['agent_id']  = $agent_id;
			$product_data['agent_name']  = $this->input->post('agent_name');
			$product_data['student_id']  = $student_id[$i];
			$product_data['student_name']  = $student_name[$i];
			$product_data['student_amount']  = $student_amount[$i];
			$product_data['agent_payment']  = $this->input->post('agent_payment');
			$product_data['total_agent_payable_amount']  = $this->input->post('total_agent_margin');
			$product_data['remaining_agent_margin']  = $this->input->post('remaining_agent_margin');
			$product_data['created_date'] = date("Y-m-d");
			$this->db->insert('agent_payment', $product_data);
			
		}
$this->db->trans_complete();	
		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
}