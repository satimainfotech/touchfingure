<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_our_range_details');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/our_range<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
					<?php 
					foreach($our_range_data as $row)
					{ 
					?>
						<div class="row">
						<div class="col-md-12">
							<div class="text-center pad-all">
								<div class="col-md-5">
									<div class="col-md-12">
										<h3>Main Image</h3>
										<?php if($row['our_range_main_image'] == ''){ ?>
									        <img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/default.jpg">
										<?php }else{ ?>
										    <img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_main_image']; ?>">
										<?php } ?>
									</div>
									
								</div>
								<div class="col-md-7">
									<div class="our_rangedetaildiv">
										<h3>Product Detail</h3>
										<table class="table table-striped" style="border-radius:3px;">
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td"><?php echo $row['our_range_name']?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('brand');?></td>
												<td class="custom_td">
													<?php  if($row['our_range_brand'] != '' && $row['our_range_brand'] != '0'){ echo get_field_id_name('brand','brand_id','brand_name',$row['our_range_brand']); }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('content');?></td>
												<td class="custom_td"><?php echo $row['our_range_content']?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('image_1');?></td>
												<td class="custom_td"><?php if($row['our_range_image_1'] == ''){ ?>
													<img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/default.jpg">
												<?php }else{ ?>
													<img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_image_1']; ?>">
												<?php } ?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('image_2');?></td>
												<td class="custom_td"><?php if($row['our_range_image_2'] == ''){ ?>
													<img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/default.jpg">
												<?php }else{ ?>
													<img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_image_2']; ?>">
												<?php } ?></td>

											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('image_3');?></td>
												<td class="custom_td"><?php if($row['our_range_image_3'] == ''){ ?>
													<img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/default.jpg">
												<?php }else{ ?>
													<img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/our_range_image/<?php echo $row['our_range_image_3']; ?>">
												<?php } ?></td>
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
.our_rangedetaildiv table td.custom_td_title{
	border-bottom: 1px solid #ddd !important;
	background-color: #eee !important;
	position: inherit !important;
}
</style>    