<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_users_information');?></h1>
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
								foreach($users_data as $row){
								$get_payment_details = @$this->db->get_where('user_payment',array('user_payment_id'=>$row['payment_id']))->result_array();
							?>
								<div id="content-container paddingtbzero">
									<div class="text-left pad-all mar_top_hr">
										<h4 class="text-lg text-overflow mar-no text-weight"><?php echo $row['name']?></h4>
									</div>
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
													<tr>
														<th class="custom_td"><?php echo translate('created_date');?></th>
														<td class="custom_td"><?php echo get_orignal_datetime($row['created_date']);?></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="col-sm-6">
											<h4>Plan & Payment Details</h4>
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td"><?php echo translate('plan_type');?></th>
														<td class="custom_td"><?php if($row['ranchise_plan_name'] != ''){ echo translate($row['ranchise_plan_name']); }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('start_date');?></th>
														<td class="custom_td"><?php if($row['franchise_plan_start_date'] != ''){ echo get_orignal_datetime($row['franchise_plan_start_date']); }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('plan_end_date');?></th>
														<td class="custom_td"><?php if($row['franchise_plan_end_date'] != ''){ echo get_orignal_datetime($row['franchise_plan_end_date']); }else{ echo '- - - - - -'; }?></td>
													</tr>
													<tr>
														<th class="custom_td"><?php echo translate('last_payment_ID');?></th>
														<td class="custom_td"><?php if($row['franchise_plan_payment_id'] != ''){ echo $row['franchise_plan_payment_id']; }else{ echo '- - - - - -'; }?></td>
													</tr>
													<?php if(!empty($get_payment_details)){ ?>
														<tr>
															<th class="custom_td"><?php echo translate('transction_id');?></th>
															<td class="custom_td"><?php echo $get_payment_details[0]['transaction_id'];?></td>
														</tr>
														<tr>
															<th class="custom_td"><?php echo translate('payment_method');?></th>
															<td class="custom_td"><?php echo $get_payment_details[0]['payment_method'];?></td>
														</tr>
														<tr>
															<th class="custom_td"><?php echo translate('status');?></th>
															<td class="custom_td"><?php echo $get_payment_details[0]['status'];?></td>
														</tr>
														<tr>
															<th class="custom_td"><?php echo translate('plan_purchase_date');?></th>
															<td class="custom_td"><?php echo $get_payment_details[0]['plan_purchase_date'];?></td>
														</tr>
													<?php }else{ ?>
														<tr>
															<th class="custom_td"><?php echo translate('transction_id');?></th>
															<td class="custom_td">- - - - - -</td>
														</tr>
														<tr>
															<th class="custom_td"><?php echo translate('payment_method');?></th>
															<td class="custom_td">- - - - - -</td>
														</tr>
														<tr>
															<th class="custom_td"><?php echo translate('status');?></th>
															<td class="custom_td">- - - - - -</td>
														</tr>
														<tr>
															<th class="custom_td"><?php echo translate('plan_purchase_date');?></th>
															<td class="custom_td">- - - - - -</td>
														</tr>
													<?php } ?>
												</table>
											</div>
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