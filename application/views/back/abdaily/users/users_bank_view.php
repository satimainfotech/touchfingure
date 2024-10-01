<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_users_bank_information');?></h1>
		<?php
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$status != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/uploaded_bank_info?n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&s_s=<?php echo @$refrence_code; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/uploaded_bank_info<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($users_bank_data as $row){
							?>
								<div id="content-container paddingtbzero">
									<div class="row">
										<div class="col-sm-6">
											<h4>User Details</h4>
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td"><?php echo translate('status');?></th>
														<td class="custom_td"><div class="label label-<?php if($row['account_status'] == 'active'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php echo $row['account_status']; ?></div></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('name');?></th>
														<td class="custom_td"><?php echo $row['name'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('user name');?></th>
														<td class="custom_td"><?php echo $row['team_name'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('mobile');?></th>
														<td class="custom_td"><?php echo '+'.$row['country_code'].' '.$row['mobile_number'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('email');?></th>
														<td class="custom_td"><?php echo $row['email'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('refer_code');?></th>
														<td class="custom_td"><?php echo $row['my_refer_code'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('referral_code');?></th>
														<td class="custom_td"><?php echo $row['register_with_refer_code'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('profile_image');?></th>
														<td class="custom_td">
														<?php
														if($row['profile_image'] != ''){
															if(file_exists('uploads/user/'.$row['profile_image'])){
														?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/user/<?php echo $row['profile_image']; ?>" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/user/<?php echo $row['profile_image']; ?>"></img></a>
														<?php
															} else {
														?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/user/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/user/default.jpg"></img></a>
														<?php
															}
														}else{ ?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/user/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/user/default.jpg"></img></a>
														<?php } ?> 
														</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="col-sm-6">
											<h4>Uploaded Pan Details</h4>
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td"><?php echo translate('status');?></th>
														<td class="custom_td"><div class="label label-<?php if($row['verification_status'] == 'yes'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php if($row['verification_status'] == 'yes'){ ?> Verified <?php } else if($row['verification_status'] == 'reject'){ ?>Reject<?php }else if($row['verification_status'] == 'saved'){ ?>Uploaded<?php }else if($row['verification_status'] == 'no'){ ?>Not Uploaded<?php } ?></div></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('account_number');?></th>
														<td class="custom_td"><?php if($row['bank_account_number'] != ''){ echo $row['bank_account_number']; }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('account_holder_name');?></th>
														<td class="custom_td"><?php if($row['bank_account_holder_name'] != ''){ echo $row['bank_account_holder_name']; }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('ifsc_code');?></th>
														<td class="custom_td"><?php if($row['bank_ifsc_code'] != ''){ echo $row['bank_ifsc_code']; }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('branch_name');?></th>
														<td class="custom_td"><?php if($row['bank_branch_name'] != ''){ echo $row['bank_branch_name']; }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('bank_name');?></th>
														<td class="custom_td"><?php if($row['bank_name'] != ''){ echo $row['bank_name']; }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('bank_image');?></th>
														<td class="custom_td">
														<?php
														if($row['bank_image'] != ''){
															if(file_exists('uploads/bank_image/'.$row['bank_image'])){
														?>
															<div style="display: none;" id="hidden-content2">
															<img src="<?php echo base_url();?>uploads/bank_image/<?php echo $row['bank_image']; ?>" />
															</div>
															<a data-fancybox data-src="#hidden-content2" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/bank_image/<?php echo $row['bank_image']; ?>"></img></a>
														<?php
															} else {
														?>
															<div style="display: none;" id="hidden-content2">
															<img src="<?php echo base_url();?>uploads/bank_image/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content2" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/bank_image/default.jpg"></img></a>
														<?php
															}
														}else{ ?>
															<div style="display: none;" id="hidden-content2">
															<img src="<?php echo base_url();?>uploads/bank_image/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content2" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/bank_image/default.jpg"></img></a>
														<?php } ?> 
														</td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('uploaded_date');?></th>
														<td class="custom_td"><?php if($row['bank_created_date'] != ''){ echo get_orignal_datetime($row['bank_created_date']); }else{ echo '- - - - - -'; }?></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="banstate">
											Banned States : Andhra Pradesh, Assam, Odisha, Telangana, Nagaland, and Sikkim
										</div>
										<div class="col-sm-12">
											<?php if($row['verification_status'] == 'saved'){ ?>
												<div class="form-group ">
													<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('Enter Reject Reason');?></label>
													<div class="col-sm-12 responsivezero">
														<textarea name="reject_reason" id="reject_reason" placeholder="<?php echo translate('Enter Reject Reason');?>" class="form-control"></textarea>
													</div>
												</div>
											<?php
											if($this->crud_model->admin_permission('update_point_and_team_points')){ ?>
												<a class="btn btn-purple btn-xs btn-labeled fa fa-check margintb5px" data-toggle="tooltip" id="verify_now" onclick="verify_now('<?php echo $row['bank_verified_id']; ?>','<?php echo $row['bank_verified_user_id']; ?>','verify');"><?php echo translate('verify'); ?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('update_point_and_team_points')){ ?>
												<a class="btn btn-danger btn-xs btn-labeled fa fa-remove margintb5px" data-toggle="tooltip" id="reject_now" onclick="reject_now('<?php echo $row['bank_verified_id']; ?>','<?php echo $row['bank_verified_user_id']; ?>','reject');"><?php echo translate('reject'); ?></a>
											<?php } } ?>
										</div>
									</div>					
								</div>
							<?php } ?>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="large_image_view" id="large_image_view" style="display:none">
	<span class="close_icons" onclick="close_large_image_box();"><i class="fa fa-remove"></i></span>
	<div class="show_main_image_box">
		<img src="" id="show_large_image">
	</div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function() {

  $(".popup_image").on('click', function() {
    w2popup.open({
      title: 'Image',
      body: '<div class="w2ui-centered"><img src="' + $(this).attr('src') + '"></img></div>'
    });
  });

});

function verify_now(bank_id,user_id,type){
	var base_url = $('#base_url').val();
	$.ajax({
		url : base_url+'users/bank_verification',
		type: 'POST',
		dataType: 'html',
		data: {bank_id:bank_id,user_id:user_id,type:type},
		beforeSend: function() {
			$('#verify_now').text('Verifying...');
			$('#reject_now').addClass('disabled');
		},
		success: function(data){
			if(data == 'done'){
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : 'Bank Information Successfully Verified',
					container : 'floating',
					timer : 4000
				});
				location.reload('true');
			}else{
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-remove',
					message : 'OOPS! Somthing went wrong....',
					container : 'floating',
					timer : 4000
				});
				location.reload('true');
			}
		}
	});
}
function reject_now(bank_id,user_id,type){
	var base_url = $('#base_url').val();
	var reject_reason = $('#reject_reason').val();
	if(reject_reason != ''){
		$.ajax({
			url : base_url+'users/bank_verification',
			type: 'POST',
			dataType: 'html',
			data: {bank_id:bank_id,user_id:user_id,type:type,reject_reason:reject_reason},
			beforeSend: function() {
				$('#reject_now').text('Verifying...');
				$('#verify_now').addClass('disabled');
			},
			success: function(data){
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Bank Information Successfully Reject',
						container : 'floating',
						timer : 4000
					});
					location.reload('true');
				}else{
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'OOPS! Somthing went wrong....',
						container : 'floating',
						timer : 4000
					});
					location.reload('true');
				}
			}
		});
	}else{
		alert('First enter a reject reson....');
		return false;
	}
	
}
</script>       
<style>
.custom_td{
	border: 1px solid #ddd !important;
	max-width:150px;
	min-width:150px;
	width:150px;
}
.table {
    width: auto !important;
    max-width: 100%;
    margin-bottom: 20px;
	min-width: 100% !important;
}
</style>