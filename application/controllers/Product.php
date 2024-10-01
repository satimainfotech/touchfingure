<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Product extends CI_Controller
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
		$category = @$_GET['c_i'];
		$sub_category = @$_GET['s_c_i'];
		$product_name = @$_GET['p_n'];
		
		$data['category'] = $category;
		$data['sub_category'] = $sub_category;
		$data['product_name'] = $product_name;
		
		if($category != '' || $sub_category != '' || $product_name != ''){
			$searchurl='?c_i='.$category.'&s_c_i='.$sub_category.'&p_n='.$product_name;
		}else{
			$searchurl='';
		}
		
		$count_data = $this->product_model->get_total_web_product_data_count($category,$sub_category,$product_name);
		
		$config = array();		
		$config['total_rows'] = count($count_data);
		$config['base_url'] = base_url() . "admin/product".$searchurl;
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
		$data['all_product'] = $this->product_model->get_total_web_product_data($category,$sub_category,$product_name,$config["per_page"],$page);
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
}