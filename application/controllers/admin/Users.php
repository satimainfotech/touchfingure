<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->model('users_model');
	}
    
	public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('users')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$name = $data['name'];
			$mobile_number = $data['mobile_number'];
			$refrence_code = $data['refrence_code'];
			$account_status = $data['account_status'];
			$plan_type = $data['plan_type'];
			
			
			if(@$name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != '' || @$plan_type != ''){
				$searchurl='?n_n='.$name.'&m_n='.$mobile_number.'&p_t='.$plan_type.'&r_c='.$refrence_code.'&a_s='.$account_status;
			}else{
				$searchurl='';
			}
			$count_data = $this->users_model->get_total_users_data_count($name,$mobile_number,$refrence_code,$account_status,$plan_type);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/abdaily/users".$searchurl;
			$config['per_page'] = 30;
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
			
			$data['all_users'] = $this->users_model->get_total_users_data($name,$mobile_number,$refrence_code,$account_status,$plan_type,$config["per_page"],$page);
			
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "users/users";
            $data['page_name_link'] = "users";
			$this->load->view('back/abdaily/index', $data);
           
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('users_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['page_id'] = @$_GET['page'];
			
			$data['page_name'] = "users/users_add";
			$data['country_data'] = $this->db->get_where('country',array('country_status'=>'Active'))->result_array();
            $data['page_name_link'] = "users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function do_add(){
		$country_code = $this->input->post('country_code');
		$mobile_number = $this->input->post('mobile_number');
		$email = $this->input->post('email');
		$user_name = $this->input->post('user_name');
		$use_refer_code = $this->input->post('refrence_code');
		$name = $this->input->post('name');
		$check_user_name = @$this->db->select('user_id')->get_where('user',array('team_name'=>$user_name))->result_array();
		$all_user_id = array_unique(array_column($check_user_name,"user_id"));
		
		$lengths = 6;
		$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
		$charactersLengths = strlen($characterss);
		$randomStrings = '';
		for ($is = 0; $is < $lengths; $is++) {
			$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
		}
		$refercode = $randomStrings;
		
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		
		if(count($all_user_id) > 1){
			echo 'user_name_exit';
		}else{
			if($use_refer_code != '' && $use_refer_code != null){
				$check_refer_code = @$this->db->get_where('user',array('my_refer_code'=>$use_refer_code))->result_array();
				$welcome_bonus = @$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
				$to_person_bonus = @$this->db->get_where('application_setting',array('application_setting_id'=>'5'))->row()->application_setting_value;
				$welcome_type = @$this->db->get_where('application_setting',array('application_setting_id'=>'14'))->row()->application_setting_value;
				if(!empty($check_refer_code)){
					
					/* REFERCODE USER DETAILS */
						$use_register_with_refer_code_type = $check_refer_code[0]['account_type'];
						$register_with_refer_user_id  = $check_refer_code[0]['user_id'];
						$register_with_refer_user_name  = $check_refer_code[0]['name'];
					/* REFERCODE USER DETAILS */
					
					
					$check_account = $this->users_model->check_exit_account($country_code,$mobile_number,$email);
					if(!empty($check_account)){
						$ca_status = $check_account[0]['account_status'];
						$user_id = $check_account[0]['user_id'];
						$ca_mobile = $check_account[0]['mobile_number'];
						$ca_country_code = $check_account[0]['country_code'];
						$user_token = $check_account[0]['user_token'];
						if($ca_status == 'Active'){
							echo 'mobile_email_exit';
						}else if($ca_status == 'Not-verified'){
							echo 'not_verify';
						}else if($ca_status == 'De-active'){
							echo 'de_active';
						}else if($ca_status == 'delete'){
							if($welcome_type == 'single'){
								$insert_data['user_token'] = $token;
								$insert_data['name'] = $name;
								$insert_data['email'] = $email;
								$insert_data['country_code'] = $country_code;
								$insert_data['mobile_number'] = $mobile_number;
								$insert_data['my_refer_code'] = 'MG11'.$refercode;
								$password = $this->input->post('password');
								$pass = md5($password.'28011987');
								$insert_data['password'] = $pass;
								$insert_data['register_with_refer_code'] = $use_refer_code;
								$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
								$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
								$insert_data['created_date'] = time();
								$insert_data['account_status'] = 'Active';
								$insert_data['team_name'] = $user_name;
								$insert_data['account_type'] = 'franchise';
								$insert_data['withdraw_email_veri_status'] = 'no';
								$insert_data['withdraw_mobile_veri_status'] = 'no';
								$insert_data['withdraw_pan_veri_status'] = 'no';
								$insert_data['withdraw_bank_veri_status'] = 'no';
								$insert_data['my_winning_amount'] = '0';
								$insert_data['my_cash_bonus'] = $welcome_bonus;
								$insert_data['my_winning_cashback'] = '0';
								$insert_data['added_cash_amount'] = '0';
								$insert_data['added_total_cash_amount'] = '0';
								$insert_data['user_withdraw_send_amount'] = '0';
								$insert_data['franchise_withdraw_send_amount'] = '0';
								$insert_data['user_withdraw_total_amount'] = '0';
								$insert_data['franchise_withdraw_total_amount'] = '0';
								
								$profile_image = $_FILES['profile_image']['name'];
								if($profile_image != ''){
									$length = 6;
									$characters = '01234567899876543210';
									$charactersLength = strlen($characters);
									$randomString = '';
									for ($i = 0; $i < $length; $i++) {
										$randomString .= $characters[rand(0, $charactersLength - 1)];
									}
									$otp2 = $randomString;
									
									$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
									
									$uploadedFile = $_FILES['profile_image']['tmp_name']; 
									$dirPath = "uploads/user/";
									$newFileName = $otp2."_users";
									
									if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
										$insert_data['profile_image'] = $otp2.'_users.'.$ext;
									}
								}
									
								$this->db->insert('user',$insert_data);
								$this->db->trans_complete();
								if ($this->db->trans_status() === TRUE) {
									$userid = $this->db->insert_id();
									/* BONUS TRANSACTION */
										$lengths= 50;
										$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengths = strlen($characterss);
										$randomStrings = '';
										for ($is = 0; $is < $lengths; $is++) {
											$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
										}
										$tokenss = $randomStrings;
										
										$lengtht= 15;
										$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengtht = strlen($characterst);
										$randomStringt = '';
										for ($it = 0; $it < $lengtht; $it++) {
											$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
										}
										$tokenst = 'DMJTX'.$randomStringt.'11';
										$data_t['txt_token'] = $tokenss;
										$data_t['transaction_id'] = $tokenst;
										$data_t['txt_status'] = 'success';
										$data_t['txt_amount'] = $welcome_bonus;
										$data_t['txt_user_id'] = $userid;
										$data_t['txt_user_name'] = $name;
										$data_t['txt_contents'] = 'Welcome Bonus added';
										$data_t['txt_date'] = time();
										$data_t['txt_type'] = 'add';
										$data_t['txt_use_type'] = 'recent';
										$data_t['created_date'] = time();
										$data_t['original_date'] = date('Y-m-d');
										$this->db->insert('transaction',$data_t);
									/* BONUS TRANSACTION */
									/* NOTIFICATION */
										$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
										$data_tn['notification_user_id'] = $userid;
										$data_tn['notification_content'] = $notification_content;
										$data_tn['notification_read'] = 'no';
										$data_tn['user_type'] = 'user';
										$data_tn['notification_type'] = 'Others';
										$data_tn['created_by'] = $userid;
										$data_tn['created_date'] = time();
										$this->db->insert('notification',$data_tn);
									/* NOTIFICATION  */
									echo 'done';
								}else{
									echo 'not_done';
								}
							}else{
								$get_old_bonus = @$this->db->get_where('user',array('user_id'=>$register_with_refer_user_id))->row()->my_cash_bonus;
								if($get_old_bonus == '' || $get_old_bonus == '0' || $get_old_bonus == null){
									$use_old_bonus = '0';
								}else{
									$use_old_bonus = $get_old_bonus;
								}
								$new_bonus = $use_old_bonus + $to_person_bonus;
								$insert_data['user_token'] = $token;
								$insert_data['name'] = $name;
								$insert_data['email'] = $email;
								$insert_data['country_code'] = $country_code;
								$insert_data['mobile_number'] = $mobile_number;
								$insert_data['my_refer_code'] = 'MG11'.$refercode;
								$password = $this->input->post('password');
								$pass = md5($password.'28011987');
								$insert_data['password'] = $pass;
								$insert_data['register_with_refer_code'] = $use_refer_code;
								$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
								$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
								$insert_data['created_date'] = time();
								$insert_data['account_status'] = 'Active';
								$insert_data['team_name'] = $user_name;
								$insert_data['account_type'] = 'franchise';
								$insert_data['withdraw_email_veri_status'] = 'no';
								$insert_data['withdraw_mobile_veri_status'] = 'no';
								$insert_data['withdraw_pan_veri_status'] = 'no';
								$insert_data['withdraw_bank_veri_status'] = 'no';
								$insert_data['my_winning_amount'] = '0';
								$insert_data['my_cash_bonus'] = $welcome_bonus;
								$insert_data['my_winning_cashback'] = '0';
								$insert_data['added_cash_amount'] = '0';
								$insert_data['added_total_cash_amount'] = '0';
								$insert_data['user_withdraw_send_amount'] = '0';
								$insert_data['franchise_withdraw_send_amount'] = '0';
								$insert_data['user_withdraw_total_amount'] = '0';
								$insert_data['franchise_withdraw_total_amount'] = '0';
								
								$profile_image = $_FILES['profile_image']['name'];
								if($profile_image != ''){
									$length = 6;
									$characters = '01234567899876543210';
									$charactersLength = strlen($characters);
									$randomString = '';
									for ($i = 0; $i < $length; $i++) {
										$randomString .= $characters[rand(0, $charactersLength - 1)];
									}
									$otp2 = $randomString;
									
									$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
									
									$uploadedFile = $_FILES['profile_image']['tmp_name']; 
									$dirPath = "uploads/user/";
									$newFileName = $otp2."_users";
									
									if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
										$insert_data['profile_image'] = $otp2.'_users.'.$ext;
									}
								}
								
								$this->db->insert('user',$insert_data);
								$this->db->trans_complete();
								if ($this->db->trans_status() === TRUE) {
									$userid = $this->db->insert_id();
									/* INSERT IN REFER LIST */
										$ruinsert_data['my_cash_bonus'] = $new_bonus;
										$this->db->where('user_id',$register_with_refer_user_id);
										$this->db->update('user',$ruinsert_data);
									/* INSERT IN REFER LIST */
									/* BONUS regiter TRANSACTION */
										$lengths= 50;
										$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengths = strlen($characterss);
										$randomStrings = '';
										for ($is = 0; $is < $lengths; $is++) {
											$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
										}
										$tokenss = $randomStrings;
										
										$lengtht= 15;
										$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengtht = strlen($characterst);
										$randomStringt = '';
										for ($it = 0; $it < $lengtht; $it++) {
											$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
										}
										$tokenst = 'DMJTX'.$randomStringt.'11';
										$data_t['txt_token'] = $tokenss;
										$data_t['transaction_id'] = $tokenst;
										$data_t['txt_status'] = 'success';
										$data_t['txt_amount'] = $welcome_bonus;
										$data_t['txt_user_id'] = $userid;
										$data_t['txt_user_name'] = $name;
										$data_t['txt_contents'] = 'Welcome Bonus added';
										$data_t['txt_date'] = time();
										$data_t['txt_type'] = 'add';
										$data_t['txt_use_type'] = 'recent';
										$data_t['created_date'] = time();
										$data_t['original_date'] = date('Y-m-d');
										$this->db->insert('transaction',$data_t);
									/* BONUS register TRANSACTION */
									/* BONUS refer user TRANSACTION */
										$lengthss= 50;
										$charactersss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengthss = strlen($charactersss);
										$randomStringss = '';
										for ($iss = 0; $iss < $lengthss; $iss++) {
											$randomStringss .= $charactersss[rand(0, $charactersLengthss - 1)];
										}
										$tokensss = $randomStringss;
										
										$lengthts= 15;
										$charactersts = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengthts = strlen($charactersts);
										$randomStringts = '';
										for ($its = 0; $its < $lengthts; $its++) {
											$randomStringts .= $charactersts[rand(0, $charactersLengthts - 1)];
										}
										$tokensts = 'DMJTX'.$randomStringts.'11';
										
										$data_ts['txt_token'] = $tokensss;
										$data_ts['transaction_id'] = $tokensts;
										$data_ts['txt_status'] = 'success';
										$data_ts['txt_amount'] = $to_person_bonus;
										$data_ts['txt_user_id'] = $register_with_refer_user_id;
										$data_ts['txt_user_name'] = $register_with_refer_user_name;
										$data_ts['txt_contents'] = 'Refer Bonus added';
										$data_ts['txt_date'] = time();
										$data_ts['txt_type'] = 'add';
										$data_ts['txt_use_type'] = 'recent';
										$data_ts['created_date'] = time();
										$data_ts['original_date'] = date('Y-m-d');
										$this->db->insert('transaction',$data_ts);
									/* BONUS refer user TRANSACTION */
									/* NOTIFICATION */
										$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
										$data_tn['notification_user_id'] = $userid;
										$data_tn['notification_content'] = $notification_content;
										$data_tn['notification_read'] = 'no';
										$data_tn['user_type'] = 'user';
										$data_tn['notification_type'] = 'Others';
										$data_tn['created_by'] = $userid;
										$data_tn['created_date'] = time();
										$this->db->insert('notification',$data_tn);
									/* NOTIFICATION  */
									/* REFER USER NOTIFICATION */
										$notification_content_refer = "Rs. $to_person_bonus Refer Bonus added in your Reddmica Wallet. Register user is $name";
										$data_tnr['notification_user_id'] = $register_with_refer_user_id;
										$data_tnr['notification_content'] = $notification_content_refer;
										$data_tnr['notification_read'] = 'no';
										$data_tnr['user_type'] = 'user';
										$data_tnr['notification_type'] = 'Others';
										$data_tnr['created_by'] = $register_with_refer_user_id;
										$data_tnr['created_date'] = time();
										$this->db->insert('notification',$data_tnr);
									/* REFER USER  NOTIFICATION  */
									echo 'done';
								}else{
									echo 'not_done';
								}
							}
						}
					}else{
						if($welcome_type == 'single'){
							$insert_data['user_token'] = $token;
							$insert_data['name'] = $name;
							$insert_data['email'] = $email;
							$insert_data['country_code'] = $country_code;
							$insert_data['mobile_number'] = $mobile_number;
							$insert_data['my_refer_code'] = 'MG11'.$refercode;
							$password = $this->input->post('password');
							$pass = md5($password.'28011987');
							$insert_data['password'] = $pass;
							$insert_data['register_with_refer_code'] = $use_refer_code;
							$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
							$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
							$insert_data['created_date'] = time();
							$insert_data['account_status'] = 'Active';
							$insert_data['team_name'] = $user_name;
							$insert_data['account_type'] = 'franchise';
							$insert_data['withdraw_email_veri_status'] = 'no';
							$insert_data['withdraw_mobile_veri_status'] = 'no';
							$insert_data['withdraw_pan_veri_status'] = 'no';
							$insert_data['withdraw_bank_veri_status'] = 'no';
							$insert_data['my_winning_amount'] = '0';
							$insert_data['my_cash_bonus'] = '100';
							$insert_data['my_winning_cashback'] = '0';
							$insert_data['added_cash_amount'] = '0';
							$insert_data['added_total_cash_amount'] = '0';
							$insert_data['user_withdraw_send_amount'] = '0';
							$insert_data['franchise_withdraw_send_amount'] = '0';
							$insert_data['user_withdraw_total_amount'] = '0';
							$insert_data['franchise_withdraw_total_amount'] = '0';
							
							$profile_image = $_FILES['profile_image']['name'];
							if($profile_image != ''){
								$length = 6;
								$characters = '01234567899876543210';
								$charactersLength = strlen($characters);
								$randomString = '';
								for ($i = 0; $i < $length; $i++) {
									$randomString .= $characters[rand(0, $charactersLength - 1)];
								}
								$otp2 = $randomString;
								
								$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
								
								$uploadedFile = $_FILES['profile_image']['tmp_name']; 
								$dirPath = "uploads/user/";
								$newFileName = $otp2."_users";
								
								if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
									$insert_data['profile_image'] = $otp2.'_users.'.$ext;
								}
							}
							
							$this->db->insert('user',$insert_data);
							$this->db->trans_complete();
							if ($this->db->trans_status() === TRUE) {
								$userid = $this->db->insert_id();
								/* BONUS TRANSACTION */
									$lengths= 50;
									$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengths = strlen($characterss);
									$randomStrings = '';
									for ($is = 0; $is < $lengths; $is++) {
										$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
									}
									$tokenss = $randomStrings;
									 
									$lengtht= 15;
									$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengtht = strlen($characterst);
									$randomStringt = '';
									for ($it = 0; $it < $lengtht; $it++) {
										$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
									}
									$tokenst = 'DMJTX'.$randomStringt.'11';
									$data_t['txt_token'] = $tokenss;
									$data_t['transaction_id'] = $tokenst;
									$data_t['txt_status'] = 'success';
									$data_t['txt_amount'] = $welcome_bonus;
									$data_t['txt_user_id'] = $userid;
									$data_t['txt_user_name'] = $name;
									$data_t['txt_contents'] = 'Welcome Bonus added';
									$data_t['txt_date'] = time();
									$data_t['txt_type'] = 'add';
									$data_t['txt_use_type'] = 'recent';
									$data_t['created_date'] = time();
									$data_t['original_date'] = date('Y-m-d');
									$this->db->insert('transaction',$data_t);
								/* BONUS TRANSACTION */
								/* NOTIFICATION */
									$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
									$data_tn['notification_user_id'] = $userid;
									$data_tn['notification_content'] = $notification_content;
									$data_tn['notification_read'] = 'no';
									$data_tn['user_type'] = 'user';
									$data_tn['notification_type'] = 'Others';
									$data_tn['created_by'] = $userid;
									$data_tn['created_date'] = time();
									$this->db->insert('notification',$data_tn);
								/* NOTIFICATION  */
								echo 'done';
							}else{
								echo 'not_done';
							}
						}else{
							$get_old_bonus = @$this->db->get_where('user',array('user_id'=>$register_with_refer_user_id))->row()->my_cash_bonus;
							
							if($get_old_bonus == '' || $get_old_bonus == '0' || $get_old_bonus == null){
								$use_old_bonus = '0';
							}else{
								$use_old_bonus = $get_old_bonus;
							}
							$new_bonus = $use_old_bonus + $to_person_bonus;
							
							$insert_data['user_token'] = $token;
							$insert_data['name'] = $name;
							$insert_data['email'] = $email;
							$insert_data['country_code'] = $country_code;
							$insert_data['mobile_number'] = $mobile_number;
							$insert_data['my_refer_code'] = 'MG11'.$refercode;
							$password = $this->input->post('password');
							$pass = md5($password.'28011987');
							$insert_data['password'] = $pass;
							$insert_data['register_with_refer_code'] = $use_refer_code;
							$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
							$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
							$insert_data['created_date'] = time();
							$insert_data['account_status'] = 'Active';
							$insert_data['team_name'] = $team_name;
							$insert_data['account_type'] = 'franchise';
							$insert_data['withdraw_email_veri_status'] = 'no';
							$insert_data['withdraw_mobile_veri_status'] = 'no';
							$insert_data['withdraw_pan_veri_status'] = 'no';
							$insert_data['withdraw_bank_veri_status'] = 'no';
							$insert_data['my_winning_amount'] = '0';
							$insert_data['my_cash_bonus'] = '100';
							$insert_data['my_winning_cashback'] = '0';
							$insert_data['added_cash_amount'] = '0';
							$insert_data['added_total_cash_amount'] = '0';
							$insert_data['user_withdraw_send_amount'] = '0';
							$insert_data['franchise_withdraw_send_amount'] = '0';
							$insert_data['user_withdraw_total_amount'] = '0';
							$insert_data['franchise_withdraw_total_amount'] = '0';
							
							$profile_image = $_FILES['profile_image']['name'];
							if($profile_image != ''){
								$length = 6;
								$characters = '01234567899876543210';
								$charactersLength = strlen($characters);
								$randomString = '';
								for ($i = 0; $i < $length; $i++) {
									$randomString .= $characters[rand(0, $charactersLength - 1)];
								}
								$otp2 = $randomString;
								
								$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
								
								$uploadedFile = $_FILES['profile_image']['tmp_name']; 
								$dirPath = "uploads/user/";
								$newFileName = $otp2."_users";
								
								if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
									$insert_data['profile_image'] = $otp2.'_users.'.$ext;
								}
							}
							
							$this->db->insert('user',$insert_data);
							
							$this->db->trans_complete();
							if ($this->db->trans_status() === TRUE) {
								$userid = $this->db->insert_id();
								/* INSERT IN REFER LIST */
									$ruinsert_data['my_cash_bonus'] = $new_bonus;
									$this->db->where('user_id',$register_with_refer_user_id);
									$this->db->update('user',$ruinsert_data);
								/* INSERT IN REFER LIST */
								/* BONUS regiter TRANSACTION */
									$lengths= 50;
									$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengths = strlen($characterss);
									$randomStrings = '';
									for ($is = 0; $is < $lengths; $is++) {
										$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
									}
									$tokenss = $randomStrings;
									
									$lengtht= 15;
									$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengtht = strlen($characterst);
									$randomStringt = '';
									for ($it = 0; $it < $lengtht; $it++) {
										$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
									}
									$tokenst = 'DMJTX'.$randomStringt.'11';
									$data_t['txt_token'] = $tokenss;
									$data_t['transaction_id'] = $tokenst;
									$data_t['txt_status'] = 'success';
									$data_t['txt_amount'] = $welcome_bonus;
									$data_t['txt_user_id'] = $userid;
									$data_t['txt_user_name'] = $name;
									$data_t['txt_contents'] = 'Welcome Bonus added';
									$data_t['txt_date'] = time();
									$data_t['txt_type'] = 'add';
									$data_t['txt_use_type'] = 'recent';
									$data_t['created_date'] = time();
									$data_t['original_date'] = date('Y-m-d');
									$this->db->insert('transaction',$data_t);
								/* BONUS register TRANSACTION */
								/* BONUS refer user TRANSACTION */
									$lengthss= 50;
									$charactersss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengthss = strlen($charactersss);
									$randomStringss = '';
									for ($iss = 0; $iss < $lengthss; $iss++) {
										$randomStringss .= $charactersss[rand(0, $charactersLengthss - 1)];
									}
									$tokensss = $randomStringss;
									
									$lengthts= 15;
									$charactersts = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengthts = strlen($charactersts);
									$randomStringts = '';
									for ($its = 0; $its < $lengthts; $its++) {
										$randomStringts .= $charactersts[rand(0, $charactersLengthts - 1)];
									}
									$tokensts = 'DMJTX'.$randomStringts.'11';
									
									$data_ts['txt_token'] = $tokensss;
									$data_ts['transaction_id'] = $tokensts;
									$data_ts['txt_status'] = 'success';
									$data_ts['txt_amount'] = $to_person_bonus;
									$data_ts['txt_user_id'] = $register_with_refer_user_id;
									$data_ts['txt_user_name'] = $register_with_refer_user_name;
									$data_ts['txt_contents'] = 'Refer Bonus added';
									$data_ts['txt_date'] = time();
									$data_ts['txt_type'] = 'add';
									$data_ts['txt_use_type'] = 'recent';
									$data_ts['created_date'] = time();
									$data_ts['original_date'] = date('Y-m-d');
									$this->db->insert('transaction',$data_ts);
								/* BONUS refer user TRANSACTION */
								/* NOTIFICATION */
									$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
									$data_tn['notification_user_id'] = $userid;
									$data_tn['notification_content'] = $notification_content;
									$data_tn['notification_read'] = 'no';
									$data_tn['user_type'] = 'user';
									$data_tn['notification_type'] = 'Others';
									$data_tn['created_by'] = $userid;
									$data_tn['created_date'] = time();
									$this->db->insert('notification',$data_tn);
								/* NOTIFICATION  */
								/* REFER USER NOTIFICATION */
									$notification_content_refer = "Rs. $to_person_bonus Refer Bonus added in your Reddmica Wallet. Register user is $name";
									$data_tnr['notification_user_id'] = $register_with_refer_user_id;
									$data_tnr['notification_content'] = $notification_content_refer;
									$data_tnr['notification_read'] = 'no';
									$data_tnr['user_type'] = 'user';
									$data_tnr['notification_type'] = 'Others';
									$data_tnr['created_by'] = $register_with_refer_user_id;
									$data_tnr['created_date'] = time();
									$this->db->insert('notification',$data_tnr);
								/* REFER USER  NOTIFICATION  */
								echo 'done';
							}else{
								echo 'not_done';
							}
						}
					}
				}else{
					echo 'refer_code_not_valid';
				}
			}else{
				$check_account = $this->users_model->check_exit_account($country_code,$mobile_number,$email);
				if(!empty($check_account)){
					$ca_status = $check_account[0]['account_status'];
					$user_id = $check_account[0]['user_id'];
					$ca_mobile = $check_account[0]['mobile_number'];
					$ca_country_code = $check_account[0]['country_code'];
					$user_token = $check_account[0]['user_token'];
					if($ca_status == 'Active'){
						echo 'mobile_email_exit';
					}else if($ca_status == 'Not-verified'){
						echo 'not_verified';
					}else if($ca_status == 'De-active'){
						echo 'de_active';
					}else if($ca_status == 'delete'){
						$insert_data['user_token'] = $token;
						$insert_data['name'] = $name;
						$insert_data['email'] = $email;
						$insert_data['country_code'] = $country_code;
						$insert_data['mobile_number'] = $mobile_number;
						$insert_data['my_refer_code'] = 'MG11'.$refercode;
						$password = $this->input->post('password');
						$pass = md5($password.'28011987');
						$insert_data['password'] = $pass;
						$insert_data['created_date'] = time();
						$insert_data['account_status'] = 'Active';
						$insert_data['account_type'] = 'franchise';
						$insert_data['withdraw_email_veri_status'] = 'no';
						$insert_data['withdraw_mobile_veri_status'] = 'no';
						$insert_data['withdraw_pan_veri_status'] = 'no';
						$insert_data['withdraw_bank_veri_status'] = 'no';
						$insert_data['my_winning_amount'] = '0';
						$insert_data['my_cash_bonus'] = '100';
						$insert_data['my_winning_cashback'] = '0';
						$insert_data['added_cash_amount'] = '0';
						$insert_data['added_total_cash_amount'] = '0';
						$insert_data['user_withdraw_send_amount'] = '0';
						$insert_data['franchise_withdraw_send_amount'] = '0';
						$insert_data['user_withdraw_total_amount'] = '0';
						$insert_data['franchise_withdraw_total_amount'] = '0';
						$profile_image = $_FILES['profile_image']['name'];
						if($profile_image != ''){
							$length = 6;
							$characters = '01234567899876543210';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) {
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							$otp2 = $randomString;
							
							$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
							
							$uploadedFile = $_FILES['profile_image']['tmp_name']; 
							$dirPath = "uploads/user/";
							$newFileName = $otp2."_users";
							
							if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
								$insert_data['profile_image'] = $otp2.'_users.'.$ext;
							}
						}
						$insert_data['team_name'] = $user_name;
						$this->db->insert('user',$insert_data);
						$this->db->trans_complete();
						if ($this->db->trans_status() === TRUE) {
							$userid = $this->db->insert_id();
							/* NOTIFICATION */
								$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
								$data_tn['notification_user_id'] = $userid;
								$data_tn['notification_content'] = $notification_content;
								$data_tn['notification_read'] = 'no';
								$data_tn['user_type'] = 'user';
								$data_tn['notification_type'] = 'Others';
								$data_tn['created_by'] = $userid;
								$data_tn['created_date'] = time();
								$this->db->insert('notification',$data_tn);
							/* NOTIFICATION  */
							echo 'done';
						}else{
							echo 'not_done';
						}
					}
				}else{
					$insert_data['user_token'] = $token;
					$insert_data['name'] = $name;
					$insert_data['email'] = $email;
					$insert_data['country_code'] = $country_code;
					$insert_data['mobile_number'] = $mobile_number;
					$password = $this->input->post('password');
					$pass = md5($password.'28011987');
					$insert_data['password'] = $pass;
					$insert_data['my_refer_code'] = 'MG11'.$refercode;
					$insert_data['created_date'] = time();
					$insert_data['account_status'] = 'Active';
					$insert_data['account_type'] = 'franchise';
					$insert_data['withdraw_email_veri_status'] = 'no';
					$insert_data['withdraw_mobile_veri_status'] = 'no';
					$insert_data['withdraw_pan_veri_status'] = 'no';
					$insert_data['withdraw_bank_veri_status'] = 'no';
					$insert_data['my_winning_amount'] = '0';
					$insert_data['my_cash_bonus'] = '100';
					$insert_data['my_winning_cashback'] = '0';
					$insert_data['added_cash_amount'] = '0';
					$insert_data['added_total_cash_amount'] = '0';
					$insert_data['user_withdraw_send_amount'] = '0';
					$insert_data['franchise_withdraw_send_amount'] = '0';
					$insert_data['user_withdraw_total_amount'] = '0';
					$insert_data['franchise_withdraw_total_amount'] = '0';
					$insert_data['team_name'] = $user_name;
					
					$profile_image = $_FILES['profile_image']['name'];
						if($profile_image != ''){
							$length = 6;
							$characters = '01234567899876543210';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) {
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							$otp2 = $randomString;
							
							$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
							
							$uploadedFile = $_FILES['profile_image']['tmp_name']; 
							$dirPath = "uploads/user/";
							$newFileName = $otp2."_users";
							
							if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
								$insert_data['profile_image'] = $otp2.'_users.'.$ext;
							}
						}
					$this->db->insert('user',$insert_data);
					$this->db->trans_complete();
					if ($this->db->trans_status() === TRUE) {
						$userid = $this->db->insert_id();
						/* NOTIFICATION */
							$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
							$data_tn['notification_user_id'] = $userid;
							$data_tn['notification_content'] = $notification_content;
							$data_tn['notification_read'] = 'no';
							$data_tn['user_type'] = 'user';
							$data_tn['notification_type'] = 'Others';
							$data_tn['created_by'] = $userid;
							$data_tn['created_date'] = time();
							$this->db->insert('notification',$data_tn);
						/* NOTIFICATION  */
						echo 'done';
					}else{
						echo 'not_done';
					}
				}
			}
		}
	}
	
	public function edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['user_id'] = @$_GET['u_i'];
			$data['page_id'] = @$_GET['page'];
			$data['country_data'] = $this->db->get_where('country',array('country_status'=>'Active'))->result_array();
			$data['users_data'] = $this->db->get_where('user', array('user_id' => $user_id,'user_token'=>$user_token))->result_array();
			$data['page_name'] = "users/franchise/users_edit";
            $data['page_name_link'] = "users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['page_id'] = @$_GET['page'];
			$data['users_data'] = $this->users_model->get_users_information($user_id,$user_token);
			$data['page_name'] = "users/franchise/users_view";
            $data['page_name_link'] = "users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function update($para1 = '', $para2 = '', $para3 = ''){
		$data['name'] = $this->input->post('name');
		$data['country_code'] = $this->input->post('country_code');
		$data['mobile_number'] = $this->input->post('mobile_number');
		$data['email'] = $this->input->post('email');
		
		$profile_image = $_FILES['profile_image']['name'];
		if($profile_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('user',array('user_id'=>$para1))->result_array();
			if($check_account[0]['profile_image'] != ''){
				$rpersonal = "uploads/user_image/".$check_account[0]['profile_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['profile_image']['tmp_name']; 
			$dirPath = "uploads/user_image/";
			$newFileName = $otp2."_users";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['profile_image'] = $otp2.'_users.'.$ext;
			}
		}
		$this->db->where('user_id', $para1);
		$this->db->update('user', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function userss($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('users')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$user_id = $this->input->post('id');
            $this->db->where('user_id',$user_id);
            
			$data['account_status'] = 'delete';
			$this->db->where('user_id', $user_id);
            $this->db->update('user',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'account_set') {
            $users = $para2;
			if ($para3 == 'true') {
                $data['account_status'] = 'Active';
            } else {
                $data['account_status'] = 'De-active';
            }
            $this->db->where('user_id', $users);
            $this->db->update('user', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
        }
    }
	
	function check_mobile_number(){
		$country_code = $this->input->post('country_code');
		$mobile_number = $this->input->post('mobile');
		$check_user_register = $this->users_model->check_user_repet($country_code,$mobile_number);
		if(!empty($check_user_register)){
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	
	function check_mobile_number_and_email($country_code,$mobile_number,$email,$user_id){
		$check_user_register = $this->users_model->check_user_repet_all($country_code,$mobile_number,$email);
		if(!empty($check_user_register)){
			if($check_user_register[0]['user_id'] == $user_id){
				return 'no';
			}else{
				return 'yes';
			}
		}else{
			return 'no';
		}
	}
	
	function check_email(){
		$email = $this->input->post('email');
		$check_user_register = $this->users_model->check_user_email_repet($email);
		if(!empty($check_user_register)){
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	
	function check_edit_mobile_number(){
		$country_code = $this->input->post('country_code');
		$mobile_number = $this->input->post('mobile');
		$user_id = $this->input->post('user_id');
		$check_user_register = $this->users_model->check_user_repet($country_code,$mobile_number);
		if(!empty($check_user_register)){
			if($check_user_register[0]['user_id'] == $user_id){
				echo 'no';
			}else{
				echo 'yes';
			}
		}else{
			echo 'no';
		}
	}
	
	function check_edit_email(){
		$email = $this->input->post('email');
		$user_id = $this->input->post('user_id');
		$check_user_register = $this->users_model->check_user_email_repet($email);
		if(!empty($check_user_register)){
			if($check_user_register[0]['user_id'] == $user_id){
				echo 'no';
			}else{
				echo 'yes';
			}
		}else{
			echo 'no';
		}
	}
	
	function purchase_plan(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_purchase_plan')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['user_id'] = @$_GET['u_i'];
			$data['page_id'] = @$_GET['page'];
			$data['plan'] = $this->db->get_where('plan_master',array('status'=>'active'))->result_array();
			$data['users_data'] = $this->db->get_where('user', array('user_id' => $user_id,'user_token'=>$user_token))->result_array();
			$data['page_name'] = "users/franchise/users_purchase_plan";
            $data['page_name_link'] = "Purchase Plan";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	function purchaseed_plan($para1 = '', $para2 = '', $para3 = ''){
		$plan_id = $this->input->post('membership_plan');
		$user_id = $para1;
		$payment_mode = $this->input->post('payment_method');
		$transaction_id = $this->input->post('transaction_id');
		$cheque_number = $this->input->post('cheque_number');
		
		$check_account = @$this->db->get_where('user',array('user_id'=>$user_id))->result_array();
		$name = $check_account[0]['name'];
		$email = $check_account[0]['email'];
		$phone = $check_account[0]['mobile_number'];
		$my_refer_code = $check_account[0]['my_refer_code'];
		
		$get_plan_details = @$this->db->get_where('plan_master',array('plan_id'=>$plan_id))->result_array();
		if(!empty($get_plan_details)){
			$plan_name = $get_plan_details[0]['plan_name'];
			if($get_plan_details[0]['discount_price'] == '' || $get_plan_details[0]['discount_price'] == '0' || $get_plan_details[0]['discount_price'] == null){
				$plan_amount = $get_plan_details[0]['main_price'];
			}else{
				$plan_amount = $get_plan_details[0]['discount_price'];
			}
			$plan_validaty_value = $get_plan_details[0]['plan_validity'];
			$plan_validaty_value_type = $get_plan_details[0]['plan_validity_duration'];
			$commission_value = $get_plan_details[0]['commission_value'];
			$commission_value_type = $get_plan_details[0]['commission_value_type'];
			
			$lengthss = 50;
			$charactersss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
			$charactersLengthss = strlen($charactersss);
			$randomStringss = '';
			for ($iss = 0; $iss < $lengthss; $iss++) {
				$randomStringss .= $charactersss[rand(0, $charactersLengthss - 1)];
			}
			$refercodes = $randomStringss;
			
			$insert_data['txt_token'] = $refercodes;
			$insert_data['txt_user_id'] = $user_id;
			$insert_data['txt_user_name'] = $name;
			$insert_data['plan_id'] = $plan_id;
			$insert_data['plan_name'] = $plan_name;
			$insert_data['txt_method'] = $payment_mode;
			$insert_data['transaction_id'] = $transaction_id;
			$insert_data['txt_amount'] = $plan_amount;
			$insert_data['paid_amount'] = $plan_amount;
			$insert_data['txt_status'] ='success';
			$insert_data['txt_contents'] = 'Franchise Purchase';
			$insert_data['txt_user_type'] = 'franchise';
			$insert_data['txt_date'] = time();
			$insert_data['txt_type'] = 'add';
			$insert_data['txt_use_type'] = 'recent';
			
			if($plan_validaty_value_type == 'year'){
				$use_validity_value = $plan_validaty_value*365;
				$use_validity_type = 'days';
			}else{
				$use_validity_value = $plan_validaty_value;
				$use_validity_type = 'months';
			}
			date_default_timezone_set('Asia/Kolkata');
			$plan_start_date = time();
			$plan_expire_date = date('Y-m-d', strtotime('+'.$use_validity_value.' '.$use_validity_type));
			
			if($plan_expire_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$plan_expire_date 23:59:59",
					new DateTimeZone('Asia/Kolkata')
				);

				if ($d === false) {
					$from_timestamp = '';
				} else {
					$from_timestamp = $d->getTimestamp();
				}
				$date_expire_date = $from_timestamp;
			}else{
				$date_expire_date = time();
			}
			
			$insert_data['plan_purchse_date'] = $plan_start_date;
			$insert_data['expire_date'] = $date_expire_date;
			$insert_data['created_date'] = time();
			$insert_data['original_date'] = date('Y-m-d');
			$this->db->insert('transaction',$insert_data);
			//echo $this->db->last_query();
			//die;
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$payment_id = $this->db->insert_id();
				$userid = $this->db->insert_id();
				/* SEND SMS */
					if(check_sms() == 'yes'){
						$send_mobile_number = $phone;
						$message = urlencode("Your Franchise plan has been successfully activated.");
						//send_sms($send_mobile_number,$message);
					}
				/* SEND SMS */
				$check_last_franchise = @$this->db->get_where('user',array('user_id'=>$user_id))->row()->old_franchise_id;
				if($check_last_franchise == '' || $check_last_franchise == '0' || $check_last_franchise == null){
					$lengths = 6;
					$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
					$charactersLengths = strlen($characterss);
					$randomStrings = '';
					for ($is = 0; $is < $lengths; $is++) {
						$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
					}
					$refercode = $randomStrings;
					$user_data['my_refer_code'] = 'MG11'.$refercode;
					$user_data['old_my_refer_code'] = $my_refer_code;
				}
				
				$user_data['franchise_plan_id'] = $plan_id;
				$user_data['franchise_plan_amount'] = $plan_amount;
				$user_data['franchise_plan_start_date'] = $plan_start_date;
				$user_data['franchise_plan_end_date'] = $date_expire_date;
				$user_data['account_type'] = 'franchise';
				$user_data['franchise_plan_commission_value'] = $commission_value;
				$user_data['franchise_commission_type'] = $commission_value_type;
				$user_data['ranchise_plan_name'] = $plan_name;
				$user_data['franchise_plan_payment_id'] = $payment_id;
				$user_data['franchise_current_wallet_amount'] = '0';
				$user_data['franchise_pay_wallet_amount'] = '0';
				$user_data['old_franchise_id'] = $plan_id;
				$this->db->where('user_id',$user_id);
				$this->db->update('user',$user_data);
				
				if($check_last_franchise == '' || $check_last_franchise == '0' || $check_last_franchise == null){
					$get_my_refer_list = @$this->db->get_where('user',array('register_with_refer_user_id'=>$user_id,'register_with_refer_code'=>$my_refer_code))->result_array();
					if(!empty($get_my_refer_list)){
						foreach($get_my_refer_list as $re_row){
							
							$data_remove['register_with_refer_code'] = NULL;
							$data_remove['use_register_with_refer_code_type'] = NULL;
							$data_remove['register_with_refer_user_id'] = NULL;
							
							$data_remove['old_register_with_refer_code'] = $re_row['register_with_refer_code'];
							$data_remove['old_register_with_refer_user_id'] = $re_row['register_with_refer_user_id'];
							$data_remove['old_use_register_with_refer_code_type'] = $re_row['use_register_with_refer_code_type'];
							$this->db->where('user_id',$re_row['user_id']);
							$this->db->update('user',$data_remove);
						}
					}
					
					/* $get_my_refer_user_list = @$this->db->get_where('user_refrence_list',array('refrence_user_id'=>$user_id,'refrence_code'=>$my_refer_code))->result_array();
					if(!empty($get_my_refer_user_list)){
						foreach($get_my_refer_user_list as $ref_row){
							$data_remove_ref['refrence_user_id'] = NULL;
							$data_remove_ref['refrence_code'] = NULL;
							$data_remove_ref['old_refrence_code'] = $ref_row['refrence_code'];
							$data_remove_ref['old_refrence_user_id'] = $ref_row['refrence_user_id'];
							$this->db->where('user_refrence_id',$ref_row['user_refrence_id']);
							$this->db->where('refrence_code',$ref_row['refrence_code']);
							$this->db->update('user_refrence_list',$data_remove_ref);
						}
					} */
				}
			
				/* NOTIFICATION */
					$notification_content = "$plan_name Franchise Plan Successfully Purchase. Plan Amount is Rs. $plan_amount";
					$data_tn['notification_user_id'] = $user_id;
					$data_tn['notification_content'] = $notification_content;
					$data_tn['notification_read'] = 'no';
					$data_tn['user_type'] = 'user';
					$data_tn['notification_type'] = 'Transactional';
					$data_tn['created_by'] = $user_id;
					$data_tn['created_date'] = time();
					$this->db->insert('notification',$data_tn);
				/* NOTIFICATION  */
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else{
			echo 'plan_not_available';
		}
	}
	
	public function view_refer_list(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			
			if (!$this->crud_model->admin_permission('insurance_details')) {
				redirect(base_url() . 'admin');
			}
			
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			
			$data['user_id'] = @$user_id;
			$data['user_token'] = @$user_token;
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['my_refrence_code'] = @$_GET['m_r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['pages'] = @$_GET['pages'];
			$name = $data['name'];
			$user_name = $data['user_name'];
			$mobile_number = $data['mobile_number'];
			$membership_plan = $data['membership_plan'];
			$refrence_code = $data['refrence_code'];
			$account_status = $data['account_status'];
			$my_refrence_code = $data['my_refrence_code'];
			$plan_type = $data['plan_type'];
			$pages = $data['pages'];
			
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$membership_plan != '' || @$refrence_code != '' || @$account_status != '' || @$plan_type != ''){
				if(@$pages != ''){
					$searchurl='?u_i='.$user_id.'&u_t='.$user_token.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&m_p='.$membership_plan.'&p_t='.$plan_type.'&r_c='.$refrence_code.'&a_s='.$account_status.'&pages='.$pages;
				}else{
					$searchurl='?u_i='.$user_id.'&u_t='.$user_token.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&m_p='.$membership_plan.'&p_t='.$plan_type.'&r_c='.$refrence_code.'&a_s='.$account_status;
				}
			}else{
				if(@$pages != ''){
					$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&m_r_c='.$my_refrence_code.'&pages='.$pages;
				}else{
					$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&m_r_c='.$my_refrence_code;
				}
			}
			$count_data = $this->users_model->get_total_users_refer_data_count($user_id,$user_token,$my_refrence_code);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/users/view_refer_list".$searchurl;
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
			
			$data['insurance_data'] = $this->users_model->get_total_users_refer_data($user_id,$user_token,$my_refrence_code,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "users/franchise/users_refer";
            $data['page_name_link'] = "users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function view_pan_information(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['page_id'] = @$_GET['page'];
			$data['pan_datas'] = $this->users_model->get_users_pan_information($user_id);
			$data['page_name'] = "users/regular/pan_view";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	public function view_bank_information(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['page_id'] = @$_GET['page'];
			$data['bank_datas'] = $this->users_model->get_users_bank_information($user_id);
			$data['page_name'] = "users/regular/bank_view";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function pan_verification($para1 = '', $para2 = '', $para3 = ''){
		$pan_id = $this->input->post('pan_id');
		$type = $this->input->post('type');
		$user_id = $this->input->post('user_id');
		$reject_reason = $this->input->post('reject_reason');
		
		if($type == 'verify'){
			$data['verification_status'] = 'yes';
			$this->db->where('pan_verified_id', $pan_id);
			$this->db->where('pan_verified_user_id', $user_id);
			$this->db->update('pan_varification_info', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$datas['withdraw_pan_veri_status'] = 'yes';
				$this->db->where('user_id', $user_id);
				$this->db->update('user', $datas);
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else{
			$data['verification_status'] = 'reject';
			$data['reject_reason'] = $reject_reason;
			$this->db->where('pan_verified_id', $pan_id);
			$this->db->where('pan_verified_user_id', $user_id);
			$this->db->update('pan_varification_info', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$datas['withdraw_pan_veri_status'] = 'reject';
				$this->db->where('user_id', $user_id);
				$this->db->update('user', $datas);
				echo 'done';
			}else{
				echo 'not_done';
			}
		}
	}
	
	public function bank_verification($para1 = '', $para2 = '', $para3 = ''){
		$bank_id = $this->input->post('bank_id');
		$type = $this->input->post('type');
		$user_id = $this->input->post('user_id');
		$reject_reason = $this->input->post('reject_reason');
		
		if($type == 'verify'){
			$data['verification_status'] = 'yes';
			$this->db->where('bank_verified_id', $bank_id);
			$this->db->where('bank_verified_user_id', $user_id);
			$this->db->update('bank_varification_info', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$datas['withdraw_bank_veri_status'] = 'yes';
				$this->db->where('user_id', $user_id);
				$this->db->update('user', $datas);
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else{
			$data['verification_status'] = 'reject';
			$data['reject_reason'] = $reject_reason;
			$this->db->where('bank_verified_id', $bank_id);
			$this->db->where('bank_verified_user_id', $user_id);
			$this->db->update('bank_varification_info', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$datas['withdraw_bank_veri_status'] = 'reject';
				$this->db->where('user_id', $user_id);
				$this->db->update('user', $datas);
				echo 'done';
			}else{
				echo 'not_done';
			}
		}
	}
	
	public function regular_users()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('users')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$name = $data['name'];
			$user_name = $data['user_name'];
			$mobile_number = $data['mobile_number'];
			$refrence_code = $data['refrence_code'];
			$account_status = $data['account_status'];
			
			
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){
				$searchurl='?n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status;
			}else{
				$searchurl='';
			}
			$count_data = $this->users_model->get_total_regular_users_data_count($name,$user_name,$mobile_number,$refrence_code,$account_status);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/users/regular_users".$searchurl;
			$config['per_page'] = 30;
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
			
			$data['all_users'] = $this->users_model->get_total_regular_users_data($name,$user_name,$mobile_number,$refrence_code,$account_status,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "users/regular/users";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function regular_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('users_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['page_id'] = @$_GET['page'];
			
			$data['page_name'] = "users/users_add";
			$data['country_data'] = $this->db->get_where('country',array('country_status'=>'Active'))->result_array();
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function regular_do_add(){
		$country_code = $this->input->post('country_code');
		$mobile_number = $this->input->post('mobile_number');
		$email = $this->input->post('email');
		$user_name = $this->input->post('user_name');
		$use_refer_code = $this->input->post('refrence_code');
		$name = $this->input->post('name');
		$check_user_name = @$this->db->select('user_id')->get_where('user',array('team_name'=>$user_name))->result_array();
		$all_user_id = array_unique(array_column($check_user_name,"user_id"));
		
		$lengths = 6;
		$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
		$charactersLengths = strlen($characterss);
		$randomStrings = '';
		for ($is = 0; $is < $lengths; $is++) {
			$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
		}
		$refercode = $randomStrings;
		
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		
		if(count($all_user_id) > 1){
			echo 'user_name_exit';
		}else{
			if($use_refer_code != '' && $use_refer_code != null){
				$check_refer_code = @$this->db->get_where('user',array('my_refer_code'=>$use_refer_code))->result_array();
				$welcome_bonus = @$this->db->get_where('application_setting',array('application_setting_id'=>'4'))->row()->application_setting_value;
				$to_person_bonus = @$this->db->get_where('application_setting',array('application_setting_id'=>'5'))->row()->application_setting_value;
				$welcome_type = @$this->db->get_where('application_setting',array('application_setting_id'=>'14'))->row()->application_setting_value;
				if(!empty($check_refer_code)){
					
					/* REFERCODE USER DETAILS */
						$use_register_with_refer_code_type = $check_refer_code[0]['account_type'];
						$register_with_refer_user_id  = $check_refer_code[0]['user_id'];
						$register_with_refer_user_name  = $check_refer_code[0]['name'];
					/* REFERCODE USER DETAILS */
					
					
					$check_account = $this->users_model->check_exit_account($country_code,$mobile_number,$email);
					if(!empty($check_account)){
						$ca_status = $check_account[0]['account_status'];
						$user_id = $check_account[0]['user_id'];
						$ca_mobile = $check_account[0]['mobile_number'];
						$ca_country_code = $check_account[0]['country_code'];
						$user_token = $check_account[0]['user_token'];
						if($ca_status == 'Active'){
							echo 'mobile_email_exit';
						}else if($ca_status == 'Not-verified'){
							echo 'not_verify';
						}else if($ca_status == 'De-active'){
							echo 'de_active';
						}else if($ca_status == 'delete'){
							if($welcome_type == 'single'){
								$insert_data['user_token'] = $token;
								$insert_data['name'] = $name;
								$insert_data['email'] = $email;
								$insert_data['country_code'] = $country_code;
								$insert_data['mobile_number'] = $mobile_number;
								$insert_data['my_refer_code'] = 'MG11'.$refercode;
								$password = $this->input->post('password');
								$pass = md5($password.'28011987');
								$insert_data['password'] = $pass;
								$insert_data['register_with_refer_code'] = $use_refer_code;
								$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
								$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
								$insert_data['created_date'] = time();
								$insert_data['account_status'] = 'Active';
								$insert_data['team_name'] = $user_name;
								$insert_data['account_type'] = 'user';
								$insert_data['withdraw_email_veri_status'] = 'no';
								$insert_data['withdraw_mobile_veri_status'] = 'no';
								$insert_data['withdraw_pan_veri_status'] = 'no';
								$insert_data['withdraw_bank_veri_status'] = 'no';
								$insert_data['my_winning_amount'] = '0';
								$insert_data['my_cash_bonus'] = $welcome_bonus;
								$insert_data['my_winning_cashback'] = '0';
								$insert_data['added_cash_amount'] = '0';
								$insert_data['added_total_cash_amount'] = '0';
								$insert_data['user_withdraw_send_amount'] = '0';
								$insert_data['franchise_withdraw_send_amount'] = '0';
								$insert_data['user_withdraw_total_amount'] = '0';
								$insert_data['franchise_withdraw_total_amount'] = '0';
								
								$profile_image = $_FILES['profile_image']['name'];
								if($profile_image != ''){
									$length = 6;
									$characters = '01234567899876543210';
									$charactersLength = strlen($characters);
									$randomString = '';
									for ($i = 0; $i < $length; $i++) {
										$randomString .= $characters[rand(0, $charactersLength - 1)];
									}
									$otp2 = $randomString;
									
									$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
									
									$uploadedFile = $_FILES['profile_image']['tmp_name']; 
									$dirPath = "uploads/user/";
									$newFileName = $otp2."_users";
									
									if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
										$insert_data['profile_image'] = $otp2.'_users.'.$ext;
									}
								}
									
								$this->db->insert('user',$insert_data);
								$this->db->trans_complete();
								if ($this->db->trans_status() === TRUE) {
									$userid = $this->db->insert_id();
									/* BONUS TRANSACTION */
										$lengths= 50;
										$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengths = strlen($characterss);
										$randomStrings = '';
										for ($is = 0; $is < $lengths; $is++) {
											$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
										}
										$tokenss = $randomStrings;
										
										$lengtht= 15;
										$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengtht = strlen($characterst);
										$randomStringt = '';
										for ($it = 0; $it < $lengtht; $it++) {
											$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
										}
										$tokenst = 'DMJTX'.$randomStringt.'11';
										$data_t['txt_token'] = $tokenss;
										$data_t['transaction_id'] = $tokenst;
										$data_t['txt_status'] = 'success';
										$data_t['txt_amount'] = $welcome_bonus;
										$data_t['txt_user_id'] = $userid;
										$data_t['txt_user_name'] = $name;
										$data_t['txt_contents'] = 'Welcome Bonus added';
										$data_t['txt_date'] = time();
										$data_t['txt_type'] = 'add';
										$data_t['txt_use_type'] = 'recent';
										$data_t['created_date'] = time();
										$data_t['original_date'] = date('Y-m-d');
										$this->db->insert('transaction',$data_t);
									/* BONUS TRANSACTION */
									/* NOTIFICATION */
										$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
										$data_tn['notification_user_id'] = $userid;
										$data_tn['notification_content'] = $notification_content;
										$data_tn['notification_read'] = 'no';
										$data_tn['user_type'] = 'user';
										$data_tn['notification_type'] = 'Others';
										$data_tn['created_by'] = $userid;
										$data_tn['created_date'] = time();
										$this->db->insert('notification',$data_tn);
									/* NOTIFICATION  */
									echo 'done';
								}else{
									echo 'not_done';
								}
							}else{
								$get_old_bonus = @$this->db->get_where('user',array('user_id'=>$register_with_refer_user_id))->row()->my_cash_bonus;
								if($get_old_bonus == '' || $get_old_bonus == '0' || $get_old_bonus == null){
									$use_old_bonus = '0';
								}else{
									$use_old_bonus = $get_old_bonus;
								}
								$new_bonus = $use_old_bonus + $to_person_bonus;
								$insert_data['user_token'] = $token;
								$insert_data['name'] = $name;
								$insert_data['email'] = $email;
								$insert_data['country_code'] = $country_code;
								$insert_data['mobile_number'] = $mobile_number;
								$insert_data['my_refer_code'] = 'MG11'.$refercode;
								$password = $this->input->post('password');
								$pass = md5($password.'28011987');
								$insert_data['password'] = $pass;
								$insert_data['register_with_refer_code'] = $use_refer_code;
								$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
								$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
								$insert_data['created_date'] = time();
								$insert_data['account_status'] = 'Active';
								$insert_data['team_name'] = $user_name;
								$insert_data['account_type'] = 'user';
								$insert_data['withdraw_email_veri_status'] = 'no';
								$insert_data['withdraw_mobile_veri_status'] = 'no';
								$insert_data['withdraw_pan_veri_status'] = 'no';
								$insert_data['withdraw_bank_veri_status'] = 'no';
								$insert_data['my_winning_amount'] = '0';
								$insert_data['my_cash_bonus'] = $welcome_bonus;
								$insert_data['my_winning_cashback'] = '0';
								$insert_data['added_cash_amount'] = '0';
								$insert_data['added_total_cash_amount'] = '0';
								$insert_data['user_withdraw_send_amount'] = '0';
								$insert_data['franchise_withdraw_send_amount'] = '0';
								$insert_data['user_withdraw_total_amount'] = '0';
								$insert_data['franchise_withdraw_total_amount'] = '0';
								
								$profile_image = $_FILES['profile_image']['name'];
								if($profile_image != ''){
									$length = 6;
									$characters = '01234567899876543210';
									$charactersLength = strlen($characters);
									$randomString = '';
									for ($i = 0; $i < $length; $i++) {
										$randomString .= $characters[rand(0, $charactersLength - 1)];
									}
									$otp2 = $randomString;
									
									$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
									
									$uploadedFile = $_FILES['profile_image']['tmp_name']; 
									$dirPath = "uploads/user/";
									$newFileName = $otp2."_users";
									
									if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
										$insert_data['profile_image'] = $otp2.'_users.'.$ext;
									}
								}
								
								$this->db->insert('user',$insert_data);
								$this->db->trans_complete();
								if ($this->db->trans_status() === TRUE) {
									$userid = $this->db->insert_id();
									/* INSERT IN REFER LIST */
										$ruinsert_data['my_cash_bonus'] = $new_bonus;
										$this->db->where('user_id',$register_with_refer_user_id);
										$this->db->update('user',$ruinsert_data);
									/* INSERT IN REFER LIST */
									/* BONUS regiter TRANSACTION */
										$lengths= 50;
										$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengths = strlen($characterss);
										$randomStrings = '';
										for ($is = 0; $is < $lengths; $is++) {
											$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
										}
										$tokenss = $randomStrings;
										
										$lengtht= 15;
										$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengtht = strlen($characterst);
										$randomStringt = '';
										for ($it = 0; $it < $lengtht; $it++) {
											$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
										}
										$tokenst = 'DMJTX'.$randomStringt.'11';
										$data_t['txt_token'] = $tokenss;
										$data_t['transaction_id'] = $tokenst;
										$data_t['txt_status'] = 'success';
										$data_t['txt_amount'] = $welcome_bonus;
										$data_t['txt_user_id'] = $userid;
										$data_t['txt_user_name'] = $name;
										$data_t['txt_contents'] = 'Welcome Bonus added';
										$data_t['txt_date'] = time();
										$data_t['txt_type'] = 'add';
										$data_t['txt_use_type'] = 'recent';
										$data_t['created_date'] = time();
										$data_t['original_date'] = date('Y-m-d');
										$this->db->insert('transaction',$data_t);
									/* BONUS register TRANSACTION */
									/* BONUS refer user TRANSACTION */
										$lengthss= 50;
										$charactersss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengthss = strlen($charactersss);
										$randomStringss = '';
										for ($iss = 0; $iss < $lengthss; $iss++) {
											$randomStringss .= $charactersss[rand(0, $charactersLengthss - 1)];
										}
										$tokensss = $randomStringss;
										
										$lengthts= 15;
										$charactersts = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
										$charactersLengthts = strlen($charactersts);
										$randomStringts = '';
										for ($its = 0; $its < $lengthts; $its++) {
											$randomStringts .= $charactersts[rand(0, $charactersLengthts - 1)];
										}
										$tokensts = 'DMJTX'.$randomStringts.'11';
										
										$data_ts['txt_token'] = $tokensss;
										$data_ts['transaction_id'] = $tokensts;
										$data_ts['txt_status'] = 'success';
										$data_ts['txt_amount'] = $to_person_bonus;
										$data_ts['txt_user_id'] = $register_with_refer_user_id;
										$data_ts['txt_user_name'] = $register_with_refer_user_name;
										$data_ts['txt_contents'] = 'Refer Bonus added';
										$data_ts['txt_date'] = time();
										$data_ts['txt_type'] = 'add';
										$data_ts['txt_use_type'] = 'recent';
										$data_ts['created_date'] = time();
										$data_ts['original_date'] = date('Y-m-d');
										$this->db->insert('transaction',$data_ts);
									/* BONUS refer user TRANSACTION */
									/* NOTIFICATION */
										$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
										$data_tn['notification_user_id'] = $userid;
										$data_tn['notification_content'] = $notification_content;
										$data_tn['notification_read'] = 'no';
										$data_tn['user_type'] = 'user';
										$data_tn['notification_type'] = 'Others';
										$data_tn['created_by'] = $userid;
										$data_tn['created_date'] = time();
										$this->db->insert('notification',$data_tn);
									/* NOTIFICATION  */
									/* REFER USER NOTIFICATION */
										$notification_content_refer = "Rs. $to_person_bonus Refer Bonus added in your Reddmica Wallet. Register user is $name";
										$data_tnr['notification_user_id'] = $register_with_refer_user_id;
										$data_tnr['notification_content'] = $notification_content_refer;
										$data_tnr['notification_read'] = 'no';
										$data_tnr['user_type'] = 'user';
										$data_tnr['notification_type'] = 'Others';
										$data_tnr['created_by'] = $register_with_refer_user_id;
										$data_tnr['created_date'] = time();
										$this->db->insert('notification',$data_tnr);
									/* REFER USER  NOTIFICATION  */
									echo 'done';
								}else{
									echo 'not_done';
								}
							}
						}
					}else{
						if($welcome_type == 'single'){
							$insert_data['user_token'] = $token;
							$insert_data['name'] = $name;
							$insert_data['email'] = $email;
							$insert_data['country_code'] = $country_code;
							$insert_data['mobile_number'] = $mobile_number;
							$insert_data['my_refer_code'] = 'MG11'.$refercode;
							$password = $this->input->post('password');
							$pass = md5($password.'28011987');
							$insert_data['password'] = $pass;
							$insert_data['register_with_refer_code'] = $use_refer_code;
							$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
							$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
							$insert_data['created_date'] = time();
							$insert_data['account_status'] = 'Active';
							$insert_data['team_name'] = $user_name;
							$insert_data['account_type'] = 'user';
							$insert_data['withdraw_email_veri_status'] = 'no';
							$insert_data['withdraw_mobile_veri_status'] = 'no';
							$insert_data['withdraw_pan_veri_status'] = 'no';
							$insert_data['withdraw_bank_veri_status'] = 'no';
							$insert_data['my_winning_amount'] = '0';
							$insert_data['my_cash_bonus'] = '100';
							$insert_data['my_winning_cashback'] = '0';
							$insert_data['added_cash_amount'] = '0';
							$insert_data['added_total_cash_amount'] = '0';
							$insert_data['user_withdraw_send_amount'] = '0';
							$insert_data['franchise_withdraw_send_amount'] = '0';
							$insert_data['user_withdraw_total_amount'] = '0';
							$insert_data['franchise_withdraw_total_amount'] = '0';
							
							$profile_image = $_FILES['profile_image']['name'];
							if($profile_image != ''){
								$length = 6;
								$characters = '01234567899876543210';
								$charactersLength = strlen($characters);
								$randomString = '';
								for ($i = 0; $i < $length; $i++) {
									$randomString .= $characters[rand(0, $charactersLength - 1)];
								}
								$otp2 = $randomString;
								
								$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
								
								$uploadedFile = $_FILES['profile_image']['tmp_name']; 
								$dirPath = "uploads/user/";
								$newFileName = $otp2."_users";
								
								if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
									$insert_data['profile_image'] = $otp2.'_users.'.$ext;
								}
							}
							
							$this->db->insert('user',$insert_data);
							$this->db->trans_complete();
							if ($this->db->trans_status() === TRUE) {
								$userid = $this->db->insert_id();
								/* BONUS TRANSACTION */
									$lengths= 50;
									$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengths = strlen($characterss);
									$randomStrings = '';
									for ($is = 0; $is < $lengths; $is++) {
										$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
									}
									$tokenss = $randomStrings;
									 
									$lengtht= 15;
									$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengtht = strlen($characterst);
									$randomStringt = '';
									for ($it = 0; $it < $lengtht; $it++) {
										$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
									}
									$tokenst = 'DMJTX'.$randomStringt.'11';
									$data_t['txt_token'] = $tokenss;
									$data_t['transaction_id'] = $tokenst;
									$data_t['txt_status'] = 'success';
									$data_t['txt_amount'] = $welcome_bonus;
									$data_t['txt_user_id'] = $userid;
									$data_t['txt_user_name'] = $name;
									$data_t['txt_contents'] = 'Welcome Bonus added';
									$data_t['txt_date'] = time();
									$data_t['txt_type'] = 'add';
									$data_t['txt_use_type'] = 'recent';
									$data_t['created_date'] = time();
									$data_t['original_date'] = date('Y-m-d');
									$this->db->insert('transaction',$data_t);
								/* BONUS TRANSACTION */
								/* NOTIFICATION */
									$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
									$data_tn['notification_user_id'] = $userid;
									$data_tn['notification_content'] = $notification_content;
									$data_tn['notification_read'] = 'no';
									$data_tn['user_type'] = 'user';
									$data_tn['notification_type'] = 'Others';
									$data_tn['created_by'] = $userid;
									$data_tn['created_date'] = time();
									$this->db->insert('notification',$data_tn);
								/* NOTIFICATION  */
								echo 'done';
							}else{
								echo 'not_done';
							}
						}else{
							$get_old_bonus = @$this->db->get_where('user',array('user_id'=>$register_with_refer_user_id))->row()->my_cash_bonus;
							
							if($get_old_bonus == '' || $get_old_bonus == '0' || $get_old_bonus == null){
								$use_old_bonus = '0';
							}else{
								$use_old_bonus = $get_old_bonus;
							}
							$new_bonus = $use_old_bonus + $to_person_bonus;
							
							$insert_data['user_token'] = $token;
							$insert_data['name'] = $name;
							$insert_data['email'] = $email;
							$insert_data['country_code'] = $country_code;
							$insert_data['mobile_number'] = $mobile_number;
							$insert_data['my_refer_code'] = 'MG11'.$refercode;
							$password = $this->input->post('password');
							$pass = md5($password.'28011987');
							$insert_data['password'] = $pass;
							$insert_data['register_with_refer_code'] = $use_refer_code;
							$insert_data['use_register_with_refer_code_type'] = $use_register_with_refer_code_type;
							$insert_data['register_with_refer_user_id'] = $register_with_refer_user_id;
							$insert_data['created_date'] = time();
							$insert_data['account_status'] = 'Active';
							$insert_data['team_name'] = $team_name;
							$insert_data['account_type'] = 'user';
							$insert_data['withdraw_email_veri_status'] = 'no';
							$insert_data['withdraw_mobile_veri_status'] = 'no';
							$insert_data['withdraw_pan_veri_status'] = 'no';
							$insert_data['withdraw_bank_veri_status'] = 'no';
							$insert_data['my_winning_amount'] = '0';
							$insert_data['my_cash_bonus'] = '100';
							$insert_data['my_winning_cashback'] = '0';
							$insert_data['added_cash_amount'] = '0';
							$insert_data['added_total_cash_amount'] = '0';
							$insert_data['user_withdraw_send_amount'] = '0';
							$insert_data['franchise_withdraw_send_amount'] = '0';
							$insert_data['user_withdraw_total_amount'] = '0';
							$insert_data['franchise_withdraw_total_amount'] = '0';
							
							$profile_image = $_FILES['profile_image']['name'];
							if($profile_image != ''){
								$length = 6;
								$characters = '01234567899876543210';
								$charactersLength = strlen($characters);
								$randomString = '';
								for ($i = 0; $i < $length; $i++) {
									$randomString .= $characters[rand(0, $charactersLength - 1)];
								}
								$otp2 = $randomString;
								
								$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
								
								$uploadedFile = $_FILES['profile_image']['tmp_name']; 
								$dirPath = "uploads/user/";
								$newFileName = $otp2."_users";
								
								if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
									$insert_data['profile_image'] = $otp2.'_users.'.$ext;
								}
							}
							
							$this->db->insert('user',$insert_data);
							
							$this->db->trans_complete();
							if ($this->db->trans_status() === TRUE) {
								$userid = $this->db->insert_id();
								/* INSERT IN REFER LIST */
									$ruinsert_data['my_cash_bonus'] = $new_bonus;
									$this->db->where('user_id',$register_with_refer_user_id);
									$this->db->update('user',$ruinsert_data);
								/* INSERT IN REFER LIST */
								/* BONUS regiter TRANSACTION */
									$lengths= 50;
									$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengths = strlen($characterss);
									$randomStrings = '';
									for ($is = 0; $is < $lengths; $is++) {
										$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
									}
									$tokenss = $randomStrings;
									
									$lengtht= 15;
									$characterst = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengtht = strlen($characterst);
									$randomStringt = '';
									for ($it = 0; $it < $lengtht; $it++) {
										$randomStringt .= $characterst[rand(0, $charactersLengtht - 1)];
									}
									$tokenst = 'DMJTX'.$randomStringt.'11';
									$data_t['txt_token'] = $tokenss;
									$data_t['transaction_id'] = $tokenst;
									$data_t['txt_status'] = 'success';
									$data_t['txt_amount'] = $welcome_bonus;
									$data_t['txt_user_id'] = $userid;
									$data_t['txt_user_name'] = $name;
									$data_t['txt_contents'] = 'Welcome Bonus added';
									$data_t['txt_date'] = time();
									$data_t['txt_type'] = 'add';
									$data_t['txt_use_type'] = 'recent';
									$data_t['created_date'] = time();
									$data_t['original_date'] = date('Y-m-d');
									$this->db->insert('transaction',$data_t);
								/* BONUS register TRANSACTION */
								/* BONUS refer user TRANSACTION */
									$lengthss= 50;
									$charactersss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengthss = strlen($charactersss);
									$randomStringss = '';
									for ($iss = 0; $iss < $lengthss; $iss++) {
										$randomStringss .= $charactersss[rand(0, $charactersLengthss - 1)];
									}
									$tokensss = $randomStringss;
									
									$lengthts= 15;
									$charactersts = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
									$charactersLengthts = strlen($charactersts);
									$randomStringts = '';
									for ($its = 0; $its < $lengthts; $its++) {
										$randomStringts .= $charactersts[rand(0, $charactersLengthts - 1)];
									}
									$tokensts = 'DMJTX'.$randomStringts.'11';
									
									$data_ts['txt_token'] = $tokensss;
									$data_ts['transaction_id'] = $tokensts;
									$data_ts['txt_status'] = 'success';
									$data_ts['txt_amount'] = $to_person_bonus;
									$data_ts['txt_user_id'] = $register_with_refer_user_id;
									$data_ts['txt_user_name'] = $register_with_refer_user_name;
									$data_ts['txt_contents'] = 'Refer Bonus added';
									$data_ts['txt_date'] = time();
									$data_ts['txt_type'] = 'add';
									$data_ts['txt_use_type'] = 'recent';
									$data_ts['created_date'] = time();
									$data_ts['original_date'] = date('Y-m-d');
									$this->db->insert('transaction',$data_ts);
								/* BONUS refer user TRANSACTION */
								/* NOTIFICATION */
									$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
									$data_tn['notification_user_id'] = $userid;
									$data_tn['notification_content'] = $notification_content;
									$data_tn['notification_read'] = 'no';
									$data_tn['user_type'] = 'user';
									$data_tn['notification_type'] = 'Others';
									$data_tn['created_by'] = $userid;
									$data_tn['created_date'] = time();
									$this->db->insert('notification',$data_tn);
								/* NOTIFICATION  */
								/* REFER USER NOTIFICATION */
									$notification_content_refer = "Rs. $to_person_bonus Refer Bonus added in your Reddmica Wallet. Register user is $name";
									$data_tnr['notification_user_id'] = $register_with_refer_user_id;
									$data_tnr['notification_content'] = $notification_content_refer;
									$data_tnr['notification_read'] = 'no';
									$data_tnr['user_type'] = 'user';
									$data_tnr['notification_type'] = 'Others';
									$data_tnr['created_by'] = $register_with_refer_user_id;
									$data_tnr['created_date'] = time();
									$this->db->insert('notification',$data_tnr);
								/* REFER USER  NOTIFICATION  */
								echo 'done';
							}else{
								echo 'not_done';
							}
						}
					}
				}else{
					echo 'refer_code_not_valid';
				}
			}else{
				$check_account = $this->users_model->check_exit_account($country_code,$mobile_number,$email);
				if(!empty($check_account)){
					$ca_status = $check_account[0]['account_status'];
					$user_id = $check_account[0]['user_id'];
					$ca_mobile = $check_account[0]['mobile_number'];
					$ca_country_code = $check_account[0]['country_code'];
					$user_token = $check_account[0]['user_token'];
					if($ca_status == 'Active'){
						echo 'mobile_email_exit';
					}else if($ca_status == 'Not-verified'){
						echo 'not_verified';
					}else if($ca_status == 'De-active'){
						echo 'de_active';
					}else if($ca_status == 'delete'){
						$insert_data['user_token'] = $token;
						$insert_data['name'] = $name;
						$insert_data['email'] = $email;
						$insert_data['country_code'] = $country_code;
						$insert_data['mobile_number'] = $mobile_number;
						$insert_data['my_refer_code'] = 'MG11'.$refercode;
						$password = $this->input->post('password');
						$pass = md5($password.'28011987');
						$insert_data['password'] = $pass;
						$insert_data['created_date'] = time();
						$insert_data['account_status'] = 'Active';
						$insert_data['account_type'] = 'user';
						$insert_data['withdraw_email_veri_status'] = 'no';
						$insert_data['withdraw_mobile_veri_status'] = 'no';
						$insert_data['withdraw_pan_veri_status'] = 'no';
						$insert_data['withdraw_bank_veri_status'] = 'no';
						$insert_data['my_winning_amount'] = '0';
						$insert_data['my_cash_bonus'] = '100';
						$insert_data['my_winning_cashback'] = '0';
						$insert_data['added_cash_amount'] = '0';
						$insert_data['added_total_cash_amount'] = '0';
						$insert_data['user_withdraw_send_amount'] = '0';
						$insert_data['franchise_withdraw_send_amount'] = '0';
						$insert_data['user_withdraw_total_amount'] = '0';
						$insert_data['franchise_withdraw_total_amount'] = '0';
						$profile_image = $_FILES['profile_image']['name'];
						if($profile_image != ''){
							$length = 6;
							$characters = '01234567899876543210';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) {
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							$otp2 = $randomString;
							
							$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
							
							$uploadedFile = $_FILES['profile_image']['tmp_name']; 
							$dirPath = "uploads/user/";
							$newFileName = $otp2."_users";
							
							if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
								$insert_data['profile_image'] = $otp2.'_users.'.$ext;
							}
						}
						$insert_data['team_name'] = $user_name;
						$this->db->insert('user',$insert_data);
						$this->db->trans_complete();
						if ($this->db->trans_status() === TRUE) {
							$userid = $this->db->insert_id();
							/* NOTIFICATION */
								$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
								$data_tn['notification_user_id'] = $userid;
								$data_tn['notification_content'] = $notification_content;
								$data_tn['notification_read'] = 'no';
								$data_tn['user_type'] = 'user';
								$data_tn['notification_type'] = 'Others';
								$data_tn['created_by'] = $userid;
								$data_tn['created_date'] = time();
								$this->db->insert('notification',$data_tn);
							/* NOTIFICATION  */
							echo 'done';
						}else{
							echo 'not_done';
						}
					}
				}else{
					$insert_data['user_token'] = $token;
					$insert_data['name'] = $name;
					$insert_data['email'] = $email;
					$insert_data['country_code'] = $country_code;
					$insert_data['mobile_number'] = $mobile_number;
					$password = $this->input->post('password');
					$pass = md5($password.'28011987');
					$insert_data['password'] = $pass;
					$insert_data['my_refer_code'] = 'MG11'.$refercode;
					$insert_data['created_date'] = time();
					$insert_data['account_status'] = 'Active';
					$insert_data['account_type'] = 'user';
					$insert_data['withdraw_email_veri_status'] = 'no';
					$insert_data['withdraw_mobile_veri_status'] = 'no';
					$insert_data['withdraw_pan_veri_status'] = 'no';
					$insert_data['withdraw_bank_veri_status'] = 'no';
					$insert_data['my_winning_amount'] = '0';
					$insert_data['my_cash_bonus'] = '100';
					$insert_data['my_winning_cashback'] = '0';
					$insert_data['added_cash_amount'] = '0';
					$insert_data['added_total_cash_amount'] = '0';
					$insert_data['user_withdraw_send_amount'] = '0';
					$insert_data['franchise_withdraw_send_amount'] = '0';
					$insert_data['user_withdraw_total_amount'] = '0';
					$insert_data['franchise_withdraw_total_amount'] = '0';
					$insert_data['team_name'] = $user_name;
					
					$profile_image = $_FILES['profile_image']['name'];
						if($profile_image != ''){
							$length = 6;
							$characters = '01234567899876543210';
							$charactersLength = strlen($characters);
							$randomString = '';
							for ($i = 0; $i < $length; $i++) {
								$randomString .= $characters[rand(0, $charactersLength - 1)];
							}
							$otp2 = $randomString;
							
							$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
							
							$uploadedFile = $_FILES['profile_image']['tmp_name']; 
							$dirPath = "uploads/user/";
							$newFileName = $otp2."_users";
							
							if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
								$insert_data['profile_image'] = $otp2.'_users.'.$ext;
							}
						}
					$this->db->insert('user',$insert_data);
					$this->db->trans_complete();
					if ($this->db->trans_status() === TRUE) {
						$userid = $this->db->insert_id();
						/* NOTIFICATION */
							$notification_content = "You are successfully register on Reddmica and Rs. $welcome_bonus Welcome Bonus added in your Reddmica Wallet.";
							$data_tn['notification_user_id'] = $userid;
							$data_tn['notification_content'] = $notification_content;
							$data_tn['notification_read'] = 'no';
							$data_tn['user_type'] = 'user';
							$data_tn['notification_type'] = 'Others';
							$data_tn['created_by'] = $userid;
							$data_tn['created_date'] = time();
							$this->db->insert('notification',$data_tn);
						/* NOTIFICATION  */
						echo 'done';
					}else{
						echo 'not_done';
					}
				}
			}
		}
	}
	
	public function regular_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['user_id'] = @$_GET['u_i'];
			$data['page_id'] = @$_GET['page'];
			$data['country_data'] = $this->db->get_where('country',array('country_status'=>'Active'))->result_array();
			$data['users_data'] = $this->db->get_where('user', array('user_id' => $user_id,'user_token'=>$user_token))->result_array();
			$data['page_name'] = "users/regular/users_edit";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function regular_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['page_id'] = @$_GET['page'];
			$data['users_data'] = $this->users_model->get_users_information($user_id,$user_token);
			$data['page_name'] = "users/regular/users_view";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function regular_update($para1 = '', $para2 = '', $para3 = ''){
		$data['name'] = $this->input->post('name');
		$data['country_code'] = $this->input->post('country_code');
		$data['mobile_number'] = $this->input->post('mobile_number');
		$data['email'] = $this->input->post('email');
		
		$profile_image = $_FILES['profile_image']['name'];
		if($profile_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('user',array('user_id'=>$para1))->result_array();
			if($check_account[0]['profile_image'] != ''){
				$rpersonal = "uploads/user_image/".$check_account[0]['profile_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['profile_image']['tmp_name']; 
			$dirPath = "uploads/user_image/";
			$newFileName = $otp2."_users";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['profile_image'] = $otp2.'_users.'.$ext;
			}
		}
		$this->db->where('user_id', $para1);
		$this->db->update('user', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function regular_userss($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('users')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$user_id = $this->input->post('id');
            $this->db->where('user_id',$user_id);
            
			$data['account_status'] = 'delete';
			$this->db->where('user_id', $user_id);
            $this->db->update('user',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'account_set') {
            $users = $para2;
			if ($para3 == 'true') {
                $data['account_status'] = 'Active';
            } else {
                $data['account_status'] = 'De-active';
            }
            $this->db->where('user_id', $users);
            $this->db->update('user', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
        }
    }
	
	function regular_purchase_plan(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('users_purchase_plan')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['user_id'] = @$_GET['u_i'];
			$data['page_id'] = @$_GET['page'];
			$data['plan'] = $this->db->get_where('plan_master',array('status'=>'active'))->result_array();
			$data['users_data'] = $this->db->get_where('user', array('user_id' => $user_id,'user_token'=>$user_token))->result_array();
			$data['page_name'] = "users/regular/users_purchase_plan";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	function regular_purchaseed_plan($para1 = '', $para2 = '', $para3 = ''){
		$plan_id = $this->input->post('membership_plan');
		$user_id = $para1;
		$payment_mode = $this->input->post('payment_method');
		$transaction_id = $this->input->post('transaction_id');
		$cheque_number = $this->input->post('cheque_number');
		
		$check_account = @$this->db->get_where('user',array('user_id'=>$user_id))->result_array();
		$name = $check_account[0]['name'];
		$email = $check_account[0]['email'];
		$phone = $check_account[0]['mobile_number'];
		$my_refer_code = $check_account[0]['my_refer_code'];
		
		$get_plan_details = @$this->db->get_where('plan_master',array('plan_id'=>$plan_id))->result_array();
		if(!empty($get_plan_details)){
			$plan_name = $get_plan_details[0]['plan_name'];
			if($get_plan_details[0]['discount_price'] == '' || $get_plan_details[0]['discount_price'] == '0' || $get_plan_details[0]['discount_price'] == null){
				$plan_amount = $get_plan_details[0]['main_price'];
			}else{
				$plan_amount = $get_plan_details[0]['discount_price'];
			}
			$plan_validaty_value = $get_plan_details[0]['plan_validity'];
			$plan_validaty_value_type = $get_plan_details[0]['plan_validity_duration'];
			$commission_value = $get_plan_details[0]['commission_value'];
			$commission_value_type = $get_plan_details[0]['commission_value_type'];
			
			$lengthss = 50;
			$charactersss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
			$charactersLengthss = strlen($charactersss);
			$randomStringss = '';
			for ($iss = 0; $iss < $lengthss; $iss++) {
				$randomStringss .= $charactersss[rand(0, $charactersLengthss - 1)];
			}
			$refercodes = $randomStringss;
			
			$insert_data['txt_token'] = $refercodes;
			$insert_data['txt_user_id'] = $user_id;
			$insert_data['txt_user_name'] = $name;
			$insert_data['plan_id'] = $plan_id;
			$insert_data['plan_name'] = $plan_name;
			$insert_data['txt_method'] = $payment_mode;
			$insert_data['transaction_id'] = $transaction_id;
			$insert_data['txt_amount'] = $plan_amount;
			$insert_data['paid_amount'] = $plan_amount;
			$insert_data['txt_status'] ='success';
			$insert_data['txt_contents'] = 'Franchise Purchase';
			$insert_data['txt_user_type'] = 'franchise';
			$insert_data['txt_date'] = time();
			$insert_data['txt_type'] = 'add';
			$insert_data['txt_use_type'] = 'recent';
			
			if($plan_validaty_value_type == 'year'){
				$use_validity_value = $plan_validaty_value*365;
				$use_validity_type = 'days';
			}else{
				$use_validity_value = $plan_validaty_value;
				$use_validity_type = 'months';
			}
			date_default_timezone_set('Asia/Kolkata');
			$plan_start_date = time();
			$plan_expire_date = date('Y-m-d', strtotime('+'.$use_validity_value.' '.$use_validity_type));
			
			if($plan_expire_date != ''){
				$d = DateTime::createFromFormat(
					"Y-m-d H:i:s",
					"$plan_expire_date 23:59:59",
					new DateTimeZone('Asia/Kolkata')
				);

				if ($d === false) {
					$from_timestamp = '';
				} else {
					$from_timestamp = $d->getTimestamp();
				}
				$date_expire_date = $from_timestamp;
			}else{
				$date_expire_date = time();
			}
			
			$insert_data['plan_purchse_date'] = $plan_start_date;
			$insert_data['expire_date'] = $date_expire_date;
			$insert_data['created_date'] = time();
			$insert_data['original_date'] = date('Y-m-d');
			$this->db->insert('transaction',$insert_data);
			
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$payment_id = $this->db->insert_id();
				$userid = $this->db->insert_id();
				/* SEND SMS */
					if(check_sms() == 'yes'){
						$send_mobile_number = $phone;
						$message = urlencode("Your Franchise plan has been successfully activated.");
						//send_sms($send_mobile_number,$message);
					}
				/* SEND SMS */
				$check_last_franchise = @$this->db->get_where('user',array('user_id'=>$user_id))->row()->old_franchise_id;
				if($check_last_franchise == '' || $check_last_franchise == '0' || $check_last_franchise == null){
					$lengths = 6;
					$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
					$charactersLengths = strlen($characterss);
					$randomStrings = '';
					for ($is = 0; $is < $lengths; $is++) {
						$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
					}
					$refercode = $randomStrings;
					$user_data['my_refer_code'] = 'MG11'.$refercode;
					$user_data['old_my_refer_code'] = $my_refer_code;
				}
				
				$user_data['franchise_plan_id'] = $plan_id;
				$user_data['franchise_plan_amount'] = $plan_amount;
				$user_data['franchise_plan_start_date'] = $plan_start_date;
				$user_data['franchise_plan_end_date'] = $date_expire_date;
				$user_data['account_type'] = 'franchise';
				$user_data['franchise_plan_commission_value'] = $commission_value;
				$user_data['franchise_commission_type'] = $commission_value_type;
				$user_data['ranchise_plan_name'] = $plan_name;
				$user_data['franchise_plan_payment_id'] = $payment_id;
				$user_data['franchise_current_wallet_amount'] = '0';
				$user_data['franchise_pay_wallet_amount'] = '0';
				$user_data['old_franchise_id'] = $plan_id;
				$this->db->where('user_id',$user_id);
				$this->db->update('user',$user_data);
				
				if($check_last_franchise == '' || $check_last_franchise == '0' || $check_last_franchise == null){
					$get_my_refer_list = @$this->db->get_where('user',array('register_with_refer_user_id'=>$user_id,'register_with_refer_code'=>$my_refer_code))->result_array();
					if(!empty($get_my_refer_list)){
						foreach($get_my_refer_list as $re_row){
							$data_remove['register_with_refer_code'] = NULL;
							$data_remove['use_register_with_refer_code_type'] = NULL;
							$data_remove['register_with_refer_user_id'] = NULL;
							
							$data_remove['old_register_with_refer_code'] = $re_row['register_with_refer_code'];
							$data_remove['old_register_with_refer_user_id'] = $re_row['register_with_refer_user_id'];
							$data_remove['old_use_register_with_refer_code_type'] = $re_row['use_register_with_refer_code_type'];
							$this->db->where('user_id',$re_row['user_id']);
							$this->db->update('user',$data_remove);
						}
					}
					
					/* $get_my_refer_user_list = @$this->db->get_where('user_refrence_list',array('refrence_user_id'=>$user_id,'refrence_code'=>$my_refer_code))->result_array();
					if(!empty($get_my_refer_user_list)){
						foreach($get_my_refer_user_list as $ref_row){
							$data_remove_ref['refrence_user_id'] = NULL;
							$data_remove_ref['refrence_code'] = NULL;
							$data_remove_ref['old_refrence_code'] = $ref_row['refrence_code'];
							$data_remove_ref['old_refrence_user_id'] = $ref_row['refrence_user_id'];
							$this->db->where('user_refrence_id',$ref_row['user_refrence_id']);
							$this->db->where('refrence_code',$ref_row['refrence_code']);
							$this->db->update('user_refrence_list',$data_remove_ref);
						}
					} */
				}
				
				/* NOTIFICATION */
					$notification_content = "$plan_name Franchise Plan Successfully Purchase. Plan Amount is Rs. $plan_amount";
					$data_tn['notification_user_id'] = $user_id;
					$data_tn['notification_content'] = $notification_content;
					$data_tn['notification_read'] = 'no';
					$data_tn['user_type'] = 'user';
					$data_tn['notification_type'] = 'Transactional';
					$data_tn['created_by'] = $user_id;
					$data_tn['created_date'] = time();
					$this->db->insert('notification',$data_tn);
				/* NOTIFICATION  */
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else{
			echo 'plan_not_available';
		}
	}
	
	public function regular_view_refer_list(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			
			if (!$this->crud_model->admin_permission('insurance_details')) {
				redirect(base_url() . 'admin');
			}
			
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			
			$data['user_id'] = @$user_id;
			$data['user_token'] = @$user_token;
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['membership_plan'] = @$_GET['m_p'];
			$data['plan_type'] = @$_GET['p_t'];
			$data['refrence_code'] = @$_GET['r_c'];
			$data['my_refrence_code'] = @$_GET['m_r_c'];
			$data['account_status'] = @$_GET['a_s'];
			$data['pages'] = @$_GET['pages'];
			$name = $data['name'];
			$user_name = $data['user_name'];
			$mobile_number = $data['mobile_number'];
			$membership_plan = $data['membership_plan'];
			$refrence_code = $data['refrence_code'];
			$account_status = $data['account_status'];
			$my_refrence_code = $data['my_refrence_code'];
			$plan_type = $data['plan_type'];
			$pages = $data['pages'];
			
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$membership_plan != '' || @$refrence_code != '' || @$account_status != '' || @$plan_type != ''){
				if(@$pages != ''){
					$searchurl='?u_i='.$user_id.'&u_t='.$user_token.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&m_p='.$membership_plan.'&p_t='.$plan_type.'&r_c='.$refrence_code.'&a_s='.$account_status.'&pages='.$pages;
				}else{
					$searchurl='?u_i='.$user_id.'&u_t='.$user_token.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&m_p='.$membership_plan.'&p_t='.$plan_type.'&r_c='.$refrence_code.'&a_s='.$account_status;
				}
			}else{
				if(@$pages != ''){
					$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&m_r_c='.$refrence_code.'&pages='.$pages;
				}else{
					$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&m_r_c='.$refrence_code;
				}
			}
			$count_data = $this->users_model->get_total_users_refer_data_count($user_id,$user_token,$refrence_code);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/users/regular_view_refer_list".$searchurl;
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
			
			$data['insurance_data'] = $this->users_model->get_total_users_refer_data($user_id,$user_token,$refrence_code,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "users/regular/users_refer";
            $data['page_name_link'] = "regular_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function system_users()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
	
			if (!$this->crud_model->admin_permission('system_users')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['account_status'] = @$_GET['a_s'];
			$name = $data['name'];
			$mobile_number = $data['mobile_number'];
			$account_status = $data['account_status'];
			
			
			if(@$name != '' || @$mobile_number != '' || @$account_status != ''){
				$searchurl='?n_n='.$name.'&m_n='.$mobile_number.'&a_s='.$account_status;
			}else{
				$searchurl='';
			}
			$count_data = $this->users_model->get_total_system_users_data_count($name,$mobile_number,$account_status);
			
			$config = array();		
			$config['total_rows'] = count($count_data);
			$config['base_url'] = base_url() . "admin/users/system_users".$searchurl;
			$config['per_page'] = 30;
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
			
			$data['all_users'] = $this->users_model->get_total_system_users_data($name,$mobile_number,$account_status,$config["per_page"],$page);
			$data["links"] = $this->pagination->create_links();
			$data['msg'] = "";		
			$data['total_rows'] = $config["total_rows"];
			$data['page_id'] = $page;
			$data['page_name'] = "users/system/users";
            $data['page_name_link'] = "system_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
    }
	
	public function system_add(){
		if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('system_users_add')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['account_status'] = @$_GET['a_s'];
			$data['page_id'] = @$_GET['page'];
			
			$data['page_name'] = "users/system/users_add";
			$data['page_name_link'] = "system_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function system_do_add(){
		$count_users = $this->input->post('count_users');
		
		for($i = 1; $i<=$count_users; $i++){
			
			$lengths1 = 12;
			$characterss1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
			$charactersLengths1 = strlen($characterss1);
			$randomStrings1 = '';
			for ($isi = 0; $isi < $lengths1; $isi++) {
				$randomStrings1 .= $characterss1[rand(0, $charactersLengths1 - 1)];
			}
			$user_name = $randomStrings1;
			
			$lengths = 6;
			$characterss = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ9876543210';
			$charactersLengths = strlen($characterss);
			$randomStrings = '';
			for ($is = 0; $is < $lengths; $is++) {
				$randomStrings .= $characterss[rand(0, $charactersLengths - 1)];
			}
			$refercode = $randomStrings;
			
			$lengthsm = 10;
			$characterssm = '01234567899876543210012345678998765432100123456789987654321001234567899876543210';
			$charactersLengthsm = strlen($characterssm);
			$randomStringsm = '';
			for ($ism = 0; $ism < $lengthsm; $ism++) {
				$randomStringsm .= $characterssm[rand(0, $charactersLengthsm - 1)];
			}
			$mobile_number = $randomStringsm;
			
			$length1= 50;
			$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength1 = strlen($characters1);
			$randomString1 = '';
			for ($ii = 0; $ii < $length1; $ii++) {
				$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
			}
			$token = $randomString1;
			
			$length1n= 15;
			$characters1n = 'abcdefghijklmnopqrstuvwzxyzabcdefghijklmnopqrstuvwzxyzabcdefghijklmnopqrstuvwzxyz';
			$charactersLength1n = strlen($characters1n);
			$randomString1n = '';
			for ($iin = 0; $iin < $length1n; $iin++) {
				$randomString1n .= $characters1n[rand(0, $charactersLength1n - 1)];
			}
			$name = $randomString1n;
			
			$insert_data['user_token'] = $token;
			$insert_data['name'] = $name;
			$insert_data['email'] = "";
			$insert_data['country_code'] = '91';
			$insert_data['mobile_number'] = $mobile_number;
			$insert_data['my_refer_code'] = 'MG11'.$refercode;
			$insert_data['created_date'] = time();
			$insert_data['account_status'] = 'Active';
			$insert_data['account_type'] = 'user';
			$insert_data['withdraw_email_veri_status'] = 'no';
			$insert_data['withdraw_mobile_veri_status'] = 'no';
			$insert_data['withdraw_pan_veri_status'] = 'no';
			$insert_data['withdraw_bank_veri_status'] = 'no';
			$insert_data['my_winning_amount'] = '0';
			$insert_data['my_cash_bonus'] = '0';
			$insert_data['my_winning_cashback'] = '0';
			$insert_data['added_cash_amount'] = '0';
			$insert_data['added_total_cash_amount'] = '0';
			$insert_data['user_withdraw_send_amount'] = '0';
			$insert_data['franchise_withdraw_send_amount'] = '0';
			$insert_data['user_withdraw_total_amount'] = '0';
			$insert_data['franchise_withdraw_total_amount'] = '0';
			$insert_data['team_name'] = $user_name;
			$insert_data['type'] = 'system';
			$this->db->insert('user',$insert_data);
		}
		echo 'done';
	}
	
	public function system_edit(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('system_users_edit')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['account_status'] = @$_GET['a_s'];
			$data['user_id'] = @$_GET['u_i'];
			$data['page_id'] = @$_GET['page'];
			$data['users_data'] = $this->db->get_where('user', array('user_id' => $user_id,'user_token'=>$user_token))->result_array();
			$data['page_name'] = "users/system/users_edit";
            $data['page_name_link'] = "system_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function system_view(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			if (!$this->crud_model->admin_permission('system_users_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['account_status'] = @$_GET['a_s'];
			$data['page_id'] = @$_GET['page'];
			$data['users_data'] = $this->users_model->get_users_information($user_id,$user_token);
			$data['page_name'] = "users/system/users_view";
            $data['page_name_link'] = "system_users";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function system_update($para1 = '', $para2 = '', $para3 = ''){
		$data['name'] = $this->input->post('name');
		$data['country_code'] = $this->input->post('country_code');
		$data['mobile_number'] = $this->input->post('mobile_number');
		$data['email'] = $this->input->post('email');
		
		$profile_image = $_FILES['profile_image']['name'];
		if($profile_image != ''){
			$length = 6;
			$characters = '01234567899876543210';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$otp2 = $randomString;
			
			$check_account = @$this->db->get_where('user',array('user_id'=>$para1))->result_array();
			if($check_account[0]['profile_image'] != ''){
				$rpersonal = "uploads/user_image/".$check_account[0]['profile_image'];
				if (file_exists($rpersonal)) {
					unlink($rpersonal);
				} else {
					
				}
			}
			
			$ext = pathinfo($profile_image, PATHINFO_EXTENSION);
			
			$uploadedFile = $_FILES['profile_image']['tmp_name']; 
			$dirPath = "uploads/user_image/";
			$newFileName = $otp2."_users";
			
			if(move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext)){
				$data['profile_image'] = $otp2.'_users.'.$ext;
			}
		}
		$this->db->where('user_id', $para1);
		$this->db->update('user', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === TRUE) {
			echo 'done';
		}else{
			echo 'not_done';
		}
	}
	
	function system_userss($para1 = '', $para2 = '', $para3 = '')
    {
		if (!$this->crud_model->admin_permission('users')) {
            redirect(base_url() . 'admin');
        }

		if ($para1 == 'delete') {
			$user_id = $this->input->post('id');
            $this->db->where('user_id',$user_id);
            
			$data['account_status'] = 'delete';
			$this->db->where('user_id', $user_id);
            $this->db->update('user',$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else if ($para1 == 'account_set') {
            $users = $para2;
			if ($para3 == 'true') {
                $data['account_status'] = 'Active';
            } else {
                $data['account_status'] = 'De-active';
            }
            $this->db->where('user_id', $users);
            $this->db->update('user', $data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				echo 'done';
			}else{
				echo 'not_done';
			}
        }
    }
	
	/* PNA AND BANK INFORMATION */
		public function uploaded_pan_info()
		{
			if ($this->session->userdata('admin_login') == 'yes') {
		
				if (!$this->crud_model->admin_permission('uploaded_pan_info')) {
					redirect(base_url() . 'admin');
				}
				
				$data['name'] = @$_GET['n_n'];
				$data['user_name'] = @$_GET['u_n'];
				$data['mobile_number'] = @$_GET['m_n'];
				$data['status'] = @$_GET['s_s'];
				$name = $data['name'];
				$user_name = $data['user_name'];
				$mobile_number = $data['mobile_number'];
				$status = $data['status'];
				
				
				if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$status != ''){
					$searchurl='?n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&s_s='.$status;
				}else{
					$searchurl='';
				}
				$count_data = $this->users_model->get_total_users_pan_data_count($name,$user_name,$mobile_number,$status);
				
				$config = array();		
				$config['total_rows'] = count($count_data);
				$config['base_url'] = base_url() . "admin/users/uploaded_pan_info".$searchurl;
				$config['per_page'] = 30;
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
				
				$data['all_users'] = $this->users_model->get_total_users_pan_data($name,$user_name,$mobile_number,$status,$config["per_page"],$page);
				$data["links"] = $this->pagination->create_links();
				$data['msg'] = "";		
				$data['total_rows'] = $config["total_rows"];
				$data['page_id'] = $page;
				$data['page_name'] = "users/regular/users_pan";
				$data['page_name_link'] = "uploaded_pan_info";
				$this->load->view('back/admin/index', $data);
			} else {
				$data['control'] = "admin";
				$this->load->view('back/admin/login',$data);
			}
		}
		
		public function view_user_pan_info(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			$pan_verified_id = @$_GET['u_p_i'];
			$pan_verified_token = @$_GET['u_p_t'];
			if (!$this->crud_model->admin_permission('users_pan_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['status'] = @$_GET['s_s'];
			$data['page_id'] = @$_GET['page'];
			$data['users_pan_data'] = $this->users_model->get_users_pan_informations($user_id,$pan_verified_id,$pan_verified_token);
			$data['page_name'] = "users/regular/users_pan_view";
            $data['page_name_link'] = "uploaded_pan_info";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	
	public function uploaded_bank_info()
		{
			if ($this->session->userdata('admin_login') == 'yes') {
		
				if (!$this->crud_model->admin_permission('uploaded_bank_info')) {
					redirect(base_url() . 'admin');
				}
				
				$data['name'] = @$_GET['n_n'];
				$data['user_name'] = @$_GET['u_n'];
				$data['mobile_number'] = @$_GET['m_n'];
				$data['status'] = @$_GET['s_s'];
				$name = $data['name'];
				$user_name = $data['user_name'];
				$mobile_number = $data['mobile_number'];
				$status = $data['status'];
				
				
				if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$status != ''){
					$searchurl='?n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&s_s='.$status;
				}else{
					$searchurl='';
				}
				$count_data = $this->users_model->get_total_users_bank_data_count($name,$user_name,$mobile_number,$status);
				
				$config = array();		
				$config['total_rows'] = count($count_data);
				$config['base_url'] = base_url() . "admin/users/uploaded_bank_info".$searchurl;
				$config['per_page'] = 30;
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
				
				$data['all_users'] = $this->users_model->get_total_users_bank_data($name,$user_name,$mobile_number,$status,$config["per_page"],$page);
				$data["links"] = $this->pagination->create_links();
				$data['msg'] = "";		
				$data['total_rows'] = $config["total_rows"];
				$data['page_id'] = $page;
				$data['page_name'] = "users/regular/users_bank";
				$data['page_name_link'] = "uploaded_bank_info";
				$this->load->view('back/admin/index', $data);
			} else {
				$data['control'] = "admin";
				$this->load->view('back/admin/login',$data);
			}
		}
		
		public function view_user_bank_info(){
		if ($this->session->userdata('admin_login') == 'yes') {
			$user_id = @$_GET['u_i'];
			$user_token = @$_GET['u_t'];
			$bank_verified_id = @$_GET['u_b_i'];
			$bank_verified_token = @$_GET['u_b_t'];
			if (!$this->crud_model->admin_permission('users_bank_view')) {
				redirect(base_url() . 'admin');
			}
			
			$data['name'] = @$_GET['n_n'];
			$data['user_name'] = @$_GET['u_n'];
			$data['mobile_number'] = @$_GET['m_n'];
			$data['status'] = @$_GET['s_s'];
			$data['page_id'] = @$_GET['page'];
			$data['users_bank_data'] = $this->users_model->get_users_bank_informations($user_id,$bank_verified_id,$bank_verified_token);
			$data['page_name'] = "users/regular/users_bank_view";
            $data['page_name_link'] = "uploaded_bank_info";
            $this->load->view('back/admin/index', $data);
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$data);
        }
	}
	/* PNA AND BANK INFORMATION */
	/* TRANSCTION INFORMATION */
		public function regular_transaction_list(){
			if ($this->session->userdata('admin_login') == 'yes') {
				$user_id = @$_GET['u_i'];
				$user_token = @$_GET['u_t'];
				
				if (!$this->crud_model->admin_permission('insurance_details')) {
					redirect(base_url() . 'admin');
				}
				
				$user_id = @$_GET['u_i'];
				$user_token = @$_GET['u_t'];
				
				$data['user_id'] = @$user_id;
				$data['user_token'] = @$user_token;
				$data['name'] = @$_GET['n_n'];
				$data['user_name'] = @$_GET['u_n'];
				$data['mobile_number'] = @$_GET['m_n'];
				$data['refrence_code'] = @$_GET['r_c'];
				$data['account_status'] = @$_GET['a_s'];
				$data['txt_type'] = @$_GET['t_y'];
				$data['txt_date'] = @$_GET['t_d'];
				$data['txt_status'] = @$_GET['t_s'];
				$data['pages'] = @$_GET['pages'];
				$name = $data['name'];
				$user_name = $data['user_name'];
				$mobile_number = $data['mobile_number'];
				$refrence_code = $data['refrence_code'];
				$account_status = $data['account_status'];
				$txt_type = $data['txt_type'];
				$txt_date = $data['txt_date'];
				$txt_status = $data['txt_status'];
				$pages = $data['pages'];
				
				if(@$txt_type != '' || @$txt_date != '' || @$txt_status != ''){
					if(@$pages != ''){
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status.'&pages='.$pages.'&t_y='.$txt_type.'&t_d='.$txt_date.'&t_s='.$txt_status;
					}else{
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status.'&t_y='.$txt_type.'&t_d='.$txt_date.'&t_s='.$txt_status;
					}
				}else{
					if(@$pages != ''){
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status.'&pages='.$pages;
					}else{
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status;
					}
				}
				$count_data = $this->users_model->get_total_users_transaction_data_count($user_id,$user_token,$txt_type,$txt_date,$txt_status);
				
				$config = array();		
				$config['total_rows'] = count($count_data);
				$config['base_url'] = base_url() . "admin/users/regular_transaction_list".$searchurl;
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
				
				$data['txt_data'] = $this->users_model->get_total_users_transaction_data($user_id,$user_token,$txt_type,$txt_date,$txt_status,$config["per_page"],$page);
				$data["links"] = $this->pagination->create_links();
				$data['msg'] = "";		
				$data['total_rows'] = $config["total_rows"];
				$data['page_id'] = $page;
				$data['page_name'] = "users/regular/users_transaction";
				$data['page_name_link'] = "regular_users";
				$this->load->view('back/admin/index', $data);
			} else {
				$data['control'] = "admin";
				$this->load->view('back/admin/login',$data);
			}
		}
	/* TRANSCTION INFORMATION */
	/* SPIN TRANSCTION INFORMATION */
		public function regular_spin_transaction_list(){
			if ($this->session->userdata('admin_login') == 'yes') {
				$user_id = @$_GET['u_i'];
				$user_token = @$_GET['u_t'];
				
				if (!$this->crud_model->admin_permission('insurance_details')) {
					redirect(base_url() . 'admin');
				}
				
				$user_id = @$_GET['u_i'];
				$user_token = @$_GET['u_t'];
				
				$data['user_id'] = @$user_id;
				$data['user_token'] = @$user_token;
				$data['name'] = @$_GET['n_n'];
				$data['user_name'] = @$_GET['u_n'];
				$data['mobile_number'] = @$_GET['m_n'];
				$data['refrence_code'] = @$_GET['r_c'];
				$data['account_status'] = @$_GET['a_s'];
				$data['txt_date'] = @$_GET['t_d'];
				$data['pages'] = @$_GET['pages'];
				$name = $data['name'];
				$user_name = $data['user_name'];
				$mobile_number = $data['mobile_number'];
				$refrence_code = $data['refrence_code'];
				$account_status = $data['account_status'];
				$txt_date = $data['txt_date'];
				$pages = $data['pages'];
				
				if(@$txt_date != ''){
					if(@$pages != ''){
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status.'&pages='.$pages.'&t_d='.$txt_date;
					}else{
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status.'&t_d='.$txt_date;
					}
				}else{
					if(@$pages != ''){
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status.'&pages='.$pages;
					}else{
						$searchurl='?u_t='.$user_token.'&u_i='.$user_id.'&n_n='.$name.'&u_n='.$user_name.'&m_n='.$mobile_number.'&r_c='.$refrence_code.'&a_s='.$account_status;
					}
				}
				$count_data = $this->users_model->get_total_users_spin_transaction_data_count($user_id,$user_token,$txt_date);
				
				$config = array();		
				$config['total_rows'] = count($count_data);
				$config['base_url'] = base_url() . "admin/users/regular_transaction_list".$searchurl;
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
				
				$data['txt_data'] = $this->users_model->get_total_users_spin_transaction_data($user_id,$user_token,$txt_date,$config["per_page"],$page);
				$data["links"] = $this->pagination->create_links();
				$data['msg'] = "";		
				$data['total_rows'] = $config["total_rows"];
				$data['page_id'] = $page;
				$data['page_name'] = "users/regular/users_spin_transaction";
				$data['page_name_link'] = "regular_users";
				$this->load->view('back/admin/index', $data);
			} else {
				$data['control'] = "admin";
				$this->load->view('back/admin/login',$data);
			}
		}
	/* SPIN TRANSCTION INFORMATION */
	
	function get_add_cash_form(){
		$user_id = $this->input->post('user_id');
		$user_token = $this->input->post('user_token');
		$get_user_details = @$this->db->get_where('user',array('user_id'=>$user_id,'user_token'=>$user_token))->result_array();
			
		if(!empty($get_user_details)){
			$html = "<div class='modal-header'>
						<h5 class='modal-title'>Add Cash Transaction</h5>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'>&times;</span>
						</button>
					</div>
					<div class='modal-body' >
					";
			$html .= "<div class='bid_i_details_box'>";
					echo form_open(base_url() . 'admin/users/add_cash_transction/'.$user_id.'/'.$user_token, array(
						'class' => 'form-horizontal',
						'method' => 'post',
						'id' => 'add_cash',
						'enctype' => 'multipart/form-data'
					));
			$html .= "<div class='col-sm-12 paddingzeroall'>
						<div class='form-group'>
							<label>Amount<span class='requiredclass'>*</span></label>
							<input class='form-control number required' type='number' name='amount' id='amount' placeholder='Enter Amount'>
						</div>
					</div>
					<div class='col-sm-12 paddingzeroall'>
						<div class='form-group'>
							<label>Transaction ID <span class='requiredclass'>*</span></label>
							<input class='form-control required' type='text' name='txt_order_id' id='txt_order_id' placeholder='Enter Transaction ID'>
						</div>
					</div>
					<div class='col-sm-12 paddingzeroall'>
						<div class='form-group'>
							<label>Transaction Method <span class='requiredclass'>*</span></label>
							<input class='form-control required' type='text' name='txt_method' id='txt_method' placeholder='Enter Transaction Method'>
						</div>
					</div>
					<div class='col-sm-12 paddingzeroall'>
						<div class='form-group'>
							<div class='col-sm-12 paddingzeroall'>
								<label>Date & Time<span class='requiredclass'>*</span></label>
							</div>
							<div class='col-sm-6 paddinglzero'>
								<input class='form-control required' type='date' name='date' id='date' placeholder='Enter Date'>
							</div>
							<div class='col-sm-6 paddingrzero'>
								<input class='form-control required' type='time' name='time' id='time' placeholder='Enter Time'>
							</div>
						</div>
					</div>
					";
			$html .= "</div>";
			$html .= "</div><div class='modal-footer'>
						<span class='btn btn-primary enterer' onclick=add_cash_ajax_form_submit('add_cash','add_cash_transction_successfully_submited');>Submit</span>
						<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					</div></form>";
		}else{
			$html = "";
		}
		echo $html;
	}
	
	public function add_cash_transction($para1 = '', $para2 = '', $para3 = ''){
		$length1= 50;
		$characters1 = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength1 = strlen($characters1);
		$randomString1 = '';
		for ($ii = 0; $ii < $length1; $ii++) {
			$randomString1 .= $characters1[rand(0, $charactersLength1 - 1)];
		}
		$token = $randomString1;
		
		$user_id = $para1;
		$amount = $this->input->post('amount');
		$txt_order_id = $this->input->post('txt_order_id');
		$txt_method = $this->input->post('txt_method');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		
		if($date != ''){
			$d = DateTime::createFromFormat(
				"Y-m-d H:i:s",
				"$date 	$time:00",
				new DateTimeZone('Asia/Kolkata')
			);

			if ($d === false) {
				$timestamp = '';
			} else {
				$timestamp = $d->getTimestamp();
			}
			$date_use = $timestamp; 
		}else{
			$date_use =  '';
		}
		
		$check_account = @$this->db->get_where('user',array('user_id'=>$para1,'user_token'=>$para2))->result_array();
		if(!empty($check_account)){
			$data['txt_token'] = $token;
			$data['txt_amount'] = setnumberformet($amount);
			$data['txt_status'] = 'success';
			$data['txt_user_id'] = $para1;
			$data['txt_user_type'] = 'user';
			$data['txt_date'] = $date_use;
			$data['txt_method'] = $txt_method;
			$data['txt_type'] = 'add';
			$data['txt_use_type'] = 'recent';
			$data['txt_order_id'] = $txt_order_id;
			$data['txt_contents'] = 'Deposited Cash';
			$data['created_date'] = time();
			$data['original_date'] = $date;
			$this->db->insert('transaction',$data);
			$id = $this->db->insert_id();
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE) {
				$old_add_amount = $check_account[0]['added_cash_amount'];
				$added_total_cash_amount = $check_account[0]['added_total_cash_amount'];
				$dataps['added_cash_amount'] = setnumberformet($old_add_amount + $amount);
				$dataps['added_total_cash_amount'] = setnumberformet($added_total_cash_amount + $amount);
				$this->db->where('user_id',$user_id);
				$this->db->update('user',$dataps);
				echo 'done';
			}else{
				echo 'not_done';
			}
		}else{
			echo 'account_not';
		}
	}
}