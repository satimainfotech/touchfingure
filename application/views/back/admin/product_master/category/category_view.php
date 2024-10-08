<div id="content-container">//
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_team_information');?></h1>
		<?php if(@$team != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/team?c_n=<?php echo @$team; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/team<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($team_data as $row){
							?>
								<div id="content-container paddingtbzero">
									<div class="row">
										<div class="col-sm-12">
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td min_width"><?php echo translate('name');?></th>
														<td class="custom_td"><?php echo $row['team_name'];?></td>
													</tr>
													<tr>
														<th class="custom_td min_width"><?php echo translate('status');?></th>
														<td class="custom_td"><div class="label label-<?php if($row['team_status'] == 'yes'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php if($row['team_status'] == 'yes'){echo 'Active';}else{echo 'De-active';} ?></div></td>
													</tr>
													
													<tr>
														<th class="custom_td min_width"><?php echo translate('image');?></th>
														<td class="custom_td">
															<div style="display: none;" id="hidden-content2">
															<?php
																if(file_exists('uploads/abdaily_team_image/'.$row['team_image'])){
															?>
																<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/<?php echo $row['team_image']; ?>" style="width:250px" id='team_image_front_blah' />
															<?php
																} else {
															?>
																<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/default.png" width="100%" id='team_image_front_blah' />
															<?php
																}
															?> 
															</div>
															<a data-fancybox data-src="#hidden-content2" href="javascript:;">
															<?php
																if(file_exists('uploads/abdaily_team_image/'.$row['team_image'])){
															?>
																<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/<?php echo $row['team_image']; ?>" style="width:250px" id='team_image_front_blah' />
															<?php
																} else {
															?>
																<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/default.png" width="100%" id='team_image_front_blah' />
															<?php
																}
															?> </a>
														</td>
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
.min_width{
	min-width:150px;
}
.custom_td{
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
}
</style>