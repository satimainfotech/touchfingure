<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller
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
            $page_data['page_name'] = "dashboard/dashboard";
			$page_data['page_name_link']   = "dashboard";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }
    
   
}