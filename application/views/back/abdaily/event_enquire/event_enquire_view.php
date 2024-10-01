<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_event_enquire_details');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$from_date != '' || @$to_date != '' || @$our_range != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/event_enquire?c_i=<?php echo @$category; ?>&sc_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$product_name; ?>&f_d=<?php echo $from_date; ?>&t_d=<?php echo $to_date; ?>&or_i=<?php echo $our_range; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product_enquire<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
					<?php 
					foreach($event_enquire_data as $row)
					{ 
					?>
						<div class="row">
						<div class="col-md-12">
							<div class="text-center pad-all">
								<div class="col-md-6">
									<div class="productdetaildiv">
										<h3>Enquire Event Details</h3>
										<table class="table table-striped" style="border-radius:3px;">
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td"><?php echo $row['event_name']?></td>
											</tr>
										
											<tr>
												<td class="custom_td_title"><?php echo translate('city');?></td>
												<td class="custom_td">
													<?php  if($row['city_name'] != ''){ echo $row['city_name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td">
													<?php  if($row['name'] != ''){ echo $row['name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
												<tr>
												<td class="custom_td_title"><?php echo translate('email');?></td>
												<td class="custom_td">
													<?php  if($row['email'] != ''){ echo $row['email']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('mobile');?></td>
												<td class="custom_td">
													<?php  if($row['phone'] != ''){ echo $row['phone']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('message');?></td>
												<td class="custom_td">
													<?php  if($row['message'] != ''){ echo $row['message']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
										</table>
											<table class="table table-striped" style="border-radius:3px;">
												
											</table>
										
									</div>
								</div>
								
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
	min-width:200px;
}
</style>    