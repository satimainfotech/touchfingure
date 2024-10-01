<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_second_sliders_information');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/manage_website/second_sliders<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($second_sliders_data as $row){
							?>
								<div id="content-container paddingtbzero">
									<div class="row">
										<div class="col-sm-12">
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td min_width"><?php echo translate('image');?></th>
														<td class="custom_td showimgsss">
															<?php
																if(file_exists('uploads/second_slider_image/'.$row['second_slider_image'])){
															?>
																<img src="<?php echo base_url(); ?>uploads/second_slider_image/<?php echo $row['second_slider_image']; ?>" style="width:250px" id='proof_image_front_blah' />  
															<?php
																} else {
															?>
																<img src="<?php echo base_url(); ?>uploads/second_slider_image/default.png" width="100%" id='proof_image_front_blah' />
															<?php
																}
															?> 
														</td>
													</tr>
													<tr>
														<th class="custom_td min_width"><?php echo translate('status');?></th>
														<td class="custom_td"><div class="label label-<?php if($row['second_slider_status'] == 'yes'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php if($row['second_slider_status'] == 'yes'){echo 'Active';}else{echo 'De-active';} ?></div></td>
													</tr>
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
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>       
<style>
.min_width{
	min-width:150px;
}
.custom_td{
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
}
</style>