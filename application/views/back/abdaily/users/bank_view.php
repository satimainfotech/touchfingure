<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_users_bank_information');?></h1>
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
						<div class="viewpages panel-body">
							<?php
								if(!empty($bank_datas)){
								foreach($bank_datas as $row){
							?>
								<div id="content-container paddingtbzero">
									<div class="row">
										<div class="col-sm-6">
											<h4>Bank Details</h4>
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td"><?php echo translate('status');?></th>
														<td class="custom_td"><div class="label label-<?php if($row['verification_status'] == 'no'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php if($row['verification_status'] == 'no'){ echo 'Not Uploaded'; }else if($row['verification_status'] == 'yes'){ echo 'Verified'; }else if($row['verification_status'] == 'saved'){ echo 'Uploaded'; }else if($row['verification_status'] == 'reject'){ echo 'Reject'; }?></div></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('account_number');?></th>
														<td class="custom_td"><?php echo $row['bank_account_number'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('account_holder_name');?></th>
														<td class="custom_td"><?php echo $row['bank_account_holder_name'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('IFSC_code');?></th>
														<td class="custom_td"><?php echo $row['bank_ifsc_code'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('branch_name');?></th>
														<td class="custom_td"><?php echo $row['bank_branch_name'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('bank_name');?></th>
														<td class="custom_td"><?php echo $row['bank_name'];?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('bank_image');?></th>
														<td class="custom_td">
														<?php
														if($row['bank_image'] != ''){
															if(file_exists('uploads/bank_image/'.$row['bank_image'])){
														?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/bank_image/<?php echo $row['bank_image']; ?>" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/bank_image/<?php echo $row['bank_image']; ?>"></img></a>
														<?php
															} else {
														?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/bank_image/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/bank_image/default.jpg"></img></a>
														<?php
															}
														}else{ ?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/bank_image/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100px; height:100px; border-radius:4px;" src="<?php echo base_url();?>uploads/bank_image/default.jpg"></img></a>
														<?php } ?> 
														</td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('created_date');?></th>
														<td class="custom_td"><?php echo get_orignal_datetime($row['created_date']);?></td>
													</tr>
												</table>
											</div>
											<?php if($row['verification_status'] == 'saved'){  
											if($this->crud_model->admin_permission('update_point_and_team_points')){ ?>
												<a class="btn btn-purple btn-xs btn-labeled fa fa-check margintb5px" data-toggle="tooltip" id="verify_now" onclick="verify_now('<?php echo $row['bank_verified_id']; ?>','<?php echo $row['bank_verified_user_id']; ?>','verify');"><?php echo translate('verify'); ?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('update_point_and_team_points')){ ?>
												<a class="btn btn-danger btn-xs btn-labeled fa fa-remove margintb5px" data-toggle="tooltip" id="reject_now" onclick="reject_now('<?php echo $row['bank_verified_id']; ?>','<?php echo $row['bank_verified_user_id']; ?>','reject');"><?php echo translate('reject'); ?></a>
											<?php } } ?>
										</div>
										<div class="col-sm-6">
											
										</div>
									</div>					
								</div>
							<?php }
							}else{ ?>
								<div id="content-container paddingtbzero">
									<div class="row">
										<div class="col-sm-6">
											<h4>Pan Details</h4>
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td"><?php echo translate('status');?></th>
														<td class="custom_td"><div class="label label-danger">Not Uploaded</div></td>
													</tr>
												</table>
											</div>
										</div>
									</div>					
								</div>
							<?php }
							 ?>
						</div>
					</div>
                </div>
            </div>
        </div>
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
	$.ajax({
		url : base_url+'users/bank_verification',
		type: 'POST',
		dataType: 'html',
		data: {bank_id:bank_id,user_id:user_id,type:type},
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