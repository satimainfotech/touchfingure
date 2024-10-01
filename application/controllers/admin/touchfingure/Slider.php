<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Slider extends CI_Controller
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
			if (!$this->crud_model->admin_permission('slider')) {
				redirect(base_url() . 'admin');
			}
            $page_data['page_name'] = "slides/slides";
            $page_data['page_name_link'] = "slider";
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
    
    /* slides add, edit, view, delete */
    function slides($para1 = '', $para2 = '', $para3 = '')
    {
        if ($para1 == 'do_add') {
            $type = 'slides';
            $data['uploaded_by'] = 'admin';
			$data['status'] = 'ok';
			$data['added_by'] = $this->session->userdata('admin_id');
            $this->db->insert('slides', $data);
            $id = $this->db->insert_id();
            $this->crud_model->file_up("img", "slides", $id, '', '', '.jpg');
        } elseif ($para1 == "update") {
            $this->crud_model->file_up("img", "slides", $para2, '', '', '.jpg');
        } elseif ($para1 == 'delete') {
            $this->crud_model->file_dlt('slides', $para2, '.jpg');
            $this->db->where('slides_id', $para2);
            $this->db->delete('slides');
        } elseif ($para1 == 'multi_delete') {
            $ids = explode('-', $param2);
            $this->crud_model->multi_delete('slides', $ids);
        } else if ($para1 == 'edit') {
            $page_data['slides_data'] = $this->db->get_where('slides', array('slides_id' => $para2))->result_array();
            $this->load->view('back/admin/slides/slides_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('slides_id', 'desc');
			$this->db->where('uploaded_by', 'admin');
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/admin/slides/slides_list', $page_data);
        }elseif ($para1 == 'slide_publish_set') {
            $slides_id = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('slides_id', $slides_id);
            $this->db->update('slides', $data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/slides/slides_add');
        }
    }
}