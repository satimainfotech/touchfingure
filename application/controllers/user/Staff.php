<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Staff extends CI_Controller
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
			if (!$this->crud_model->admin_permission('staff')) {
				redirect(base_url() . 'admin');
			}
            $page_data['page_name']  = "admins/admin";
            $page_data['page_name_link']  = "staff";
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/admin/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    /* Checking if email exists*/
    function exists()
    {
        $email  = $this->input->post('email');
        $admin  = $this->db->get('admin')->result_array();
        $exists = 'no';
        foreach ($admin as $row) {
            if ($row['email'] == $email) {
                $exists = 'yes';
            }
        }
        echo $exists;
    }
    /* Administrator Management */
    function admins($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('staff')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
			$password = $this->input->post('password');
            $data['password'] = sha1($password);
            $data['orignal_password'] = $password;
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['role'] = $this->input->post('role');
            $data['timestamp'] = time();
            $this->db->insert('admin', $data);
            $this->email_model->account_opening('admin', $data['email'], $password);
        } else if ($para1 == 'edit') {
			$page_data['admin_data'] = $this->db->get_where('admin', array('admin_id' => $para2))->result_array();
            $this->load->view('back/admin/admins/admin_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
			$password = $this->input->post('password');
            $data['password'] = sha1($password);
			$data['orignal_password'] = $password;
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['role'] = $this->input->post('role');
			$this->db->where('admin_id', $para2);
            $this->db->update('admin', $data);
            $this->email_model->account_opening('admin', $data['email'], $password);
        } elseif ($para1 == 'delete') {
            $this->db->where('admin_id', $para2);
            $this->db->delete('admin');
        } elseif ($para1 == 'list') {
            $this->db->order_by('admin_id', 'desc');
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/admin/admins/admin_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['admin_data'] = $this->db->get_where('admin', array('admin_id' => $para2))->result_array();
            $this->load->view('back/admin/admins/admin_view', $page_data);
        } elseif ($para1 == 'add') {
			$this->load->view('back/admin/admins/admin_add');
        }
    }
    
    /* Account Role Management */
    function role($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('staff_role')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['permission'] = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->insert('role', $data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $data['permission'] = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->where('role_id', $para2);
            $this->db->update('role', $data);
        } elseif ($para1 == 'delete') {
            $this->db->where('role_id', $para2);
            $this->db->delete('role');
        } elseif ($para1 == 'list') {
            $this->db->order_by('role_id', 'desc');
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/admin/role/role_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['role_data'] = $this->db->get_where('role', array('role_id' => $para2))->result_array();
            $this->load->view('back/admin/role/role_view', $page_data);
        } elseif ($para1 == 'add') {
            $page_data['all_permissions'] = $this->db->order_by('permission_id','asc')->get_where('permission',array('show' => 'yes'))->result_array();
            $this->load->view('back/admin/role/role_add', $page_data);
        } else if ($para1 == 'edit') {
            $page_data['all_permissions'] = $this->db->order_by('permission_id','asc')->get_where('permission',array('show' => 'yes'))->result_array();
            $page_data['role_data']       = $this->db->get_where('role', array('role_id' => $para2))->result_array();
            $this->load->view('back/admin/role/role_edit', $page_data);
        } else {
            $page_data['page_name'] = "role/role";
            $page_data['page_name_link'] = "role";
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/admin/index', $page_data);
        }
    }
}