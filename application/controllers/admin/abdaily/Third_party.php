<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class third_party extends CI_Controller
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
			if (!$this->crud_model->admin_permission('third_party')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_name'] = "third_party";
			$page_data['page_name_link'] = "third_party";
			$this->load->view('back/admin/index', $page_data);
		} else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
	function google_api_key($para1 = "")
    {
        if (!$this->crud_model->admin_permission('third_party')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "google_api_key");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('api_key')
        ));
    }
}