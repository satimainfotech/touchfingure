<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\IOFactory;
class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
		$this->load->model('order_model');
    }

	public function index()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('Orders')) {
				redirect(base_url() . 'admin');
			}
			$order_status = $_GET['order_status'];
			$order_id = $_GET['order_id'];
			$searchurl='order_status='.$order_status.'&order_id='.$order_id;
			$count_data = $this->order_model->get_total_order_data_count($order_status,$order_id);
			
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
			$data['all_sales'] = $this->order_model->get_total_order_data($order_status,$order_id,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "orders/orders";
            $data['page_name_link'] = "orders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }

	public function assigned_orders()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('or_assign')) {
				redirect(base_url() . 'admin');
			}
			$order_status = $_GET['order_status'];
			$order_id = $_GET['order_id'];
			$searchurl='order_status='.$order_status.'&order_id='.$order_id;
			$count_data = $this->order_model->get_total_order_data_count_assigned($order_status,$order_id);
			
			$config = array();		
			$config['total_rows'] = $count_data;
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
			$data['all_sales'] = $this->order_model->get_total_order_data_assigned($order_status,$order_id,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "orders/assignedorder";
            $data['page_name_link'] = "orders";
			$this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }

	public function report()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('or_assign')) {
				redirect(base_url() . 'admin');
			}
			$order_status = $_GET['employee'];
			$order_id = $_GET['order_id'];
			$searchurl='employee='.$order_status.'&order_id='.$order_id;
			$count_data = $this->order_model->get_total_order_data_count_assignedemployee($order_status,$order_id);
			
			$config = array();		
			$config['total_rows'] = $count_data;
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
			$data['all_sales'] = $this->order_model->get_total_order_data_assignedemployee($order_status,$order_id,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "orders/assignedorderreport";
            $data['page_name_link'] = "orders";
			$this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }

	public function order_invoice()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('orma')) {
				redirect(base_url() . 'admin');
			}
			$order_id = $_GET['o_t'];
			$data['all_sales'] = $this->get_ordermain_details($order_id);
			$data['page_name'] = "orders/mainorder";
            $data['page_name_link'] = "orders";
			$this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	public function get_ordermain_details($order_id){
		$this->db->select('*');
		$this->db->from('order');		
		$this->db->where('parentid', $order_id);
		return $this->db->get()->result_array();
	}
	public function main()
    {
		if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('order')) {
				redirect(base_url() . 'admin');
			}
			$sfrom_date = @$_GET['from_date'];
			$sto_date = @$_GET['to_date'];
			
			$data['from_date'] = $sfrom_date;
			$data['to_date'] = $sto_date;
			$data['payment_status'] = @$_GET['payment_status'];
			$data['order_status'] = @$_GET['order_status'];
			$data['order_id'] = @$_GET['order_id'];
			$gfrom_date = "$date_of_use_from";
			$gto_date = "$date_of_use_to";
			$payment_status = $data['payment_status'];
			$order_status = $data['order_status'];
			$order_id = $data['order_id'];
			$mobile_number = $data['mobile_number'];
			$customer_name = $data['customer_name'];
			
			$searchurl='from_date='.$sfrom_date.'&to_date='.$sto_date.'&payment_status='.$payment_status.'&order_status='.$order_status.'&order_id='.$order_id.'&mobile_number='.$mobile_number.'&customer_name='.$customer_name;
			
			$count_data = $this->order_model->get_total_ordermain_data_count($gfrom_date,$gto_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/orders/main?".$searchurl;
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
			
			$data['all_sales'] = $this->order_model->get_total_ordermain_data($gfrom_date,$gto_date,$payment_status,$order_status,$order_id,$mobile_number,$customer_name,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "orders/main";
            $data['page_name_link'] = "orders";
            //$data['all_categories'] = $this->db->get('orders')->result_array();
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }

    public function import() {
      
		if ($this->session->userdata('admin_login') == ''){
			if (!$this->crud_model->admin_permission('order')) {
				redirect(base_url() . 'admin');
			}
		}
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
					//print_r($rowData);
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
					// Check for Material ID (country)
					$material_name = $rowData[4]; // Assuming this is the material name
					$material_id = $this->get_or_create_country_id($material_name); // Custom method to check and create country

					$model_name = $rowData[10]; // Assuming this is the model name
					$model_id = $this->get_or_create_member_type_id($model_name); // Custom method to check and create member type
			
						$data = [
						'parentid' => $masterOrderId,
						'sr_no' => $rowData[0],
						'job_description' => $rowData[1],
						'drawing_no' => $rowData[2],
						'qty' => $rowData[3],
						'material' => $material_id,
						'proposed_raw_material_size' => $rowData[5],
						'approx_fim_cost' => $rowData[6],
						'id_no_from' => $rowData[7],
						'id_no_to'=> $rowData[8],
						'project' => $rowData[9],
						'model' => $model_id,
						'gst_rate' => $rowData[11],
						'materialname' => $rowData[4],
						'modelname' => $rowData[10],
						'status' => 1,
						'order_status' => 'new',
						'created_date' => date('Y-m-d H:i:s'),
						'updated_date' => date('Y-m-d H:i:s')
					];
					$this->db->insert('Order', $data);
					$id = $this->db->insert_id();

					$datanui['notification_user_id']= $_SESSION['admin_id'];
					$datanui['notification_content']= $_SESSION['admin_name']." has created new order - ".@$id;
					$datanui['notification_read']= 1;
					$datanui['created_by']= $_SESSION['admin_id'];
					$datanui['created_date']= date('Y-m-d H:i:s'); 
					$datanui['order_id']=  $id; 
					$this->db->insert('logs',$datanui);

				}
				}
                $this->db->trans_complete(); // Complete transaction

                if ($this->db->trans_status() === FALSE) {
                    $page_data['error'] = 'Data insertion failed.';
                } else {
                    $page_data['error'] = 'File uploaded and data inserted successfully.';
                }
                // Load the view with the result
               // $this->load->view('upload_view', $data);
            } catch (Exception $e) {
                $page_data['error'] = 'Error loading file: ' . $e->getMessage();
                //$this->load->view('upload_view', $data);
            }
        }
			$page_data['page_name'] = "upload_view";
            $page_data['page_name_link'] = "import";
			$this->load->view('back/admin/index', $page_data);
    }
	public function get_or_create_country_id($country_name) {
		// Check if the country exists
		$this->db->select('country_id');
		$this->db->from('country');
		$this->db->where('country_name', $country_name);
		$query = $this->db->get();
		$this->db->last_query();
		if ($query->num_rows() > 0) {
			// Country exists, return its ID
			$row = $query->row();
			return $row->country_id;
		} else {
			// Country doesn't exist, insert it
			$data = [
				'country_name' => $country_name
			];
			$this->db->insert('country', $data);
			return $this->db->insert_id(); // Return the new country ID
		}
	}

	public function get_or_create_member_type_id($member_type_name) {
		// Check if the member type exists
		$this->db->select('member_type_id');
		$this->db->from('member_type');
		$this->db->where('member_type_name', $member_type_name);
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			// Member type exists, return its ID
			$row = $query->row();
			return $row->member_type_id;
		} else {
			// Member type doesn't exist, insert it
			$data = [
				'member_type_name' => $member_type_name
			];
			$this->db->insert('member_type', $data);
			return $this->db->insert_id(); // Return the new member type ID
		}
	}

	/* Managing sales by users */
    function Deleteorder($para1 = '', $para2 = '')
    {
		if (!$this->crud_model->admin_permission('orm_delete')) {
            redirect(base_url() . 'admin');
        }
        $data['status'] = '0';
		$this->db->where('orderno', $para1);
        $this->db->update('order',$data);

		$datanui['notification_user_id']= $_SESSION['admin_id'];
		$datanui['notification_content']= $_SESSION['admin_name']." has deleted order - ".@$para1;
		$datanui['notification_read']= 1;
		$datanui['created_by']= $_SESSION['admin_id'];
		$datanui['created_date']= date('Y-m-d H:i:s'); 
		$datanui['order_id']=  $para1; 
		$this->db->insert('logs',$datanui);



    }
	function Assign($para1 = '', $para2 = '')
    {
		if (!$this->crud_model->admin_permission('orma_add')) {
            redirect(base_url() . 'admin');
        }
		$page_data['admin_data'] = $this->db->get_where('order', array('orderno' => $para1))->result_array();
		$this->load->view('back/admin/orders/assigned', $page_data);
    }	
	function Assignto($para1 = '', $para2 = ''){
		if (!$this->crud_model->admin_permission('orma_add')) {
            redirect(base_url() . 'admin');
        }
		try {
			$datap['orderid']= $para1; 
			$datap['assign_date']= date('Y-m-d');
			$datap['assign_by']= $_SESSION['admin_id'];
			$datap['assign_to']= $_POST['assignto'];
			$datap['status']= "new";
			$this->db->insert('order_assign', $datap);
			$data['error'] = 'Data insertion successfully.';


			$datanui['notification_user_id']= $_POST['assignto'];
			$datanui['notification_content']= "you have been assigned a new order number ".$para1." by ".$_SESSION['admin_name'];
			$datanui['notification_read']= 0;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']= $para1; 
			$this->db->insert('notification',$datanui);
			$this->db->insert('logs',$datanui);


			$datapp['order_status']= "assigned";
			$this->db->where('orderno', $para1);
			$this->db->update('order', $datapp);

		}
		catch (Exception $e) {
			$data['error'] = 'Error loading file: ' . $e->getMessage();
		}  
	}
	function Startenddone(){

		$flag = $_GET['flag'];
		if($flag == "start"){
			$datap['assignby']= $_GET['assign_by']; 
			$datap['assignto']= $_GET['assign_to']; 
			$datap['orderno']= $_GET['orderid']; 
			$datap['as_id']= $_GET['as_id']; 
			$datap['starttime']= date('Y-m-d H:i:s');
			$this->db->insert('ordertimelog', $datap);
			$data['error'] = 'Data insertion successfully.';

			$datapp['status']= "inprogress";
			$this->db->where('id',$_GET['as_id']);
			$this->db->update('order_assign', $datapp);

			$datappp['order_status']= "inprogress";
			$this->db->where('orderno',$_GET['orderid']);
			$this->db->update('order', $datappp);

			$para1 = $_GET['orderid'];
			$datanui['notification_user_id']= $_GET['assign_by'];
			$datanui['notification_content']= $_SESSION['admin_name']." has started working on order number ".$para1;
			$datanui['notification_read']= 0;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']= $para1; 
			$this->db->insert('logs',$datanui);
			$this->db->insert('notification',$datanui);

			
		}
		if($flag == "end"){
			$datap['endtime']= date('Y-m-d H:i:s');
			$this->db->where('otid',$_GET['as_id']);
			$this->db->update('ordertimelog', $datap);			
		}
		if($flag == "done"){

			$datap['endtime']= date('Y-m-d H:i:s');
			$this->db->where('otid',$_GET['orderid']);
			$this->db->where('assignto',$_SESSION['admin_id']);
			$this->db->update('ordertimelog', $datap);

			$datapp['status']= "done";
			$this->db->where('orderid',$_GET['orderid']);
			$this->db->where('assign_to',$_SESSION['admin_id']);
			$this->db->update('order_assign', $datapp);

			$datappp['order_status']= "done";
			$this->db->where('orderno',$_GET['orderid']);
			$this->db->update('order', $datappp);


			$para1 = $_GET['orderid'];
			$datanui['notification_user_id']= $_GET['assign_by'];
			$datanui['notification_content']= $_SESSION['admin_name']." has completed order number ".$para1;
			$datanui['notification_read']= 0;
			$datanui['created_by']= $_SESSION['admin_id'];
			$datanui['created_date']= date('Y-m-d H:i:s'); 
			$datanui['order_id']= $para1; 
			$this->db->insert('logs',$datanui);
			$this->db->insert('notification',$datanui);

		}
		return true;
	}
	function get_notification_count(){
		$query = $this->db->get_where('notification', array(
			'notification_read' => 0,
			'notification_user_id' => $_SESSION['admin_id']
		));		
		//echo $this->db->last_query();
		$notification = $query->row();		
		if($notification != "" &&  $_SESSION['role'] != '') {
			$id = $notification->{'notification_id'};
			$content = $notification->{'notification_content'};
			$html = $content.'<br/><br/><button type="button" class="btn btn-warning mark-as-read" onclick="markNotificationsAsRead('.$id.')">OK GOT IT</button>';
			$res = array('count'=>1,'notification_content'=>$html);
			echo json_encode($res);
		}
	}
	function mark_notifications_read(){
		$p = $_GET['p'];
		$data['notification_read'] = 1;
		$this->db->where('notification_id',$p);
		$this->db->update('notification',$data);
		//echo $this->db->last_query();
		$res = array('status'=>'success','notification_content'=>"Thank You!");
		echo json_encode($res);
	}
	function Stopyesterday(){
		
	// Retrieve all records where endtime is NULL
	$this->db->where('endtime', NULL);
	$this->db->where('starttime <', date('Y-m-d'));
	$query = $this->db->get('ordertimelog');
	// Loop through each record and update the endtime dynamically based on starttime
	foreach ($query->result() as $record) {
	// Get the starttime date part
	$start_date = date('Y-m-d', strtotime($record->starttime));

	// Set the endtime to 9 PM on the same day as the starttime
	$end_time = $start_date . ' 21:00:00';

	// Update the record with the calculated endtime
	$this->db->set('endtime', $end_time);
	$this->db->where('otid', $record->otid); // Update by record ID or primary key
	$this->db->update('ordertimelog');

	echo "Order ID: " . $record->id . " - Start Time: " . $record->starttime . " - End Time updated to: " . $end_time . "<br>";
	}
	}
}
