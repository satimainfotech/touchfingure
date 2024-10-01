<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_contact_enquire_details');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$contact_name != '' || @$from_date != '' || @$to_date != '' || @$our_range != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/contact_enquire?p_n=<?php echo @$phone; ?>&f_d=<?php echo $from_date; ?>&t_d=<?php echo $to_date; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/contact_enquire<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
					<?php 
					foreach($contact_enquire_data as $row)
					{ 
					?>
						<div class="row">
						<div class="col-md-12">
							<div class="text-center pad-all">
								<div class="col-md-6">
									<div class="productdetaildiv">
										<table class="table table-striped" style="border-radius:3px;">
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td"><?php echo $row['contact_enquire_name']?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('email');?></td>
												<td class="custom_td">
													<?php  if($row['contact_enquire_email'] != ''){ echo $row['contact_enquire_email']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('phone');?></td>
												<td class="custom_td">
													<?php  if($row['contact_enquire_phone'] != ''){ echo $row['contact_enquire_phone']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('city');?></td>
												<td class="custom_td">
													<?php  if($row['contact_enquire_city'] != ''){ echo $row['contact_enquire_city']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('message');?></td>
												<td class="custom_td">
													<?php  if($row['contact_enquire_message'] != ''){ echo $row['contact_enquire_message']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<hr>
							</div>
						</div>
					</div>		
					<?php 
						}
					?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>     
<style>
.productdetaildiv table td.custom_td_title{
	border-bottom: 1px solid #ddd !important;
	background-color: #eee !important;
	position: inherit !important;
}
</style>    