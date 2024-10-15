<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Logs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
	}
    
    /* Dashboard */
    public function index()
    {
		//print_r($_SESSION);
		if ($this->session->userdata('admin_login') == 'yes') {
		// Get the total count of notifications for the admin user
        //$this->db->where('notification_user_id', $_SESSION['admin_id']);
		$this->db->order_by('notification_user_id','DESC');
       	$count_data = $this->db->get('logs')->num_rows();

        // Set up pagination config
        $config = array();
        $config['base_url'] = base_url() . 'admin/logs/' . $searchurl;
        $config['total_rows'] = $count_data;
        $config['per_page'] = 20;
        $config['uri_segment'] = '3';
        $config['page_query_string'] = TRUE; // Enable query string pagination
        $config['query_string_segment'] = 'page'; // Set the query string key
        $choice = $config["total_rows"] / $config["per_page"];

        // Customizing pagination links
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

        // Initialize pagination with the configured settings
        $this->pagination->initialize($config);

        // Get the current page number
        $page = ($this->input->get('page')) ? $this->input->get('page') : 0;

        // Fetch paginated results based on per_page and current page
        //$this->db->where('notification_user_id', $_SESSION['admin_id']);
        $this->db->limit($config['per_page'], $page);
		$this->db->order_by('notification_id','DESC');
        $data['all_country'] = $this->db->get('logs')->result_array();

        // Generate pagination links
        $data['links'] = $this->pagination->create_links();
        $data['msg'] = "";
        $data['total_rows'] = $config['total_rows'];
        $data['page_id'] = $page;
        $data['page_name'] = "master/notifications";
        $data['page_name_link'] = "notification";

        // Load the view
        $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }    
}