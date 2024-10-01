<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Subscribers extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('subscribers_model');
    }
    
    /* Dashboard */
	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('contact')) {
				redirect(base_url() . 'admin');
			}
			$export_type = $this->input->post('export_type');
			if($export_type == 'excel'){
				$new_pdf = $this->excel_export();
			}
			$phone = @$_GET['p_n'];
			$from_date = @$_GET['f_d'];
			$to_date = @$_GET['t_d'];
			
			$data['phone'] = $phone;
			$data['from_date'] = $from_date;
			$data['to_date'] = $to_date;
			
			if($from_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$from_date 00:00:00",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$from_timestamp = '';
				} else {
					$from_timestamp = $d->getTimestamp();
				}
				$use_from_date = $from_timestamp; 
			}else{
				$use_from_date =  '';
			}
			
			if($to_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$to_date 23:59:59",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$to_timestamp = '';
				} else {
					$to_timestamp = $d->getTimestamp();
				}
				$use_to_date = $to_timestamp; 
			}else{
				$use_to_date =  '';
			}
			
			if($from_date != '' || $to_date != '' || $phone != ''){
				$searchurl='?p_n='.$phone.'&f_d='.$from_date.'&t_d='.$to_date;
			}else{
				$searchurl='';
			}
			
			$count_data = $this->subscribers_model->get_total_subscribers_data_count($phone,$use_from_date,$use_to_date);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/abdaily/subscribers".$searchurl;
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
			
			$data['all_subscribers'] = $this->subscribers_model->get_total_subscribers_data($phone,$use_from_date,$use_to_date,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data["category_data"] = get_category();
			$data["our_range_data"] = get_our_range();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "subscribers/subscribers";
            $data['page_name_link'] = "subscribers";
            $this->load->view('back/abdaily/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	function subscriberss($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('contact')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
			$id = $this->input->post('id');
            $data['subscribers_status'] = 'delete';
            $this->db->where('subscribers_id', $id);
            $this->db->update('contact_us_data',$data);
			echo 'done';
        }  else if ($para1 == 'subscribers_status_set') {
            $contact = $para2;
            if ($para3 == 'true') {
                $data['subscribers_status'] = 'Active';
            } else {
                $data['subscribers_status'] = 'De-active';
            }
            $this->db->where('subscribers_id', $contact);
            $this->db->update('contact_us_data',$data);
			echo 'done';
		}
    }
	
	function subscribers_view(){
		$contact_enq_id = @$_GET['ce_i'];
		$contact_enq_token = @$_GET['ce_t'];
		$page_id = @$_GET['page'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('contact')) {
				redirect(base_url() . 'admin');
			}
			$phone = @$_GET['p_n'];
			$from_date = @$_GET['f_d'];
			$to_date = @$_GET['t_d'];
			
			$data['phone'] = $phone;
			$data['from_date'] = $from_date;
			$data['to_date'] = $to_date;
			
			$page_data['subscribers_data'] = $this->subscribers_model->get_subscribers_details($contact_enq_id,$contact_enq_token);
			$page_data['subscribers_id'] = $contact_enq_id;
			$page_data['page_id'] = $page_id;
            $page_data['page_name'] = "subscribers/subscribers_view";
            $page_data['page_name_link'] = "subscribers";
            $this->load->view('back/abdaily/index', $page_data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
	} 
	
	public function excel_export()
	{
		$this->load->library("excel");
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("No.", "Contact id", "Name" , "Category", "Sub Category", "Sale qty", "Sale unit", "Status", "Description", "Disclaimer", "Storage tip");

		$column = 0;

		foreach($table_columns as $field)
		{
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$contact_data = $this->subscribers_model->get_exal_contact();

		$excel_row = 2;
		$r = 1;
		foreach($contact_data as $row)
		{
			$category = $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name');
			$sub_category = $this->crud_model->get_type_name_by_id('sub_category',$row['sub_category'],'sub_category_name');
			if($row['subscribers_status'] == 'ok'){ $subscribers_status = "Active"; } else { $subscribers_status = "De-active"; }
			
			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $r++);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['contact_id']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['title']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['category_name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['sub_category_name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['sale_unit_qty']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['unit_name']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $subscribers_status);
			$object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['description']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['disclaimer']);
			$object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['storage_tip']);
			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Contacts.xls"');
		$object_writer->save('php://output');
	}
}