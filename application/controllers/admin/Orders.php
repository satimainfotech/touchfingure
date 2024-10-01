<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('order_model');
    }
    
    /* Dashboard */
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
    
	function status_update($para1 = '', $para2 = '',  $para3 = ''){
		$orders= $this->db->get_where('orders',array('order_id'=>$para1))->result_array();
		$order_status = $this->input->post('status');
		$traking_id = $this->input->post('traking_id');
		$traking_link = $this->input->post('traking_link');
		if($traking_id != ''){
			$use_traking_id = $traking_id;
		}else{
			$use_traking_id = $orders[0]['traking_id'];
		}
		if($traking_link != ''){
			$use_traking_link = $traking_link;
		}else{
			$use_traking_link = $orders[0]['traking_link'];
		}
		
		if($order_status != ''){
			if($order_status == '2'){
				$data['order_status'] = $order_status;
				$data['traking_id'] = $use_traking_id;
				$data['traking_link'] = $use_traking_link;
				
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status;
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status;
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER READY FOR SHIPPING */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							if($use_traking_id != '' && $use_traking_link != '' ){
								$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is Ready for shipping. Tracking ID : $use_traking_id and Link $use_traking_link";
								$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Ready for shipping. Tracking ID : $use_traking_id and Link $use_traking_link";
							}else{
								$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is Ready for shipping.";
								$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Ready for shipping.";
							}
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER READY FOR SHIPPING */
				echo 'done';
				return false;
			}else if($order_status == '3'){
				$data['order_status'] = $order_status;
				$data['traking_id'] = $use_traking_id;
				$data['traking_link'] = $use_traking_link;
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status;
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status;
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER SHIPPED */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							if($use_traking_id != '' && $use_traking_link != '' ){
								$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is Shipped. Tracking ID : $use_traking_id and Link $use_traking_link";
								$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Shipped. Tracking ID : $use_traking_id and Link $use_traking_link";
							}else{
								$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is Shipped.";
								$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Shipped.";
							}
							$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is Shipped.";
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER SHIPPED */
				echo 'done';
				return false;
			}else if($order_status == '4'){
				$data['order_status'] = $order_status;
				$data['traking_id'] = $use_traking_id;
				$data['traking_link'] = $use_traking_link;
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status;
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status;
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							if($use_traking_id != '' && $use_traking_link != '' ){
								$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is on the way. Tracking ID : $use_traking_id and Link $use_traking_link";
								$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is on the way. Tracking ID : $use_traking_id and Link $use_traking_link";
							}else{
								$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is on the way.";
								$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is on the way.";
							}
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
				echo 'done';
				return false;
			}else if($order_status == '5'){
				$data['order_status'] = $order_status;
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status;
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status;
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							$notification_msg = "Hello $user_name,Your Order $order_id_with_prefix is Delivered.";
							$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Delivered.";
							
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
				echo 'done';
				return false;
			}else if($order_status == '6'){
				$data['order_status'] = $order_status;
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status.',7';
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status.',7';
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							$notification_msg = "Hello $user_name, Your Order $order_id_with_prefix is Return. Your cashback point is refund in Cashback Point wallet.";
							$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Return. Your cashback point is refund in Cashback Point wallet.";
							
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
				echo 'done';
				return false;
			}else if($order_status == '7'){
				$data['order_status'] = $order_status;
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status.',6';
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status.',6';
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							$notification_msg = "Hello $user_name, Your Order $order_id_with_prefix is Replcaed.";
							$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Replcaed.";
							
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER ON THE WAY */
				echo 'done';
				return false;
			}else if($order_status == '8'){
				$data['order_status'] = $order_status;
				if($orders[0]['update_order_status'] == ''){
					$data['update_order_status'] = $order_status.',2,3,4,5,6,7';
				}else{
					$data['update_order_status'] = $orders[0]['update_order_status'].','.$order_status.',2,3,4,5,6,7';
				}
				$this->db->where('order_id', $para1);
				$this->db->update('orders', $data);
				
				
				/* SEND SMS FOR USER TO ORDER CANCEL */
					$order_id_with_prefix = order_id_with_prefix($para1);
					$user_data = @$this->db->get_where('user',array('user_id'=>$orders[0]['order_user_id']))->result_array();
					if(!empty($user_data)){
						$user_name = $user_data[0]['name'];
						$mobile_number = $user_data[0]['mobile_number'];
						//$check_sms = 		@$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
						//if($check_sms == 'yes'){
							//$message = urlencode("Hello $user_name, Your Order $order_id_with_prefix is on the way.");
							//$send_sms = send_sms($mobile_number,$message);
						//}
						/* USER NOTIFICATION */
							$notification_msg = "Hello $user_name, Your Order $order_id_with_prefix is Cancel by Reddmica. if any query contact to Reddmica";
							$noti_mass = "Hello $user_name, Your Order $order_id_with_prefix is Cancel by Reddmica. if any query contact to Reddmica";
							
							$udata['notification_user_id'] = $user_data[0]['user_id'];
							$udata['notification_content'] = $notification_msg;
							$udata['notification_type'] = 'order';
							$udata['user_type'] = $user_data[0]['account_type'];
							$udata['order_id'] = $para1;
							$udata['created_by'] = $user_data[0]['user_id'];
							$udata['order_token'] = $orders[0]['order_token'];
							$udata['notification_read'] = 'no';
							$udata['created_date'] = time();
							$this->db->insert('notification',$udata);
						/* USER NOTIFICATION */
						$to = $user_data[0]['device_token'];
						$data = array(
							'title' => "Order ID : $order_id_with_prefix",
							'body' => $noti_mass
						);
						sendPushNotification($to,$data);
					}
				/* SEND SMS FOR USER TO ORDER CANCEL */
				echo 'done';
				return false;
			}
		}else{
			echo 'not_done';
			return false;
		}
		
	}
    /* Managing sales by users */
    function sales($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('order')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
			$data['order_delete_status'] = 'delete';
		    $this->db->where('order_id', $para2);
            $this->db->update('orders',$data);
        } else if ($para1 == 'order_status') {
            $page_data['order_id'] = $para2;
            $page_data['orderstatus'] = $this->db->get_where('orders',array('order_id'=>$para2))->row()->order_status;
			$page_data['update_order_status'] = $this->db->get_where('orders',array('order_id'=>$para2))->row()->update_order_status;
			$page_data['order_status'] = get_order_status($page_data['orderstatus']);
            $this->load->view('back/admin/orders/orders_order_status', $page_data);
        } elseif ($para1 == 'send_invoice') {
            $page_data['orders'] = $this->db->get_where('orders', array('order_id' => $para2))->result_array();
            $text = $this->load->view('back/admin/includes_top', $page_data);
            $text .= $this->load->view('back/admin/orders/orders_view', $page_data);
            $text .= $this->load->view('back/admin/includes_bottom', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/orders/orders_add');
        } elseif ($para1 == 'total') {
            echo $this->db->get('orders')->num_rows();
        }
    }
	
	function order_invoice(){
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
	
	function order_status(){
		$order_id = @$_GET['o_i'];
		$order_token = @$_GET['o_t'];
		$order_status = @$_GET['o_s'];
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
			$data['orders_items'] = $this->order_model->get_single_order_item_details($order_id);
			$data['orders_status'] = get_order_status($order_status);
            $data['page_name'] = "orders/orders_status";
            $data['page_name_link'] = "orders";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function order_pdf($order_id,$user_id)
	{
		$orders = $this->order_model->get_single_order_details($order_id);
		$orders_items = $this->order_model->get_single_order_item_details($order_id);
		$get_html = $this->crud_model->get_admin_pdf_html($order_id,$user_id,$orders,$orders_items);
		$s_name = 'admin';
		
		$this->load->library('m_pdf');
		$this->m_pdf->pdf->SetProtection(array('print'));
		$this->m_pdf->pdf->SetTitle($order_id);
		$this->m_pdf->pdf->SetAuthor($order_id);
		$this->m_pdf->pdf->showWatermarkText = false;
		$this->m_pdf->pdf->SetDisplayMode('fullpage');
		$this->m_pdf->pdf->AddPage('','L', '', '', '', 15,15,15,15,15,15); // margin footer
		$stylesheet = file_get_contents('template/front/order_pdf.css');
		$this->m_pdf->pdf->WriteHTML($stylesheet,1);
		$this->m_pdf->pdf->WriteHTML($get_html);
		$pdfFilePath = $s_name."_".$order_id.".pdf";
		$this->m_pdf->pdf->Output($pdfFilePath, "D"); 
	}
	
	function stock($para1 = '', $para2 = '')
    {
        if ($para1 == 'delete') {
            $quantity = $this->crud_model->get_type_name_by_id('stock', $para2, 'quantity');
            $product = $this->crud_model->get_type_name_by_id('stock', $para2, 'product');
            $type = $this->crud_model->get_type_name_by_id('stock', $para2, 'type');
            if ($type == 'add') {
                $this->crud_model->decrease_quantity($product, $quantity);
            } else if ($type == 'destroy') {
                $this->crud_model->increase_quantity($product, $quantity);
            }
            $this->db->where('stock_id', $para2);
            $this->db->delete('stock');
            recache();
        }
    }
	function sendPushNotification($to = '', $data = array()){
		$apikey = 'AAAAeV3qHTQ:APA91bFrYTiXonpEfM5xayQ-WdgBFImCJXXl9fAVkFGpesOUuQ8d1g62yjkNtsg1n607B0E4LJyMQ2gRMQ9JDQ8R7fFRTO7ta4C76pn898A9f_cUkZ-haVSi75QOF_FZDw1UCu4CpTJB';
		$fields = array('to'=>$to, 'notification'=>$data);
		$headers = array('Authorization:key='.$apikey, 'Content-Type:application/json');
		$url = 'https://fcm.googleapis.com/fcm/send';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,true);
	}
}