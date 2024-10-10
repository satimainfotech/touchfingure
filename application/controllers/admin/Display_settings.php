<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Display_settings extends CI_Controller
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
            if (!$this->crud_model->admin_permission('display_setting')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_name'] = "settings/display_settings";
			$page_data['page_name_link'] = "display_settings";
			$this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
	public function logo()
    {
        if (!$this->crud_model->admin_permission('logo')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_name'] = "settings/display_settings";
			$page_data['page_name_link'] = "display_settings";
			$page_data['tab_name']  = 'logo';
			$this->load->view('back/admin/index', $page_data);
    }
	public function favicon()
    {
        if (!$this->crud_model->admin_permission('favicon')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_name'] = "settings/display_settings";
			$page_data['page_name_link'] = "display_settings";
			$page_data['tab_name']  = 'favicon';
			$this->load->view('back/admin/index', $page_data);
    }
	
    /* Checking Login Stat */
    function is_logged()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            echo 'yah!good';
        } else {
            echo 'nope!bad';
        }
    }
    
    /* Manage Logos */
    function logo_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('logo')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "select_logo") {
            $page_data['page_name'] = "select_logo";
            $page_data['page_name_link'] = "select_logo";
        } elseif ($para1 == "delete_logo") {
            if (file_exists("uploads/logo_image/logo_" . $para2 . ".png")) {
                unlink("uploads/logo_image/logo_" . $para2 . ".png");
            }
            $this->db->where('logo_id', $para2);
            $this->db->delete('logo');
			return;
        } elseif ($para1 == "set_logo") {
			$type = $this->input->post('type');
            $logo_id = $this->input->post('logo_id');
            $this->db->where('type', $type);
            $this->db->update('general_settings', array('value' => $logo_id));
        } elseif ($para1 == "show_all") {
            $page_data['logo'] = $this->db->get('logo')->result_array();
            if ($para2 == "") {
                $this->load->view('back/admin/logo/all_logo', $page_data);
            }
            if ($para2 == "selectable") {
                $page_data['logo_type'] = $para3;
                $this->load->view('back/admin/logo/select_logo', $page_data);
            }
        } elseif ($para1 == "upload_logo") {
            foreach ($_FILES["file"]['name'] as $i => $row) {
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
                move_uploaded_file($_FILES["file"]['tmp_name'][$i], 'uploads/logo_image/logo_' . $id . '.png');
				
            }
            return;
        } elseif ($para1 == "upload_logo1") {
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
				echo $_FILES["logo"]['name'];
                move_uploaded_file($_FILES["logo"]['tmp_name'], 'uploads/logo_image/logo_' . $id . '.png');
				
        }else {
            $this->load->view('back/admin/index', $page_data);
        }
    }
    
    /* Manage Favicons */
    function favicon_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('favicon')) {
            redirect(base_url() . 'admin');
        }
        $name = $_FILES['img']['name'];
        $ext  = end((explode(".", $name)));
		$this->db->where('type', 'fav_ext');
        $this->db->update('general_settings', array('value' =>$ext));
        move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/others/favicon.'.$ext);
    }
    
	function logo_part(){
        $this->load->view('back/admin/settings/logo_part');
	}
	function favicon_part(){
		
        $this->load->view('back/admin/settings/favicon');
	}
}