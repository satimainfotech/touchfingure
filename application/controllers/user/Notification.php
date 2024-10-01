<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Notification extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
	}
    
    /* Dashboard */
    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
			if (!$this->crud_model->admin_permission('notification')) {
				redirect(base_url() . 'admin');
			}
			$page_data['page_name_link']   = "notification";
            $page_data['page_name']   = "notifications/notifications";
            $page_data['all_notification'] = $this->db->get('notification')->result_array();
            $this->load->view('back/admin/index', $page_data);
			$export_type = $this->input->post('export_type');
			if($export_type == 'pdf'){
				$new_pdf = $this->notification_pdf();
			}
			if($export_type == 'excel'){
				$new_pdf = $this->excel_export();
			}
        } else {
            $data['control'] = "admin";
            $this->load->view('back/admin/login',$page_data);
        }
    }
	
	function notifications($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('notification')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'view') {
			$data['read'] = 'ok';
            $this->db->where('notification_id', $para2);
            $this->db->update('notification', $data);
            $page_data['notification_data'] = $this->db->get_where('notification', array('notification_id' => $para2,'notification_user_id'=>'1','notitfication_user_type'=>'admin'))->result_array();
            $this->load->view('back/admin/notifications/notifications_view', $page_data);
        } elseif ($para1 == 'delete') {
            $this->db->where('notification_id', $para2);
            $this->db->delete('notification');
		} elseif ($para1 == 'list') {
            $this->db->order_by('notification_id', 'desc');
			$page_data['all_notification'] = $this->db->get_where('notification', array('notification_user_id'=>'1','notitfication_user_type'=>'admin'))->result_array();
            $this->load->view('back/admin/notifications/notifications_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('display_message',$search,'after');
				$this->db->or_like('message',$search,'both');
            }
			$total = $this->db->get('notification')->num_rows();
            $this->db->limit($limit);
            $this->db->where('notification_user_id','1');
            $this->db->where('notitfication_user_type','admin');
			if($sort == ''){
				$sort = 'notification_id';
				$order = 'DESC';
			}
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('display_message',$search,'after');
				$this->db->or_like('message',$search,'both');
            }
			$notifications   = $this->db->get('notification', $limit, $offset)->result_array();
            $data       = array();
			$i = 1;
            foreach ($notifications as $row) {
				
                $res = array(
						 'no' => '',
						 'message' => '',
						 'date' => '',
						 'options' => ''
					  );

                $res['no']  = $i;
                $res['message']  = $row['display_message'];
				$newdate = explode("-",$row['careated_date']);
				$newdatey = $newdate[0];
				$newdatem = $newdate[1];
				$newdated = $newdate[2];
				$new_date =  $newdatey.'-'.$newdatem.'-'.$newdated;
				$date = date_create($new_date);
				$order_date = $date->format('d').'<sup>'.$date->format('S').'</sup>'.$date->format('M').' '.$date->format('Y');
				
				$res['date']  = $order_date;
				$res['from']  = $row['notification_from_name'].' ( '.$row['notification_type']. ')';
				
				if($this->crud_model->admin_permission('notification')){
					$p_view = "<span class='viewbutton' onclick=\"ajax_set_full('view','".translate('view_notification')."','".translate('successfully_viewed!')."','notification_view','".$row['notification_id']."');proceed('to_view');\"><i class='fa fa-eye'></i></span>";
					$p_delete = "<span class='deletebutton' onclick=\"delete_confirm('".$row['notification_id']."','".translate('really_want_to_delete_this?')."')\" ><i class='fa fa-trash'></i></span>";
					
					$res['options'] = "$p_delete $p_view";
				}
                $data[] = $res;
				$i++;
            }
            $result = array(
						 'total' => $total,
						 'rows' => $data
					   );

            echo json_encode($result);

        }
    }
}