<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('user_uploaded_pan_information');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>mind1992gameadmin/users/uploaded_pan_info" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Name</label>
										<input type="text" name="n_n" value="<?php echo @$name; ?>" placeholder="Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>User Name</label>
										<input type="text" name="u_n" value="<?php echo @$user_name; ?>" placeholder="User Name">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Mobile Number</label>
										<input type="text" name="m_n" value="<?php echo @$mobile_number; ?>" placeholder="Mobile Number">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Status</label>
										<select id="status" name="s_s" class="demo-chosen-select">
											<option value="">Select Status</option>
											<option value="saved">New</option>
											<option value="reject">Reject</option>
										</select>
									</div>
									<div class="col-sm-2 col-xs-12 paddingonlyfive m-b-5px">
										<button class="reportbutton">Filter</button>
										<?php if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$status != ''){?>
										<a class="reportbutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users">Filter Clear</a>
										<?php } ?>
									</div>
								</form>
							</div>
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th><?php echo translate('Sr.no');?></th>
												<th><?php echo translate('name');?></th>
												<th><?php echo translate('mobile_&_email');?></th>
												<th><?php echo translate('status');?></th>
												<th><?php echo translate('date');?></th>
												<?php if($this->crud_model->admin_permission('users_pan_view')){?>
													<th style="min-width:150px" class="text-right"><?php echo translate('options');?></th>
												<?php } ?>
											</tr>
										</thead>				
										<tbody >
										<?php
										if(!empty($all_users)){
											$i = @$page_id + 0;
											foreach($all_users as $row){
												$i++;
										?>     
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo '+'.$row['country_code'].' '.$row['mobile_number']; ?><hr/><br/><?php echo $row['email']; ?></td>
											<td><?php if($row['verification_status'] == 'no'){ echo 'Not Uploaded'; }else if($row['verification_status'] == 'yes'){ echo 'Verified'; }else if($row['verification_status'] == 'saved'){ echo 'Uploaded'; }else if($row['verification_status'] == 'reject'){ echo 'Reject'; }?></td>
											<td><?php echo @get_orignal_datetime($row['pan_created_date']); ?></td>
											<?php if($this->crud_model->admin_permission('users_pan_view')){ ?>
												<td class="text-center">
													<?php if($this->crud_model->admin_permission('users_view')){ 
														if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){ ?>
															<a href="<?php echo base_url(); ?>mind1992gameadmin/users/view_user_pan_info?u_t=<?php echo $row['user_token']; ?>&u_i=<?php echo $row['user_id']; ?>&u_p_t=<?php echo $row['pan_verified_token']; ?>&u_p_i=<?php echo $row['pan_verified_id']; ?>&n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&s_s=<?php echo @$status; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-kesari btn-labeled margintb5px" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('view_&_verify');?>
															</a>
														<?php }else{ ?>
															<a href="<?php echo base_url(); ?>mind1992gameadmin/users/view_user_pan_info?u_t=<?php echo $row['user_token']; ?>&u_i=<?php echo $row['user_id']; ?>&u_p_t=<?php echo $row['pan_verified_token']; ?>&u_p_i=<?php echo $row['pan_verified_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-kesari btn-labeled margintb5px" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('view_&_verify');?>
															</a>
														<?php }
													} ?>
												</td>
											<?php } ?>
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
							</div>
						</div>
						<?php echo $links; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="users" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'mind1992gameadmin';
	var module = 'users/userss';
	var delete_function = 'delete';
</script>
<script>
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function other(){
	    set_select();
    }
	var selected_status = '<?php echo @$status; ?>';
	$(document).ready(function() {
        set_select();
		if(selected_status != ''){
			$("#status").val(selected_status).trigger("chosen:updated");
		}
	});
</script>