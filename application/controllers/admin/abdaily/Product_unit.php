<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product_unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('product_unit_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('product_unit')) {
				redirect(base_url() . 'admin');
			}
			
			$product_unit = @$_GET['p_u_n'];
			$data['product_unit'] = $product_unit;
			
			if($product_unit != ''){
				$searchurl='?p_u_n='.$product_unit;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->product_unit_model->get_total_product_unit_data_count($product_unit);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/product_unit".$searchurl;
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
			
			$data['all_product_unit'] = $this->product_unit_model->get_total_product_unit_data($product_unit,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "product_master/product_unit/product_unit";
            $data['page_name_link'] = "product_unit";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function product_unit_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product_unit_add')) {
				redirect(base_url() . 'admin');
			}
			$product_unit = @$_GET['p_u_n'];
			$page_data['product_unit'] = $product_unit;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/product_unit/product_unit_add";
            $page_data['page_name_link'] = "product_unit";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function product_unit_edit(){
		$product_unit_id = @$_GET['p_u_i'];
		$product_unit_token = @$_GET['p_u_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product_unit_edit')) {
				redirect(base_url() . 'admin');
			}
			$product_unit = @$_GET['p_u_n'];
			$page_data['product_unit'] = $product_unit;
			
			$page_data['product_unit_data'] = $this->product_unit_model->get_product_unit_details($product_unit_id,$product_unit_token);
			$page_data['product_unit_id'] = $product_unit_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/product_unit/product_unit_edit";
            $page_data['page_name_link'] = "product_unit";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function product_unit_view(){
		$product_unit_id = @$_GET['p_u_i'];
		$product_unit_token = @$_GET['p_u_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('product_unit_view')) {
				redirect(base_url() . 'admin');
			}
			$product_unit = @$_GET['p_u_n'];
			$page_data['product_unit'] = $product_unit;
			
			$page_data['product_unit_data'] = $this->product_unit_model->get_product_unit_details($product_unit_id,$product_unit_token);
			$page_data['product_unit_id'] = $product_unit_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "product_master/product_unit/product_unit_view";
            $page_data['page_name_link'] = "product_unit";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function product_unit_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['product_unit_token'] = $token;
		$data['product_unit_name'] = $this->input->post('product_unit_name');
		$data['product_unit_status'] = 'Active';
		
		$this->db->insert('product_unit', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function product_unit_update($para1 = '', $para2 = '', $para3 = ''){
		$data['product_unit_name'] = $this->input->post('product_unit_name');
		
		$this->db->where('product_unit_id', $para1);
		$this->db->update('product_unit', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function product_units($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product_unit')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$data['product_unit_status'] = 'delete';
            $this->db->where('product_unit_id', $id);
			$this->db->update('product_unit', $data);
        }else if ($para1 == 'status_set') {
            $product_unit = $para2;
			if ($para3 == 'true') {
                $data['product_unit_status'] = 'Active';
            } else {
                $data['product_unit_status'] = 'De-active';
            }
            $this->db->where('product_unit_id', $product_unit);
            $this->db->update('product_unit', $data);
        }
    }
	
	function update_product_unit_position(){
		$position_value = $this->input->post('position_value');
		$product_unit_id = $this->input->post('product_unit_id');
		
		$data['product_unit_position'] = $position_value;
		$this->db->where('product_unit_id',$product_unit_id);
		$this->db->update('product_unit',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}