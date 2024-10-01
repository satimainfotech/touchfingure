<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Send_all_notification extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('send_all_notification_model');
	}
/* MANAGE CATEGORY */
	public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('send_all_notification')) {
				redirect(base_url() . 'admin');
			}
			
			$data['page_name'] = "send_all_notification/send_all_notification";
            $data['page_name_link'] = "send_all_notification";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function send_all()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
			
			$title = $this->input->post('title');
			$message = $this->input->post('message');
			$type = $this->input->post('type');
			
			
			if($type == 'image'){
				$notification_image = $_FILES['notification_image']['name'];
				if($notification_image != ''){
					$length = 6;
					$characters = '01234567899876543210';
					$charactersLength = strlen($characters);
					$randomString = '';
					for ($i = 0; $i < $length; $i++) {
						$randomString .= $characters[rand(0, $charactersLength - 1)];
					}
					$otp2 = $randomString;
					
					$ext = pathinfo($notification_image, PATHINFO_EXTENSION);
					
					$uploadedFile = $_FILES['notification_image']['tmp_name']; 
					$dirPath = "uploads/notification_image/";
					$newFileName = $otp2."_notification.".$ext;
					
					move_uploaded_file($uploadedFile, $dirPath. $newFileName);
				}
				
				$image_url = base_url().'uploads/notification_image/'.$newFileName;
				$user_data = array(
					'title' => $title,
					'body' => $message,
					'image' => $image_url
				);
			}else{
				$user_data = array(
					'title' => $title,
					'body' => $message
				);
			}
			PromotionsendPushNotification($user_data);
			echo "sended";
		} else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
}