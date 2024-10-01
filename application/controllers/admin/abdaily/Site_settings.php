<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Site_settings extends CI_Controller
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
            if (!$this->crud_model->admin_permission('site_setting')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_name'] = "site_settings/site_settings";
			$page_data['page_name_link'] = "site_settings";
			$page_data['tab_name']  = 'general_settings';
			$this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    function smtp_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('site_setting')) {
            redirect(base_url() . 'admin');
        }
		if ($para1 == "set") {
            $this->db->where('type', 'smtp_host');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_host')));
			
			$this->db->where('type', 'smtp_port');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_port')));
			
			$this->db->where('type', 'smtp_user');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_user')));
			
			$this->db->where('type', 'smtp_pass');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_pass')));
			
			redirect(base_url() . 'admin/site_settings/smtp_settings/', 'refresh');
		}
	}
    /* Manage General Settings */
    function general_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('site_setting')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "system_name");
            $this->db->update('general_settings', array('value' => $this->input->post('system_name')));
            $this->db->where('type', "system_email");
            $this->db->update('general_settings', array('value' => $this->input->post('system_email')));
            $this->db->where('type', "system_title");
            $this->db->update('general_settings', array('value' => $this->input->post('system_title')));
        }
    }
}