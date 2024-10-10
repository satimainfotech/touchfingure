<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
		$this->load->model('order_model');
    }

	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('order')) {
				redirect(base_url() . 'admin');
			}
			$sfrom_date = @$_GET['from_date'];
			$sto_date = @$_GET['to_date'];
			
			
			if($sfrom_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$sfrom_date 00:00:00",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$from_timestamp = '';
				} else {
					$from_timestamp = $d->getTimestamp();
				}
				$date_of_use_from = $from_timestamp; 
			}else{
				$date_of_rfrom =  '';
				$date_of_use_from =  '';
			}
			
			if($sto_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$sto_date 23:59:59",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$to_timestamp = '';
				} else {
					$to_timestamp = $d->getTimestamp();
				}
				$date_of_use_to = $to_timestamp; 
			}else{
				$date_of_rto =  '';
				$date_of_use_to =  '';
			}
			$data['from_date'] = $sfrom_date;
			$data['to_date'] = $sto_date;
			$data['payment_status'] = @$_GET['payment_status'];
			$data['order_status'] = @$_GET['order_status'];
			$data['order_id'] = @$_GET['order_id'];
			$data['mobile_number'] = @$_GET['mobile_number'];
			$data['customer_name'] = @$_GET['customer_name'];
			$gfrom_date = "$date_of_use_from";
			$gto_date = "$date_of_use_to";
			$payment_status = $data['payment_status'];
			$order_status = $data['order_status'];
			$order_id = $data['order_id'];
			$mobile_number = $data['mobile_number'];
			$customer_name = $data['customer_name'];
			
			$searchurl='from_date='.$sfrom_date.'&to_date='.$sto_date.'&payment_status='.$payment_status.'&order_status='.$order_status.'&order_id='.$order_id.'&mobile_number='.$mobile_number.'&customer_name='.$customer_name;
			
			$count_data = $this->order_model->get_total_order_data_count($gfrom_date,$gto_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/orders?".$searchurl;
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
			
			$data['all_sales'] = $this->order_model->get_total_order_data($gfrom_date,$gto_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			//$data['order_status_data'] = get_search_order_status();
			$data['page_name'] = "orders/orders";
            $data['page_name_link'] = "orders";
            //$data['all_categories'] = $this->db->get('orders')->result_array();
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }

    public function import() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $data['error'] = $this->upload->display_errors();
            //$this->load->view('upload_view', $data);
        } else {
            $file = $this->upload->data();
            $filePath = './uploads/' . $file['file_name'];

            // Load spreadsheet
            try {
                $spreadsheet = IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
                $this->db->trans_start(); // Start transaction

                // Insert Master Order record
                $dataOrder = [
                    'filename' => $file['file_name'],
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('Order', $dataOrder);
                $masterOrderId = $this->db->insert_id(); // Get the generated master order ID




				foreach ($sheet->getRowIterator() as $rowIndex => $row) {
					if ($rowIndex == 1) continue; // Skip header row
				
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(false); // Loop through all cells
				
					$rowData = [];
					foreach ($cellIterator as $cell) {
						$cellValue = $cell->getValue();
				
						// Handle rich text objects
						if ($cellValue instanceof \PhpOffice\PhpSpreadsheet\RichText\RichText) {
							$cellValue = $cellValue->getPlainText();
						}				
						$rowData[] = $cellValue; // Store the extracted value
					}
					print_r($rowData);
					// Now $rowData contains the plain text values
					// Insert into database here...
					$string =  $rowData[0];
					$delimiter = "Machining of Components";
					$pos = strpos($string, $delimiter);
					if ($pos !== false) {
					// Extract the Indent No part (before the delimiter)
					$indent_no = trim(substr($string, 0, $pos));
					// Extract the Machining of Components + HSN code part (after the delimiter)
					$hsn_code_part = trim(substr($string, $pos));
				    if($indent_no != "" && $hsn_code_part != ""){
						$dataOrder = [
							'indent_no' => $indent_no,
							'hsn_code' =>$hsn_code_part
						];
						$this->db->where('orderno',$masterOrderId);
						$this->db->update('Order', $dataOrder);
					}
					} 
					if($rowData[0] != "" && $rowData[1] != "" && $rowData[3] != "" && $rowData[1] != "JOB DESCRIPTION"){
					$data = [
						'parentid' => $masterOrderId,
						'sr_no' => $rowData[0],
						'job_description' => $rowData[1],
						'drawing_no' => $rowData[2],
						'qty' => $rowData[3],
						'material' => $rowData[4],
						'proposed_raw_material_size' => $rowData[5],
						'approx_fim_cost' => $rowData[6],
						'id_no_from' => $rowData[7],
						'project' => $rowData[8],
						'model' => $rowData[9],
						'gst_rate' => $rowData[10],
						'status' => $rowData[11],
						'created_date' => date('Y-m-d H:i:s'),
						'updated_date' => date('Y-m-d H:i:s')
					];
					$this->db->insert('Order', $data);
				}
				}
                $this->db->trans_complete(); // Complete transaction

                if ($this->db->trans_status() === FALSE) {
                    $data['error'] = 'Data insertion failed.';
                } else {
                    $data['error'] = 'File uploaded and data inserted successfully.';
                }
                // Load the view with the result
               // $this->load->view('upload_view', $data);
            } catch (Exception $e) {
                $data['error'] = 'Error loading file: ' . $e->getMessage();
                //$this->load->view('upload_view', $data);
            }
        }
			$page_data['page_name'] = "upload_view";
            $page_data['page_name_link'] = "import";
			$this->load->view('back/admin/index', $page_data);
    }
	function order_invoice(){
		echo "ttt";die;
		$order_id = @$_GET['o_i'];
		$order_token = @$_GET['o_t'];
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('order')) {
				redirect(base_url() . 'admin');
			}
			
			$sfrom_date = @$_GET['from_date'];
			$sto_date = @$_GET['to_date'];
			
			
			if($sfrom_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$sfrom_date 00:00:00",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$from_timestamp = '';
				} else {
					$from_timestamp = $d->getTimestamp();
				}
				$date_of_use_from = $from_timestamp; 
			}else{
				$date_of_rfrom =  '';
				$date_of_use_from =  '';
			}
			
			if($sto_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$sto_date 23:59:59",
					new DateTimeZone('UTC')
				);

				if ($d === false) {
					$to_timestamp = '';
				} else {
					$to_timestamp = $d->getTimestamp();
				}
				$date_of_use_to = $to_timestamp; 
			}else{
				$date_of_rto =  '';
				$date_of_use_to =  '';
			}
			$data['from_date'] = $sfrom_date;
			$data['to_date'] = $sto_date;
			$data['payment_status'] = @$_GET['payment_status'];
			$data['order_status'] = @$_GET['order_status'];
			$data['order_id'] = @$_GET['order_id'];
			$data['mobile_number'] = @$_GET['mobile_number'];
			$data['customer_name'] = @$_GET['customer_name'];
			$data['page_id'] = @$_GET['page'];
			
			$invoice_type = $this->input->post('invoice_type');
			if($invoice_type == 'pdf'){
				$new_pdf = $this->order_pdf($order_id,$user_id);
			}
			$data['orders'] = $this->order_model->get_single_order_details($order_id,$order_token);
			//$data['orders_items'] = $this->order_model->get_single_order_item_details($order_id);
            $data['page_name'] = "orders/orders_view";
            $data['page_name_link'] = "orders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
}
