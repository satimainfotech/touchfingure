<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_user_details');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
					<?php 
					foreach($user_data as $row)
					{ 
					?>
						<div class="row">
						<div class="col-md-12">
							<div class="text-center pad-all">
								<div class="col-md-5">
									<div class="col-md-12">
										<h3>Main Product Image</h3>
										<?php if($row['main_product_image'] == ''){ ?>
									        <img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/product_image/default.jpg">
										<?php }else{ ?>
										    <img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['main_product_image']; ?>">
										<?php } ?>
									</div>
									<div class="col-md-12">
										<h3>Second Product Image</h3>
										<?php if($row['second_product_image'] == ''){ ?>
									        <img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/product_image/default.jpg">
										<?php }else{ ?>
										    <img class="img-responsive thumbnail" alt="Profile Picture" src="<?php echo base_url(); ?>uploads/product_image/<?php echo $row['second_product_image']; ?>">
										<?php } ?>
									</div>
								</div>
								<div class="col-md-7">
									<div class="productdetaildiv">
										<h3>Product Detail</h3>
										<table class="table table-striped" style="border-radius:3px;">
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td"><?php echo $row['product_name']?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('category');?></td>
												<td class="custom_td">
													<?php  if($row['category_id'] != '' && $row['category_id'] != '0'){ echo get_field_id_name('category','category_id','category_name',$row['category_id']); }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('sub-category');?></td>
												<td class="custom_td">
													<?php if($row['sub_category_id'] != '' && $row['sub_category_id'] != '0'){ echo get_field_id_name('sub_category','sub_category_id','sub_category_name',$row['sub_category_id']); }else { echo '- - - N/A - - -'; } ?>
												</td>
											</tr>
										</table>
										<?php if($row['product_details'] != ''){ ?>
										<?php
											$decode_data = json_decode($row['product_details'],true);
											$total_row = array();
											for($j=1; $j<=count($decode_data); $j++){ 
												$total_row[] = $j;
											} 
											
											$final_total_row = implode(",",$total_row);
										?>
											<table class="table table-striped" style="border-radius:3px;">
												<?php foreach($decode_data as $rows){ ?>
													<tr>
														<td class="custom_td_title"><?php echo $rows['option_name'];?></td>
														<td class="custom_td"><?php echo $rows['option_value']?></td>
													</tr>
												<?php }?>
											</table>
										<?php } ?>
										<?php if($row['product_options'] != ''){ ?>
										<?php
											$decode_datas = json_decode($row['product_options'],true);
											//echo "<pre>"; print_r($decode_datas);
											$total_rows = array();
											for($js=1; $js<=count($decode_datas); $js++){ 
												$total_rows[] = $js;
											} 
											
											$final_total_rows = implode(",",$total_rows);
										?>
											<table class="table table-striped" style="border-radius:3px;">
												<?php foreach($decode_datas as $rowss){ ?>
													<tr>
														<td class="custom_td_title"><?php echo $rowss['title'];?></td>
														<td class="custom_td"><img src="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>"></td>
													</tr>
												<?php }?>
											</table>
										<?php } ?>
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