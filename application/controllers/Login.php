<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{ 
    function __construct()
    {
		parent::__construct();
		
		
		 
		

	}

   public function index()
    {
    	$data['home_page_data'] = $this->db->get_where('home_page',array('home_page_id'=>'1'))->result_array();
		$data['content_data'] = $this->db->get_where('aboutus',array('aboutus_id'=>'1'))->result_array();
		$data['attend_event_data'] = $this->db->order_by('position','asc')->get_where('our_technology',array('our_technology_status'=>'yes'))->result_array();
		
		$content_data = $this->db->get_where('aboutus',array('aboutus_id'=>'1'))->result_array();
		$data["member_type_data"] = get_member_type();
		$data["page_names"] = @$content_data[0]['page_title'];
		$data["header_image"] = @$content_data[0]['header_image'];
		$data["page_title"] = @$content_data[0]['page_title'];
		$data["page_title_bottom_text"] = @$content_data[0]['page_title_bottom_text'];
		$data['social_media_data'] = $this->db->get_where('web_social_media',array('status'=>'Active'))->result_array();
		$data['category_data'] = $this->db->order_by('category_position','asc')->get_where('category',array('category_status'=>'Active'))->result_array();
		$data['brand_data'] = $this->db->order_by('brand_position','asc')->get_where('brand',array('brand_status'=>'Active'))->result_array();
		$data['sub_category_data'] = $this->db->order_by('sub_category_position','asc')->get_where('sub_category',array('sub_category_status'=>'Active'))->result_array();
		$data['testominal_data'] = $this->db->order_by('testimonials_position','asc')->get_where('testimonials',array('testimonials_status'=>'Active'))->result_array();
		$data['our_technology'] = $this->db->limit($technolgy_show)->order_by('position','asc')->get_where('our_technology',array('our_technology_status'=>'yes'))->result_array();
		$data["system_name"] = 'Convart';
		$data["meta_description"] = 'Convart';
		$data["meta_keywords"] = 'Convart';
		$data["meta_author"] = 'Convart';
		$data["page_slug"] = "about";
		$data["page_class"] = "about";
		$data["main_content"] = "cms_pages/login";
		$data["form_msg"] = "";
		$this->load->view("common_file/template",$data);
	}
	
	 /* Login into Admin panel */
    function check_login($para1 = '')
    {
	    
		$this->load->library('form_validation');
		$this->form_validation->set_rules('mobile', 'mobile', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		}
		else
		{
			$this->db->where('mobile', $this->input->post('mobile'));
			$this->db->where('password', $this->input->post('password'));
			$this->db->where('status', 'active'); 
			$this->db->order_by('id', 'DESC'); // Assuming 'id' is the auto-increment field
			$this->db->limit(1);
			$login_data = $this->db->get('user');
			
			if ($login_data->num_rows() > 0) {
				foreach ($login_data->result_array() as $row) {
					$this->session->set_userdata('login', 'yes');
					$this->session->set_userdata('user_login', 'yes');
					$this->session->set_userdata('user_id', $row['id']);
					$this->session->set_userdata('user_name', $row['name']);
					$this->session->set_userdata('title', 'user');
					$this->session->set_userdata('panel_title', 'user');
					
					
					$page_data['user_data'] =  $login_data->result_array();
					$page_data["member_type_data"] = get_member_type();
					
					$page_data['page_name'] = "dashboard/dashboard";
					$page_data['page_name_link']   = "dashboard";
					$this->load->view('back/user/index', $page_data);
				}
			} else {
				
					$this->session->set_flashdata('message', 'Mobile and Password Not Correct Or Account Not Active .');
					redirect(base_url('login'), 'refresh');
				}
		}
    }
	
	 /* Loging out from Admin panel */
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'login', 'refresh');
    }
	
	
	 public function dashboard()
    {
        if ($this->session->userdata('user_login') == 'yes') {
			
		$user_id = $this->session->userdata('user_id');
		$login_data = $this->db->get_where('user', array('id' => $user_id));
		$page_data['user_data'] =  $login_data->result_array();
		$page_data["member_type_data"] = get_member_type();
	
		$page_data['page_name'] = "dashboard/dashboard";
		$page_data['page_name_link']   = "dashboard";
		$this->load->view('back/user/index', $page_data);
		} else {
            $page_data['control'] = "user";
            $this->load->view('login',$page_data);
        }
    }
	

	
public function letter()
{		
	if ($this->session->userdata('user_login') == 'yes') {
		$user_id = $this->session->userdata('user_id');
		$login_data = $this->db->get_where('user', array('id' => $user_id));
		$data['user_detail'] =  $login_data->result_array();
		$data['user_detail'] = $data['user_detail'][0];
		
		$html = $this->load->view('back/user/letter_pdf', $data, TRUE);
		
		$filename = $user_id;
		$name = $data['user_detail']['name'];

		$mpdf = new \Mpdf\Mpdf([
		'default_font' => 'shruti'
		]);

		// Define the font data
		$mpdf->fontdata['shruti'] = [
		'R' => 'shruti.ttf',     // Regular
		'B' => __DIR__ . '/fonts/shrutib.ttf',    // Bold
		// Add other styles if needed
		];
		// Ensure paths to font files are correct
		$mpdf->autoScriptToLang = true;
		$mpdf->autoLangToFont = true;
		$mpdf->WriteHTML($html);
		
		$mpdf->Output($name.'_'.$filename."_letter.pdf",'D');
		exit;
	}
	else 
	{
		$page_data['control'] = "user";
		$this->load->view('login',$page_data);
	}
	
} 


public function idcard()
{
	if ($this->session->userdata('user_login') == 'yes') {
		$user_id = $this->session->userdata('user_id');
		$login_data = $this->db->get_where('user', array('id' => $user_id));
		$data['user_detail'] =  $login_data->result_array();
		$data['user_detail'] = $data['user_detail'][0];
			$html = $this->load->view('back/user/idcard_pdf', $data, TRUE);
			
			
			$filename = $data['user_detail']['id'];
			$name = $data['user_detail']['name'];

			$mpdf = new \Mpdf\Mpdf([
			'default_font' => 'shruti'
			]);

			// Define the font data
			$mpdf->fontdata['shruti'] = [
			'R' => 'shruti.ttf',     // Regular
			'B' => __DIR__ . '/fonts/shrutib.ttf',    // Bold
			// Add other styles if needed
			];

			// Ensure paths to font files are correct
			$mpdf->autoScriptToLang = true;
			$mpdf->autoLangToFont = true;
			$mpdf->WriteHTML($html);
			
			$mpdf->Output($name.'_'.$filename."_idcard.pdf",'D');
			
		
			exit;
	}
	else 
	{
		$page_data['control'] = "user";
		$this->load->view('login',$page_data);
	}
} 

public function visitingcard()
{
	
	if ($this->session->userdata('user_login') == 'yes') {
		$user_id = $this->session->userdata('user_id');
		$login_data = $this->db->get_where('user', array('id' => $user_id));
		$data['user_detail'] =  $login_data->result_array();
		$data['user_detail'] = $data['user_detail'][0];
	
		$html = $this->load->view('back/user/visitingcard_pdf', $data, TRUE);
			
			
			$filename = $data['user_detail']['id']; 
			$name = $data['user_detail']['name'];

			$mpdf = new \Mpdf\Mpdf();

			
			$mpdf->WriteHTML($html);
			
			$mpdf->Output($name.'_'.$filename."_visitingcard.pdf",'D');
			
		
			exit;
	}
	else 
	{
		$page_data['control'] = "user";
		$this->load->view('login',$page_data);
	}
} 

public function congratulations()
{
	
	if ($this->session->userdata('user_login') == 'yes') {
		$user_id = $this->session->userdata('user_id');
		$login_data = $this->db->get_where('user', array('id' => $user_id));
		$data['user_detail'] =  $login_data->result_array();
		$data['user_detail'] = $data['user_detail'][0];
	
		$html = $this->load->view('back/user/congratulations_pdf', $data, TRUE);
			
			
			$filename = $data['user_detail']['id'];
			$name = $data['user_detail']['name'];		

			$mpdf = new \Mpdf\Mpdf([
			'default_font' => 'shruti'
			]);

			// Define the font data
			$mpdf->fontdata['shruti'] = [
			'R' => 'shruti.ttf',     // Regular
			'B' => __DIR__ . '/fonts/shrutib.ttf',    // Bold
			// Add other styles if needed
			];

			// Ensure paths to font files are correct
			$mpdf->autoScriptToLang = true;
			$mpdf->autoLangToFont = true;
			$mpdf->WriteHTML($html);
			$mpdf->Output($name.'_'.$filename."_congratulations.pdf",'D');
			
		
			exit;
	}
	else 
	{
		$page_data['control'] = "user";
		$this->load->view('login',$page_data);
	}
} 





	
	
}