<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_about_information');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/about<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($about_data as $row){
							?>
								<div id="content-container paddingtbzero">
									<div class="text-left pad-all mar_top_hr">
										<h4 class="text-lg text-overflow mar-no text-weight"><?php echo $row['about_title']?></h4>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="panel-body">
												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>
														<th class="custom_td"><?php echo translate('about_image');?></th>
														<td class="custom_td">
														<?php
														if($row['about_image'] != ''){
															if(file_exists('uploads/about_image/'.$row['about_image'])){
														?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/about_image/<?php echo $row['about_image']; ?>" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100%; height:auto; border-radius:4px;" src="<?php echo base_url();?>uploads/about_image/<?php echo $row['about_image']; ?>"></img></a>
														<?php
															} else {
														?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/about_image/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100%; height:auto; border-radius:4px;" src="<?php echo base_url();?>uploads/about_image/default.jpg"></img></a>
														<?php
															}
														}else{ ?>
															<div style="display: none;" id="hidden-content3">
															<img src="<?php echo base_url();?>uploads/about_image/default.jpg" />
															</div>
															<a data-fancybox data-src="#hidden-content3" href="javascript:;"><img class="btn popup_image" style="width:100%; height:auto; border-radius:4px;" src="<?php echo base_url();?>uploads/about_image/default.jpg"></img></a>
														<?php }
														?> 
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