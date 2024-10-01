<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Cms_page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
	}
    
    /* Dashboard */
    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('application_setting')) {
				redirect(base_url() . 'admin');
			}
            $page_data['page_name'] = "cms_page/customer_cms_page";
			$page_data['page_name_link'] = "cms_page";
			$page_data['table_info']  = $this->db->get_where('cms_page',array('cms_page_type'=>'Customer'))->result_array();;
			$this->load->view('back/admin/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    
	/* Manage Email Template */
    function update_customer_cms_page($para1 = "", $para2 = "")
    {
        if($para1 = "update"){
			$data['cms_page_status'] = $this->input->post('cms_page_status');
			$data['cms_page_content'] = $this->input->post('cms_page_content');
			$data['app_menu_title'] = $this->input->post('app_menu_title');
			$this->db->where('cms_page_id', $para2);
            $this->db->update('cms_page', $data);
		}
    }
	
	public function delivery_cms()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('application_setting')) {
				redirect(base_url() . 'admin');
			}
            $page_data['page_name'] = "cms_page/delivery_cms_page";
			$page_data['page_name_link'] = "delivery_cms";
			$page_data['table_info']  = $this->db->get_where('cms_page',array('cms_page_type'=>'Delivery'))->result_array();;
			$this->load->view('back/admin/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    
	public function office_cms()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('application_setting')) {
				redirect(base_url() . 'admin');
			}
            $page_data['page_name'] = "cms_page/office_cms_page";
			$page_data['page_name_link'] = "office_cms";
			$page_data['table_info']  = $this->db->get_where('cms_page',array('cms_page_type'=>'Office'))->result_array();;
			$this->load->view('back/admin/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
	
	/* Manage Email Template */
    function update_cms_page($para1 = "", $para2 = "")
    {
        if($para1 = "update"){
			$data['cms_page_status'] = $this->input->post('cms_page_status');
			$data['cms_page_content'] = $this->input->post('cms_page_content');
			$data['app_menu_title'] = $this->input->post('app_menu_title');
			$this->db->where('cms_page_id', $para2);
            $this->db->update('cms_page', $data);
		}
    }
}