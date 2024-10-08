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
            $this->load->view('back/admin/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }

    /* Login into Admin panel */
    function logins($para1 = '')
    {
	    if ($para1 == 'forget_form') {
            $page_data['control'] = 'admin';
            $this->load->view('back/admin/forget_password',$page_data);
        } else if ($para1 == 'forget') {
			
        	$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');			
            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
				$query = $this->db->get_where('admin', array('email' => $this->input->post('email')));
				if ($query->num_rows() > 0) {
					$admin_id = $query->row()->admin_id;
					$password = substr(hash('sha512', rand()), 0, 12);
					$data['password'] = sha1($password);
					$this->db->where('admin_id', $admin_id);
					$this->db->update('admin', $data);
					
				} else {
					echo 'email_nay';
				}
			}
        } else {
        	$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
				$login_data = $this->db->get_where('admin', array('email' => $this->input->post('email'),'password' => sha1($this->input->post('password'))));
				if ($login_data->num_rows() > 0) {
					foreach ($login_data->result_array() as $row) {
						$this->session->set_userdata('login', 'yes');
						$this->session->set_userdata('admin_login', 'yes');
						$this->session->set_userdata('admin_id', $row['admin_id']);
						$this->session->set_userdata('admin_name', $row['name']);
						$this->session->set_userdata('title', 'admin');
						$this->session->set_userdata('panel_title', 'admin');
						$this->session->set_userdata('role', $row['role']);
						echo 'lets_login';
					}
				} else {
					echo 'login_failed';
				}
			}
        }
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }
    
   
}