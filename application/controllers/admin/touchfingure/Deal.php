<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Deal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('deal_model');
		$this->load->model('bank_model');
		
	}
  
    /* Country add, edit, view, delete */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('deal')) {
				redirect(base_url() . 'admin');
			}
			
			$name = @$_GET['b_n'];
		    $agent_id = @$_GET['agent_id'];
		 	$company_id = @$_GET['company_id'];
		
			
			$data['name'] = $name;
			$data['agent_id'] = $agent_id;
			$data['company_id'] = $company_id;
		
			
			if($name != '' || $agent_id != '' || $company_id != '' ){
				$searchurl='?name='.$name.'&agent_id='.$agent_id.'&company_id='.$company_id;
			}else{
				$searchurl='';
			}
			
		
			
			$count_data = $this->deal_model->get_total_deal_data_count($name,$agent_id,$company_id);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/deal".$searchurl;
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
			
			$data['all_deal'] = $this->deal_model->get_total_deal_data($name,$agent_id,$company_id,$config["per_page"],$page);
			$data['agent_data'] = $this->bank_model->get_agent_data();
			$data['investor_data'] = $this->bank_model->get_investor_data();
			
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "deal/deal";
            $data['page_name_link'] = "deal";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	function deal_add(){
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			
			if (!$this->crud_model->admin_permission('deal_add')) {
				redirect(base_url() . 'admin');
			}
			$deal = @$_GET['b_n'];
			$page_data['deal'] = $deal;
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
			$page_data['agent_data'] = $this->bank_model->get_agent_data();
			$page_data['investor_data'] = $this->bank_model->get_investor_data();
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "deal/deal_add";
            $page_data['page_name_link'] = "deal";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function deal_edit(){
		$deal_id = @$_GET['b_i'];
		$deal_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('deal_edit')) {
				redirect(base_url() . 'admin');
			}
			$deal = @$_GET['b_n'];
			$page_data['deal'] = $deal;
			
			$page_data['deal_data'] = $this->deal_model->get_deal_details($deal_id,$deal_token);
			$page_data['bank_data'] = $this->bank_model->get_bank_data();
			$page_data['agent_data'] = $this->bank_model->get_agent_data();
			$page_data['investor_data'] = $this->bank_model->get_investor_data();
			
			$page_data['deal_id'] = $deal_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "deal/deal_edit";
            $page_data['page_name_link'] = "deal";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function deal_view(){
		$deal_id = @$_GET['b_i'];
		$deal_token = @$_GET['b_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('deal_view')) {
				redirect(base_url() . 'admin');
			}
			$deal = @$_GET['b_n'];
			$page_data['deal'] = $deal;
			
			$page_data['deal_data'] = $this->deal_model->get_deal_details($deal_id,$deal_token);
			$page_data['deal_id'] = $deal_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "deal/deal_view";
            $page_data['page_name_link'] = "deal";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	function deal_do_add($para1 = '', $para2 = '', $para3 = ''){
		
		
		$length1 = 50;
		$characters1 = '01234567899876543210ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$data['deal_token'] = $token;
		
		$student_bank = explode("-",$this->input->post('student_bank_id'));
		$agent = explode("-",$this->input->post('agent_id'));
		$product = explode("-",$this->input->post('product_id'));
		$investor = explode("-",$this->input->post('investor_id'));
		$investor_bank = explode("-",$this->input->post('investor_bank_id'));
		
		$data['student_name'] = $this->input->post('student_name');
		$data['student_mobile'] = $this->input->post('student_mobile');
		$data['student_email'] = $this->input->post('student_email');
		$data['student_address'] = $this->input->post('student_address');		
		$data['student_bank_id'] = $student_bank[0];
		$data['student_bank_name'] = $student_bank[1];
		$data['student_account_number'] = $this->input->post('student_account_number');
		$data['loan_amount'] = $this->input->post('loan_amount');
		$data['loan_margin_percentage'] = $this->input->post('loan_margin_percentage');
		$data['loan_return_amount'] = $this->input->post('loan_return_amount');
		$data['loan_final_amount'] = $this->input->post('loan_final_amount');
		$data['agent_id'] = $agent[0];
		$data['product_id'] = $product[0];
		$data['product_name'] = $product[1];
		$data['agent_name'] = $agent[1];
		$data['agent_intrest_rate'] = $this->input->post('agent_intrest_rate');
		$data['agent_intrest_days'] = $this->input->post('agent_intrest_days');
		$data['agent_due_date_intrest_rate'] = $this->input->post('agent_due_date_intrest_rate');
		$data['deal_date'] = $this->input->post('deal_date');
		$data['deal_expiry_date'] = $this->input->post('deal_expiry_date');
		$data['agent_margin_amount'] = $this->input->post('agent_margin_amount');		
		$data['investor_id'] = $investor[0];
		$data['investor_name'] = $investor[1];
		$data['investor_intrest_rate'] = $this->input->post('investor_intrest_rate');
		$data['investor_margin_amount'] = $this->input->post('investor_margin_amount');
		$data['investor_bank_id'] = $investor_bank[0];
		$data['investor_bank_name'] = $investor_bank[1];
		$data['investor_account_number'] = $this->input->post('investor_account_number');
		$data['created_date'] = date("Y-m-d");
		$data['updated_date'] = date("Y-m-d");
		
		$this->db->insert('deal_master', $data);
		$id = $this->db->insert_id(); 
		
		/*for($i=1;$i<=$data['months'];$i++)
		{
			$tran_data['deal_id']= $id;
			$today = date('Y-m-d');
			$next_date = date('Y-m-d', strtotime('+'.$i. 'month', strtotime($today)));
			$tran_data['next_date']= $next_date;
			$tran_data['deal_status']= 'pending';
			$tran_data['created_date'] = $today;
			$tran_data['updated_date'] = $today;
			$this->db->insert('deal_transaction', $tran_data);
		}*/
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
	function deal_update($para1 = '', $para2 = '', $para3 = ''){
		
		$data['agent_id'] = $this->input->post('agent_id');
		$data['student_name'] = $this->input->post('student_name');
		$data['student_mobile'] = $this->input->post('student_mobile');
		$data['student_email'] = $this->input->post('student_email');
		$data['student_address'] = $this->input->post('student_address');
		$data['loan_amount'] = $this->input->post('loan_amount');
		$data['months'] = $this->input->post('months');
		$data['intrest_percentage'] = $this->input->post('intrest_percentage');
		$data['deal_date'] = $this->input->post('deal_date');
		$data['addon'] = $this->input->post('addon');
		$data['student_account_number'] = $this->input->post('student_account_number');
		$data['bank_id'] = $this->input->post('bank_id');
		$data['investor_id'] = $this->input->post('investor_id');
		$data['investor_bank_id'] = $this->input->post('investor_bank_id');
		$data['investor_account_number'] = $this->input->post('investor_account_number');
		$data['product'] = $this->input->post('product');
		
		
		$this->db->where('deal_id', $para1);
		$this->db->update('deal_master', $data);
		
		$this->db->where('deal_id', $para1);
		$this->db->delete('deal_transaction');
		
		for($i=1;$i<=$data['months'];$i++)
		{
			$tran_data['deal_id']= $para1;
			$today = date('Y-m-d');
			$next_date = date('Y-m-d', strtotime('+'.$i. 'month', strtotime($today)));
			$tran_data['next_date']= $next_date;
			$tran_data['deal_status']= 'pending';
			$tran_data['created_date'] = $today;
			$tran_data['updated_date'] = $today;
			$this->db->insert('deal_transaction', $tran_data);
		}
		
		$this->db->trans_complete();
		
		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			echo 'not_done';
		} else {
			echo 'done';
		}
	}
	
    function deals($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('deal')) {
            redirect(base_url() . 'admin');
        }
        elseif ($para1 == 'delete') {
			$id = $this->input->post('id');
			$deal_images = @$this->db->get_where('deal',array('deal_id'=>$id))->row()->deal_image;
			if($deal_images != ''){
				$rpersonal = "uploads/deal_image/".$deal_images;
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			$data['deal_image'] = NULL;
			$data['deal_status'] = 'delete';
            $this->db->where('deal_id', $id);
			$this->db->update('deal', $data);
        }else if ($para1 == 'status_set') {
            $deal = $para2;
			if ($para3 == 'true') {
                $data['deal_status'] = 'Active';
            } else {
                $data['deal_status'] = 'De-active';
            }
            $this->db->where('deal_id', $deal);
            $this->db->update('deal_master', $data);
        }
    }
	
	function transaction_status_set($para1 = '', $para2 = '', $para3 = '')
	{
		
		if ($para2 == 'false') {
			$data['deal_status'] = 'pending';
		} else {
			$data['deal_status'] = 'completed';
		}
		
		 $this->db->where('deal_transaction_id', $para1);
         $this->db->update('deal_transaction', $data);
	
		
	}
	function update_deal_position(){
		$position_value = $this->input->post('position_value');
		$deal_id = $this->input->post('deal_id');
		
		$data['updated_date'] = date("Y-m-d");
		$data['force_amount'] = $position_value;
		$this->db->where('deal_id',$deal_id);
		$this->db->update('deal_master',$data);
		
		$tran_data['updated_date'] = date("Y-m-d");
		$tran_data['status'] = 'completed';
		$this->db->where('deal_id',$deal_id);
		$this->db->update('deal_transaction',$tran_data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function update_remarks(){
		$position_value = $this->input->post('position_value');
		$deal_id = $this->input->post('deal_id');		
		$tran_data['remarks'] = $position_value;
		$tran_data['updated_date'] = date("Y-m-d");
		$tran_data['deal_status'] = 'completed';
		$this->db->where('deal_transaction_id',$deal_id);
		$this->db->update('deal_transaction',$tran_data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	
	
	/* Country add, edit, view, delete */
	public function transactions()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('deal')) {
				redirect(base_url() . 'admin');
			}
			
			$deal = @$_GET['b_i'];
			$data['deal'] = $deal;
			
			if($deal != ''){
				$searchurl='?b_n='.$deal;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->deal_model->get_total_deal_transactions_data_count($deal);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/deal".$searchurl;
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
			
			$data['all_deal'] = $this->deal_model->get_total_deal_transactions_data($deal,$config["per_page"],$page);
			
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "deal/deal_transactions";
            $data['page_name_link'] = "deal";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	public function get_agent_products()
	{
		$products_data = $this->deal_model->get_agent_products($this->input->post('agent_id'));
		$select = '';
		$select.="<select name='product_id' class='demo-chosen-select' data-placeholder='Choose a Products' id='product_id' onchange='get_agent_product_details(this.value)'><option value='0'>Select Any Product </option>";
		foreach($products_data as $products)
 		{	
			$select.="<option value='".$products['id']."-".$products['product_name']."'>".$products['product_name']."</option>";
		} 
		$select.="</select>";
		echo $select;
	}
	
	
	public function get_investor_details()
	{
		$investor_data = $this->deal_model->get_investor_details($this->input->post('investor_id'));	
		
		
		$intrest_rate = $investor_data[0]['intrest_rate'];
		$loan_amount = $this->input->post('loan_amount');
		$investor_margin_amount = ($loan_amount*$intrest_rate)/100;
		
			
		$investor_details = '';
		
		echo $investor_details.='<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">Agent Intrest Rate</label><div class="col-sm-10">
																<input type="text" name="investor_intrest_rate" id="investor_intrest_rate" placeholder="Investor Intrest Rate" value = "'.$intrest_rate.'" class="form-control required " readonly>
															</div>
														</div>
														<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">Investor Margin Amount</label><div class="col-sm-10">
																<input type="text" name="investor_margin_amount" id="investor_intrest_rate" placeholder="Investor Margin Amount" value = "'.$investor_margin_amount.'" class="form-control required " readonly>
															</div>
														</div>';
	}

	
	public function get_agent_product_details()
	{
		$products_data = $this->deal_model->get_agent_product_details($this->input->post('agent_prodcut_id'));	
		$loan_amount = $this->input->post('loan_amount');

		$intrest_rate = $products_data[0]['intrest_rate'];
		$days = $products_data[0]['days'];
		$due_date_intrest_rate = $products_data[0]['due_date_intrest_rate'];
		$today = date('Y-m-d');
		$expiry_date = date('Y-m-d', strtotime('+'.$days. 'days', strtotime($today)));
		
		$agent_margin_amount = ($loan_amount*$intrest_rate)/100;
		
		$agent_products = '';
		
		echo $agent_products.='<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">Agent Intrest Rate</label><div class="col-sm-10">
																<input type="text" name="agent_intrest_rate" id="agent_intrest_rate" placeholder="Agent Intrest Rate" value = "'.$intrest_rate.'" class="form-control required " readonly>
															</div>
														</div>
														<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">No Of Days</label><div class="col-sm-10">
																<input type="text" name="agent_intrest_days" id="agent_intrest_days" placeholder="Agent Intrest Rate" value = "'.$days.'" class="form-control required " readonly>
															</div>
														</div>
														<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">After Due Date Intrest Rate</label><div class="col-sm-10">
																<input type="text" name="agent_due_date_intrest_rate" id="agent_due_date_intrest_rate" placeholder="Agent Intrest Rate" value = "'.$due_date_intrest_rate.'" class="form-control required " readonly>
															</div>
														</div>
															<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">Deal Date</label><div class="col-sm-10">
																<input type="text" name="deal_date" id="deal_date" placeholder="Deal Date" value = "'.$today.'" class="form-control required " readonly>
															</div>
														</div>
														<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">Deal Expiry Date</label><div class="col-sm-10">
																<input type="text" name="deal_expiry_date" id="deal_expiry_date" placeholder="Deal Expiry Date" value = "'.$expiry_date.'" class="form-control required " readonly>
															</div>
														</div>
														<div class="form-group "><label class="col-sm-2 control-label" for="demo-hor-1">Agent Margin Amount</label><div class="col-sm-10">
																<input type="text" name="agent_margin_amount" id="agent_margin_amount" placeholder="Agent Margin  Amount" value = "'.$agent_margin_amount.'" class="form-control required " readonly>
															</div>
														</div>';
		
		
	}
}