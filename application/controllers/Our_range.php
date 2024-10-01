<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Our_range extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('product_model');
    }
    
    /* Dashboard */
	public function index()
    {
		$count_data = $this->product_model->get_total_web_our_range_data_count();
		
		$config = array();		
		$config['total_rows'] = count($count_data);
		$config['base_url'] = base_url() . "admin/our_range";
		$config['per_page'] = 20;
		$config['uri_segment'] = '3';
		$config['page_query_string']= TRUE;
		$config['query_string_segment'] = "page";
		$choice = $config["total_rows"] / $config["per_page"];
		
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
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($this->input->get('page') != '')
		{
			$page = ($this->input->get('page'));
		}
		else
		{
			$page = 0;
		}
		$image_url = base_url().'uploads/images/innerBanner.png';
		$oth_image_url = base_url().'uploads/images/thinklam.png';
		
		$data['all_our_range'] = $this->product_model->get_total_web_our_range_data($config["per_page"],$page);
		$data["links"] = $this->pagination->create_links();
		$data["category_data"] = get_category();
		$data['total_rows'] = $config["total_rows"];
		$data['page_id'] = $page;
		$data["page_names"] = 'Our Range';
		$data["header_image"] = $image_url;
		$data["oth_image_url"] = $oth_image_url;
		$data["page_title"] = 'Our Range';
		$data["page_title_bottom_text"] = "";
		$data["system_name"] = 'Reddmica';
		$data["meta_description"] = '';
		$data["meta_keywords"] = '';
		$data["meta_author"] = 'Reddmica';
		$data["page_slug"] = "our_range";
		$data["page_class"] = "our_range";
		$data["main_content"] = "cms_pages/our_range";
		$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item active'><a href='".base_url()."product'>Our Range</a></li>";
		$data["form_msg"] = "";
		$this->load->view("common_file/product_inner_template",$data);
    }
	
	public function product($para1 = '', $para2 = '', $para3 = '')
    {
		$range_id = $para1;
		$range_slug = $para2;
		$get_our_range_details = @$this->db->get_where('our_range',array('our_range_id'=>$range_id,'our_range_slug'=>$range_slug))->result_array();
		
		
		
		if(!empty($get_our_range_details)){
			$our_range_name = $get_our_range_details[0]['our_range_name'];
		}else{
			$our_range_name = "";
		}
		
		$category = @$_GET['category'];
		$data['category'] = $category;
		$data['range_id'] = $range_id;
		
		$per_page = 9;
		$page = 0;
		
		$next_page = $page + 9;
		
		$count_data = $this->product_model->get_total_web_product_data_count($category,$range_id);
		$total_pages = ceil(count($count_data)/$per_page);
		
		$image_url = base_url().'uploads/images/innerBanner.png';
		$oth_image_url = base_url().'uploads/images/thinklam.png';
		
		$data['all_product'] = $this->product_model->get_total_web_product_data($category,$range_id,$per_page,$page);
		$data["category_data"] = get_category();
		$data["brand_data"] = get_brand();
		$data['page_id'] = $page;
		$data['total_pages'] = $total_pages;
		$data['next_page'] = $next_page;
		$data["page_names"] = 'Our Range';
		$data["header_image"] = $image_url;
		$data["oth_image_url"] = $oth_image_url;
		$data["page_title"] = 'Our Range';
		$data["page_title_bottom_text"] = "";
		$data["system_name"] = 'Reddmica';
		$data["meta_description"] = '';
		$data["meta_keywords"] = '';
		$data["meta_author"] = 'Reddmica';
		$data["page_slug"] = "our_range";
		$data["page_class"] = "our_range";
		$data["main_content"] = "cms_pages/product_listing";
		$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item'><a href='".base_url()."product'>Our Range</a></li><li class='breadcrumb-item active'>$our_range_name</li>";
		$data["form_msg"] = "";
		$this->load->view("common_file/product_inner_template",$data);
    }
	
	public function product_load($para1 = '', $para2 = '', $para3 = '')
    {
		$range_id = $this->input->post('range_id');
		$category = $this->input->post('category');
		$per_page = 9;
		$page = $this->input->post('next_page_number');
		
		$data['next_page'] = $page + 9; 
		$all_product = $this->product_model->get_total_web_product_data($category,$range_id,$per_page,$page);
		$data['all_product'] = $all_product;
		if(!empty($all_product)){
			$data["main_content"] = "cms_pages/more_product_listing";
			$this->load->view("common_file/load_more_template",$data);
		}
    }
	
	function product_details($para1 = '',$para2 = '',$para3 = ''){
		$product_id = @$para1;
		$product_na = @$para2;
		$page_id = @$_GET['page'];
			
		$category = @$_GET['c_i'];
		$sub_category = @$_GET['s_c_i'];
		$data['category'] = $category;
		$data['sub_category'] = $sub_category;
		
		$data['product_data'] = $this->product_model->get_web_produtc_details($product_id,$product_na);
		$product_data = $data['product_data'];
		if(!empty($product_data)){
			$product_name = $product_data[0]['product_name'];
		}else{
			$product_name = "";
		}
		
		$image_url = base_url().'uploads/images/innerBanner.png';
		$oth_image_url = base_url().'uploads/images/thinklam.png';
		$data['product_id'] = $product_id;
		$data['page_id'] = $page_id;
		$data["page_names"] = $product_name;
		$data["header_image"] = $image_url;
		$data["oth_image_url"] = $oth_image_url;
		$data["page_title"] = $product_name;
		$data["page_title_bottom_text"] = "";
		$data["system_name"] = 'Reddmica';
		$data["meta_description"] = '';
		$data["meta_keywords"] = '';
		$data["meta_author"] = 'Reddmica';
		$data["page_slug"] = "our_range";
		$data["page_class"] = "our_range";
		$data["main_content"] = "cms_pages/our_range_details";
		$data["breadcum"] = "<li class='breadcrumb-item'><a href='".base_url()."'>Home</a></li><li class='breadcrumb-item'><a href='".base_url()."product'>Our Range</a></li><li class='breadcrumb-item active'>".$product_name."</li>";
		$data["form_msg"] = "";
		$this->load->view("common_file/product_inner_template",$data);
        
	}
	
	public function submit_enquiry(){
		$length1= 25;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$product_id = $this->input->post('product_id');
		$selected_items = $this->input->post('selected_texture');
		if(!empty($selected_items)){
			$selecteditems = array();
			foreach($selected_items as $row){
				$expo_name = explode("$//$",$row);
				$selecteditems[] = array(
					'title'=>$expo_name[0],
					'image'=>$expo_name[1],
				);
			}
			$final_selecteditems = json_encode($selecteditems);
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$cname = $this->input->post('cname');
			$city = $this->input->post('city');
			$comment = $this->input->post('comment');
			
			$data['inq_token'] = $token;
			$data['name'] = $name;
			$data['email'] = $email;
			$data['phone'] = $phone;
			$data['city'] = $city;
			$data['message'] = $comment;
			$data['company_name'] = $cname;
			$data['product_id'] = $product_id;
			$data['selected_items'] = $final_selecteditems;
			$data['created_date'] = time();
			$data['status'] = 'Active';
			$this->db->insert('product_inquirey', $data);
			
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				echo 'not_done';
			} else {
			    $this->product_model->send_email($data);
				echo 'done';
			}
		}else{
			echo 'select_a_texchure';
		}
	}
}