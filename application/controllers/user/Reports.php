<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Reports extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('report_model');
		$this->load->model('agent_model');
		$this->load->model('investor_model');
		$this->load->model('deal_model');
		$this->load->model('bank_model');
		
    }
    
    /* Dashboard */
	
	public function agent()
	{
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('agent')) {
				redirect(base_url() . 'admin');
			}
			
			$agent = @$_GET['b_n'];
			$data['agent'] = $agent;
			
			if($agent != ''){
				$searchurl='?b_n='.$agent;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->agent_model->get_total_agent_data_count($agent);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/reports/agent".$searchurl;
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
			
			$data['all_agent'] = $this->agent_model->get_total_agent_data($agent,$config["per_page"],$page);
			
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "reports/agent";
            $data['page_name_link'] = "reports_agent";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function investor()
    {
	
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('investor')) {
				redirect(base_url() . 'admin');
			}
			
			$investor = @$_GET['b_n'];
			$data['investor'] = $investor;
			
			if($investor != ''){
				$searchurl='?b_n='.$investor;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->investor_model->get_total_investor_data_count($investor);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/reports/investor".$searchurl;
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
			
			$data['all_investor'] = $this->investor_model->get_total_investor_data($investor,$config["per_page"],$page);
			
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "reports/investor";
            $data['page_name_link'] = "reports_investor";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	/* Country add, edit, view, delete */
	public function student()
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
			$config['base_url'] = base_url() . "admin/reports/student".$searchurl;
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
			$data['page_name'] = "reports/student";
            $data['page_name_link'] = "reports_student";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	
	
	public function online_transaction()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('online_transaction')) {
				redirect(base_url() . 'admin');
			}
			
			$m_n = @$_GET['m_n'];
			$f_date = @$_GET['f_date'];
			$t_date = @$_GET['t_date'];
			$t_y = @$_GET['t_y'];
			
			$data['m_n'] = $m_n;
			$data['f_date'] = $f_date;
			$data['t_date'] = $t_date;
			$data['t_y'] = $t_y;
			
			if($f_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$f_date 00:00:00",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$from_timestamp = '';
				} else {
					$from_timestamp = $d->getTimestamp();
				}
				$from_date = $from_timestamp; 
			}else{
				$from_date =  '';
			}
			
			if($t_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$t_date 23:59:59",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$to_timestamp = '';
				} else {
					$to_timestamp = $d->getTimestamp();
				}
				$to_date = $to_timestamp; 
			}else{
				$to_date =  '';
			}
			
			$export_type = @$_GET['export_type'];
			if($export_type == 'excel'){
				$this->excel_online_transaction_export($m_n,$from_date,$to_date,$t_y);
			}
			
			if($m_n != '' || $f_date != '' || $t_date != '' || $t_y != ''){
				$searchurl='?m_n='.$m_n.'&f_date='.$f_date.'&t_date='.$t_date.'&t_y='.$t_y;
			}else{
				$searchurl='';
			}
			
			$data['fe_date'] = $from_date;
			$data['te_date'] = $to_date;
			
			$count_data = $this->report_model->get_total_online_transaction_data_count($m_n,$from_date,$to_date,$t_y);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/reports/online_transaction".$searchurl;
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
			
			$data['online_transaction_data'] = $this->report_model->get_total_online_transaction_data($m_n,$from_date,$to_date,$t_y,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "reports/online_transaction_list";
            $data['page_name_link'] = "online_transaction";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function online_transaction_view(){
		$txt_token = @$_GET['t_t'];
		$txt_id = @$_GET['t_i'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('online_transaction_view')) {
				redirect(base_url() . 'admin');
			}
			
			$m_n = @$_GET['m_n'];
			$f_date = @$_GET['f_date'];
			$t_date = @$_GET['t_date'];
			$t_y = @$_GET['t_y'];
			
			$page_data['m_n'] = $m_n;
			$page_data['f_date'] = $f_date;
			$page_data['t_date'] = $t_date;
			$page_data['t_y'] = $t_y;
			
			$page_data['online_transaction_data'] = $this->report_model->get_online_transaction_details($txt_token,$txt_id);
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "reports/online_transaction_view";
            $page_data['page_name_link'] = "online_transaction";
            $this->load->view('back/admin/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	}
	
	public function excel_online_transaction_export($m_n,$from_date,$to_date,$t_y)
	{
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("No.", "Txt ID", "Transaction ID", "Amount" , "Payment Method" , "User Name" , "Mobile", "Email", "Transaction Date", "Created date");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$request_data = $this->report_model->get_total_online_transaction_excel_data($m_n,$from_date,$to_date,$t_y);

		$excel_row = 2;
		$r = 1;
		foreach($request_data as $row)
		{
			$txt_date = get_orignal_app_datetime($row['txt_date']);
			$created_date = get_orignal_app_datetime($row['created_date']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $r++);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['txt_id']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['txt_order_id']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, 'Rs. '.$row['txt_amount']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['txt_method']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['mobile_number']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['email']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $txt_date);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $created_date);
			$excel_row++;
		}
		
		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Onlline Transaction Data.xls"');
		$object_writer->save('php://output');
	}
}