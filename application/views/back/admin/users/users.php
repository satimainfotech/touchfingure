<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('users');?></h1>
		<?php if($this->crud_model->admin_permission('users_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin//users/regular_add"><?php echo translate('add_a_new_users');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin//users/regular_users" method="get">
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
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Refer Code</label>
										<input type="text" name="r_c" value="<?php echo @$refrence_code; ?>" placeholder="Refer Code">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Status</label>
										<select id="account_status" name="a_s" class="demo-chosen-select">
											<option value="">Select Status</option>
											<option value="active">Active</option>
											<option value="de_active">De-active</option>
											<option value="Not-verified">Not-verified</option>
										</select>
									</div>
									<div class="col-sm-2 col-xs-12 paddingonlyfive m-b-5px">
										<button class="reportbutton">Filter</button>
										<?php if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != '' || @$plan_type != ''){?>
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
												<th><?php echo translate('name_/_last_active');?></th>
												<th><?php echo translate('team_name');?></th>
												<th><?php echo translate('mobile_&_email');?></th>
												<th><?php echo translate('user_code');?></th>
												<th><?php echo translate('refer_code');?></th>
												<th><?php echo translate('account_status');?></th>
												<th style="min-width:150px"><?php echo translate('wallets');?></th>
												<?php if($this->crud_model->admin_permission('users_view') || $this->crud_model->admin_permission('users_status')|| $this->crud_model->admin_permission('users_delete')){?>
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
												
											<td class="<?php echo $new_class; ?>"><?php echo $i; ?></td>
											<td><?php echo @$row['name']; ?><hr/><br/><?php if($row['last_activity_time'] != ''){ echo get_orignal_datetime($row['last_activity_time']); }?></td>
											<td><?php echo $row['team_name']; ?></td>
											<td><?php echo '+'.$row['country_code'].' '.$row['mobile_number']; ?><hr/><br/><?php echo $row['email']; ?></td>
											<td><?php echo $row['my_refer_code']; ?><hr/><br/><?php if($row['created_date'] != ''){ echo get_orignal_datetime($row['created_date']); }?></td>
											<td><?php echo $row['register_with_refer_code']; ?></td>
											<td>
											<?php 
												if($row['account_status'] == 'Active'){
													echo '<input id="accounts_'.$row['user_id'].'" class="sw2" type="checkbox" data-id="'.$row['user_id'].'" checked />';
												} else {
													echo '<input id="accounts_'.$row['user_id'].'" class="sw2" type="checkbox" data-id="'.$row['user_id'].'" />';
												}
												?>
											</td>
											<?php if($this->crud_model->admin_permission('users_view') || $this->crud_model->admin_permission('users_delete') || $this->crud_model->admin_permission('users_edit')){ ?>
												<td class="text-center">
													<?php if($this->crud_model->admin_permission('users_view')){ 
														if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){ ?>
															<a href="<?php echo base_url(); ?>admin//users/view?u_t=<?php echo $row['user_token']; ?>&u_i=<?php echo $row['user_id']; ?>&n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-kesari btn-labeled margintb5px" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('view');?>
															</a>
														<?php }else{ ?>
															<a href="<?php echo base_url(); ?>admin//users/view?u_t=<?php echo $row['user_token']; ?>&u_i=<?php echo $row['user_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-kesari btn-labeled margintb5px" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('view');?>
															</a>
														<?php }
													} ?>
													<?php if($this->crud_model->admin_permission('users_edit')){ 
														if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){?>
															<a href="<?php echo base_url(); ?>admin//users/edit?u_t=<?php echo $row['user_token']; ?>&u_i=<?php echo $row['user_id']; ?>&n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled margintb5px" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('edit');?>
															</a>
														<?php }else{ ?>
															<a href="<?php echo base_url(); ?>admin//users/edit?u_t=<?php echo $row['user_token']; ?>&u_i=<?php echo $row['user_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled margintb5px" data-toggle="tooltip" 
															data-original-title="proof" data-container="body"><?php echo translate('edit');?>
															</a>
														<?php } ?> 
													<?php } ?>
													<?php if($this->crud_model->admin_permission('users_delete')){ ?> 
														<a onclick="delete_popup('<?php echo $row['user_id']; ?>','<?php echo translate('really_want_to_delete_this_users ?'); ?>')" class="btn btn-xs btn-danger btn-labeled margintb5px" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?>
														</a>
													<?php } ?>
													
													
													
													
												
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
<div class="modal" id="popupmodel" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="popupdata">
			
		</div>
	</div>
</div>
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
	var selected_account_status = '<?php echo @$account_status; ?>';
	$(document).ready(function() {
        set_select();
		if(selected_account_status != ''){
			$("#account_status").val(selected_account_status).trigger("chosen:updated");
		}
	});
	$( document ).ready(function() {
		$(".sw2").each(function(){
			new Switchery(document.getElementById('accounts_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
			var changeCheckbox = document.querySelector('#accounts_'+$(this).data('id'));
			changeCheckbox.onchange = function() {
			ajax_load(base_url+''+user_type+'/'+module+'/account_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
			if(changeCheckbox.checked == true){
				var trans_msg = 'User successfully avtivated';
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
			} else {
				var trans_msg = 'User successfully De-avtivated';
				$.activeitNoty({
					type : 'danger',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
				
			  }
			};
		});
	});
	function add_cash_transaction(user_id,user_token){
		var base_url = $('#base_url').val();
		$.ajax({
			url : base_url+'users/get_add_cash_form',
			type: 'POST',
			dataType: 'html',
			data: {user_id:user_id,user_token:user_token},
			success: function(data){
				$('#popupdata').html(data);
				$('#popupmodel').modal('show');
			}
		});
	}
</script>