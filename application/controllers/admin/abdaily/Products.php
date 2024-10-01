<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Products extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('products_model');
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('products')) {
				redirect(base_url() . 'admin');
			}
			
			$products = @$_GET['b_n'];
			$data['products'] = $products;
			
			if($products != ''){
				$searchurl='?b_n='.$products;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->products_model->get_total_products_data_count($products);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/products".$searchurl;
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
			
			$data['all_products'] = $this->products_model->get_total_products_data($products,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "products/products";
            $data['page_name_link'] = "products";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function products_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('products_add')) {
				redirect(base_url() . 'admin');
			}
			$products = @$_GET['b_n'];
			$page_data['products'] = $products;
			
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "products/products_add";
            $page_data['page_name_link'] = "products";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function products_edit(){
		$products_id = @$_GET['b_i'];
		$products_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('products_edit')) {
				redirect(base_url() . 'admin');
			}
			$products = @$_GET['b_n'];
			$page_data['products'] = $products;
			
			$page_data['products_data'] = $this->products_model->get_products_details($products_id,$products_token);
			$page_data['products_id'] = $products_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "products/products_edit";
            $page_data['page_name_link'] = "products";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function products_view(){
		$products_id = @$_GET['b_i'];
		$products_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('products_view')) {
				redirect(base_url() . 'admin');
			}
			$products = @$_GET['b_n'];
			$page_data['products'] = $products;
			
			$page_data['products_data'] = $this->products_model->get_products_details($products_id,$products_token);
			$page_data['products_id'] = $products_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "products/products_view";
            $page_data['page_name_link'] = "products";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function products_do_add($para1 = '', $para2 = '', $para3 = ''){
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['products_token'] = $token;
		$data['products_name'] = $this->input->post('products_name');
		$data['intrest_rate'] = $this->input->post('intrest_rate');
		$data['days'] = $this->input->post('days');
		$data['products_status'] = 'Active';
		
		$this->db->insert('products', $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function products_update($para1 = '', $para2 = '', $para3 = ''){
		$data['products_name'] = $this->input->post('products_name');
		$data['intrest_rate'] = $this->input->post('intrest_rate');
		$data['days'] = $this->input->post('days');
		
		$this->db->where('products_id', $para1);
		$this->db->update('products', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function productss($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('products')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');		
			$data['products_status'] = 'delete';
            $this->db->where('products_id', $id);
			$this->db->update('products', $data);
			echo 'done';
        }else if ($para1 == 'status_set') {
            $products = $para2;
			if ($para3 == 'true') {
                $data['products_status'] = 'Active';
            } else {
                $data['products_status'] = 'De-active';
            }
            $this->db->where('products_id', $products);
            $this->db->update('products', $data);
        }
    }
	function update_products_position(){
		$position_value = $this->input->post('position_value');
		$products_id = $this->input->post('products_id');
		
		$data['products_position'] = $position_value;
		$this->db->where('products_id',$products_id);
		$this->db->update('products',$data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
}