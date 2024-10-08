<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('users_refer_list');?></h1>
		<?php
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users?n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('Sr.no');?></th>
										<th><?php echo translate('name');?></th>
										<th><?php echo translate('mobile_number');?></th>
										<th><?php echo translate('email');?></th>
										<th><?php echo translate('refer_code');?></th>
										<th><?php echo translate('success_addded_amount');?></th>
										<th><?php echo translate('failed_addded_amount');?></th>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($insurance_data)){
									$i = @$page_id + 0;
									foreach($insurance_data as $row){
										$i++;
								?>                
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo '+'.$row['country_code'].' '.$row['mobile_number']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['my_refer_code']; ?></td>
									<td><?php $get_added_amount = $this->users_model->get_refer_user_added_amount($row['user_id']); 
									if($get_added_amount[0]['total_amount'] != ''){ echo 'Rs. '.setnumberformet($get_added_amount[0]['total_amount']);}else{ echo 'Rs. 0.00';}
									?></td>
									<td><?php $get_f_added_amount = $this->users_model->get_refer_user_f_added_amount($row['user_id']); 
									if($get_f_added_amount[0]['total_amount'] != ''){ echo 'Rs. '.setnumberformet($get_f_added_amount[0]['total_amount']);}else{ echo 'Rs. 0.00';}
									?></td>
								</tr>
								<?php
									}
								}else{ ?>
									<tr style="text-align:center;">
										<td colspan="9">Data Not Found....</td>
									</tr>	
								<?php } ?>
								</tbody>
							</table>
						</div>
						<?php echo $links; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>